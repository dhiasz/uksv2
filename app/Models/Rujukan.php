<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    protected $table = 'rujukans';

    protected $fillable = [
        'kunjungan_id',
        'alamat',
        'diagnosa',
        'tujuan',
    ];

    // Relasi ke Kunjungan
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
