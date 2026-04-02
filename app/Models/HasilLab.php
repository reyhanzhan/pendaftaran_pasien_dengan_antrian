<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_lab',
        'tanggal_pemeriksaan',
        'jenis_pemeriksaan',
        'dokter_pengirim',
        'hasil',
        'catatan',
        'status',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'hasil' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'proses' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Dalam Proses</span>',
            'selesai' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>',
            'diambil' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Sudah Diambil</span>',
            default => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">-</span>',
        };
    }
}
