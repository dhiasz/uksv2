<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::all();
        return view('obats.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'golongan_obat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'sediaan' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'dosis' => 'string|max:255',
        ]);

        Obat::create($request->all());

        return redirect()->route('obats.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obats.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'golongan_obat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'sediaan' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'dosis' => 'string|max:255',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());

        return redirect()->route('obats.index')->with('success', 'Obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obats.index')->with('success', 'Obat berhasil dihapus.');
    }
}
