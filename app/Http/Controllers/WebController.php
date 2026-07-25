<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ranting;
use App\Models\Pengurus;
use App\Models\Anggota;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Content;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()
    {
        $ketua = Pengurus::where('jabatan', 'LIKE', '%Ketua%')->first();
        $sekretaris = Pengurus::where('jabatan', 'LIKE', '%Sekretaris%')->first();
        $bendahara = Pengurus::where('jabatan', 'LIKE', '%Bendahara%')->first();

        $rantings = Ranting::withCount('anggota')->orderBy('nama_ranting', 'asc')->get();
        $galeris = Gallery::latest()->get();
        $beritaUtama = Post::latest()->first();

        $beritaTerbarus = Post::latest()->skip(1)->take(2)->get();

        return view('welcome', compact('ketua', 'sekretaris', 'bendahara', 'rantings', 'galeris', 'beritaUtama', 'beritaTerbarus'));
    }
    public function sejarah()
    {
        $content = Content::first();

        return view('web.profil.sejarah', compact('content'));
    }
    public function visi()
    {
        $content = Content::first();

        return view('web.profil.visi', compact('content'));
    }
    public function falsafah()
    {
        return view('web.profil.falsafah');
    }
    public function legalitas()
    {
        $legals = Content::whereNotNull('legalitas_nama')->get();
        $totalDokumen = $legals->count();

        return view('web.profil.legalitas',  compact('legals', 'totalDokumen'));
    }
    public function panca()
    {
        return view('web.profil.panca');
    }
    public function struktur()
    {
        $struktur = Pengurus::whereNull('parent_id')
            ->with('anakBuah')
            ->orderBy('urutan', 'asc')
            ->get();

        $totalPengurus = Pengurus::count();

        return view('web.struktur', compact('struktur', 'totalPengurus'));
    }
    public function anggota(Request $request)
    {
        $search = $request->input('search');

        $query = Anggota::with(['pendaftaran', 'ranting']);

        $query->when($search, function ($q) use ($search) {
            $q->where('nomor_anggota', 'LIKE', "%{$search}%")
                ->orWhereHas('pendaftaran', function ($sq) use ($search) {
                    $sq->where('nama_lengkap', 'LIKE', "%{$search}%");
                });
        });

        $semuaAnggota = $query->orderBy('nomor_anggota', 'asc')->get();
        $totalAnggota = Anggota::count();

        return view('web.ranting.anggota', compact('semuaAnggota', 'totalAnggota', 'search'));
    }
    public function lokasi(Request $request)
    {
        $user = Auth::user();

        $query = Ranting::withCount('anggota');

        // Jika user login sebagai admin ranting, batasi hanya ranting miliknya
        if ($user && $user->role === 'admin_ranting') {
            $query->where('id', $user->ranting_id);
        }

        $dataRanting = $query->orderBy('nama_ranting', 'asc')->get();
        $totalRanting = $dataRanting->count();

        return view('web.ranting.lokasi', compact('dataRanting', 'totalRanting'));
    }
    public function berita()
    {
        $posts = Post::latest()->paginate(9);

        return view('web.berita', compact('posts'));
    }
    public function showberita($id)
    {
        $berita = Post::findOrFail($id);

        return view('web.show-berita', compact('berita'));
    }
    public function galeri()
    {
        $gambarList = Gallery::where('tipe', 'gambar')->latest()->get();
        $videoList = Gallery::where('tipe', 'video')->latest()->get();

        $galleries = Gallery::latest()->paginate(12);

        return view('web.galeri', compact('galleries', 'gambarList', 'videoList'));
    }
}
