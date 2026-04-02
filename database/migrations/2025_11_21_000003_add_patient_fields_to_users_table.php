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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik', 16)->unique()->nullable()->after('email');
            $table->string('no_telp', 20)->nullable()->after('nik');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('no_telp');
            $table->date('tanggal_lahir')->nullable()->after('jenis_kelamin');
            $table->text('alamat')->nullable()->after('tanggal_lahir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'no_telp', 'jenis_kelamin', 'tanggal_lahir', 'alamat']);
        });
    }
};
