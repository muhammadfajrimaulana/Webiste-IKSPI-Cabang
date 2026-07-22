<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegalitasController extends Controller
{
    public function index()
    {
        $legals = Content::whereNotNull('legalitas_nama')->get();
        $totalDokumen = $legals->count();

        return view('navigasi.legalitas', compact('legals', 'totalDokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'dokumen' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('dokumen')->store('legalitas', 'public');

        Content::create([
            'legalitas_nama' => $request->nama,
            'legalitas_file' => $path
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }

    public function destroy($id)
    {
        $legal = Content::findOrFail($id);

        if ($legal->legalitas_file && Storage::disk('public')->exists($legal->legalitas_file)) {
            Storage::disk('public')->delete($legal->legalitas_file);
        }

        $legal->delete();

        return back()->with('success', 'Dokumen legalitas berhasil dihapus.');
    }
}
