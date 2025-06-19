<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Stokobat;
use App\Models\AlatMedis;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    // Filter laporan kunjungan
    public function filterKunjungan(Request $request)
    {
        $request->validate([
            'start_month' => 'required|date_format:Y-m',
            'end_month' => 'required|date_format:Y-m|after_or_equal:start_month',
        ]);

        $start = $request->start_month . '-01';
        $end = date('Y-m-t', strtotime($request->end_month . '-01'));

        $kunjungans = Kunjungan::with(['siswa', 'user', 'stokobat.obat'])
        ->whereBetween('created_at', [$start, $end])
        ->get();


        return view('laporan.index', compact('kunjungans'));
    }

    // Cetak PDF laporan kunjungan
    public function cetakKunjunganPdf(Request $request)
    {
        $request->validate([
            'start_month' => 'required|date_format:Y-m',
            'end_month' => 'required|date_format:Y-m|after_or_equal:start_month',
        ]);

        $start = $request->start_month . '-01';
        $end = date('Y-m-t', strtotime($request->end_month . '-01'));

        $kunjungans = Kunjungan::with(['user', 'stokobat.obat', 'siswa'])
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $pdf = Pdf::loadView('kunjungans.print', compact('kunjungans'));
        return $pdf->download('kunjungan.pdf');
    }

    // Filter laporan stok obat
    public function filterObat(Request $request)
    {
        $request->validate([
            'obatstart_month' => 'required|date_format:Y-m',
            'obatend_month' => 'required|date_format:Y-m|after_or_equal:obatstart_month',
        ]);

        $start = $request->obatstart_month . '-01';
        $end = date('Y-m-t', strtotime($request->obatend_month . '-01'));

        $stokobats = Stokobat::with('obat')
            ->whereBetween('masuk', [$start, $end])
            ->get();


        return view('laporan.index', compact('stokobats'));
    }

    // Cetak PDF laporan stok obat
    public function cetakObatPdf(Request $request)
    {
        $request->validate([
            'obatstart_month' => 'required|date_format:Y-m',
            'obatend_month' => 'required|date_format:Y-m|after_or_equal:obatstart_month',
        ]);

        $start = $request->obatstart_month . '-01';
        $end = date('Y-m-t', strtotime($request->obatend_month . '-01'));

        $stokobats = Stokobat::with('obat')
        ->whereBetween('masuk', [$start, $end])
        ->get();


        $pdf = Pdf::loadView('stokobats.print', compact('stokobats'));
        return $pdf->download('stok_obat.pdf');
    }

        // Filter laporan alat medis
    public function filterAlatMedis(Request $request)
    {
        $request->validate([
            'alatstart_month' => 'required|date_format:Y-m',
            'alatend_month' => 'required|date_format:Y-m|after_or_equal:alatstart_month',
        ]);

        $start = $request->alatstart_month . '-01';
        $end = date('Y-m-t', strtotime($request->alatend_month . '-01'));

        $alatmedis = AlatMedis::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return view('laporan.index', compact('alatmedis'));
    }

    // Cetak PDF laporan alat medis
    public function cetakAlatMedisPdf(Request $request)
    {
        $request->validate([
            'alatstart_month' => 'required|date_format:Y-m',
            'alatend_month' => 'required|date_format:Y-m|after_or_equal:alatstart_month',
        ]);

        $start = $request->alatstart_month . '-01';
        $end = date('Y-m-t', strtotime($request->alatend_month . '-01'));

        $alatmedis = AlatMedis::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $pdf = Pdf::loadView('alatmedis.print', compact('alatmedis'));
        return $pdf->download('alat_medis.pdf');
    }


}
