<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\StokObatController;
use App\Http\Controllers\RujukanController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //kunjungan
    //======================================================================================================
    Route::resource('kunjungans', KunjunganController::class)->except(['show']);
    Route::get('/kunjungans/export', [KunjunganController::class, 'export'])->name('kunjungans.export');
    Route::post('/kunjungans/import', [KunjunganController::class, 'import'])->name('kunjungans.import');
    Route::get('/kunjungans/print', [KunjunganController::class, 'print'])->name('kunjungans.print');
    Route::get('/kunjungan/{id}/rujukan', [KunjunganController::class, 'rujukan'])->name('kunjungans.rujukan');
    Route::get('/kunjungan/{id}/rujukan/create', [RujukanController::class, 'create'])->name('rujukans.create');
    Route::post('/kunjungan/{id}/rujukan', [RujukanController::class, 'store'])->name('rujukans.store');
    Route::get('/kunjungan/{id}/rujukan/print', [RujukanController::class, 'print'])->name('rujukans.print');

    //======================================================================================================





    Route::resource('obats', ObatController::class);

    Route::resource('stokobats', StokObatController::class)->except(['show']);
    Route::get('/stokobats/export', [StokObatController::class, 'export'])->name('stokobats.export');
    Route::post('/stokobats/import', [StokObatController::class, 'import'])->name('stokobats.import');
    Route::get('/stokobats/print', [StokObatController::class, 'print'])->name('stokobats.print');


    Route::resource('siswas', \App\Http\Controllers\SiswaController::class);

});

require __DIR__.'/auth.php';
