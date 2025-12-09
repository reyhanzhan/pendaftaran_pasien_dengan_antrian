<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;
use App\Models\Pendaftaran;

class JadwalPraktek extends Model {
    protected $table = 'jadwal_prakteks';
    
    public function dokter() {
        return $this->belongsTo(Dokter::class);
    }
    
    public function pendaftarans() {
        return $this->hasMany(Pendaftaran::class);
    }
    
    public function tersedia() {
        return $this->kuota - $this->terisi > 0;
    }
}
