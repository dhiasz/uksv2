<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
  public function index(Request $request)
{
    $query = Siswa::with('user');

    if ($request->has('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $siswas = $query->paginate(10)->withQueryString();

    return view('siswas.index', compact('siswas'));
}


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:5',
            'umur' => 'required|integer',
            'tb' => 'required|integer',
            'bb' => 'required|integer',
            'tensi' => 'nullable|string',
            'goldar' => 'nullable|string',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $users = User::all();
        return view('siswas.edit', compact('siswa', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:20',
            'umur' => 'required|integer',
            'tb' => 'required|integer',
            'bb' => 'required|integer',
            'tensi' => 'nullable|string',
            'goldar' => 'nullable|string|max:2',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
