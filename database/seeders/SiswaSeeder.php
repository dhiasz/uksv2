<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::insert([
        'user_id'=> 1,
        'nama'=> 'budi',
        'kelas'=> '10A',
        'umur'=> '16',
        'tb'=> '160',
        'bb'=> '50',
        'tensi'=> '120/80 mmHg',
        'goldar'=> 'AB',
        ]);
    }
}
