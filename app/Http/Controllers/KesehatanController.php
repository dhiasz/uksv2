<?php

namespace App\Http\Controllers;

use App\Models\Kesehatan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KesehatanController extends Controller
{
   public function index(Request $request)
    {
        $query = Kesehatan::with(['user', 'siswa'])->withCount('historis');

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $kesehatans = $query->latest()->paginate(15);

        return view('kesehatan.index', compact('kesehatans'));
    }


    public function create()
    {
        $siswas = Siswa::all();
        return view('kesehatan.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'umur' => 'required||numeric|min:0',
            'tb' => 'required||numeric|min:0',
            'bb' => 'required||numeric|min:0',
            'tensi' => 'nullable|string',
            'goldar' => 'nullable|string|max:2',
        ]);

        Kesehatan::create([
            'user_id' => Auth::id(),
            'siswa_id' => $validated['siswa_id'],
            'umur' => $validated['umur'],
            'tb' => $validated['tb'],
            'bb' => $validated['bb'],
            'tensi' => $validated['tensi'] ?? null,
            'goldar' => $validated['goldar'] ?? null,
        ]);

        return redirect()->route('kesehatan.index')->with('success', 'Data kesehatan berhasil disimpan.');
    }

    public function show($id)
    {
        $kesehatan = Kesehatan::with('historis')->findOrFail($id);
        return view('kesehatan.show', compact('kesehatan'));
    }

    public function edit($id)
    {
        $kesehatan = Kesehatan::findOrFail($id);
        $siswas = Siswa::all();
        return view('kesehatan.edit', compact('kesehatan', 'siswas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'umur' => 'required||numeric|min:0',
            'tb' => 'required||numeric|min:0',
            'bb' => 'required||numeric|min:0',
            'tensi' => 'nullable|string',
            'goldar' => 'nullable|string|max:2',
        ]);

        $kesehatan = Kesehatan::findOrFail($id);

        // Asumsikan kamu punya method simpanHistoriJikaBerubah di model Kesehatan
        $kesehatan->simpanHistoriJikaBerubah($validated);

        $kesehatan->update([
            'siswa_id' => $validated['siswa_id'],
            'umur' => $validated['umur'],
            'tb' => $validated['tb'],
            'bb' => $validated['bb'],
            'tensi' => $validated['tensi'] ?? null,
            'goldar' => $validated['goldar'] ?? null,
        ]);

        return redirect()->route('kesehatan.index')->with('success', 'Data kesehatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kesehatan = Kesehatan::findOrFail($id);
        $kesehatan->delete();

        return redirect()->route('kesehatan.index')->with('success', 'Data kesehatan berhasil dihapus.');
    }
}
