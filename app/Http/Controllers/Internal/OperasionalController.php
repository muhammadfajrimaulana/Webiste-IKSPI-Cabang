<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperasionalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // LOGIKA ISOLASI: Jika Ranting, hanya ambil datanya sendiri
        $query = Ranting::withCount('anggota');

        if ($user->role === 'admin_ranting') {
            $query->where('id', $user->ranting_id);
        }

        $dataRanting = $query->orderBy('nama_ranting', 'asc')->get();

        return view('internal.operasional', [
            'title' => '2. Operasional Ranting',
            'icon' => 'fa-building-shield',
            'dataRanting' => $dataRanting,
            'totalRanting' => $dataRanting->count(),
            'totalPelatihAktif' => $dataRanting->whereNotNull('nama_pelatih')->count()
        ]);
    }

    public function store(Request $request)
    {
        // Hanya Admin Cabang yang boleh tambah Ranting
        if (Auth::user()->role !== 'admin_cabang') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menambah Ranting.');
        }

        $request->validate([
            'nama_ranting' => 'required|string|max:255',
            'nama_pelatih' => 'nullable|string|max:255',
            'lokasi_latihan' => 'required|string',
            'kontak_ranting' => 'nullable|string|max:20',
        ]);

        Ranting::create($request->all());

        return redirect()->back()->with('success', 'Ranting baru berhasil didaftarkan!');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $ranting = Ranting::findOrFail($id);

        // PROTEKSI: Admin Ranting hanya boleh edit rantingnya sendiri
        if ($user->role === 'admin_ranting' && $ranting->id !== $user->ranting_id) {
            return redirect()->back()->with('error', 'Akses ditolak! Anda tidak bisa mengubah data ranting lain.');
        }

        $request->validate([
            'nama_ranting' => 'required|string|max:255',
            'nama_pelatih' => 'nullable|string|max:255',
            'lokasi_latihan' => 'required|string',
            'kontak_ranting' => 'nullable|string|max:20',
        ]);

        $ranting->update($request->all());

        return redirect()->back()->with('success', 'Data Ranting berhasil diperbarui!');
    }
}
