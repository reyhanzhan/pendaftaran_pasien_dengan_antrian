<?php

namespace App\Http\Controllers;

use App\Models\JadwalPraktek;
use App\Models\AntrianPasien;
use Illuminate\Http\Request;
use Carbon\Carbon; // Digunakan untuk membandingkan tanggal

class AntrianController extends Controller
{
    /**
     * Menampilkan daftar jadwal yang tersedia untuk pendaftaran.
     */
    public function index()
    {
        // Ambil jadwal yang tanggalnya belum lewat hari ini
        $today = Carbon::today()->toDateString();
        
        // Mengambil semua jadwal yang akan datang atau hari ini.
        // Eager load dokter dan hitung antrian yang sudah terdaftar
        $jadwals = JadwalPraktek::where('tanggal_praktek', '>=', $today)
            ->with('dokter')
            // ->withCount('antrianPasiens')
            ->orderBy('tanggal_praktek', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('pasien.antrian.jadwal', compact('jadwals')); // View yang berisi tabel jadwal dan tombol daftar
    }

    /**
     * Memproses pendaftaran antrian pasien.
     * Logic ini memastikan: 1 antrian per pasien (via no_telp) dan nomor antrian unik.
     */
    public function daftar(Request $request)
    {
        // Validasi input data pasien
        $request->validate([
            'jadwal_praktek_id' => 'required|exists:jadwal_prakteks,id',
            'nama_pasien' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20', 
        ]);

        $jadwal = JadwalPraktek::findOrFail($request->jadwal_praktek_id);
        $tanggalPraktek = $jadwal->tanggal_praktek;

        // 1. Validasi Satu Antrian Per Pasien (menggunakan no_telp sebagai ID pasien)
        $sudahDaftar = AntrianPasien::where('no_telp', $request->no_telp)
                                    ->where('tanggal_praktek', $tanggalPraktek)
                                    ->exists();
        
        if ($sudahDaftar) {
            return back()->with('error', 'Anda hanya diizinkan mendaftar satu antrian per hari.');
        }

        // Hitung Antrian Saat Ini
        $jumlahAntrianSaatIni = AntrianPasien::where('jadwal_praktek_id', $jadwal->id)
                                             ->where('tanggal_praktek', $tanggalPraktek)
                                             ->count();

        // 2. Validasi Kuota Penuh
        if ($jumlahAntrianSaatIni >= $jadwal->kuota) {
            return back()->with('error', 'Kuota antrian untuk jadwal ini sudah penuh.');
        }

        // 3. Penentuan Nomor Antrian Unik
        // Ambil nomor antrian terbesar untuk jadwal dan tanggal ini
        $antrianTerakhir = AntrianPasien::where('jadwal_praktek_id', $jadwal->id)
                                        ->where('tanggal_praktek', $tanggalPraktek)
                                        ->orderByDesc('nomor_antrian')
                                        ->first();

        $nomorAntrianBaru = $antrianTerakhir ? ($antrianTerakhir->nomor_antrian + 1) : 1;
        
        // Simpan Data Pendaftaran
        AntrianPasien::create([
            'jadwal_praktek_id' => $jadwal->id,
            'nama_pasien' => $request->nama_pasien,
            'no_telp' => $request->no_telp,
            'tanggal_praktek' => $tanggalPraktek,
            'nomor_antrian' => $nomorAntrianBaru,
        ]);

        return redirect()->back()->with('success', "Pendaftaran berhasil! Nomor antrian Anda: **$nomorAntrianBaru**.");
    }
}