<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $kontakCabang = Contact::all();
        $kontakRanting = \App\Models\Ranting::all();

        if ($user->role === 'admin_cabang') {
            $kontakRanting = \App\Models\Ranting::all();
        } else {
            // $kontakRanting = \App\Models\Ranting::where('id', $user->ranting_id)->get();
            $kontakRanting = \App\Models\Ranting::all();
        }

        return view('navigasi.kontak', compact('kontakCabang', 'kontakRanting'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'nomor_wa' => 'required',
            'level' => 'required',
        ]);

        if ($request->level === 'ranting') {
            $data['ranting_id'] = Auth::user()->ranting_id;
        }

        Contact::create($data);
        return back()->with('success', 'Kontak berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_wa' => 'required|string|max:20',
        ]);

        $kontak = Contact::findOrFail($id);

        $kontak->update([
            'nama' => $request->nama,
            'nomor_wa' => $request->nomor_wa,
        ]);

        return redirect()->back()->with('success', 'Kontak berhasil diperbarui.');
    }
}
