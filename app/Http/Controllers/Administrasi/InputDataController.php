<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Ranting;
use Illuminate\Http\Request;

class InputDataController extends Controller
{
    public function create()
    {
        $rantings = Ranting::all();
        return view('administrasi.pendaftaran', compact('rantings'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'nik'           => 'required|string|size:16',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'no_hp'         => 'required|string|max:20',
            'ranting_id'    => 'required|exists:rantings,id',
            'alamat'        => 'required|string',
            'latitude'      => 'nullable|string',
            'longitude'     => 'nullable|string',
            'foto_sakral'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'berkas_pdf'    => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('foto_sakral')) {
            $pathFoto = $request->file('foto_sakral')->store('pendaftaran/foto', 'public');
            $validatedData['foto_sakral'] = $pathFoto;
        }

        if ($request->hasFile('berkas_pdf')) {
            $pathPdf = $request->file('berkas_pdf')->store('pendaftaran/berkas', 'public');
            $validatedData['berkas_pdf'] = $pathPdf;
        }

        $validatedData['status_verifikasi'] = 'pending';

        Pendaftaran::create($validatedData);

        return redirect()->back()->with('success', 'Data calon warga berhasil di-input! Silakan cek di bagian Flow B (Verifikasi).');
    }
}
