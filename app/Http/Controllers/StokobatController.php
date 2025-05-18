<?php

namespace App\Http\Controllers;

use App\Models\StokObat;
use App\Models\Obat;
use Illuminate\Http\Request;

class StokObatController extends Controller
{
    // Menampilkan semua stok obat
    public function index()
    {
        $stokobats = StokObat::with('obat')->get();
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
}
