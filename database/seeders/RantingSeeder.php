<?php

namespace Database\Seeders;

use App\Models\Ranting;
use Illuminate\Database\Seeder;

class RantingSeeder extends Seeder
{
    public function run(): void
    {
        $rantings = [
            ['nama_ranting' => 'Gambir', 'ketua_ranting' => 'Budi Santoso', 'alamat_ranting' => 'Jl. Gambir No. 1', 'nama_pelatih' => 'Mas Gilang', 'lokasi_latihan' => 'Lapangan Monas', 'kontak_ranting' => '081211112222'],
            ['nama_ranting' => 'Sawah Besar', 'ketua_ranting' => 'Siti Aminah', 'alamat_ranting' => 'Jl. Sawah Besar No. 1', 'nama_pelatih' => 'Mba Aminah', 'lokasi_latihan' => 'GOR Sawah Besar', 'kontak_ranting' => '081211113333'],
            ['nama_ranting' => 'Kemayoran', 'ketua_ranting' => 'Andi Wijaya', 'alamat_ranting' => 'Jl. Kemayoran No. 1', 'nama_pelatih' => 'Mas Wijaya', 'lokasi_latihan' => 'GOR Kemayoran', 'kontak_ranting' => '081211114444'],
            ['nama_ranting' => 'Senen', 'ketua_ranting' => 'Rudi Hartono', 'alamat_ranting' => 'Jl. Senen No. 1', 'nama_pelatih' => 'MasHartono', 'lokasi_latihan' => 'Aula Kecamatan Senen', 'kontak_ranting' => '081211115555'],
            ['nama_ranting' => 'Cempaka Putih', 'ketua_ranting' => 'Dewi Lestari', 'alamat_ranting' => 'Jl. Cempaka Putih No. 1', 'nama_pelatih' => 'Mba Lestari', 'lokasi_latihan' => 'Lapangan Cempaka', 'kontak_ranting' => '081211116666'],
            ['nama_ranting' => 'Menteng', 'ketua_ranting' => 'Eko Prasetyo', 'alamat_ranting' => 'Jl. Menteng No. 1', 'nama_pelatih' => 'Mas Eko', 'lokasi_latihan' => 'Taman Menteng', 'kontak_ranting' => '081211117777'],
            ['nama_ranting' => 'Tanah Abang', 'ketua_ranting' => 'Farhan Hidayat', 'alamat_ranting' => 'Jl. Tanah Abang No. 1', 'nama_pelatih' => 'Mas Hidayat', 'lokasi_latihan' => 'GOR Tanah Abang', 'kontak_ranting' => '081211118888'],
            ['nama_ranting' => 'Johar Baru', 'ketua_ranting' => 'Gita Permata', 'alamat_ranting' => 'Jl. Johar Baru No. 1', 'nama_pelatih' => 'Mba Permata', 'lokasi_latihan' => 'Aula Johar Baru', 'kontak_ranting' => '081211119999'],
        ];

        foreach ($rantings as $ranting) {
            \App\Models\Ranting::updateOrCreate(
                ['nama_ranting' => $ranting['nama_ranting']],
                $ranting
            );
        }
    }
}
