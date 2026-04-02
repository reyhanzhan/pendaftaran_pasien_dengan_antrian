<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dokter;
use App\Models\JadwalPraktek;
use App\Models\HasilLab;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pasien' => User::where('role', 'pasien')->count(),
            'total_dokter' => Dokter::count(),
            'total_jadwal' => JadwalPraktek::count(),
            'antrian_hari_ini' => DB::table('antrians')
                ->whereDate('created_at', today())
                ->count(),
            'antrian_menunggu' => DB::table('antrians')
                ->whereDate('created_at', today())
                ->where('status', 'menunggu')
                ->count(),
            'hasil_lab_pending' => HasilLab::where('status', 'proses')->count(),
        ];

        $recentAntrians = DB::table('antrians')
            ->join('users', 'antrians.user_id', '=', 'users.id')
            ->select('antrians.*', 'users.name as pasien_name')
            ->whereDate('antrians.created_at', today())
            ->orderBy('antrians.nomor', 'asc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAntrians'));
    }
}
