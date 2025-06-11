<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'golongan_obat',
        'kategori',
        'sediaan',
        'satuan',
        'dosis',
    ];



    public function stokobats()
    {
        return $this->hasMany(Stokobat::class);
    }


    // Optional: relasi total stok (agregat SUM)
    public function totalStok()
    {
        return $this->hasOne(Stokobat::class, 'obat_id')
                    ->selectRaw('obat_id, SUM(jumlah) as jumlah')
                    ->groupBy('obat_id');
    }
    
}
