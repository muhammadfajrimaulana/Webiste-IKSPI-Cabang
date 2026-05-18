<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

class OutputController extends Controller
{
    public function index()
    {
        return view('administrasi.report_output', ['title' => 'Flow C: Output Laporan']);
    }
}
