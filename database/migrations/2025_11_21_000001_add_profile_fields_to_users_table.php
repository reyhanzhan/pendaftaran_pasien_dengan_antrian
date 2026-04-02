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
            // Only add columns that don't exist yet (nik, no_telp, etc already added in previous migration)
            if (!Schema::hasColumn('users', 'golongan_darah')) {
                $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('users', 'tinggi_badan')) {
                $table->decimal('tinggi_badan', 5, 2)->nullable()->after('golongan_darah');
            }
            if (!Schema::hasColumn('users', 'berat_badan')) {
                $table->decimal('berat_badan', 5, 2)->nullable()->after('tinggi_badan');
            }
            if (!Schema::hasColumn('users', 'alergi')) {
                $table->text('alergi')->nullable()->after('berat_badan');
            }
            if (!Schema::hasColumn('users', 'riwayat_penyakit')) {
                $table->text('riwayat_penyakit')->nullable()->after('alergi');
            }
            if (!Schema::hasColumn('users', 'is_admin')) {
                $table->boolean('is_admin')->default(false)->after('riwayat_penyakit');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['golongan_darah', 'tinggi_badan', 'berat_badan', 'alergi', 'riwayat_penyakit', 'is_admin'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
