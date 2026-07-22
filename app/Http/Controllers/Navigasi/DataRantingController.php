<?php

namespace App\Http\Controllers\Navigasi;

use App\Http\Controllers\Controller;
use App\Models\Ranting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataRantingController extends Controller
{
    public function daftarRanting()
    {
        $user = Auth::user();

        $query = Ranting::query();

        if ($user->role !== 'admin_cabang' && $user->ranting_id) {
            $query->where('id', $user->ranting_id);
        }

        $dataRanting = $query->orderBy('nama_ranting', 'asc')->get();
        $totalTitik = $dataRanting->count();
        $totalAktif = $dataRanting->whereNotNull('nama_pelatih')->count();

        return view('navigasi.ranting', compact('dataRanting', 'totalTitik', 'totalAktif'));
    }

    public function updateRanting(Request $request, $id)
    {
        $request->validate([
            'nama_ranting' => 'required|string|max:255',
            'ketua_ranting' => 'nullable|string|max:255',
            'alamat_ranting' => 'nullable|string|max:255',
            'nama_pelatih' => 'required|string|max:255',
            'lokasi_latihan' => 'required|string|max:255',
            'kontak_ranting' => 'required|string|max:255',
        ]);

        $ranting = Ranting::findOrFail($id);
        $ranting->update([
            'nama_ranting' => $request->nama_ranting,
            'ketua_ranting' => $request->ketua_ranting,
            'alamat_ranting' => $request->alamat_ranting,
            'nama_pelatih' => $request->nama_pelatih,
            'lokasi_latihan' => $request->lokasi_latihan,
            'kontak_ranting' => $request->kontak_ranting,
        ]);

        return redirect()->route('menu.ranting')->with('success', 'Data ranting berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ranting = Ranting::findOrFail($id);

        DB::transaction(function () use ($ranting) {
            User::where('ranting_id', $ranting->id)->delete();

            $ranting->delete();
        });

        return redirect()->back()->with('success', 'Ranting dan akun admin terkait berhasil dihapus.');
    }
}
