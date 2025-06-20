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
        'siswa_id',
        'kelas',
        'umur',
        'keluhan',
        'tindakan',
        'sobat_id',
    ];

    // Definisikan relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stokobat()
    {
        return $this->belongsTo(Stokobat::class, 'sobat_id');
    }


    
        public function obat()
    {
    return $this->belongsTo(Obat::class, 'obat_id');
    }

     // Relasi ke Rujukan
    public function rujukans()
    {
        return $this->belongsTo(Rujukan::class);
    }

}
