<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Antrian;


class KonsultasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan halaman konsultasi / tombol ambil nomor
    public function index()
    {
        return view('konsultasi.index');
    }

    // Ambil nomor antrian aman (transaction + lock)
    public function takeNumber(Request $request)
    {
        $userId = $request->user()->id;

        $nomor = DB::transaction(function () use ($userId) {
            // lock last row to prevent race condition
            $last = DB::table('antrians')
                ->lockForUpdate()
                ->orderBy('nomor', 'desc')
                ->first();

            $next = ($last->nomor ?? 0) + 1;

            DB::table('antrians')->insert([
                'user_id'    => $userId,
                'nomor'      => $next,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $next;
        });

        return redirect()->route('konsultasi.show')->with('nomor_antrian', $nomor);
    }

    public function show()
    {
        $nomor = session('nomor_antrian');
        return view('konsultasi.show', compact('nomor'));
    }
}