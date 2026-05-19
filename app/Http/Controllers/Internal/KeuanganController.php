<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        // 1. Tarik semua log transaksi dari DB, urutkan dari yang terbaru
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();

        // 2. Kalkulasi nominal total masuk, keluar, dan hitung saldo bersih dinamis
        $totalMasuk = Transaksi::where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = Transaksi::where('tipe', 'keluar')->sum('nominal');
        $saldoAkhir = $totalMasuk - $totalKeluar;

        return view('internal.keuangan', [
            'title' => '3. Keuangan & Logistik',
            'icon' => 'fa-wallet',
            'transaksi' => $transaksi,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldoAkhir' => $saldoAkhir
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input catatan kas baru
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'nominal' => 'required|numeric|min:1',
            'kategori' => 'required|string',
        ]);

        // Simpan ke database
        Transaksi::create($request->all());

        return redirect()->back()->with('success', 'Transaksi keuangan baru berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi input data perubahan
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'nominal' => 'required|numeric|min:1',
            'kategori' => 'required|string',
        ]);

        // 2. Cari dan update datanya di DB
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        // 3. Redirect balik dengan notifikasi sukses
        return redirect()->back()->with('success', 'Catatan keuangan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cari data transaksi berdasarkan ID di database
        $transaksi = Transaksi::findOrFail($id);

        // Simpan keterangan singkat untuk notifikasi alert
        $ketLama = $transaksi->keterangan;

        // Eksekusi penghapusan data
        $transaksi->delete();

        // Kembalikan ke halaman dengan alert sukses
        return redirect()->back()->with('success', 'Catatan transaksi "' . $ketLama . '" berhasil dihapus!');
    }
}
