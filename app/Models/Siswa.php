<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'kelas',
        'umur',
        'tb',
        'bb',
        'tensi',
        'goldar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
