<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        // Ambil Ketua Cabang dan sertakan anak buahnya (Ranting/Pengurus bawah)
        $struktur = Pengurus::whereNull('parent_id')
            ->with('anakBuah')
            ->orderBy('urutan', 'asc')
            ->get();

        return view('navigasi.struktur', compact('struktur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'urutan' => 'required|integer',
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        Pengurus::create($data);
        return back()->with('success', 'Data berhasil ditambah!');
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }
        $pengurus->update($data);
        return back()->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Pengurus $pengurus)
    {
        $pengurus->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
