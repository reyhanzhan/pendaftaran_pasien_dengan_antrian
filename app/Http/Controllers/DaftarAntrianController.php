<?php

namespace App\Http\Controllers;

use App\Models\AntrianPasien;
use App\Models\JadwalPraktek;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DaftarAntrianController extends Controller
{
    public function daftarAntrian(Request $request)
{
    // Ambil ID pasien yang sedang login
    $userId = Auth::id(); 
    $jadwalId = $request->jadwal_praktek_id;
    $tanggalPraktek = $request->tanggal_praktek;

    // 1. Validasi Keberadaan Antrian (Satu antrian per pasien per tanggal)
    $antrianSudahAda = AntrianPasien::where('user_id', $userId)
                                    ->where('tanggal_praktek', $tanggalPraktek)
                                    ->exists();

    if ($antrianSudahAda) {
        return back()->with('error', 'Anda sudah mendaftar untuk tanggal ini.');
    }

    // Ambil Data Jadwal
    $jadwal = JadwalPraktek::findOrFail($jadwalId);

    // 2. Validasi Kuota
    $jumlahAntrianSaatIni = AntrianPasien::where('jadwal_praktek_id', $jadwalId)
                                         ->where('tanggal_praktek', $tanggalPraktek)
                                         ->count();

    if ($jumlahAntrianSaatIni >= $jadwal->kuota) {
        return back()->with('error', 'Kuota antrian untuk jadwal ini sudah penuh.');
    }

    // 3. Penentuan Nomor Antrian (Nomor Antrian Unik)
    // Cari nomor antrian terbesar saat ini untuk jadwal ini
    $antrianTerakhir = AntrianPasien::where('jadwal_praktek_id', $jadwalId)
                                     ->where('tanggal_praktek', $tanggalPraktek)
                                     ->orderByDesc('nomor_antrian')
                                     ->first();

    $nomorAntrianBaru = $antrianTerakhir ? ($antrianTerakhir->nomor_antrian + 1) : 1;

    // 4. Simpan Antrian
    try {
        AntrianPasien::create([
            'user_id' => $userId,
            'jadwal_praktek_id' => $jadwalId,
            'tanggal_praktek' => $tanggalPraktek,
            'nomor_antrian' => $nomorAntrianBaru,
            'status' => 'menunggu',
        ]);
    } catch (\Throwable $th) {
        // Ini jarang terjadi jika logic sudah benar, tapi untuk berjaga-jaga
        return back()->with('error', 'Gagal mendaftar antrian. Silakan coba lagi.');
    }
    

    return redirect()->route('halaman.antrian')->with('success', 'Pendaftaran berhasil. Nomor antrian Anda: ' . $nomorAntrianBaru);
}
}
