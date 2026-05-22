<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Base Query
        $query = Transaksi::query();

        // 2. Isolasi: Admin Ranting hanya lihat kas rantingnya
        if ($user->role === 'admin_ranting') {
            $query->where('ranting_id', $user->ranting_id);
        }

        // 3. Ambil data transaksi
        $transaksi = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();

        // 4. Kalkulasi saldo (Clone query agar filter tetap terjaga)
        $totalMasuk = (clone $query)->where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = (clone $query)->where('tipe', 'keluar')->sum('nominal');

        $dataRanting = ($user->role === 'admin_cabang')
            ? Ranting::orderBy('nama_ranting', 'asc')->get()
            : [];

        return view('internal.keuangan', [
            'title' => '3. Keuangan & Logistik',
            'icon' => 'fa-wallet',
            'transaksi' => $transaksi,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldoAkhir' => $totalMasuk - $totalKeluar,
            'dataRanting' => $dataRanting
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'nominal' => 'required|numeric|min:1',
            'kategori' => 'required|string',
        ]);

        // Simpan dengan menyertakan ranting_id secara otomatis
        $data = $request->all();
        $data['ranting_id'] = ($user->role === 'admin_ranting') ? $user->ranting_id : $request->ranting_id;

        Transaksi::create($data);

        return redirect()->back()->with('success', 'Transaksi berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $transaksi = Transaksi::findOrFail($id);

        // Proteksi: Admin Ranting tidak boleh ubah kas ranting lain
        if ($user->role === 'admin_ranting' && $transaksi->ranting_id !== $user->ranting_id) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'nominal' => 'required|numeric|min:1',
            'kategori' => 'required|string',
        ]);

        $transaksi->update($request->all());

        return redirect()->back()->with('success', 'Catatan keuangan diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $transaksi = Transaksi::findOrFail($id);

        // Proteksi: Admin Ranting tidak boleh hapus kas ranting lain
        if ($user->role === 'admin_ranting' && $transaksi->ranting_id !== $user->ranting_id) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus!');
    }
}
