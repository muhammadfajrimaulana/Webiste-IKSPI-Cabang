<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IKSPISeeder extends Seeder
{
    public function run(): void
    {
        $rantingTanahAbang = DB::table('rantings')->insertGetId([
            'nama_ranting' => 'Tanah Abang',
            'nama_pelatih' => 'Mas Budi Santoso',
            'lokasi_latihan' => 'GOR Tanah Abang, Jakarta Pusat',
            'kontak_ranting' => '081234567890',
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);

        $rantingKemayoran = DB::table('rantings')->insertGetId([
            'nama_ranting' => 'Kemayoran',
            'nama_pelatih' => 'Mas Adi Wijaya',
            'lokasi_latihan' => 'Halaman Kecamatan Kemayoran',
            'kontak_ranting' => '081298765432',
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);


        DB::table('pendaftarans')->insert([
            'ranting_id' => $rantingTanahAbang,
            'nama_lengkap' => 'Wahyu Supono',
            'nik' => '3171012345670001',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2002-08-15',
            'no_hp' => '081211112222',
            'alamat' => 'Jl. Kebon Kacang No. 12, Tanah Abang',
            'status_verifikasi' => 'pending', // 👈 Muncul di Flow B (Belum Verifikasi)
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);

        DB::table('pendaftarans')->insert([
            'ranting_id' => $rantingKemayoran,
            'nama_lengkap' => 'Lukman Pratama',
            'nik' => '3171023456780002',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => '2001-04-20',
            'no_hp' => '081233334444',
            'alamat' => 'Jl. Sumur Batu No. 5, Kemayoran',
            'status_verifikasi' => 'pending',
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);

        $pendaftaran3 = DB::table('pendaftarans')->insertGetId([
            'ranting_id' => $rantingTanahAbang,
            'nama_lengkap' => 'Rian Hidayat',
            'nik' => '3171034567890003',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '1999-12-05',
            'no_hp' => '081255556666',
            'alamat' => 'Jl. KH. Mas Mansyur No. 88, Jakarta Pusat',
            'status_verifikasi' => 'verified',
            'created_at' => Carbon::now('Asia/Jakarta')->subDays(2),
            'updated_at' => Carbon::now('Asia/Jakarta')->subDays(2),
        ]);


        DB::table('anggotas')->insert([
            'nomor_anggota' => 'IKS-JP-2026-0001',
            'pendaftaran_id' => $pendaftaran3,
            'ranting_id' => $rantingTanahAbang,
            'tingkatan' => 'Warga',
            'tanggal_pengesahan' => '2026-05-20',
            'status_aktif' => 'aktif',
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);
    }
}
