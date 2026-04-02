<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nik',
        'no_telp',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'golongan_darah',
        'tinggi_badan',
        'berat_badan',
        'alergi',
        'riwayat_penyakit',
        'is_admin',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDokter(): bool
    {
        return $this->role === 'dokter';
    }

    public function isPasien(): bool
    {
        return $this->role === 'pasien';
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Generate nomor antrian dengan transaction & lock
     * Mencegah race condition saat multiple user daftar bersamaan
     */
    public static function generateNomorAntrian(): int
    {
        return DB::transaction(function () {
            // Lock table users untuk update
            $lastUser = User::lockForUpdate()
                ->orderBy('nomor_antrian', 'desc')
                ->first();

            $nomorAntrian = ($lastUser?->nomor_antrian ?? 0) + 1;

            return $nomorAntrian;
        });
    }
}
