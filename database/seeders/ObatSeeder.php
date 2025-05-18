<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Obat;
class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obat::insert([
            'nama_obat' => 'parahmen',
            'jenis_obat' => 'Parasetamol'
        ]
        );
    }
}
