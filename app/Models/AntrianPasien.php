<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntrianPasien extends Model
{
    protected $fillable = [
        'name',
        'dokter_id',
        'password',
    ];
}
