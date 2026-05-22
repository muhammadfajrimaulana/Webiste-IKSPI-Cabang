<?php

namespace Database\Seeders;

use App\Models\Ranting;
use Illuminate\Database\Seeder;

class RantingSeeder extends Seeder
{
    public function run(): void
    {
        $rantings = [
            ['nama_ranting' => 'Ranting Gambir', 'nama_pelatih' => 'Budi Santoso', 'lokasi_latihan' => 'Lapangan Monas', 'kontak_ranting' => '081211112222'],
            ['nama_ranting' => 'Ranting Sawah Besar', 'nama_pelatih' => 'Siti Aminah', 'lokasi_latihan' => 'GOR Sawah Besar', 'kontak_ranting' => '081211113333'],
            ['nama_ranting' => 'Ranting Kemayoran', 'nama_pelatih' => 'Andi Wijaya', 'lokasi_latihan' => 'GOR Kemayoran', 'kontak_ranting' => '081211114444'],
            ['nama_ranting' => 'Ranting Senen', 'nama_pelatih' => 'Rudi Hartono', 'lokasi_latihan' => 'Aula Kecamatan Senen', 'kontak_ranting' => '081211115555'],
            ['nama_ranting' => 'Ranting Cempaka Putih', 'nama_pelatih' => 'Dewi Lestari', 'lokasi_latihan' => 'Lapangan Cempaka', 'kontak_ranting' => '081211116666'],
            ['nama_ranting' => 'Ranting Menteng', 'nama_pelatih' => 'Eko Prasetyo', 'lokasi_latihan' => 'Taman Menteng', 'kontak_ranting' => '081211117777'],
            ['nama_ranting' => 'Ranting Tanah Abang', 'nama_pelatih' => 'Farhan Hidayat', 'lokasi_latihan' => 'GOR Tanah Abang', 'kontak_ranting' => '081211118888'],
            ['nama_ranting' => 'Ranting Johar Baru', 'nama_pelatih' => 'Gita Permata', 'lokasi_latihan' => 'Aula Johar Baru', 'kontak_ranting' => '081211119999'],
        ];

        foreach ($rantings as $ranting) {
            \App\Models\Ranting::updateOrCreate(
                ['nama_ranting' => $ranting['nama_ranting']],
                $ranting
            );
        }
    }
}
