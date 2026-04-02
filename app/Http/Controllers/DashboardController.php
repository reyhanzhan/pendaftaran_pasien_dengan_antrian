<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'dokter') {
            return redirect()->route('dokter.dashboard');
        }

        // Pasien - show regular dashboard
        return view('dashboard');
    }
}
