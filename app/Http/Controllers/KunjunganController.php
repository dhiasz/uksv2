<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Stokobat;
use App\Models\User;
use App\Models\Siswa;

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

        $kunjungans = Kunjungan::with(['stokobat.obat', 'user', 'siswa'])
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
        $users = User::all();
        $siswas = Siswa::all();
        $stokobats = Stokobat::with('obat')->get();
        return view('kunjungans.create', compact('users', 'stokobats', 'siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'siswa_id' => 'required|exists:siswas,id',
            'sobat_id' => 'nullable|exists:stokobats,id',
            'kelas' => 'required|string',
            'umur' => 'required|integer',
            'keluhan' => 'required|string',
            'tindakan' => 'required|string',
        ]);

        if ($request->sobat_id) {
            $stokobat = Stokobat::findOrFail($request->sobat_id);
            if ($stokobat->jumlah <= 0) {
                return back()->with('error', 'Stok obat tidak mencukupi');
            }
            $stokobat->decrement('jumlah');
        }

        Kunjungan::create($request->all());

        return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil ditambahkan' . ($request->sobat_id ? ' dan stok dikurangi' : ''));
    }

    public function edit($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $users = User::all();
        $siswas = Siswa::all();
        $stokobats = Stokobat::with('obat')->get();
        return view('kunjungans.edit', compact('kunjungan', 'users', 'stokobats', 'siswas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'sobat_id' => 'nullable|exists:stokobats,id',
            'kelas' => 'required|string',
            'umur' => 'required|integer',
            'keluhan' => 'required|string',
            'tindakan' => 'required|string',
        ]);

        $kunjungan = Kunjungan::findOrFail($id);
        $sobatLamaId = $kunjungan->sobat_id;
        $sobatBaruId = $request->sobat_id;

        if ($sobatLamaId != $sobatBaruId) {
            if ($sobatLamaId) {
                $stokLama = Stokobat::find($sobatLamaId);
                if ($stokLama) $stokLama->increment('jumlah');
            }

            if ($sobatBaruId) {
                $stokBaru = Stokobat::findOrFail($sobatBaruId);
                if ($stokBaru->jumlah <= 0) {
                    return back()->with('error', 'Stok obat baru tidak mencukupi');
                }
                $stokBaru->decrement('jumlah');
            }
        }

        $data = $request->only(['siswa_id', 'sobat_id', 'kelas', 'umur', 'keluhan', 'tindakan']);
        $data['user_id'] = auth()->id();
        $kunjungan->update($data);

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
        $kunjungans = Kunjungan::with(['user', 'stokobat.obat', 'siswa'])->get();
        $pdf = Pdf::loadView('kunjungans.print', compact('kunjungans'));
        return $pdf->download('kunjungan.pdf');
    }
}
