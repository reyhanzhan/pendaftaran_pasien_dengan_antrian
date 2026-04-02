<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPraktek;
use Illuminate\Http\Request;

class CariDokterController extends Controller
{
    /**
     * Display the Cari Dokter page
     */
    public function index()
    {
        $dokters = Dokter::with(['jadwalPrakteks' => function ($query) {
            $query->where('tanggal_praktek', '>=', now()->toDateString())
                  ->where('is_active', true);
        }])->get()->map(function ($dokter) {
            return [
                'id' => $dokter->id,
                'kode_dokter' => $dokter->kode_dokter,
                'nama_dokter' => $dokter->nama_dokter,
                'spesialisasi' => $dokter->spesialisasi ?? 'Dokter Umum',
                'rumah_sakit' => $dokter->rumah_sakit ?? 'RS Sehat Sentosa',
                'foto' => $dokter->foto ?? null,
                'tersedia' => $dokter->jadwalPrakteks->count() > 0,
                'konsultasi_online' => $dokter->konsultasi_online ?? false,
                'tipe' => $dokter->konsultasi_online ? 'online' : 'kunjung',
            ];
        });

        $spesialis = $this->getSpesialisList();

        return view('cari-dokter', compact('dokters', 'spesialis'));
    }

    /**
     * Get all dokters (API)
     */
    public function getDokters(Request $request)
    {
        $query = Dokter::with(['jadwalPrakteks' => function ($q) {
            $q->where('tanggal_praktek', '>=', now()->toDateString())
              ->where('is_active', true);
        }]);

        // Filter by search query
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_dokter', 'like', "%{$search}%")
                  ->orWhere('spesialisasi', 'like', "%{$search}%");
            });
        }

        // Filter by spesialisasi
        if ($request->has('spesialisasi')) {
            $query->where('spesialisasi', $request->spesialisasi);
        }

        $dokters = $query->get()->map(function ($dokter) {
            return [
                'id' => $dokter->id,
                'kode_dokter' => $dokter->kode_dokter,
                'nama_dokter' => $dokter->nama_dokter,
                'spesialisasi' => $dokter->spesialisasi ?? 'Dokter Umum',
                'rumah_sakit' => $dokter->rumah_sakit ?? 'RS Sehat Sentosa',
                'foto' => $dokter->foto ?? null,
                'tersedia' => $dokter->jadwalPrakteks->count() > 0,
                'konsultasi_online' => $dokter->konsultasi_online ?? false,
                'tipe' => $dokter->konsultasi_online ? 'online' : 'kunjung',
            ];
        });

        return response()->json(['data' => $dokters]);
    }

    /**
     * Get jadwal praktek for a dokter (API)
     */
    public function getJadwals($dokterId)
    {
        $jadwals = JadwalPraktek::where('dokter_id', $dokterId)
            ->where('tanggal_praktek', '>=', now()->toDateString())
            ->where('is_active', true)
            ->orderBy('tanggal_praktek')
            ->get()
            ->map(function ($jadwal) {
                return [
                    'id' => $jadwal->id,
                    'tanggal_praktek' => $jadwal->tanggal_praktek,
                    'jam_mulai' => $jadwal->jam_mulai,
                    'jam_selesai' => $jadwal->jam_selesai,
                    'kuota' => $jadwal->kuota,
                    'terisi' => $jadwal->terisi,
                    'tersedia' => ($jadwal->kuota - $jadwal->terisi) > 0,
                ];
            });

        return response()->json(['data' => $jadwals]);
    }

    /**
     * Get list of spesialis
     */
    public function getSpesialis()
    {
        return response()->json(['data' => $this->getSpesialisList()]);
    }

    /**
     * Helper method to get spesialis list
     */
    private function getSpesialisList()
    {
        return [
            ['id' => 1, 'nama' => 'Akupunktur'],
            ['id' => 2, 'nama' => 'Andrologi (Reproduksi Pria)'],
            ['id' => 3, 'nama' => 'Anestesiologi'],
            ['id' => 4, 'nama' => 'Bedah Anak'],
            ['id' => 5, 'nama' => 'Bedah Digestif'],
            ['id' => 6, 'nama' => 'Bedah Onkologi (Kanker)'],
            ['id' => 7, 'nama' => 'Bedah Plastik'],
            ['id' => 8, 'nama' => 'Bedah Saraf'],
            ['id' => 9, 'nama' => 'Bedah Toraks Kardiovaskular'],
            ['id' => 10, 'nama' => 'Bedah Umum'],
            ['id' => 11, 'nama' => 'Bedah Vaskular'],
            ['id' => 12, 'nama' => 'Dermatologi (Kulit)'],
            ['id' => 13, 'nama' => 'Farmakologi Klinik'],
            ['id' => 14, 'nama' => 'Gizi Klinik'],
            ['id' => 15, 'nama' => 'Kardiologi (Jantung)'],
            ['id' => 16, 'nama' => 'Kedokteran Gigi'],
            ['id' => 17, 'nama' => 'Kedokteran Nuklir'],
            ['id' => 18, 'nama' => 'Kedokteran Okupasi'],
            ['id' => 19, 'nama' => 'Kedokteran Olahraga'],
            ['id' => 20, 'nama' => 'Kedokteran Umum'],
            ['id' => 21, 'nama' => 'Laboratorium Medis'],
            ['id' => 22, 'nama' => 'Lainnya'],
            ['id' => 23, 'nama' => 'Neurologi (Otak dan Sistem Saraf)'],
            ['id' => 24, 'nama' => 'Obstetri dan Ginekologi (Kandungan)'],
            ['id' => 25, 'nama' => 'Oftalmologi (Mata)'],
            ['id' => 26, 'nama' => 'Onkologi (Kanker)'],
            ['id' => 27, 'nama' => 'Onkologi Radiasi'],
            ['id' => 28, 'nama' => 'Ortopedi (Tulang)'],
            ['id' => 29, 'nama' => 'Otorinolaringologi (THTBKL)'],
            ['id' => 30, 'nama' => 'Pediatrik (Anak)'],
            ['id' => 31, 'nama' => 'Pengobatan Darurat'],
            ['id' => 32, 'nama' => 'Penyakit Dalam'],
            ['id' => 33, 'nama' => 'Psikiatri'],
            ['id' => 34, 'nama' => 'Psikologi'],
            ['id' => 35, 'nama' => 'Pulmonologi (Paru)'],
            ['id' => 36, 'nama' => 'Radiologi'],
            ['id' => 37, 'nama' => 'Rehabilitasi Medik'],
            ['id' => 38, 'nama' => 'Urologi'],
        ];
    }
}
