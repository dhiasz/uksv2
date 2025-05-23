<?php

namespace App\Exports;

use App\Models\Kunjungan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KunjunganExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Kunjungan::with(['user', 'stokobat.obat'])->get()->map(function ($kunjungan) {
            return [
                'Nama' => $kunjungan->nama,
                'Kelas' => $kunjungan->kelas,
                'Umur' => $kunjungan->umur,
                'Keluhan' => $kunjungan->keluhan,
                'Tindakan' => $kunjungan->tindakan,
                'Petugas' => $kunjungan->user->name ?? '',
                'Obat' => $kunjungan->stokobat->obat->nama ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kelas',
            'Umur',
            'Keluhan',
            'Tindakan',
            'Petugas',
            'Obat',
        ];
    }
}
