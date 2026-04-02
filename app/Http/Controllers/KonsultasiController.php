<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPraktek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    // Tampilkan halaman konsultasi / tombol ambil nomor
    public function index()
    {
        $dokters = Dokter::with(['jadwalPrakteks' => function ($query) {
            $query->where('tanggal_praktek', '>=', now()->toDateString())
                  ->where('is_active', true)
                  ->orderBy('tanggal_praktek');
        }])->get();

        return view('konsultasi.index', compact('dokters'));
    }

    // Ambil nomor antrian aman (transaction + lock + time slot)
    public function takeNumber(Request $request)
    {
        $request->validate([
            'jadwal_praktek_id' => 'required|exists:jadwal_prakteks,id',
            'slot_waktu' => 'required|string',
        ]);

        $userId = $request->user()->id;
        $user = $request->user();

        try {
            $antrian = DB::transaction(function () use ($userId, $user, $request) {
                // Lock the jadwal_praktek row
                $jadwal = JadwalPraktek::where('id', $request->jadwal_praktek_id)
                    ->lockForUpdate()
                    ->first();

                if (!$jadwal || !$jadwal->is_active) {
                    throw new \Exception('Jadwal praktek tidak tersedia');
                }

                // Check kuota
                if ($jadwal->terisi >= $jadwal->kuota) {
                    throw new \Exception('Kuota jadwal sudah penuh');
                }

                // Check if user already has active queue for this jadwal
                $existing = DB::table('antrians')
                    ->where('user_id', $userId)
                    ->where('dokter_id', $jadwal->dokter_id)
                    ->where('tanggal', $jadwal->tanggal_praktek)
                    ->whereIn('status', ['menunggu', 'dipanggil'])
                    ->lockForUpdate()
                    ->first();

                if ($existing) {
                    throw new \Exception('Anda sudah memiliki nomor antrian aktif. Nomor: ' . $existing->nomor);
                }

                // Check slot availability (max 5 per slot by default)
                $maxPerSlot = config('antrian.max_per_slot', 5);
                $slotCount = DB::table('antrians')
                    ->where('dokter_id', $jadwal->dokter_id)
                    ->where('tanggal', $jadwal->tanggal_praktek)
                    ->where('jam_mulai', $request->slot_waktu)
                    ->whereIn('status', ['menunggu', 'dipanggil'])
                    ->lockForUpdate()
                    ->count();

                if ($slotCount >= $maxPerSlot) {
                    throw new \Exception('Slot waktu ' . $request->slot_waktu . ' sudah penuh. Silakan pilih slot lain.');
                }

                // Get next queue number for this dokter on this date (using pessimistic lock)
                $lastQueue = DB::table('antrians')
                    ->where('dokter_id', $jadwal->dokter_id)
                    ->where('tanggal', $jadwal->tanggal_praktek)
                    ->lockForUpdate()
                    ->orderBy('nomor', 'desc')
                    ->first();

                $next = ($lastQueue->nomor ?? 0) + 1;

                // Parse slot time
                $slotTime = $request->slot_waktu;
                $slotDuration = config('antrian.slot_duration', 60);
                $slotEnd = date('H:i', strtotime($slotTime) + ($slotDuration * 60));

                // Insert new queue entry
                $id = DB::table('antrians')->insertGetId([
                    'user_id'      => $userId,
                    'dokter_id'    => $jadwal->dokter_id,
                    'nomor'        => $next,
                    'hari'         => now()->locale('id')->dayName,
                    'tanggal'      => $jadwal->tanggal_praktek,
                    'jam_mulai'    => $slotTime,
                    'jam_selesai'  => $slotEnd,
                    'status'       => 'menunggu',
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                // Increment terisi
                $jadwal->increment('terisi');

                return DB::table('antrians')->find($id);
            });

            return redirect()->route('konsultasi.show')
                ->with('success', 'Nomor antrian berhasil didapatkan!')
                ->with('antrian', $antrian);
        } catch (\Exception $e) {
            return redirect()->route('konsultasi.index')
                ->with('error', $e->getMessage());
        }
    }

    public function show()
    {
        $antrian = session('antrian');
        
        // If no antrian in session, get the latest from DB
        if (!$antrian && Auth::check()) {
            $antrian = DB::table('antrians')
                ->where('user_id', Auth::id())
                ->whereIn('status', ['menunggu', 'dipanggil'])
                ->where('tanggal', '>=', now()->toDateString())
                ->orderBy('created_at', 'desc')
                ->first();
        }

        // Get dokter info if antrian exists
        $dokter = null;
        if ($antrian && $antrian->dokter_id) {
            $dokter = Dokter::find($antrian->dokter_id);
        }

        return view('konsultasi.show', compact('antrian', 'dokter'));
    }

    /**
     * Get available time slots for a jadwal (API)
     */
    public function getSlots(Request $request, $jadwalId)
    {
        $jadwal = JadwalPraktek::find($jadwalId);
        
        if (!$jadwal) {
            return response()->json(['error' => 'Jadwal tidak ditemukan'], 404);
        }

        $slots = [];
        $startTime = strtotime($jadwal->jam_mulai);
        $endTime = strtotime($jadwal->jam_selesai);
        $slotDuration = config('antrian.slot_duration', 60) * 60;
        $maxPerSlot = config('antrian.max_per_slot', 5);

        while ($startTime < $endTime) {
            $slotStart = date('H:i', $startTime);
            
            // Count existing registrations for this slot
            $count = DB::table('antrians')
                ->where('dokter_id', $jadwal->dokter_id)
                ->where('tanggal', $jadwal->tanggal_praktek)
                ->where('jam_mulai', $slotStart)
                ->whereIn('status', ['menunggu', 'dipanggil'])
                ->count();

            $slots[] = [
                'waktu' => $slotStart,
                'terisi' => $count >= $maxPerSlot,
                'sisa' => max(0, $maxPerSlot - $count),
            ];

            $startTime += $slotDuration;
        }

        return response()->json(['data' => $slots]);
    }
}