<?php

namespace App\Imports;

use App\Models\Kunjungan;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KunjunganImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Kunjungan([
            'nama' => $row['nama'],
            'kelas' => $row['kelas'],
            'umur' => $row['umur'],
            'keluhan' => $row['keluhan'],
            'tindakan' => $row['tindakan'],
            'user_id' => auth()->id(), // atau sesuaikan dengan petugas default
            'sobat_id' => null, // harus diisi manual nanti atau ditambahkan logika mapping obat
        ]);
    }
}
