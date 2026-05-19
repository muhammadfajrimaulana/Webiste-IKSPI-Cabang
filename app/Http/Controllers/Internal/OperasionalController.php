<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Ranting;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
    public function index()
    {
        // Tarik data ranting beserta hitung otomatis berapa jumlah anggota di dalamnya
        // Menggunakan method withCount() bawaan Eloquent Laravel
        $dataRanting = Ranting::withCount('anggota')->orderBy('nama_ranting', 'asc')->get();

        // Hitung total kapasitas operasional cabang
        $totalRanting = $dataRanting->count();
        $totalPelatihAktif = $dataRanting->whereNotNull('nama_pelatih')->count();

        return view('internal.operasional', [
            'title' => '2. Operasional Ranting',
            'icon' => 'fa-building-shield',
            'dataRanting' => $dataRanting,
            'totalRanting' => $totalRanting,
            'totalPelatihAktif' => $totalPelatihAktif
        ]);
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'nama_ranting' => 'required|string|max:255',
            'nama_pelatih' => 'nullable|string|max:255',
            'lokasi_latihan' => 'required|string',
            'kontak_ranting' => 'nullable|string|max:20',
        ]);

        // 2. Simpan ke Database
        Ranting::create([
            'nama_ranting' => $request->nama_ranting,
            'nama_pelatih' => $request->nama_pelatih,
            'lokasi_latihan' => $request->lokasi_latihan,
            'kontak_ranting' => $request->kontak_ranting,
        ]);

        // 3. Redirect Balik dengan Notifikasi Sukses
        return redirect()->back()->with('success', 'Ranting baru berhasil didaftarkan ke sistem Cabang Jakpus!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ranting' => 'required|string|max:255',
            'nama_pelatih' => 'nullable|string|max:255',
            'lokasi_latihan' => 'required|string',
            'kontak_ranting' => 'nullable|string|max:20',
        ]);

        $ranting = Ranting::findOrFail($id);
        $ranting->update([
            'nama_ranting' => $request->nama_ranting,
            'nama_pelatih' => $request->nama_pelatih,
            'lokasi_latihan' => $request->lokasi_latihan,
            'kontak_ranting' => $request->kontak_ranting,
        ]);

        return redirect()->back()->with('success', 'Data Ranting ' . $ranting->nama_ranting . ' berhasil diperbarui!');
    }
}
