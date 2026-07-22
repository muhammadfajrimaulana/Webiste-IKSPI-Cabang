<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::create([
            'judul' => 'Dokumentasi Rapat Koordinasi Cabang',
            'deskripsi' => 'Kegiatan rapat rutin bulanan pengurus untuk membahas program kerja.',
            'file_path' => 'galleries/default.jpg',
            'tipe' => 'gambar',
            'kategori' => 'Rapat',
        ]);

        Gallery::create([
            'judul' => 'Video Profil Kegiatan Bakti Sosial Ranting',
            'deskripsi' => 'Aksi nyata kepedulian sosial kepada masyarakat sekitar.',
            'file_path' => 'galleries/default2.mp4',
            'tipe' => 'video',
            'kategori' => 'Kegiatan',
        ]);
    }
}
