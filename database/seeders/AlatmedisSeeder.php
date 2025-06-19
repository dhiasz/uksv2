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
                'kode' => 'AM0001',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Stetoskop',
                'kode' => 'AM0002',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Termometer',
                'kode' => 'AM0003',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Alat Nebulizer',
                'kode' => 'AM0004',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Timbangan Badan',
                'kode' => 'AM0005',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Stetoskop',
                'kode' => 'AM0006',
                'kondisi' => 'Rusak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    }
