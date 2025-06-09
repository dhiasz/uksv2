<?php

namespace App\Http\Controllers;

use App\Models\KesehatanHistoris;
use App\Models\Kesehatan;
use Illuminate\Http\Request;

class KesehatanHistorisController extends Controller
{
    public function index($kesehatan_id)
    {
        // Pastikan data kesehatan yang dimaksud ada (optional)
        $kesehatan = Kesehatan::findOrFail($kesehatan_id);

        // Ambil histori terkait kesehatan_id itu, urutkan terbaru dulu, paginasi
        $historis = KesehatanHistoris::where('kesehatan_id', $kesehatan_id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Kirim data ke view, termasuk data utama kesehatan (bisa pakai buat info header)
        return view('kesehatan_historis.index', compact('historis', 'kesehatan'));
    }
}
