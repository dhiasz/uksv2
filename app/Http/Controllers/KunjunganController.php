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

        $kunjungans = Kunjungan::with(['user', 'stokobat.obat'])
            ->when($request->query('semua') !== 'true', function ($query) use ($today) {
                $query->whereDate('created_at', $today);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
        $stokobats = Stokobat::select('obat_id')
            ->groupBy('obat_id')
            ->get()
            ->map(function ($item) {
                $stokList = Stokobat::with('obat')
                    ->where('obat_id', $item->obat_id)
                    ->orderBy('id', 'asc')
                    ->get();

                $stokDipilih = $stokList->firstWhere('jumlah', '>', 0)
                    ?? $stokList->last();

                $stokDipilih->total_jumlah = $stokList->sum('jumlah');

                return $stokDipilih;
            });

        return view('kunjungans.create', compact('stokobats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'umur'          => 'required|integer|min:1',
            'kelas_tingkat' => 'required|string',
            'kelas_jurusan' => 'required|string',
            'kelas_ke'      => 'required|integer',
            'sobat_id'      => 'nullable|exists:stokobats,id',
            'keluhan'       => 'required|string',
            'tindakan'      => 'required|string',
            'status'        => 'nullable|string|max:50',
        ]);

        // Gabungkan kelas
        $validated['kelas'] =
            $request->kelas_tingkat . ' - ' .
            $request->kelas_jurusan . ' - ' .
            $request->kelas_ke;

        $validated['user_id'] = auth()->id();

        // Kurangi stok obat jika dipilih
        if ($request->sobat_id) {
            $stokobat = Stokobat::findOrFail($request->sobat_id);
            if ($stokobat->jumlah <= 0) {
                return back()->with('error', 'Stok obat tidak mencukupi');
            }
            $stokobat->decrement('jumlah');
        }

        Kunjungan::create($validated);

        return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil ditambahkan' . ($request->sobat_id ? ' dan stok dikurangi' : ''));
    }
        

    public function edit($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $users = User::all();
        
        $stokobats = Stokobat::select('obat_id')
        ->groupBy('obat_id')
        ->get()
        ->map(function ($item) {
        // Ambil semua stok berdasarkan obat_id (urutan dari ID terkecil ke terbesar)
        $stokList = Stokobat::with('obat')
            ->where('obat_id', $item->obat_id)
            ->orderBy('id', 'asc')
            ->get();

        // Cari stok pertama yang jumlahnya > 0
        $stokDipilih = $stokList->firstWhere('jumlah', '>', 0);

        // Jika tidak ada yang jumlah > 0, ambil stok terakhir (terbaru)
        $stokDipilih = $stokDipilih ?? $stokList->last();

        // Tambahkan total jumlah semua stok untuk obat ini
        $stokDipilih->total_jumlah = $stokList->sum('jumlah');

        return $stokDipilih;
    });
        return view('kunjungans.edit', compact('kunjungan', 'users', 'stokobats'))->with('success', 'Data kunjungan berhasil disimpan.');
    }

   public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'umur'          => 'required|integer|min:1',
            'kelas_tingkat' => 'required|string',
            'kelas_jurusan' => 'required|string',
            'kelas_ke'      => 'required|integer',
            'sobat_id'      => 'nullable|exists:stokobats,id',
            'keluhan'       => 'required|string',
            'tindakan'      => 'required|string',
            'status'        => 'nullable|string|max:50',
        ]);

        $validated['kelas'] =
            $request->kelas_tingkat . ' - ' .
            $request->kelas_jurusan . ' - ' .
            $request->kelas_ke;

        $kunjungan = Kunjungan::findOrFail($id);

        // Manajemen stok
        if ($kunjungan->sobat_id != $request->sobat_id) {
            if ($kunjungan->sobat_id) {
                Stokobat::find($kunjungan->sobat_id)?->increment('jumlah');
            }

            if ($request->sobat_id) {
                $stokBaru = Stokobat::findOrFail($request->sobat_id);
                if ($stokBaru->jumlah <= 0) {
                    return back()->with('error', 'Stok obat tidak mencukupi');
                }
                $stokBaru->decrement('jumlah');
            }
        }

        $validated['user_id'] = auth()->id();
        $kunjungan->update($validated);

         return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil diperbarui');
    }

       
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
            $errorMessage = collect($e->failures())->pluck('errors')->flatten()->implode(' ');
            return back()->with('error', 'Gagal impor! ' . $errorMessage);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal impor! Alasan: ' . $e->getMessage());
        }
    }

    public function print()
    {
        $rekapKunjungan = Kunjungan::select(
                'nama',
                DB::raw('COUNT(*) as total_kunjungan')
            )
            ->groupBy('nama')
            ->orderBy('total_kunjungan', 'desc')
            ->get();

        $pdf = Pdf::loadView('kunjungans.print', compact('rekapKunjungan'));

        return $pdf->download('laporan_rekap_kunjungan.pdf');
    }

}
