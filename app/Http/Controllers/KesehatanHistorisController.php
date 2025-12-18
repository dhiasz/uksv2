<?php

namespace App\Http\Controllers;

use App\Models\KesehatanHistoris;
use App\Models\Kesehatan;
use Illuminate\Http\Request;

class KesehatanHistorisController extends Controller
{
    public function index($kesehatan_id)
{
    $kesehatan = Kesehatan::findOrFail($kesehatan_id);

    // Hitung BMI
    $tbMeter = $kesehatan->tb / 100;
    $bmi = $tbMeter > 0
        ? round($kesehatan->bb / ($tbMeter * $tbMeter), 1)
        : 0;

    if ($bmi < 18.5) {
        $kategoriBmi = 'Kurus';
    } elseif ($bmi < 25) {
        $kategoriBmi = 'Normal';
    } elseif ($bmi < 30) {
        $kategoriBmi = 'Overweight';
    } else {
        $kategoriBmi = 'Obesitas';
    }

    $historis = KesehatanHistoris::where('kesehatan_id', $kesehatan_id)
        ->latest()
        ->paginate(10);

    return view('kesehatan_historis.index', compact(
        'kesehatan',
        'historis',
        'bmi',
        'kategoriBmi'
    ));
}

}
