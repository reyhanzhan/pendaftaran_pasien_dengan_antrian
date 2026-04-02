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
        // 2. Jadwal praktek dokter (bisa harian, mingguan, atau tanggal spesifik)
        Schema::create('jadwal_prakteks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_praktek');           // tanggal spesifik
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('kuota')->default(30);     // maksimal pasien per hari
            $table->integer('terisi')->default(0);     // sudah terdaftar berapa
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_prakteks');
    }
};
