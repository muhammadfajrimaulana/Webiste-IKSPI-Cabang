<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Ranting;
use App\Models\Pendaftaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total data statistik untuk Stat Cards
        $totalAnggota = Anggota::count();
        $totalRanting = Ranting::count();

        // Verifikasi Form: Hitung pendaftar yang statusnya masih 'pending' (Flow B)
        $totalVerifikasi = Pendaftaran::where('status_verifikasi', 'pending')->count();

        // 2. Ambil data antrean pendaftaran terbaru yang statusnya 'pending' untuk tabel utama
        // Kita gunakan eager loading dengan 'ranting' untuk mengoptimalkan query database
        $antreanPendaftaran = Pendaftaran::with('ranting')
            ->where('status_verifikasi', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5) // Batasi maksimal 5 data terbaru yang muncul di beranda
            ->get();

        // Kas Keuangan: Hitung total saldo (Flow C)
        $totalMasuk = Transaksi::where('tipe', 'masuk')->sum('nominal') - Transaksi::where('tipe', 'keluar')->sum('nominal');

        // 3. Lempar semua data ke view beranda/dashboard utama
        return view('dashboard', [
            'title' => 'Beranda / Pusat Navigasi',
            'icon' => 'fa-house-chimney',
            'totalAnggota' => $totalAnggota,
            'totalRanting' => $totalRanting,
            'totalVerifikasi' => $totalVerifikasi,
            'totalMasuk' => $totalMasuk,
            'antreanPendaftaran' => $antreanPendaftaran
        ]);
    }
}
