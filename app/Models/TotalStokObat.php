<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalStokObat extends Model
{

    protected $table = 'total_stok_obats';

    protected $fillable = [
        'obat_id',
        'total_jumlah',
    ];

    /**
     * Relasi ke model Obat
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
