<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesehatan extends Model
{
    use HasFactory;

    protected $table = 'kesehatans';

    protected $fillable = [
        'user_id',
        'siswa_id',
        'umur',
        'tb',
        'bb',
        'tensi',
        'goldar',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke KesehatanHistoris
    public function historis()
    {
        return $this->hasMany(KesehatanHistoris::class, 'kesehatan_id');
    }

    // Method untuk menyimpan histori jika ada perubahan (opsional tapi saya rekomendasikan)
    public function simpanHistoriJikaBerubah(array $data)
    {
        if (
            $this->umur != $data['umur'] ||
            $this->tb != $data['tb'] ||
            $this->bb != $data['bb'] ||
            $this->tensi != ($data['tensi'] ?? null) ||
            $this->goldar != ($data['goldar'] ?? null)
        ) {
            KesehatanHistoris::create([
                'kesehatan_id' => $this->id,
                'umur' => $this->umur,
                'tb' => $this->tb,
                'bb' => $this->bb,
                'tensi' => $this->tensi,
                'goldar' => $this->goldar,
            ]);
        }
    }
}
