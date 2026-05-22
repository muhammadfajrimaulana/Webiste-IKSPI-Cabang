<?php

namespace App\Http\Controllers;

use App\Models\{Anggota, Ranting, Pendaftaran, Transaksi};
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Query Dasar (Awalnya global)
        $queryAnggota = Anggota::query();
        $queryPendaftaran = Pendaftaran::with('ranting')->where('status_verifikasi', 'pending');
        $queryTransaksi = Transaksi::query();

        // FILTER OTOMATIS: 
        // Jika Admin Ranting, batasi datanya hanya untuk ranting_id miliknya
        if ($user->role === 'admin_ranting') {
            $queryAnggota->where('ranting_id', $user->ranting_id);
            $queryPendaftaran->where('ranting_id', $user->ranting_id);
            $queryTransaksi->where('ranting_id', $user->ranting_id);
        }

        // Ambil hasil statistik
        $data = [
            'title' => 'Dashboard ' . ucfirst(str_replace('_', ' ', $user->role)),
            'totalAnggota' => $queryAnggota->count(),
            'totalRanting' => ($user->role === 'admin_cabang') ? Ranting::count() : 0,
            'totalVerifikasi' => $queryPendaftaran->count(),
            'totalMasuk' => $queryTransaksi->where('tipe', 'masuk')->sum('nominal') - $queryTransaksi->where('tipe', 'keluar')->sum('nominal'),
            'antreanPendaftaran' => $queryPendaftaran->latest()->take(5)->get(),
        ];

        return view('dashboard', $data);
    }
}
