<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kunjungan;

class KunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kunjungan::insert([
    [
        'user_id' => 1,
        'sobat_id' => 2,
        'nama' => 'Budi',
        'kelas' => '10A',
        'umur' => 15,
        'keluhan' => 'Sakit kepala',
        'tindakan' => 'Diberikan obat',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    // bisa tambah data lain di array ini
]);

    }
}
