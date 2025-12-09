<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model {
    protected $table = 'pendaftarans';
    
    public function jadwalPraktek() {
        return $this->belongsTo(JadwalPraktek::class);
    }
}
