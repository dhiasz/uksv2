<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kunjungan extends Model
{
    protected $table = 'kunjungans'; // Nama tabel

    // Field yang boleh diisi mass assignment
    protected $fillable = [
        'user_id',
        'sobat_id',
        'nama',
        'kelas',
        'umur',
        'keluhan',
        'tindakan',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function stokobat(): BelongsTo
    {
        return $this->belongsTo(Stokobat::class);
    }
}
