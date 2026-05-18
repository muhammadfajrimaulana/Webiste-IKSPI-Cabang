<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GerbangController extends Controller
{
    public function showGerbangForm()
    {
        return view('auth.gerbang', ['title' => 'Gerbang Utama - IKSPI Jakpus']);
    }

    public function checkGerbangPassword(Request $request)
    {
        // Sementara bypass dulu untuk keperluan testing frontend
        return redirect()->route('login.form');
    }
}
