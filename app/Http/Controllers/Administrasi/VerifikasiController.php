<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Inisialisasi Query
        $query = Pendaftaran::with('ranting')->where('status_verifikasi', 'pending');

        // 2. Filter hanya jika dia Admin Ranting
        if ($user->role === 'admin_ranting') {
            $query->where('ranting_id', $user->ranting_id);
        }

        $antrean = $query->latest()->get();
        return view('administrasi.verifikasi', compact('antrean'));
    }

    public function proses(Request $request, $id)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::findOrFail($id);

        // 3. PROTEKSI: Pastikan Admin Ranting tidak bisa memproses data ranting lain
        if ($user->role === 'admin_ranting' && $pendaftaran->ranting_id !== $user->ranting_id) {
            return redirect()->back()->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk memproses data ranting ini.');
        }

        // 4. Validasi aksi (Terima atau Tolak)
        $request->validate([
            'action' => 'required|in:setujui,tolak'
        ]);

        if ($request->action === 'setujui') {
            $pendaftaran->update(['status_verifikasi' => 'verified']);
            $msg = 'Data ' . $pendaftaran->nama_lengkap . ' berhasil diverifikasi.';
        } else {
            $pendaftaran->update(['status_verifikasi' => 'rejected', 'catatan' => $request->catatan]);
            $msg = 'Data ' . $pendaftaran->nama_lengkap . ' ditolak.';
        }

        return redirect()->back()->with('success', $msg);
    }
}
