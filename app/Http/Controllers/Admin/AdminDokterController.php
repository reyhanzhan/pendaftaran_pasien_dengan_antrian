<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class AdminDokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::orderBy('nama_dokter')->paginate(10);
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_dokter' => ['required', 'string', 'max:50', 'unique:dokters'],
            'nama_dokter' => ['required', 'string', 'max:255'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'rumah_sakit' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'string', 'max:255'],
            'konsultasi_online' => ['boolean'],
        ]);

        $validated['konsultasi_online'] = $request->has('konsultasi_online');

        Dokter::create($validated);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function show(Dokter $dokter)
    {
        $dokter->load('jadwalPrakteks');
        return view('admin.dokter.show', compact('dokter'));
    }

    public function edit(Dokter $dokter)
    {
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'kode_dokter' => ['required', 'string', 'max:50', 'unique:dokters,kode_dokter,' . $dokter->id],
            'nama_dokter' => ['required', 'string', 'max:255'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'rumah_sakit' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'string', 'max:255'],
            'konsultasi_online' => ['boolean'],
        ]);

        $validated['konsultasi_online'] = $request->has('konsultasi_online');

        $dokter->update($validated);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Dokter berhasil dihapus!');
    }
}
