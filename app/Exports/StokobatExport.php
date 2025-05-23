<?php

namespace App\Exports;

use App\Models\Stokobat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StokobatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return StokObat::with('obat')->get()->map(function ($item) {
            return [
                'Nama Obat'     => $item->obat->nama_obat ?? '-',
                'Jumlah'        => $item->jumlah,
                'Tanggal Masuk' => $item->masuk,
                'Kadaluarsa'    => $item->kadaluarsa,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Obat', 'Jumlah', 'Tanggal Masuk', 'Kadaluarsa'];
    }
}