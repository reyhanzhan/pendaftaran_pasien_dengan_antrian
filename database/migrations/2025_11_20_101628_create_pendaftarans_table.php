<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 3. Tabel pendaftaran / antrian pasien (ini yang benar!)
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_praktek_id')->constrained('jadwal_prakteks')->onDelete('cascade');
            $table->string('no_antrian');              // ex: A001, A002 (otomatis)
            $table->string('nama_pasien');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_telp');
            $table->text('keluhan')->nullable();
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'batal'])
                ->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
