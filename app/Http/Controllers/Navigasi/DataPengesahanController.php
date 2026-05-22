<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class DataPengesahanController extends Controller
{
    public function daftarPengesahan()
    {
        $dataPengesahan = \App\Models\Anggota::all();
        return view('navigasi.pengesahan', compact('dataPengesahan'));
    }
}
