<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Stokobat;
use App\Models\User;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
    
        $kunjungans = Kunjungan::with(['user', 'stokobat.obat'])->get();
        return view('kunjungans.index', compact('kunjungans'));
    }

    public function create()
    {
        $users = User::all();
        $stokobats = Stokobat::with('obat')->get();
        return view('kunjungans.create', compact('users', 'stokobats'));
    }

   public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'sobat_id' => 'required|exists:stokobats,id',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:10',
        'umur' => 'required|integer',
        'keluhan' => 'required|string',
        'tindakan' => 'required|string',
    ]);

    // Ambil data stok obat
    $stokobat = Stokobat::findOrFail($request->sobat_id);

    // Cek apakah stok cukup
    if ($stokobat->jumlah <= 0) {
        return back()->with('error', 'Stok obat tidak mencukupi');
    }

    // Kurangi stok
    $stokobat->decrement('jumlah');

    // Simpan data kunjungan
    Kunjungan::create($request->all());

    return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil ditambahkan dan stok dikurangi');
}


    public function edit($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $users = User::all();
        $stokobats = Stokobat::with('obat')->get();
        return view('kunjungans.edit', compact('kunjungan', 'users', 'stokobats'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'sobat_id' => 'required|exists:stokobats,id',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:10',
        'umur' => 'required|integer',
        'keluhan' => 'required|string',
        'tindakan' => 'required|string',
    ]);

    $kunjungan = Kunjungan::findOrFail($id);
    $sobatLamaId = $kunjungan->sobat_id;
    $sobatBaruId = $request->sobat_id;

    // Jika obat diganti
    if ($sobatLamaId != $sobatBaruId) {
        // Kembalikan stok obat lama
        $stokLama = Stokobat::find($sobatLamaId);
        if ($stokLama) {
            $stokLama->increment('jumlah');
        }

        // Kurangi stok obat baru
        $stokBaru = Stokobat::findOrFail($sobatBaruId);
        if ($stokBaru->jumlah <= 0) {
            return back()->with('error', 'Stok obat baru tidak mencukupi');
        }
        $stokBaru->decrement('jumlah');
    }

    // Update data kunjungan
    $kunjungan->update($request->all());

    return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil diperbarui dan stok diperbarui');
}



    /**
     * Hapus data kunjungan.
     */
    public function destroy($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungans.index')->with('success', 'Data kunjungan berhasil dihapus');
    }
}
