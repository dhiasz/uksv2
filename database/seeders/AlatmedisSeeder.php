<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AlatMedis;
class AlatmedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         AlatMedis::insert([
            [
                'user_id' => 1,
                'nama' => 'Tensimeter',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Stetoskop',
                'kondisi' => 'Baik ke Sedang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Termometer',
                'kondisi' => 'Sedang ke Rusak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Alat Nebulizer',
                'kondisi' => 'Rusak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Timbangan Badan',
                'kondisi' => 'Rusak Berat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    }
