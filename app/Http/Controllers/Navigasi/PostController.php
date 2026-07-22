<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $totalMedia = Post::count();

        return view('navigasi.media', compact('posts', 'totalMedia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'tipe' => 'required|in:berita,gambar,video',
            'kategori' => 'required',
            'isi' => 'nullable',
            'file_path' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('media', 'public');
        }

        Post::create($data);

        return back()->with('success', 'Konten berhasil diterbitkan!');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'judul' => 'required',
            'tipe' => 'required|in:berita,gambar,video',
            'kategori' => 'required'
        ]);

        $data = $request->except('file_path');

        if ($request->hasFile('file_path')) {
            if ($post->file_path) Storage::disk('public')->delete($post->file_path);
            $data['file_path'] = $request->file('file_path')->store('media', 'public');
        }

        $post->update($data);
        return back()->with('success', 'Konten berhasil diupdate!');
    }

    public function destroy(Post $post)
    {
        if ($post->file_path) {
            Storage::disk('public')->delete($post->file_path);
        }

        $post->delete();
        return back()->with('success', 'Konten berhasil dihapus!');
    }
}
