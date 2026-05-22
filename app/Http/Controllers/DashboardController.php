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

        // 1. Definisikan Base Query
        $queryAnggota = Anggota::query();
        $queryPendaftaran = Pendaftaran::where('status_verifikasi', 'pending');
        $queryTransaksi = Transaksi::query();

        // 2. Gunakan Gate untuk filter (lebih clean daripada mengecek string role)
        if (Gate::allows('is-ranting')) {
            $queryAnggota->where('ranting_id', $user->ranting_id);
            $queryPendaftaran->where('ranting_id', $user->ranting_id);
            $queryTransaksi->where('ranting_id', $user->ranting_id);
        }

        // 3. Hitung Keuangan (optimasi sum)
        $totalMasuk = $queryTransaksi->where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = $queryTransaksi->where('tipe', 'keluar')->sum('nominal');

        // 4. Data Dashboard
        return view('dashboard', [
            'title'           => 'Dashboard ' . ucfirst(str_replace('_', ' ', $user->role)),
            'totalAnggota'    => $queryAnggota->count(),
            'totalRanting'    => Gate::allows('is-cabang') ? Ranting::count() : 0,
            'totalVerifikasi' => $queryPendaftaran->count(),
            'totalSaldo'      => $totalMasuk - $totalKeluar,
            'antreanPendaftaran' => $queryPendaftaran->latest()->take(5)->get(),
        ]);
    }
}
