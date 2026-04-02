<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminPasienController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('is_admin', false);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        $pasiens = $query->orderBy('name')->paginate(15);
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'nik' => ['nullable', 'string', 'size:16', 'unique:users'],
            'no_telp' => ['nullable', 'string', 'max:20'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string', 'max:500'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = false;

        User::create($validated);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Pasien berhasil ditambahkan!');
    }

    public function show(User $pasien)
    {
        $pasien->load(['hasilLabs' => function($q) {
            $q->orderBy('tanggal_pemeriksaan', 'desc')->limit(5);
        }]);
        
        $antrians = \DB::table('antrians')
            ->where('user_id', $pasien->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.pasien.show', compact('pasien', 'antrians'));
    }

    public function edit(User $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, User $pasien)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($pasien->id)],
            'nik' => ['nullable', 'string', 'size:16', Rule::unique('users')->ignore($pasien->id)],
            'no_telp' => ['nullable', 'string', 'max:20'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'golongan_darah' => ['nullable', 'in:A,B,AB,O'],
            'alergi' => ['nullable', 'string', 'max:500'],
            'riwayat_penyakit' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => ['string', 'min:8']]);
            $validated['password'] = Hash::make($request->password);
        }

        $pasien->update($validated);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(User $pasien)
    {
        $pasien->delete();

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Pasien berhasil dihapus!');
    }
}
