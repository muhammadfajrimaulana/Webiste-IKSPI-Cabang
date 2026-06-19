<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contents')->insert([
            [
                'visi' => 'Mendidik manusia yang berbudi luhur, tahu benar dan salah, serta bertakwa kepada Tuhan Yang Maha Esa.',
                'misi' => 'Melestarikan seni budaya bangsa berupa pencak silat aliran Kera Sakti (Kungfu) sebagai wadah bela diri fisik dan mental.',
                'sejarah' => 'Didirikan oleh Bapak R. Totong Kiemdarto pada 15 Januari 1980 di Madiun, memadukan silat nusantara dan kungfu lincah.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
