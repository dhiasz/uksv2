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

    public function create()
    {
        return view('siswas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'nis' => 'required|digits_between:1,10|numeric',
            'tgl' => 'required|date',
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
            'nis' => 'required|digits_between:1,10|numeric',
            'tgl' => 'required|date',
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

    public function autocomplete(Request $request)
    {
        $term = $request->get('term');
        $results = [];

        if($term){
            $query = Siswa::where('nama', 'LIKE', "%{$term}%")->take(10)->get();

            foreach($query as $siswa){
                $results[] = [
                    'id' => $siswa->id,
                    'label' => $siswa->nama,
                    'value' => $siswa->nama,
                    'nis' => $siswa->nis,
                    'tgl' => $siswa->tgl, // sesuaikan nama field
                ];
            }
        }

        return response()->json($results);
    }


    
}
