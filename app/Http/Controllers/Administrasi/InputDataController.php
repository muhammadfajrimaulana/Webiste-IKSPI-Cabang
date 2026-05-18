<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

class InputDataController extends Controller
{
    public function create()
    {
        return view('administrasi.pendaftaran_form', ['title' => 'Flow A: Pendaftaran Baru']);
    }
}
