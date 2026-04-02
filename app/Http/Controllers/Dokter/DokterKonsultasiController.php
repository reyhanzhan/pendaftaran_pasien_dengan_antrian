<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterKonsultasiController extends Controller
{
    public function index(Request $request)
    {
        $dokter = Auth::user()->dokter;

        $query = DB::table('antrians')
            ->join('users', 'antrians.user_id', '=', 'users.id')
            ->select(
                'antrians.*',
                'users.name as pasien_name',
                'users.nik as pasien_nik',
                'users.no_telp as pasien_telp'
            )
            ->where('antrians.dokter_id', $dokter->id);

        if ($request->tanggal) {
            $query->whereDate('antrians.tanggal', $request->tanggal);
        } else {
            $query->whereDate('antrians.tanggal', today());
        }

        if ($request->status) {
            $query->where('antrians.status', $request->status);
        }

        $antrians = $query->orderBy('antrians.nomor', 'asc')->paginate(20);

        return view('dokter.konsultasi.index', compact('antrians', 'dokter'));
    }

    public function show($id)
    {
        $dokter = Auth::user()->dokter;

        $antrian = DB::table('antrians')
            ->join('users', 'antrians.user_id', '=', 'users.id')
            ->select(
                'antrians.*',
                'users.name as pasien_name',
                'users.nik as pasien_nik',
                'users.no_telp as pasien_telp',
                'users.email as pasien_email',
                'users.jenis_kelamin',
                'users.tanggal_lahir',
                'users.golongan_darah',
                'users.alergi',
                'users.riwayat_penyakit'
            )
            ->where('antrians.dokter_id', $dokter->id)
            ->where('antrians.id', $id)
            ->first();

        if (!$antrian) {
            abort(404);
        }

        return view('dokter.konsultasi.show', compact('antrian', 'dokter'));
    }

    public function updateStatus(Request $request, $id)
    {
        $dokter = Auth::user()->dokter;

        $request->validate([
            'status' => 'required|in:menunggu,dipanggil,selesai,tidak_hadir',
        ]);

        $antrian = DB::table('antrians')
            ->where('id', $id)
            ->where('dokter_id', $dokter->id)
            ->first();

        if (!$antrian) {
            abort(404);
        }

        DB::table('antrians')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        $statusLabel = match($request->status) {
            'dipanggil' => 'dipanggil',
            'selesai' => 'selesai',
            'tidak_hadir' => 'ditandai tidak hadir',
            default => 'diupdate',
        };

        return redirect()->back()
            ->with('success', "Pasien {$antrian->nomor} berhasil {$statusLabel}!");
    }

    public function callNext()
    {
        $dokter = Auth::user()->dokter;

        // Set current dipanggil to selesai
        DB::table('antrians')
            ->where('dokter_id', $dokter->id)
            ->whereDate('tanggal', today())
            ->where('status', 'dipanggil')
            ->update(['status' => 'selesai', 'updated_at' => now()]);

        // Call next menunggu
        $next = DB::table('antrians')
            ->where('dokter_id', $dokter->id)
            ->whereDate('tanggal', today())
            ->where('status', 'menunggu')
            ->orderBy('nomor', 'asc')
            ->first();

        if ($next) {
            DB::table('antrians')
                ->where('id', $next->id)
                ->update(['status' => 'dipanggil', 'updated_at' => now()]);

            return redirect()->back()
                ->with('success', "Nomor antrian {$next->nomor} dipanggil!");
        }

        return redirect()->back()
            ->with('info', 'Tidak ada antrian yang menunggu.');
    }
}
