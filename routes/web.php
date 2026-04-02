<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarPraktikController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\CariDokterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfilPasienController;
use App\Http\Controllers\HasilLabController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDokterController;
use App\Http\Controllers\Admin\AdminJadwalController;
use App\Http\Controllers\Admin\AdminPasienController;
use App\Http\Controllers\Admin\AdminAntrianController;
use App\Http\Controllers\Admin\AdminHasilLabController;
use App\Http\Controllers\Dokter\DokterDashboardController;
use App\Http\Controllers\Dokter\DokterJadwalController;
use App\Http\Controllers\Dokter\DokterKonsultasiController;
use App\Http\Controllers\Dokter\DokterProfilController;
use App\Http\Controllers\DashboardController;

// Public routes
Route::view('/', 'welcome');
Route::get('/cari-dokter', [CariDokterController::class, 'index'])->name('cari-dokter');

// API routes (can be moved to api.php if needed)
Route::prefix('api')->group(function () {
    Route::get('/dokters', [CariDokterController::class, 'getDokters']);
    Route::get('/dokters/{id}/jadwals', [CariDokterController::class, 'getJadwals']);
    Route::get('/spesialis', [CariDokterController::class, 'getSpesialis']);
    Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
    Route::get('/pendaftaran/slots/{jadwalId}', [PendaftaranController::class, 'getSlots']);
    Route::post('/pendaftaran/check-status', [PendaftaranController::class, 'checkStatus']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/jadwal_praktik', [DaftarPraktikController::class, 'index'])
        ->name('jadwal_praktik.index');

    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('/konsultasi', [KonsultasiController::class, 'index'])
        ->name('konsultasi.index');

    Route::post('/konsultasi/take', [KonsultasiController::class, 'takeNumber'])
        ->name('konsultasi.take');

    Route::get('/konsultasi/nomor', [KonsultasiController::class, 'show'])
        ->name('konsultasi.show');

    // Profil Pasien
    Route::get('/profil', [ProfilPasienController::class, 'index'])
        ->name('profil.index');
    Route::put('/profil', [ProfilPasienController::class, 'update'])
        ->name('profil.update');
    Route::put('/profil/password', [ProfilPasienController::class, 'updatePassword'])
        ->name('profil.password');

    // Hasil Lab
    Route::get('/hasil-lab', [HasilLabController::class, 'index'])
        ->name('hasil-lab.index');
    Route::get('/hasil-lab/{hasilLab}', [HasilLabController::class, 'show'])
        ->name('hasil-lab.show');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // CRUD Dokter
    Route::resource('dokter', AdminDokterController::class);
    
    // CRUD Jadwal
    Route::resource('jadwal', AdminJadwalController::class);
    
    // CRUD Pasien
    Route::resource('pasien', AdminPasienController::class);
    
    // CRUD Antrian
    Route::resource('antrian', AdminAntrianController::class);
    
    // CRUD Hasil Lab
    Route::resource('hasil-lab', AdminHasilLabController::class);
});

// Dokter Routes
Route::middleware(['auth', 'verified', 'dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/', [DokterDashboardController::class, 'index'])->name('dashboard');

    // Jadwal Praktek CRUD
    Route::resource('jadwal', DokterJadwalController::class)->except(['show']);

    // Konsultasi / Antrian
    Route::get('/konsultasi', [DokterKonsultasiController::class, 'index'])->name('konsultasi.index');
    Route::get('/konsultasi/{id}', [DokterKonsultasiController::class, 'show'])->name('konsultasi.show');
    Route::put('/konsultasi/{id}/status', [DokterKonsultasiController::class, 'updateStatus'])->name('konsultasi.updateStatus');
    Route::post('/konsultasi/call-next', [DokterKonsultasiController::class, 'callNext'])->name('konsultasi.callNext');

    // Profil Dokter
    Route::get('/profil', [DokterProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [DokterProfilController::class, 'update'])->name('profil.update');
});

require __DIR__.'/auth.php';
