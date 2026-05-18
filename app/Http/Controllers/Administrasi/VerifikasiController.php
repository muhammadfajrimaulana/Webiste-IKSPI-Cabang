<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

class VerifikasiController extends Controller
{
    public function index()
    {
        return view('administrasi.verifikasi_index', ['title' => 'Flow B: Verifikasi Data']);
    }
}
