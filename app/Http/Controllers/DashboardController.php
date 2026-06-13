<?php

namespace App\Http\Controllers;

use App\Models\{Anggota, Ranting, Pendaftaran, Transaksi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Jika role adalah anggota, langsung return view tanpa data admin
        if ($user->role === 'anggota') {
            return view('dashboard', [
                'title' => 'Dashboard Anggota'
            ]);
        }

        // 2. Jika bukan anggota (admin_cabang/admin_ranting), proses logika admin
        $queryAnggota = Anggota::query();
        $queryPendaftaran = Pendaftaran::where('status_verifikasi', 'pending');
        $queryTransaksi = Transaksi::query();

        if (Gate::allows('is-ranting')) {
            $queryAnggota->where('ranting_id', $user->ranting_id);
            $queryPendaftaran->where('ranting_id', $user->ranting_id);
            $queryTransaksi->where('ranting_id', $user->ranting_id);
        }

        $totalMasuk = $queryTransaksi->where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = $queryTransaksi->where('tipe', 'keluar')->sum('nominal');

        return view('dashboard', [
            'title'             => 'Dashboard ' . ucfirst(str_replace('_', ' ', $user->role)),
            'totalAnggota'      => $queryAnggota->count(),
            'totalRanting'      => Gate::allows('is-cabang') ? Ranting::count() : 0,
            'totalVerifikasi'   => $queryPendaftaran->count(),
            'totalSaldo'        => $totalMasuk - $totalKeluar,
            'antreanPendaftaran' => $queryPendaftaran->latest()->take(5)->get(),
        ]);
    }
}
