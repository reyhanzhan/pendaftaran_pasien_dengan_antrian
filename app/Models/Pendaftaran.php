<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model {
    protected $table = 'pendaftarans';
    
    protected $fillable = [
        'jadwal_praktek_id',
        'nik',
        'no_antrian',
        'nama_pasien',
        'jenis_kelamin',
        'no_telp',
        'slot_waktu',
        'keluhan',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function jadwalPraktek() {
        return $this->belongsTo(JadwalPraktek::class);
    }
}
