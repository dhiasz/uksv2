<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'satuan',
        'kategori',
        'dosis',
    ];

     public function stokobat(): BelongsTo
    {
        return $this->belongsTo(Stokobat::class);
    }
}
