<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokter;
use App\Models\JadwalPraktek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test patient user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('reyhan123'),
                'role' => 'pasien',
                'nik' => '3201011234567890',
                'no_telp' => '081234567890',
                'jenis_kelamin' => 'L',
            ]
        );

        // Create sample dokters
        $dokters = [
            [
                'kode_dokter' => 'A001',
                'nama_dokter' => 'dr. Anasthasya Ficka Lillononi, M.Psi., Psikolog',
                'spesialisasi' => 'Psikologi',
                'rumah_sakit' => 'RS Sehat Sentosa Manado',
                'konsultasi_online' => false,
            ],
            [
                'kode_dokter' => 'A002',
                'nama_dokter' => 'Andy Chandra, SPsi, MPsi',
                'spesialisasi' => 'Psikologi',
                'rumah_sakit' => 'RS Sehat Sentosa Medan',
                'konsultasi_online' => false,
            ],
            [
                'kode_dokter' => 'B001',
                'nama_dokter' => 'dr. Baiq Sofia Iswan Azizah, M.Psi., Psikolog',
                'spesialisasi' => 'Psikologi',
                'rumah_sakit' => 'RS Sehat Sentosa Makassar',
                'konsultasi_online' => true,
            ],
            [
                'kode_dokter' => 'C001',
                'nama_dokter' => 'dr. Catherine Dowi Surya, S. Psi., Psikolog',
                'spesialisasi' => 'Psikologi',
                'rumah_sakit' => 'RS Sehat Sentosa Bogor',
                'konsultasi_online' => true,
            ],
            [
                'kode_dokter' => 'C002',
                'nama_dokter' => 'dr. Citra Hati Leometa, M.Psi., Psi',
                'spesialisasi' => 'Psikologi',
                'rumah_sakit' => 'RS Sehat Sentosa Lippo Cikarang',
                'konsultasi_online' => true,
            ],
            [
                'kode_dokter' => 'D001',
                'nama_dokter' => 'Devi Delia, M.Psi., Psikolog',
                'spesialisasi' => 'Psikologi',
                'rumah_sakit' => 'RS Sehat Sentosa Sriwijaya Palembang',
                'konsultasi_online' => false,
            ],
            [
                'kode_dokter' => 'K001',
                'nama_dokter' => 'dr. Kevin Hartanto, Sp.JP',
                'spesialisasi' => 'Kardiologi (Jantung)',
                'rumah_sakit' => 'RS Sehat Sentosa Jakarta',
                'konsultasi_online' => true,
            ],
            [
                'kode_dokter' => 'S001',
                'nama_dokter' => 'dr. Siti Aminah, Sp.A',
                'spesialisasi' => 'Pediatrik (Anak)',
                'rumah_sakit' => 'RS Sehat Sentosa Jakarta',
                'konsultasi_online' => true,
            ],
            [
                'kode_dokter' => 'B002',
                'nama_dokter' => 'dr. Budi Santoso, Sp.PD',
                'spesialisasi' => 'Penyakit Dalam',
                'rumah_sakit' => 'RS Sehat Sentosa Jakarta',
                'konsultasi_online' => false,
            ],
            [
                'kode_dokter' => 'R001',
                'nama_dokter' => 'drg. Rita Wulandari, Sp.Ort',
                'spesialisasi' => 'Kedokteran Gigi',
                'rumah_sakit' => 'RS Sehat Sentosa Jakarta',
                'konsultasi_online' => false,
            ],
        ];

        foreach ($dokters as $index => $dokterData) {
            $dokter = Dokter::firstOrCreate(
                ['kode_dokter' => $dokterData['kode_dokter']],
                $dokterData
            );

            // Create a user account for each dokter if not linked yet
            if (!$dokter->user_id) {
                $email = strtolower(str_replace([' ', '.', ','], '', $dokterData['kode_dokter'])) . '@dokter.rumahsakit.com';
                $userDokter = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $dokterData['nama_dokter'],
                        'password' => Hash::make('reyhan123'),
                        'role' => 'dokter',
                    ]
                );
                $dokter->update(['user_id' => $userDokter->id]);
            }

            // Create jadwal praktek for the next 7 days
            for ($i = 0; $i < 7; $i++) {
                $date = now()->addDays($i)->toDateString();
                
                // Skip weekends for some doctors
                $dayOfWeek = now()->addDays($i)->dayOfWeek;
                if ($dayOfWeek === 0 && rand(0, 1)) continue; // Sunday
                if ($dayOfWeek === 6 && rand(0, 1)) continue; // Saturday

                JadwalPraktek::firstOrCreate(
                    [
                        'dokter_id' => $dokter->id,
                        'tanggal_praktek' => $date,
                    ],
                    [
                        'jam_mulai' => $i % 2 === 0 ? '08:00' : '13:00',
                        'jam_selesai' => $i % 2 === 0 ? '12:00' : '17:00',
                        'kuota' => 20,
                        'terisi' => rand(0, 10),
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
