<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Ranting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OperasionalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = Ranting::withCount('anggota');

        if ($user->role === 'admin_ranting') {
            $query->where('id', $user->ranting_id);
        }

        $dataRanting = $query->orderBy('nama_ranting', 'asc')->get();

        return view('internal.operasional', [
            'title' => '2. Operasional Ranting',
            'icon' => 'fa-building-shield',
            'dataRanting' => $dataRanting,
            'totalRanting' => $dataRanting->count(),
            'totalPelatihAktif' => $dataRanting->whereNotNull('nama_pelatih')->count()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ranting'   => 'required|string|max:255',
            'ketua_ranting'  => 'nullable|string|max:255',
            'nama_pelatih'   => 'required|string|max:255',
            'kontak_ranting' => 'required|string|max:255',
            'lokasi_latihan' => 'nullable|string',
        ]);

        $passwordDefault = 'ikspi123';
        $username = '';

        DB::transaction(function () use ($request, $passwordDefault, &$username) {
            $ranting = Ranting::create([
                'nama_ranting'   => $request->nama_ranting,
                'ketua_ranting'  => $request->ketua_ranting,
                'alamat_ranting' => $request->alamat_ranting, // Pastikan input ini ada di form jika dipakai
                'nama_pelatih'   => $request->nama_pelatih,
                'kontak_ranting' => $request->kontak_ranting,
                'lokasi_latihan' => $request->lokasi_latihan,
            ]);

            $slugRanting = Str::slug($request->nama_ranting, '_');
            $username = 'admin_' . $slugRanting;

            User::create([
                'avatar'        => null,
                'nama_pengurus' => 'Admin ' . $request->nama_ranting,
                'username'      => $username,
                'password'      => Hash::make($passwordDefault),
                'role'          => 'admin_ranting',
                'ranting_id'    => $ranting->id,
            ]);
        });

        return redirect()->back()->with([
            'success' => 'Ranting ' . $request->nama_ranting . ' berhasil ditambahkan.',
            'show_credential_modal' => true,
            'new_ranting' => $request->nama_ranting,
            'new_username' => $username,
            'new_password' => $passwordDefault
        ]);
    }

    public function cekNamaRanting(Request $request)
    {
        $namaRanting = $request->query('nama_ranting');

        $exists = Ranting::where('nama_ranting', $namaRanting)->exists();

        return response()->json(['exists' => $exists]);
    }

    protected $msg;

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $ranting = Ranting::findOrFail($id);

        if ($user->role === 'admin_ranting' && $ranting->id !== $user->ranting_id) {
            return redirect()->back()->with('error', 'Akses ditolak! Anda tidak bisa mengubah data ranting lain.');
        }

        $request->validate([
            'nama_ranting' => 'required|string|max:255',
            'nama_pelatih' => 'nullable|string|max:255',
            'lokasi_latihan' => 'required|string',
            'kontak_ranting' => 'nullable|string|max:20',
        ]);

        $ranting->update($request->all());

        return redirect()->back()->with('success', 'Data Ranting berhasil diperbarui!');
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
