<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\JadwalPraktek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    /**
     * Store a new pendaftaran (patient registration)
     * Uses database transaction with pessimistic locking to prevent race conditions
     */
    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|size:16',
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required|string|max:20',
            'jadwal_praktek_id' => 'required|exists:jadwal_prakteks,id',
            'slot_waktu' => 'required|string',
            'keluhan' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Validate NIK format
        if (!$this->validateNik($request->nik)) {
            return response()->json([
                'success' => false,
                'message' => 'Format NIK tidak valid'
            ], 422);
        }

        try {
            $result = DB::transaction(function () use ($request) {
                // Lock the jadwal_praktek row to prevent race condition
                $jadwal = JadwalPraktek::where('id', $request->jadwal_praktek_id)
                    ->lockForUpdate()
                    ->first();

                if (!$jadwal) {
                    throw new \Exception('Jadwal praktek tidak ditemukan');
                }

                if (!$jadwal->is_active) {
                    throw new \Exception('Jadwal praktek tidak aktif');
                }

                // Check if slot is still available
                if ($jadwal->terisi >= $jadwal->kuota) {
                    throw new \Exception('Kuota jadwal sudah penuh');
                }

                // Check for duplicate NIK on same jadwal and slot
                $existingPendaftaran = Pendaftaran::where('jadwal_praktek_id', $request->jadwal_praktek_id)
                    ->where('nik', $request->nik)
                    ->where('slot_waktu', $request->slot_waktu)
                    ->whereIn('status', ['menunggu', 'dipanggil'])
                    ->lockForUpdate()
                    ->first();

                if ($existingPendaftaran) {
                    throw new \Exception('Anda sudah terdaftar pada jadwal dan slot waktu ini');
                }

                // Generate unique queue number using FCFS algorithm
                // Format: [KODE_DOKTER][DATE][SEQUENCE] e.g., "A20260302001"
                $prefix = $this->generateQueuePrefix($jadwal);
                $lastQueue = Pendaftaran::where('jadwal_praktek_id', $jadwal->id)
                    ->where('no_antrian', 'like', $prefix . '%')
                    ->lockForUpdate()
                    ->orderBy('no_antrian', 'desc')
                    ->first();

                $sequence = 1;
                if ($lastQueue) {
                    $lastSequence = (int) substr($lastQueue->no_antrian, -3);
                    $sequence = $lastSequence + 1;
                }

                $noAntrian = $prefix . str_pad($sequence, 3, '0', STR_PAD_LEFT);

                // Create pendaftaran
                $pendaftaran = Pendaftaran::create([
                    'jadwal_praktek_id' => $request->jadwal_praktek_id,
                    'nik' => $request->nik,
                    'no_antrian' => $noAntrian,
                    'nama_pasien' => $request->nama_pasien,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'no_telp' => $request->no_telp,
                    'slot_waktu' => $request->slot_waktu,
                    'keluhan' => $request->keluhan,
                    'status' => 'menunggu',
                ]);

                // Increment terisi count
                $jadwal->increment('terisi');

                return $pendaftaran;
            });

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil',
                'data' => [
                    'id' => $result->id,
                    'no_antrian' => $result->no_antrian,
                    'nama_pasien' => $result->nama_pasien,
                    'slot_waktu' => $result->slot_waktu,
                    'status' => $result->status,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get available time slots for a jadwal
     */
    public function getSlots($jadwalId)
    {
        $jadwal = JadwalPraktek::find($jadwalId);
        
        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ], 404);
        }

        $slots = $this->generateTimeSlots($jadwal);
        
        // Get occupied slots
        $occupiedSlots = Pendaftaran::where('jadwal_praktek_id', $jadwalId)
            ->whereIn('status', ['menunggu', 'dipanggil'])
            ->select('slot_waktu', DB::raw('COUNT(*) as count'))
            ->groupBy('slot_waktu')
            ->pluck('count', 'slot_waktu')
            ->toArray();

        // Max patients per slot (configurable, default 5)
        $maxPerSlot = config('antrian.max_per_slot', 5);

        $availableSlots = [];
        foreach ($slots as $slot) {
            $occupied = $occupiedSlots[$slot['waktu']] ?? 0;
            $availableSlots[] = [
                'waktu' => $slot['waktu'],
                'slot_start' => $slot['slot_start'],
                'slot_end' => $slot['slot_end'],
                'terisi' => $occupied >= $maxPerSlot,
                'sisa' => max(0, $maxPerSlot - $occupied),
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $availableSlots
        ]);
    }

    /**
     * Generate queue number prefix
     */
    private function generateQueuePrefix(JadwalPraktek $jadwal): string
    {
        $dokter = $jadwal->dokter;
        $prefix = strtoupper(substr($dokter->kode_dokter ?? 'A', 0, 1));
        $date = date('Ymd', strtotime($jadwal->tanggal_praktek));
        return $prefix . $date;
    }

    /**
     * Generate time slots for a jadwal
     */
    private function generateTimeSlots(JadwalPraktek $jadwal): array
    {
        $slots = [];
        $startTime = strtotime($jadwal->jam_mulai);
        $endTime = strtotime($jadwal->jam_selesai);
        
        // Each slot is 1 hour (configurable)
        $slotDuration = config('antrian.slot_duration', 60) * 60; // in seconds

        while ($startTime < $endTime) {
            $slotEnd = min($startTime + $slotDuration, $endTime);
            $slots[] = [
                'waktu' => date('H:i', $startTime),
                'slot_start' => date('H:i', $startTime),
                'slot_end' => date('H:i', $slotEnd),
            ];
            $startTime = $slotEnd;
        }

        return $slots;
    }

    /**
     * Validate Indonesian NIK (Nomor Induk Kependudukan)
     */
    private function validateNik(string $nik): bool
    {
        // NIK must be 16 digits
        if (!preg_match('/^\d{16}$/', $nik)) {
            return false;
        }

        // Province code (first 2 digits) should be valid (11-94)
        $provinsi = (int) substr($nik, 0, 2);
        if ($provinsi < 11 || $provinsi > 94) {
            return false;
        }

        // Date of birth validation (digits 7-12)
        $tanggal = (int) substr($nik, 6, 2);
        $bulan = (int) substr($nik, 8, 2);
        
        // For women, date is added by 40
        $actualTanggal = $tanggal > 40 ? $tanggal - 40 : $tanggal;
        
        if ($actualTanggal < 1 || $actualTanggal > 31) {
            return false;
        }
        
        if ($bulan < 1 || $bulan > 12) {
            return false;
        }

        return true;
    }

    /**
     * Check queue status
     */
    public function checkStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|size:16',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $pendaftarans = Pendaftaran::where('nik', $request->nik)
            ->whereIn('status', ['menunggu', 'dipanggil'])
            ->with(['jadwalPraktek.dokter'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pendaftarans->map(function ($p) {
                return [
                    'id' => $p->id,
                    'no_antrian' => $p->no_antrian,
                    'nama_pasien' => $p->nama_pasien,
                    'slot_waktu' => $p->slot_waktu,
                    'status' => $p->status,
                    'dokter' => $p->jadwalPraktek->dokter->nama_dokter ?? null,
                    'tanggal' => $p->jadwalPraktek->tanggal_praktek ?? null,
                ];
            })
        ]);
    }
}
