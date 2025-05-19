<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stokobat extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'obat_id',
        'jumlah',
        'kadaluarsa',
        'masuk',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}


