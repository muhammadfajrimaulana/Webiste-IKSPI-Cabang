<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Ranting;
use Illuminate\Http\Request;

class DataRantingController extends Controller
{
    public function daftarRanting()
    {
        $dataRanting = \App\Models\Ranting::all();
        return view('navigasi.ranting', compact('dataRanting'));
    }
}
