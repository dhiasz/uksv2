<?php

namespace App\Http\Controllers;

use App\Models\Kesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KesehatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kesehatan::with('user')->withCount('historis');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $kesehatans = $query->latest()->paginate(15);

        return view('kesehatan.index', compact('kesehatans'));
    }

    public function create()
    {
        return view('kesehatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'umur'   => 'required|numeric|min:0',
            'tb'     => 'required|numeric|min:0',
            'bb'     => 'required|numeric|min:0',
            'tensi'  => 'nullable|string',
            'goldar' => 'nullable|string|max:2',
        ]);

        Kesehatan::create([
            'user_id' => Auth::id(),
            'nama'    => $validated['nama'],
            'umur'    => $validated['umur'],
            'tb'      => $validated['tb'],
            'bb'      => $validated['bb'],
            'tensi'   => $validated['tensi'] ?? null,
            'goldar'  => $validated['goldar'] ?? null,
        ]);

        return redirect()
            ->route('kesehatan.index')
            ->with('success', 'Data kesehatan berhasil disimpan.');
    }

    public function show($id)
    {
        $kesehatan = Kesehatan::with('historis')->findOrFail($id);
        return view('kesehatan.show', compact('kesehatan'));
    }

    public function edit($id)
    {
        $kesehatan = Kesehatan::findOrFail($id);
        return view('kesehatan.edit', compact('kesehatan'));
    }

   public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama'   => 'required|string|max:255',
        'umur'   => 'required|numeric|min:0',
        'tb'     => 'required|numeric|min:0',
        'bb'     => 'required|numeric|min:0',
        'tensi'  => 'nullable|string',
        'goldar' => 'nullable|string|max:2',
    ]);

    $kesehatan = Kesehatan::findOrFail($id);

    $tidakBerubah =
        $kesehatan->nama   === $validated['nama'] &&
        $kesehatan->umur   === $validated['umur'] &&
        $kesehatan->tb     === $validated['tb'] &&
        $kesehatan->bb     === $validated['bb'] &&
        $kesehatan->tensi  === ($validated['tensi'] ?? null) &&
        $kesehatan->goldar === ($validated['goldar'] ?? null);

    if ($tidakBerubah) {
        return redirect()
            ->back()
            ->with('info', 'Kamu belum melakukan perubahan apa pun.');
    }

    // Simpan histori jika berubah
    $kesehatan->simpanHistoriJikaBerubah($validated);

    // Update data
    $kesehatan->update($validated);

    return redirect()
        ->route('kesehatan.index')
        ->with('success', 'Data kesehatan berhasil diperbarui.');
}

    public function destroy($id)
    {
        Kesehatan::findOrFail($id)->delete();

        return redirect()
            ->route('kesehatan.index')
            ->with('success', 'Data kesehatan berhasil dihapus.');
    }

    
}