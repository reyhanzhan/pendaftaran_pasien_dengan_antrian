<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('pasien')->after('email');
        });

        // Migrate existing is_admin values to role
        DB::table('users')->where('is_admin', true)->update(['role' => 'admin']);

        // Add user_id to dokters table so a dokter can login
        if (!Schema::hasColumn('dokters', 'user_id')) {
            Schema::table('dokters', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::table('dokters', function (Blueprint $table) {
            if (Schema::hasColumn('dokters', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
