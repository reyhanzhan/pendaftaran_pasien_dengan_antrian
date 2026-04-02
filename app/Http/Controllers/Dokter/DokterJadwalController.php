<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterJadwalController extends Controller
{
    public function index()
    {
        $dokter = Auth::user()->dokter;
        $jadwals = JadwalPraktek::where('dokter_id', $dokter->id)
            ->orderBy('tanggal_praktek', 'desc')
            ->paginate(15);

        return view('dokter.jadwal.index', compact('jadwals', 'dokter'));
    }

    public function create()
    {
        return view('dokter.jadwal.create');
    }

    public function store(Request $request)
    {
        $dokter = Auth::user()->dokter;

        $validated = $request->validate([
            'tanggal_praktek' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota' => 'required|integer|min:1|max:100',
        ]);

        $validated['dokter_id'] = $dokter->id;
        $validated['terisi'] = 0;
        $validated['is_active'] = true;

        JadwalPraktek::create($validated);

        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal praktek berhasil ditambahkan!');
    }

    public function edit(JadwalPraktek $jadwal)
    {
        $dokter = Auth::user()->dokter;
        if ($jadwal->dokter_id !== $dokter->id) {
            abort(403);
        }

        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalPraktek $jadwal)
    {
        $dokter = Auth::user()->dokter;
        if ($jadwal->dokter_id !== $dokter->id) {
            abort(403);
        }

        $validated = $request->validate([
            'tanggal_praktek' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota' => 'required|integer|min:1|max:100',
            'is_active' => 'required|boolean',
        ]);

        $jadwal->update($validated);

        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal praktek berhasil diupdate!');
    }

    public function destroy(JadwalPraktek $jadwal)
    {
        $dokter = Auth::user()->dokter;
        if ($jadwal->dokter_id !== $dokter->id) {
            abort(403);
        }

        $jadwal->delete();

        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal praktek berhasil dihapus!');
    }
}
