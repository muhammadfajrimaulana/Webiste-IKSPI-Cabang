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

        $kontakCabang = Contact::where('level', 'cabang')->get();

        if ($user->role === 'admin_cabang') {
            $kontakRanting = \App\Models\Ranting::all();
        } else {
            $kontakRanting = \App\Models\Ranting::where('id', $user->ranting_id)->get();
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
            // Gunakan Auth::user() agar lebih eksplisit
            $data['ranting_id'] = Auth::user()->ranting_id;
        }

        Contact::create($data);
        return back()->with('success', 'Kontak berhasil ditambah!');
    }
}
