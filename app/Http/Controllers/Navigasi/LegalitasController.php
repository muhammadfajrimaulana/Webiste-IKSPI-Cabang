<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class LegalitasController extends Controller
{
    public function index()
    {
        $legals = Content::whereNotNull('legalitas_nama')->get();

        return view('navigasi.legalitas', compact('legals'));
    }

    public function store(Request $request)
    {
        $path = $request->file('dokumen')->store('legalitas', 'public');

        Content::create([
            'legalitas_nama' => $request->nama,
            'legalitas_file' => $path
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }
}
