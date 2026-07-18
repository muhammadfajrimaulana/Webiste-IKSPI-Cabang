<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputDataController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->ranting_id == null) {
            // Admin Cabang/Pusat: bisa lihat semua ranting
            $rantings = Ranting::all();
        } else {
            // Admin Ranting: hanya bisa lihat rantingnya sendiri
            $rantings = Ranting::where('id', $user->ranting_id)->get();
        }

        return view('administrasi.pendaftaran', compact('rantings'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'nik'           => 'required|string|size:16',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'no_hp'         => 'required|numeric|digits_between:10,15',
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
