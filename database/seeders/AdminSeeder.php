<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rumahsakit.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('reyhan123'),
                'role' => 'admin',
                'is_admin' => true,
            ]
        );
    }
}
