<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Menampilkan Dashboard berdasarkan Role (Admin/Anggota)
     */
    public function index()
    {
        // Pengecekan role untuk menentukan view yang dibuka
        if (Auth::user()->role == 'admin') {
            // Admin melihat semua data anggota untuk proses verifikasi
            $members = Member::all();
            return view('admin.dashboard', compact('members'));
        }

        // Anggota hanya melihat dashboard/index milik mereka sendiri
        return view('anggota.index');
    }

    /**
     * Menampilkan Form Pendaftaran (Alur A: Input Data)
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Menyimpan Data Pendaftaran ke Database
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required',
            'foto'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Olah file foto dan simpan ke storage/app/public/photos
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('photos', 'public');
        }

        // 3. Simpan ke database dengan status awal 'pending'
        Member::create([
            'user_id'           => Auth::id(), // Mengikat data anggota ke akun login
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'foto'              => $path,
            'status_verifikasi' => 'pending', 
        ]);

        return redirect()->route('member.index')->with('success', 'Data pendaftaran berhasil dikirim!');
    }

    /**
     * Proses Pengesahan Anggota oleh Admin (Alur B: Verifikasi)
     */
    public function verify($id)
    {
        // Keamanan tambahan: pastikan hanya admin yang bisa eksekusi
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses tidak sah!');
        }

        $member = Member::findOrFail($id);
        $member->update([
            'status_verifikasi' => 'approved' // Status berubah menjadi disahkan
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil disahkan!');
    }
}