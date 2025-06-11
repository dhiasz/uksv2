<?php

namespace App\Http\Controllers;
use App\Models\Obat;
use App\Models\TotalStokObat;
use Illuminate\Http\Request;

class TotalStokObatController extends Controller
{
    


public function index()
{
    // Ambil semua obat beserta total stok-nya
    $obats = Obat::with('totalStok')->get();

    return view('pengadaan.index', compact('obats'));
}

}
