<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model {
    protected $table = 'dokters';
    public function jadwalPrakteks() {
        return $this->hasMany(JadwalPraktek::class);
    }
}