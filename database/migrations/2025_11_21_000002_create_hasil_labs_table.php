<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_labs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_lab')->unique();
            $table->date('tanggal_pemeriksaan');
            $table->string('jenis_pemeriksaan');
            $table->string('dokter_pengirim')->nullable();
            $table->json('hasil')->nullable(); // Store results as JSON
            $table->text('catatan')->nullable();
            $table->enum('status', ['proses', 'selesai', 'diambil'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_labs');
    }
};
