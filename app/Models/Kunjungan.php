<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungans';

    protected $fillable = [
        'user_id',
        'sobat_id',
        'nama',
        'kelas',
        'umur',
        'keluhan',
        'tindakan',
        'status',
    ];

    // Relasi ke User (petugas)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Stok Obat
    public function stokobat()
    {
        return $this->belongsTo(Stokobat::class, 'sobat_id');
    }

    // Relasi ke Rujukan (1 kunjungan bisa punya 1 rujukan)
    public function rujukan()
    {
        return $this->hasOne(Rujukan::class);
    }
}
