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
            [
            'user_id'=> 1,
            'nama'=> 'budi',
            'nis' => '203331556',
            'tgl' => '2007-08-15',
            ],
            [
            'user_id'=> 2,
            'nama'=> 'Rizky',
            'nis' => '2032981554',
            'tgl' => '2006-04-12',
            ]
            ,
            [
            'user_id'=> 1,
            'nama'=> 'Susan',
            'nis' => '2032981524',
            'tgl' => '2010-04-12',
            ]
        ]);
    }
}
