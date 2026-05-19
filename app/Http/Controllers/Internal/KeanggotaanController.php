<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Ranting;
use Illuminate\Http\Request;

class KeanggotaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $rantingId = $request->input('ranting_id'); // Tangkap filter id ranting

        $semuaAnggota = Anggota::with(['pendaftaran', 'ranting'])
            // Filter pencarian teks nama/nomor
            ->when($search, function ($query) use ($search) {
                $query->where('nomor_anggota', 'LIKE', "%{$search}%")
                    ->orWhereHas('pendaftaran', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'LIKE', "%{$search}%");
                    });
            })
            // Filter spesifik per ranting (Tambahan baris ini)
            ->when($rantingId, function ($query) use ($rantingId) {
                $query->where('ranting_id', $rantingId);
            })
            ->orderBy('nomor_anggota', 'asc')
            ->get();

        $statWarga = Anggota::where('tingkatan', 'Warga')->count();
        $statPendekar = Anggota::where('tingkatan', 'Pendekar')->count();
        $statAktif = Anggota::where('status_aktif', 'aktif')->count();
        $statNonAktif = Anggota::where('status_aktif', 'non-aktif')->count();

        return view('internal.keanggotaan', [
            'title' => '1. Manajemen Keanggotaan',
            'icon' => 'fa-users',
            'semuaAnggota' => $semuaAnggota,
            'statWarga' => $statWarga,
            'statPendekar' => $statPendekar,
            'statAktif' => $statAktif,
            'statNonAktif' => $statNonAktif,
            'search' => $search,
            'rantingId' => $rantingId,
            'dataRanting' => Ranting::orderBy('nama_ranting', 'asc')->get()
        ]);
    }
}
