<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarPraktikController; // Import Controller Anda
use App\Http\Controllers\KonsultasiController;

Route::view('/', 'welcome');

Route::get('/jadwal_praktik', [DaftarPraktikController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('jadwal_praktik.index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/konsultasi', [KonsultasiController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('konsultasi.index');

Route::post('/konsultasi/take', [KonsultasiController::class, 'takeNumber'])
    ->middleware(['auth', 'verified'])
    ->name('konsultasi.take');

Route::get('/konsultasi/nomor', [KonsultasiController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('konsultasi.show');

require __DIR__.'/auth.php';
