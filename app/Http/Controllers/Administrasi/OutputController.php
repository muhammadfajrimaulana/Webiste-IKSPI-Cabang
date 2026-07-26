<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\{Pendaftaran, Ranting, Anggota};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OutputController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $querySiapSah = Pendaftaran::where('status_verifikasi', 'verified')
            ->whereDoesntHave('anggota');

        $queryAnggota = Anggota::with(['pendaftaran', 'ranting'])
            ->orderBy('created_at', 'desc');

        // Filter Ranting 
        if ($request->filled('ranting_id')) {
            $querySiapSah->where('ranting_id', $request->ranting_id);
            $queryAnggota->where('ranting_id', $request->ranting_id);
        }

        // Filter khusus untuk Admin Ranting (Override jika user bukan cabang)
        if ($user->role === 'admin_ranting') {
            $querySiapSah->where('ranting_id', $user->ranting_id);
            $queryAnggota->where('ranting_id', $user->ranting_id);
        }

        $wargaSiapSah = $querySiapSah->get();
        $anggotaResmi = $queryAnggota->get();

        // Data untuk dropdown filter
        $dataRanting = ($user->role === 'admin_cabang')
            ? Ranting::all()
            : Ranting::where('id', $user->ranting_id)->get();

        return view('administrasi.output', compact('wargaSiapSah', 'anggotaResmi', 'dataRanting'));
    }

    public function cetakLaporan(Request $request)
    {
        $user = Auth::user();
        $query = Anggota::with(['pendaftaran', 'ranting'])->orderBy('created_at', 'desc');

        if ($request->filled('ranting_id')) {
            $query->where('ranting_id', $request->ranting_id);
        }

        if ($user->role === 'admin_ranting') {
            $query->where('ranting_id', $user->ranting_id);
        }

        $anggotaResmi = $query->get();

        // Tentukan nama file PDF yang dinamis berdasarkan filter/ranting user
        $namaRantingFile = $request->filled('ranting_id')
            ? \App\Models\Ranting::find($request->ranting_id)?->nama_ranting ?? 'Cabang'
            : ($user->ranting?->nama_ranting ?? 'Semua-Ranting');

        $pdf = Pdf::loadView('administrasi.cetak_pdf', compact('anggotaResmi'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan-Pengesahan-' . $namaRantingFile . '.pdf');
    }

    public function updatePengesahan(Request $request, $id)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Proteksi: Admin Ranting tidak bisa mengesahkan data ranting lain
        if ($user->role === 'admin_ranting' && $pendaftaran->ranting_id !== $user->ranting_id) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'nomor_anggota' => 'required|string|unique:anggotas,nomor_anggota',
            'ranting_id' => 'required|exists:rantings,id',
        ]);

        Anggota::create([
            'pendaftaran_id' => $id,
            'ranting_id' => $request->ranting_id,
            'nomor_anggota' => $request->nomor_anggota,
        ]);

        return redirect()->back()->with('success', 'Pendekar resmi disahkan!');
    }

    public function updateTanggal(Request $request, $id)
    {
        // Cari data anggota berdasarkan ID
        $anggota = Anggota::findOrFail($id);

        // Validasi
        $request->validate([
            'tanggal_pengesahan' => 'required|date',
        ]);

        // Update tanggal
        $anggota->update([
            'tanggal_pengesahan' => $request->tanggal_pengesahan
        ]);

        return redirect()->back()->with('success', 'Tanggal pengesahan berhasil diperbarui!');
    }
}
