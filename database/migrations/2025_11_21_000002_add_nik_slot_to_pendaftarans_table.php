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
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('nik', 16)->after('jadwal_praktek_id');
            $table->string('slot_waktu', 20)->nullable()->after('no_telp');
            
            // Index for faster lookups
            $table->index(['nik', 'jadwal_praktek_id', 'slot_waktu']);
            $table->index(['jadwal_praktek_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropIndex(['nik', 'jadwal_praktek_id', 'slot_waktu']);
            $table->dropIndex(['jadwal_praktek_id', 'status']);
            $table->dropColumn(['nik', 'slot_waktu']);
        });
    }
};
