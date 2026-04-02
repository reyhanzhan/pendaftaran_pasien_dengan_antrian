<?php

namespace App\Http\Controllers;

use App\Models\HasilLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilLabController extends Controller
{
    public function index()
    {
        $hasilLabs = HasilLab::where('user_id', Auth::id())
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->paginate(10);

        return view('hasil-lab.index', compact('hasilLabs'));
    }

    public function show(HasilLab $hasilLab)
    {
        // Ensure user can only view their own lab results
        if ($hasilLab->user_id !== Auth::id()) {
            abort(403);
        }

        return view('hasil-lab.show', compact('hasilLab'));
    }
}
