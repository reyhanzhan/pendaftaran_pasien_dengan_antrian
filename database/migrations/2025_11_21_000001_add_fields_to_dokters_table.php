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
        Schema::table('dokters', function (Blueprint $table) {
            $table->string('spesialisasi', 255)->nullable()->after('nama_dokter');
            $table->string('rumah_sakit', 255)->nullable()->after('spesialisasi');
            $table->string('foto', 500)->nullable()->after('rumah_sakit');
            $table->boolean('konsultasi_online')->default(false)->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokters', function (Blueprint $table) {
            $table->dropColumn(['spesialisasi', 'rumah_sakit', 'foto', 'konsultasi_online']);
        });
    }
};
