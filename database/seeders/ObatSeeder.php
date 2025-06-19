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
                'golongan_obat' => 'Obat Bebas',
                'kategori' => 'Antipiretik',
                'sediaan' => 'Tablet',
                'satuan' => 'pcs',
                'dosis' => '500 mg',
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'golongan_obat' => 'Obat Keras',
                'kategori' => 'Antibiotik',
                'sediaan' => 'Kapsul',
                'satuan' => 'pcs',
                'dosis' => '500 mg',
            ],
            [
                'nama_obat' => 'Ibuprofen',
                'golongan_obat' => 'Obat Bebas Terbatas',
                'kategori' => 'Analgesik',
                'sediaan' => 'Tablet',
                'satuan' => 'pcs',
                'dosis' => '400 mg',
            ],
            [
                'nama_obat' => 'Vitamin C',
                'golongan_obat' => 'Obat Bebas',
                'kategori' => 'Vitamin',
                'sediaan' => 'Tablet',
                'satuan' => 'pcs',
                'dosis' => '500 mg',
            ],
            [
                'nama_obat' => 'Salep Miconazole',
                'golongan_obat' => 'Obat Keras',
                'kategori' => 'Antibiotik',
                'sediaan' => 'Salep',
                'satuan' => 'gram',
                'dosis' => '2x sehari dioleskan tipis',
            ],
        ]);
    }
}
