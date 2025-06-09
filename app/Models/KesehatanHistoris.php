<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesehatanHistoris extends Model
{
    use HasFactory;

    protected $table = 'kesehatan_historis';

    protected $fillable = [
        'kesehatan_id',
        'umur',
        'tb',
        'bb',
        'tensi',
        'goldar',
    ];

    // Relasi ke model Kesehatan
    public function kesehatan()
    {
        return $this->belongsTo(Kesehatan::class, 'kesehatan_id');
    }
}
