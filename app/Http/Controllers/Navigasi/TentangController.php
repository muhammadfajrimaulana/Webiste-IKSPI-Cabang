<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        $content = \App\Models\Content::first() ?? new \App\Models\Content();

        return view('navigasi.tentang', compact('content'));
    }

    public function update(Request $request)
    {
        $content = \App\Models\Content::firstOrNew(['id' => 1]);
        $content->visi = $request->visi;
        $content->misi = $request->misi;
        $content->sejarah = $request->sejarah;
        $content->save();

        return back()->with('success', 'Konten berhasil diperbarui!');
    }
}
