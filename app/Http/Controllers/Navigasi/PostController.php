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
        // Mengambil semua konten media, terbaru di atas
        $posts = Post::latest()->get();
        return view('navigasi.media', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori' => 'required',
            'thumbnail' => 'image|nullable|max:2048' // Max 2MB
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('media', 'public');
        }

        Post::create($data);

        return back()->with('success', 'Konten media berhasil diterbitkan!');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate(['judul' => 'required', 'kategori' => 'required']);
        $data = $request->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama jika ada
            if ($post->thumbnail) Storage::disk('public')->delete($post->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('media', 'public');
        }

        $post->update($data);
        return back()->with('success', 'Media berhasil diupdate!');
    }

    public function destroy(Post $post)
    {
        // Hapus file gambar dari storage jika ada
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();
        return back()->with('success', 'Konten berhasil dihapus!');
    }
}
