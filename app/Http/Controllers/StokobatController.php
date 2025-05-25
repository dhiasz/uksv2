<?php

namespace App\Http\Controllers;

use App\Models\StokObat;
use App\Models\Obat;
use Illuminate\Http\Request;

use App\Exports\StokobatExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use \Maatwebsite\Excel\Facades\Excel;
class StokObatController extends Controller
{
    // Menampilkan semua stok obat
public function index()
{
    $stokobats = StokObat::with('obat')->get();

    $stokobats->transform(function ($stokobat) {
        $kadaluarsa = \Carbon\Carbon::parse($stokobat->kadaluarsa);
        $sekarang = \Carbon\Carbon::now();
        $selisihHari = $sekarang->diffInDays($kadaluarsa, false);

        // Tambahkan properti virtual
        $stokobat->hampir_kadaluarsa = $selisihHari <= 7 && $selisihHari >= 0;
        $stokobat->sudah_kadaluarsa = $selisihHari < 0;

        return $stokobat;
    });

    return view('stokobats.index', compact('stokobats'));
}

    // Tampilkan form tambah stok obat
    public function create()
    {
        $obats = Obat::all();
        return view('stokobats.create', compact('obats'));
    }

    // Simpan stok obat baru
    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:obats,id',
            'jumlah' => 'required|integer|min:1',
            'kadaluarsa' => 'required|date',
        ]);

        StokObat::create($request->all());

        return redirect()->route('stokobats.index')->with('success', 'Stok obat berhasil ditambahkan');
    }


    public function edit($id)
{
    $stokobat = StokObat::findOrFail($id);
    $obats = \App\Models\Obat::all();
    return view('stokobats.edit', compact('stokobat', 'obats'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'obat_id' => 'required|exists:obats,id',
        'jumlah' => 'required|integer|min:1',
        'kadaluarsa' => 'required|date',
    ]);

    $stokobat = StokObat::findOrFail($id);
    $stokobat->update($request->all());

    return redirect()->route('stokobats.index')->with('success', 'Stok obat berhasil diperbarui');
}


    // Hapus stok obat
    public function destroy($id)
    {
        $stokobat = StokObat::findOrFail($id);
        $stokobat->delete();

        return redirect()->route('stokobats.index')->with('success', 'Stok obat berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new StokobatExport, 'stok_obat.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new StoksbatImport, $request->file('file'));
            return redirect()->route('stokobats.index')->with('success', 'Data stok obat berhasil diimpor.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $errors = $e->failures();
            $errorMessage = collect($errors)->pluck('errors')->flatten()->implode(' ');
            return redirect()->back()->with('error', 'Gagal impor! ' . $errorMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal impor! Alasan: ' . $e->getMessage());
        }
    }

    public function print()
    {
        $stokobats = Stokobat::with('obat')->get();
        $pdf = Pdf::loadView('stokobats.print', compact('stokobats'));
        return $pdf->download('stok_obat.pdf');
    }


}
