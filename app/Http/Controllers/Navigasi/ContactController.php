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
        $kontakCabang = Contact::where('level', 'cabang')->get();

        // Gunakan Auth::user() atau auth()->user()
        $user = Auth::user();

        $kontakRanting = Contact::where('level', 'ranting')
            ->where('ranting_id', $user->ranting_id)
            ->get();

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
