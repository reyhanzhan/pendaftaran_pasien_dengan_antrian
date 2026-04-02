<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model {
    protected $table = 'dokters';
    
    protected $fillable = [
        'kode_dokter',
        'nama_dokter',
        'spesialisasi',
        'rumah_sakit',
        'foto',
        'konsultasi_online',
    ];

    protected $casts = [
        'konsultasi_online' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalPrakteks() {
        return $this->hasMany(JadwalPraktek::class);
    }
}