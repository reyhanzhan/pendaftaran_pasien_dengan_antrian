<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktek;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterDashboardController extends Controller
{
    public function index()
    {
        $dokter = Auth::user()->dokter;

        if (!$dokter) {
            return view('dokter.dashboard', ['stats' => [], 'recentAntrians' => collect(), 'dokter' => null]);
        }

        $stats = [
            'jadwal_aktif' => JadwalPraktek::where('dokter_id', $dokter->id)
                ->where('is_active', true)
                ->where('tanggal_praktek', '>=', today())
                ->count(),
            'antrian_hari_ini' => DB::table('antrians')
                ->where('dokter_id', $dokter->id)
                ->whereDate('tanggal', today())
                ->count(),
            'antrian_menunggu' => DB::table('antrians')
                ->where('dokter_id', $dokter->id)
                ->whereDate('tanggal', today())
                ->where('status', 'menunggu')
                ->count(),
            'pasien_selesai' => DB::table('antrians')
                ->where('dokter_id', $dokter->id)
                ->whereDate('tanggal', today())
                ->where('status', 'selesai')
                ->count(),
        ];

        $recentAntrians = DB::table('antrians')
            ->join('users', 'antrians.user_id', '=', 'users.id')
            ->select('antrians.*', 'users.name as pasien_name', 'users.nik as pasien_nik')
            ->where('antrians.dokter_id', $dokter->id)
            ->whereDate('antrians.tanggal', today())
            ->orderBy('antrians.nomor', 'asc')
            ->limit(20)
            ->get();

        return view('dokter.dashboard', compact('stats', 'recentAntrians', 'dokter'));
    }
}
