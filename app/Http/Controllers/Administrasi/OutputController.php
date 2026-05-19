<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Ranting;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OutputController extends Controller
{
    public function index()
    {
        $wargaSiapSah = Pendaftaran::where('status_verifikasi', 'verified')
            ->whereDoesntHave('anggota')
            ->get();

        $anggotaResmi = Anggota::with(['pendaftaran', 'ranting'])->orderBy('created_at', 'desc')->get();

        $dataRanting = Ranting::all();

        return view('administrasi.output', compact('wargaSiapSah', 'anggotaResmi', 'dataRanting'));
    }

    public function cetakLaporan()
    {
        $anggotaResmi = Anggota::with(['pendaftaran', 'ranting'])->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('administrasi.cetak_pdf', compact('anggotaResmi'));

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan-Pengesahan-Cabang.pdf');
    }

    public function updatePengesahan(Request $request, $id)
    {
        $request->validate([
            'nomor_anggota' => 'required|string|unique:anggotas,nomor_anggota',
            'ranting_id' => 'required|exists:rantings,id',
        ]);

        Anggota::create([
            'pendaftaran_id' => $id,
            'ranting_id' => $request->ranting_id,
            'nomor_anggota' => $request->nomor_anggota,
        ]);

        return redirect()->back()->with('success', 'Sakral dan Nomor Anggota berhasil diterbitkan. Pendekar resmi disahkan!');
    }
}
