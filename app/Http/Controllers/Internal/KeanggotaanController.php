<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeanggotaanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // LOGIKA ISOLASI: Admin Ranting dipaksa melihat rantingnya sendiri
        $rantingId = ($user->role === 'admin_ranting') ? $user->ranting_id : $request->input('ranting_id');

        // Query Dasar
        $query = Anggota::with(['pendaftaran', 'ranting']);

        // Filter Pencarian
        $query->when($search, function ($q) use ($search) {
            $q->where('nomor_anggota', 'LIKE', "%{$search}%")
                ->orWhereHas('pendaftaran', function ($sq) use ($search) {
                    $sq->where('nama_lengkap', 'LIKE', "%{$search}%");
                });
        });

        // Filter Ranting (yang sudah diisolasi)
        $query->when($rantingId, function ($q) use ($rantingId) {
            $q->where('ranting_id', $rantingId);
        });

        $semuaAnggota = $query->orderBy('nomor_anggota', 'asc')->get();

        // Statistik Dinamis (Penting: harus ikut terfilter berdasarkan user)
        $statQuery = Anggota::query();
        if ($user->role === 'admin_ranting') {
            $statQuery->where('ranting_id', $user->ranting_id);
        }

        return view('internal.keanggotaan', [
            'title' => '1. Manajemen Keanggotaan',
            'icon' => 'fa-users',
            'semuaAnggota' => $semuaAnggota,
            // Statistik disesuaikan dengan enum tingkatan di database
            'statSiswa' => (clone $statQuery)->where('tingkatan', 'Siswa')->count(),
            'statWargaTk1' => (clone $statQuery)->where('tingkatan', 'Warga TK 1')->count(),
            'statWargaTk2' => (clone $statQuery)->where('tingkatan', 'Warga TK 2')->count(),
            'statWargaTk3' => (clone $statQuery)->where('tingkatan', 'Warga TK 3')->count(),
            'search' => $search,
            'rantingId' => $rantingId,
            // Admin Cabang lihat semua ranting, Admin Ranting hanya lihat namanya sendiri
            'dataRanting' => ($user->role === 'admin_cabang')
                ? Ranting::orderBy('nama_ranting', 'asc')->get()
                : Ranting::where('id', $user->ranting_id)->get()
        ]);
    }
}
