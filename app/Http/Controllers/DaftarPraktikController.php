<?php

namespace App\Http\Controllers;

use App\Models\JadwalPraktek;
use App\Models\Dokter; // Asumsi Anda punya model Dokter
use Illuminate\Http\Request;



class DaftarPraktikController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal praktek.
     */
    public function index()
    {
        // KOREKSI: Tambahkan withCount('antrianPasiens')
        $jadwals = JadwalPraktek::with('dokter')
            // ->withCount('antrianPasiens') 
            ->orderBy('tanggal_praktek', 'asc')
            ->get();

        // KOREKSI: Pastikan path view sudah benar sesuai C:\...\resources\views\jadwal_praktik\index.blade.php
        return view('jadwal_praktik.index', compact('jadwals'));
    }

    /**
     * Menampilkan form untuk membuat jadwal baru.
     */
    public function create()
    {
        $dokters = Dokter::all(); // Ambil semua data dokter
        return view('jadwal_praktik.create', compact('dokters'));
    }

    /**
     * Menyimpan jadwal praktek baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_praktek' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        JadwalPraktek::create($request->all());

        return redirect()->route('jadwal_praktik.index')->with('success', 'Jadwal praktek berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail jadwal (opsional).
     */
    public function show(JadwalPraktek $jadwal)
    {
        return view('jadwal_praktik.show', compact('jadwal'));
    }

    /**
     * Menampilkan form untuk mengedit jadwal.
     */
    public function edit(JadwalPraktek $jadwal)
    {
        $dokters = Dokter::all();
        return view('jadwal_praktik.edit', compact('jadwal', 'dokters'));
    }

    /**
     * Memperbarui jadwal praktek di database.
     */
    public function update(Request $request, JadwalPraktek $jadwal)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_praktek' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal praktek berhasil diperbarui!');
    }

    /**
     * Menghapus jadwal praktek.
     */
    public function destroy(JadwalPraktek $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal praktek berhasil dihapus!');
    }
}