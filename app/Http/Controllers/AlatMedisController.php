<?php

namespace App\Http\Controllers;

use App\Models\AlatMedis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AlatMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alatmedis = AlatMedis::all();
        return view('alatmedis.index', compact('alatmedis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alatmedis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
        ]);

        AlatMedis::create($request->all());

        return redirect()->route('alatmedis.index')->with('success', 'Alat medis berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alatmedis = AlatMedis::findOrFail($id);
        return view('alatmedis.edit', compact('alatmedis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
        ]);

        $alatmedis = AlatMedis::findOrFail($id);
        $alatmedis->update($request->all());

        return redirect()->route('alatmedis.index')->with('success', 'Alat medis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alatmedis = AlatMedis::findOrFail($id);
        $alatmedis->delete();

        return redirect()->route('alatmedis.index')->with('success', 'Alat medis berhasil dihapus.');
    }

    public function print()
    {
        $alatmedis = AlatMedis::all();

        $pdf = Pdf::loadView('alatmedis.print', compact('alatmedis'));

        return $pdf->download('alat_medis.pdf');
    }

}
