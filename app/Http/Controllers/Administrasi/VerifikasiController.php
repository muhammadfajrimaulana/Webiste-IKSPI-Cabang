<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $antrean = Pendaftaran::with('ranting')
            ->where('status_verifikasi', 'pending')
            ->get();
        return view('administrasi.verifikasi', compact('antrean'));
    }

    public function proses($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status_verifikasi' => 'verified']);

        return redirect()->back()->with('success', 'Data ' . $pendaftaran->nama_lengkap . ' berhasil diverifikasi! Data berlanjut ke Flow C.');
    }
}
