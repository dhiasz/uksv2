<?php

namespace App\Http\Controllers;

use App\Models\Rujukan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan sudah install barryvdh/laravel-dompdf

class RujukanController extends Controller
{
    // Form create rujukan berdasarkan kunjungan_id
    public function create($kunjungan_id)
    {
        $kunjungan = Kunjungan::findOrFail($kunjungan_id);
        // Kirim data kunjungan ke view form create rujukan
        return view('rujukans.create', compact('kunjungan'));
    }

    // Simpan rujukan
    public function store(Request $request, $kunjungan_id)
    {
        $validated = $request->validate([
            'alamat' => 'required|string',
            'diagnosa' => 'required|string',
            'tujuan' => 'required|string',
        ]);

        $validated['kunjungan_id'] = $kunjungan_id;

        Rujukan::create($validated);

         return response()->json(['message' => 'Rujukan berhasil ditambahkan']);
    }

  public function print($kunjungan_id)
{
    $rujukan = Rujukan::with(['kunjungan.user', 'kunjungan.obat'])
    ->where('kunjungan_id', $kunjungan_id)
    ->orderBy('created_at', 'desc')
    ->first();

$rujukans = collect([$rujukan]); // bungkus dalam collection

$pdf = Pdf::loadView('rujukans.print', compact('rujukans'));

    return $pdf->download('rujukan.pdf');
}


}
