<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataRantingController extends Controller
{
    public function daftarRanting()
    {
        $user = Auth::user();

        $query = Ranting::query();

        if ($user->role !== 'admin_cabang' && $user->ranting_id) {
            $query->where('id', $user->ranting_id);
        }

        $dataRanting = $query->orderBy('nama_ranting', 'asc')->get();

        return view('navigasi.ranting', compact('dataRanting'));
    }

    public function updateRanting(Request $request, $id)
    {
        $request->validate([
            'nama_ranting' => 'required|string|max:255',
            'ketua_ranting' => 'nullable|string|max:255',
            'alamat_ranting' => 'nullable|string|max:255',
            'nama_pelatih' => 'required|string|max:255',
            'lokasi_latihan' => 'required|string|max:255',
            'kontak_ranting' => 'required|string|max:255',
        ]);

        $ranting = Ranting::findOrFail($id);
        $ranting->update([
            'nama_ranting' => $request->nama_ranting,
            'ketua_ranting' => $request->ketua_ranting,
            'alamat_ranting' => $request->alamat_ranting,
            'nama_pelatih' => $request->nama_pelatih,
            'lokasi_latihan' => $request->lokasi_latihan,
            'kontak_ranting' => $request->kontak_ranting,
        ]);

        return redirect()->route('menu.ranting')->with('success', 'Data ranting berhasil diperbarui.');
    }
}
