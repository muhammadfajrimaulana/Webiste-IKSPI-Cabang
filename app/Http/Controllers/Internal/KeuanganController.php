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
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. Base Query
        $query = Transaksi::with('ranting');

        // 2. Filter berdasarkan ranting_id jika ada input dari form
        if ($request->has('ranting_id') && $request->ranting_id != '') {
            $query->where('ranting_id', $request->ranting_id);
        }

        // 3. Filter kategori transaksi
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // 4. Isolasi: Admin Ranting hanya lihat kas rantingnya
        if ($user->role === 'admin_ranting') {
            $query->where(function ($q) use ($user) {
                $q->where('ranting_id', $user->ranting_id);
                // ->orWhereNull('ranting_id')
            });
        }

        // 5. Ambil data transaksi
        $transaksi = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();

        // 6. Kalkulasi saldo
        $totalMasuk = (clone $query)->where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = (clone $query)->where('tipe', 'keluar')->sum('nominal');

        $totalMasukCabang = Transaksi::where('tipe', 'masuk')->sum('nominal');
        $totalKeluarCabang = Transaksi::where('tipe', 'keluar')->sum('nominal');
        $saldoTotalCabang = $totalMasukCabang - $totalKeluarCabang;

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
            'saldoTotalCabang' => $saldoTotalCabang,
            'dataRanting' => $dataRanting
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($request->has('nominal')) {
            $nominalBersih = str_replace(['.', ','], '', $request->nominal);
            $request->merge(['nominal' => $nominalBersih]);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:300',
            'tipe' => 'required|in:masuk,keluar',
            'nominal' => 'required|numeric|min:1',
            'kategori' => 'required|string',
        ]);

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

    public function cetak(Request $request)
    {
        $query = Transaksi::query();

        // Terapkan filter yang sama persis dengan index agar hasil cetak akurat
        if ($request->has('ranting_id') && $request->ranting_id != '') {
            $query->where('ranting_id', $request->ranting_id);
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $transaksi = $query->orderBy('tanggal', 'desc')->get();
        $ranting = $request->ranting_id ? Ranting::find($request->ranting_id) : null;

        return view('laporan.cetak', compact('transaksi', 'ranting'));
    }
}
