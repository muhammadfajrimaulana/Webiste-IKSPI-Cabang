<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class WebGaleriController extends Controller
{

    public function index()
    {
        $gambarList = Gallery::where('tipe', 'gambar')->latest()->get();
        $videoList = Gallery::where('tipe', 'video')->latest()->get();

        $galleries = Gallery::latest()->paginate(12);

        return view('web.galeri', compact('galleries', 'gambarList', 'videoList'));
    }
}
