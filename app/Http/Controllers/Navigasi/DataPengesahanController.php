<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DataPengesahanController extends Controller
{
    public function daftarPengesahan()
    {
        $user = Auth::user();
        $search = request()->input('search');

        // 1. Mulai query
        $query = Anggota::query()->with(['pendaftaran', 'ranting']);

        // 2. Filter akses data
        if ($user->role === 'anggota') {
            // Anggota cuma bisa lihat datanya sendiri berdasarkan nomor_anggota-nya
            $query->where('nomor_anggota', $user->nomor_anggota);
        } elseif ($user->role === 'admin_ranting') {
            // Admin ranting cuma bisa lihat di rantingnya saja
            $query->where('ranting_id', $user->ranting_id);
        }

        // 3. Filter Pencarian
        $query->when($search, function ($q) use ($search) {
            $q->where('nomor_anggota', 'LIKE', "%{$search}%")
                ->orWhereHas('pendaftaran', function ($sq) use ($search) {
                    $sq->where('nama_lengkap', 'LIKE', "%{$search}%");
                });
        });

        // 4. EKSEKUSI QUERY (Ini yang lu lupa tadi!)
        $dataPengesahan = $query->orderBy('created_at', 'desc')->get();
        $totalPengesahan = $dataPengesahan->count();

        // 5. Transformasi data
        $dataPengesahan->transform(function ($item) {
            $item->nama_lengkap = $item->pendaftaran->nama_lengkap ?? 'N/A';
            $item->nama_ranting = $item->ranting->nama_ranting ?? 'N/A';
            $item->status = $item->status_aktif;
            return $item;
        });

        return view('navigasi.pengesahan', compact('dataPengesahan', 'search', 'totalPengesahan'));
    }

    public function updatePengesahan(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tingkatan'    => 'required|string',
            'status'       => 'required',
        ]);

        // 2. Cari anggota beserta relasi pendaftarannya
        $anggota = Anggota::with('pendaftaran')->findOrFail($id);

        // 3. Update tabel pendaftaran (Nama Lengkap)
        // Cek dulu apakah relasi pendaftarannya ada
        if ($anggota->pendaftaran) {
            $anggota->pendaftaran->update([
                'nama_lengkap' => $request->nama_lengkap
            ]);
        }

        // 4. Update tabel anggota
        $anggota->update([
            'tingkatan'    => $request->tingkatan,
            'status_aktif' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // Method cetak ini buat role anggota aja
    public function cetak()
    {
        $user = Auth::user();

        $p = \App\Models\Anggota::with(['pendaftaran', 'ranting'])
            ->where('id', $user->id)
            ->firstOrFail();

        $pdf = Pdf::loadView('navigasi.cetak-pengesahan', compact('p'));
        $pdf->setPaper('a4', 'portrait');

        // Mengembalikan view khusus cetak (tanpa layout dashboard)
        return $pdf->stream('data-pengesahan.pdf');
    }
}
