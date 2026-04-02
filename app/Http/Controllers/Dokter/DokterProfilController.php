<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterProfilController extends Controller
{
    public function index()
    {
        $dokter = Auth::user()->dokter;
        return view('dokter.profil.index', compact('dokter'));
    }

    public function update(Request $request)
    {
        $dokter = Auth::user()->dokter;

        $validated = $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'rumah_sakit' => 'nullable|string|max:255',
            'konsultasi_online' => 'boolean',
        ]);

        $validated['konsultasi_online'] = $request->has('konsultasi_online');
        $dokter->update($validated);

        return redirect()->route('dokter.profil.index')
            ->with('success', 'Profil dokter berhasil diupdate!');
    }
}
