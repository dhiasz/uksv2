<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'jenis_obat',
    ];

     public function stokobat(): BelongsTo
    {
        return $this->belongsTo(Stokobat::class);
    }
}
