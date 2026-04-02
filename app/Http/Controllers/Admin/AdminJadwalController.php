<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktek;
use App\Models\Dokter;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPraktek::with('dokter')
            ->orderBy('tanggal_praktek', 'desc')
            ->paginate(15);
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $dokters = Dokter::orderBy('nama_dokter')->get();
        return view('admin.jadwal.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dokter_id' => ['required', 'exists:dokters,id'],
            'tanggal_praktek' => ['required', 'date', 'after_or_equal:today'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'kuota' => ['required', 'integer', 'min:1', 'max:100'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['terisi'] = 0;

        JadwalPraktek::create($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal praktek berhasil ditambahkan!');
    }

    public function show(JadwalPraktek $jadwal)
    {
        $jadwal->load(['dokter', 'pendaftarans.user']);
        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function edit(JadwalPraktek $jadwal)
    {
        $dokters = Dokter::orderBy('nama_dokter')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'dokters'));
    }

    public function update(Request $request, JadwalPraktek $jadwal)
    {
        $validated = $request->validate([
            'dokter_id' => ['required', 'exists:dokters,id'],
            'tanggal_praktek' => ['required', 'date'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'kuota' => ['required', 'integer', 'min:1', 'max:100'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal praktek berhasil diperbarui!');
    }

    public function destroy(JadwalPraktek $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal praktek berhasil dihapus!');
    }
}
