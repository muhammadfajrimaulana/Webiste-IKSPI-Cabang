<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class WebPostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(9);

        return view('web.berita', compact('posts'));
    }
}
