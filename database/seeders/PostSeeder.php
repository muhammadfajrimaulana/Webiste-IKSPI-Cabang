<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama
        DB::table('posts')->truncate();

        DB::table('posts')->insert([
            [
                'judul' => 'Latihan Gabungan Jakarta Pusat',
                'isi' => 'Kegiatan latihan rutin gabungan untuk meningkatkan fisik dan teknik warga.',
                'file_path' => 'galleries/default.jpg',
                'tipe' => 'gambar',
                'kategori' => 'Kegiatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Acara Pengesahan Warga Baru',
                'isi' => 'Momen sakral pengesahan anggota baru cabang Jakarta Pusat.',
                'file_path' => 'galleries/default.mp4',
                'tipe' => 'video',
                'kategori' => 'Pengesahan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
