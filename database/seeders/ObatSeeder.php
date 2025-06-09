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
           [
                'nama_obat' => 'Paracetamol',
                'jenis_obat' => 'Tablet',
                'satuan' => 'pcs',
                'kategori' => 'Analgesik',
                'dosis' => '500 mg',
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'jenis_obat' => 'Kapsul',
                'satuan' => 'pcs',
                'kategori' => 'Antibiotik',
                'dosis' => '250 mg',
            ],
            [
                'nama_obat' => 'Minyak Kayu Putih',
                'jenis_obat' => 'Cair',
                'satuan' => 'Botol',
                'kategori' => 'Obat luar',
                'dosis' => '60 mL',
            ],

            [
                'nama_obat' => 'Sirup Paracetamol',
                'jenis_obat' => 'Cair',
                'satuan' => 'Botol',
                'kategori' => 'Analgesik',
                'dosis' => '120 mg/5 mL',
            ],
        ]);
    }
}
