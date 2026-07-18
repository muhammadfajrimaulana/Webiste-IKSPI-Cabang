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

        if ($user->role === 'anggota') {
            return view('dashboard', [
                'title' => 'Dashboard Anggota'
            ]);
        }

        $queryAnggota = Anggota::query();
        $queryPendaftaran = Pendaftaran::where('status_verifikasi', 'pending');
        $queryTransaksi = Transaksi::query();

        if (Gate::allows('is-ranting')) {
            $queryAnggota->where('ranting_id', $user->ranting_id);
            $queryPendaftaran->where('ranting_id', $user->ranting_id);
            $queryTransaksi->where('ranting_id', $user->ranting_id);
        }

        $totalMasuk = (clone $queryTransaksi)->where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = (clone $queryTransaksi)->where('tipe', 'keluar')->sum('nominal');

        return view('dashboard', [
            'title'             => 'Dashboard ' . ucfirst(str_replace('_', ' ', $user->role)),
            'totalAnggota'      => $queryAnggota->count(),
            'totalRanting'      => Gate::allows('is-cabang') ? Ranting::count() : 0,
            'totalVerifikasi'   => $queryPendaftaran->count(),
            'totalSaldo'        => $totalMasuk - $totalKeluar,
            'antreanPendaftaran' => $queryPendaftaran->latest()->take(5)->get(),
            'userRanting'       => $user->ranting
        ]);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('profile/profile', [
            'title' => 'Profil ' . ucfirst(str_replace('_', ' ', $user->role)),
            'user'  => $user,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('profile/edit', [
            'title' => 'Edit Profil ' . ucfirst(str_replace('_', ' ', $user->role)),
            'user'  => $user,
        ]);
    }
}
