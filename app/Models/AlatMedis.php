<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatMedis extends Model
{
    
    protected $table = 'alatmedis';

    protected $fillable = [
        'user_id',
        'nama',
        'kode',
        'kondisi',
        ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
