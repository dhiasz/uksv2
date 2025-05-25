<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Stokobat;
use App\Models\User;
use Illuminate\Http\Request;

use App\Exports\KunjunganExport;
use App\Imports\KunjunganImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class KunjunganController extends Controller
{
  
    public function index(Request $request)
    {
        $today = Carbon::today();

        // Cek apakah ingin melihat semua data
        if ($request->query('semua') === 'true') {
            $kunjungans = Kunjungan::with(['stokobat.obat', 'user'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        } else {
            $kunjungans = Kunjungan::with(['stokobat.obat', 'user'])
                            ->whereDate('created_at', $today)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        }

        $statistik = Kunjungan::select(
                DB::raw("DATE_FORMAT(created_at, '%M %Y') as bulan"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('bulan')
            ->orderByRaw("MIN(created_at)")
            ->pluck('total', 'bulan');

        return view('kunjungans.index', compact('kunjungans', 'statistik'));
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
        'sobat_id' => 'nullable|exists:stokobats,id',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:10',
        'umur' => 'required|integer',
        'keluhan' => 'required|string',
        'tindakan' => 'required|string',
    ]);

    // Jika ada sobat_id, kurangi stok
    if ($request->sobat_id) {
        $stokobat = Stokobat::findOrFail($request->sobat_id);

        if ($stokobat->jumlah <= 0) {
            return back()->with('error', 'Stok obat tidak mencukupi');
        }

        $stokobat->decrement('jumlah');
    }

    // Simpan data kunjungan
    Kunjungan::create($request->all());

    return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil ditambahkan' . ($request->sobat_id ? ' dan stok dikurangi' : ''));
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
    // Validasi input
    $request->validate([
        'sobat_id' => 'required|exists:stokobats,id',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:10',
        'umur' => 'required|integer',
        'keluhan' => 'required|string',
        'tindakan' => 'required|string',
    ]);

    // Ambil data kunjungan yang akan diupdate
    $kunjungan = Kunjungan::findOrFail($id);
    $sobatLamaId = $kunjungan->sobat_id;
    $sobatBaruId = $request->sobat_id;

    // Cek apakah sobat_id berubah
    if ($sobatLamaId != $sobatBaruId) {
        // Kembalikan stok obat lama
        $stokLama = Stokobat::find($sobatLamaId);
        if ($stokLama) {
            $stokLama->increment('jumlah');
        }

        // Cek stok obat baru
        $stokBaru = Stokobat::findOrFail($sobatBaruId);
        if ($stokBaru->jumlah <= 0) {
            return back()->with('error', 'Stok obat baru tidak mencukupi');
        }

        // Kurangi stok obat baru
        $stokBaru->decrement('jumlah');
    }

    // Siapkan data untuk update
    $data = $request->only(['sobat_id', 'nama', 'kelas', 'umur', 'keluhan', 'tindakan']);
    $data['user_id'] = auth()->id(); // Set user yang sedang login

    // Update kunjungan
    $kunjungan->update($data);

    return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil diperbarui');
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


    public function export()
    {
        return Excel::download(new KunjunganExport, 'kunjungan.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new KunjunganImport, $request->file('file'));
            return redirect()->route('kunjungans.index')->with('success', 'Data kunjungan berhasil diimpor.');
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
        $kunjungans = Kunjungan::with(['user', 'stokobat.obat'])->get();
        $pdf = Pdf::loadView('kunjungans.print', compact('kunjungans'));
        return $pdf->download('kunjungan.pdf');
    }
}
