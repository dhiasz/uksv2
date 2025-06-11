<?php

namespace App\Observers;

use App\Models\Stokobat;
use App\Models\TotalStokObat;

class StokObatObserver
{
    public function saved(Stokobat $stokObat)
    {
        $this->updateTotal($stokObat->obat_id);
    }

    public function deleted(Stokobat $stokObat)
    {
        $this->updateTotal($stokObat->obat_id);
    }

    protected function updateTotal($obat_id)
    {
        $total = Stokobat::where('obat_id', $obat_id)->sum('jumlah');

        TotalStokObat::updateOrCreate(
            ['obat_id' => $obat_id],
            ['total_jumlah' => $total]
        );
    }
}

