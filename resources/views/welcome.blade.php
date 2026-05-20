<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKSPI Kera Sakti - Cabang Jakarta Pusat</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700,900" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50">

    <div
        class="bg-slate-950 text-white text-[10px] py-2 px-6 flex justify-between items-center uppercase tracking-widest font-bold">
        <span>{{ date('l, d F Y') }}</span>
        <div class="flex gap-4">
            <a href="#" class="hover:text-red-500"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-red-500"><i class="fab fa-facebook"></i></a>
            <a href="#" class="hover:text-red-500"><i class="fab fa-youtube"></i></a>
        </div>
    </div>

    <nav class="bg-white border-b border-slate-200 py-6 px-6 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-3xl font-black italic tracking-tighter"><span class="text-red-600">IKSPI</span> JAKPUS</h1>
            <div class="hidden md:flex gap-6 text-xs font-bold uppercase">
                <a href="#" class="hover:text-red-600 transition">Beranda</a>
                <a href="#" class="hover:text-red-600 transition">Sejarah</a>
                <a href="#" class="hover:text-red-600 transition">Media</a>
                <a href="#" class="hover:text-red-600 transition">Kontak</a>
            </div>
            <a href="/login"
                class="bg-red-600 text-white px-4 py-2 text-[10px] font-bold rounded hover:bg-slate-900 transition">LOGIN
            </a>
        </div>
    </nav>

    <section class="max-w-6xl mx-auto p-6">
        <div class="relative w-full h-[450px] rounded-lg overflow-hidden shadow-2xl">
            <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                class="w-full h-full object-cover">
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/90 to-transparent p-12 flex flex-col justify-center">
                <span class="bg-red-600 text-white w-fit px-2 py-1 text-[10px] font-bold mb-3 uppercase">Headline
                    Utama</span>
                <h2 class="text-5xl font-black text-white max-w-2xl leading-tight">MENJAGA WARISAN KERA SAKTI
                    UNTUK MASA DEPAN</h2>
                <button class="mt-6 w-fit bg-white text-black px-6 py-3 font-bold text-xs uppercase rounded">Baca
                    Selengkapnya</button>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-12">
        <h3 class="font-black text-sm uppercase border-b-2 border-black pb-2 mb-8">Galeri Foto</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="h-40 bg-slate-200 rounded hover:opacity-80 transition cursor-pointer">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400" alt="Galeri Foto"
                    class="w-full h-full object-cover rounded">
            </div>
            <div class="h-40 bg-slate-200 rounded hover:opacity-80 transition cursor-pointer">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400" alt="Galeri Foto"
                    class="w-full h-full object-cover rounded">
            </div>
            <div class="h-40 bg-slate-200 rounded hover:opacity-80 transition cursor-pointer">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400" alt="Galeri Foto"
                    class="w-full h-full object-cover rounded">
            </div>
            <div class="h-40 bg-slate-200 rounded hover:opacity-80 transition cursor-pointer">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400" alt="Galeri Foto"
                    class="w-full h-full object-cover rounded">
            </div>
        </div>
    </section>

    <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-8 py-10">
        <div class="md:col-span-2 space-y-8">
            <h3 class="font-black text-sm uppercase border-b-2 border-black pb-2">Berita Terbaru</h3>

            <div class="bg-white p-4 border border-slate-200 rounded flex gap-6 hover:shadow-md transition">
                <div class="w-32 h-24 bg-slate-200 shrink-0"><img
                        src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                        class="w-full h-full object-cover"></div>
                <div>
                    <span class="text-[10px] font-bold text-red-600">KEGIATAN</span>
                    <h3 class="font-bold text-lg mt-1">Penyambutan Warga Baru 2026</h3>
                    <p class="text-xs text-slate-500 mt-1">Liputan lengkap prosesi pengesahan warga baru di padepokan
                        pusat yang berlangsung khidmat.</p>
                </div>
            </div>
            <div class="bg-white p-4 border border-slate-200 rounded flex gap-6 hover:shadow-md transition">
                <div class="w-32 h-24 bg-slate-200 shrink-0"><img
                        src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                        class="w-full h-full object-cover"></div>
                <div><span class="text-[10px] font-bold text-red-600">PRESTASI</span>
                    <h3 class="font-bold text-lg mt-1">Atlet Cabang Jakpus Sabet Juara Umum</h3>
                    <p class="text-xs text-slate-500 mt-1">Turnamen silat antar perguruan se-Jakarta Pusat dimenangkan
                        oleh atlet IKSPI.</p>
                </div>
            </div>
            <div class="bg-white p-4 border border-slate-200 rounded flex gap-6 hover:shadow-md transition">
                <div class="w-32 h-24 bg-slate-200 shrink-0"><img
                        src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                        class="w-full h-full object-cover"></div>
                <div><span class="text-[10px] font-bold text-red-600">RANTING</span>
                    <h3 class="font-bold text-lg mt-1">Jadwal Kegiatan Setiap Ranting 2026</h3>
                    <p class="text-xs text-slate-500 mt-1">Berikut adalah daftar kegiatan yang akan dilaksanakan oleh
                        ranting dalam tahun 2026.</p>
                </div>
            </div>
        </div>

        <aside class="space-y-8">
            <h3 class="font-black text-sm uppercase border-b-2 border-black pb-2">
                Trending
            </h3>
            <div class="bg-white border border-slate-200 rounded-lg p-6">

                <ul class="space-y-6">
                    <li class="group cursor-pointer">
                        <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest">Agenda</span>
                        <h4 class="font-bold text-sm mt-1 group-hover:text-red-700 transition">Jadwal Pengesahan Warga
                            Baru 2026</h4>
                    </li>

                    <li class="group cursor-pointer">
                        <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest">Pendaftaran</span>
                        <h4 class="font-bold text-sm mt-1 group-hover:text-red-700 transition">Dibuka: Pendaftaran Calon
                            Anggota Gelombang II</h4>
                    </li>

                    <li class="group cursor-pointer">
                        <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest">Prestasi</span>
                        <h4 class="font-bold text-sm mt-1 group-hover:text-red-700 transition">Atlet Jakpus Raih Medali
                            Emas di Kejuaraan Nasional</h4>
                    </li>

                    <li class="group cursor-pointer">
                        <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest">Sosial</span>
                        <h4 class="font-bold text-sm mt-1 group-hover:text-red-700 transition">Bakti Sosial Bersih
                            Padepokan & Donor Darah</h4>
                    </li>

                    <li class="group cursor-pointer">
                        <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest">Internal</span>
                        <h4 class="font-bold text-sm mt-1 group-hover:text-red-700 transition">Hasil Rapat Pleno
                            Pengurus Cabang Bulanan</h4>
                    </li>
                </ul>
            </div>
        </aside>
    </main>

    <footer class="bg-slate-950 text-white py-16 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-2">
                <h2 class="text-2xl font-black italic mb-4"><span class="text-red-600">IKSPI</span> JAKPUS</h2>
                <p class="text-[11px] text-slate-400 leading-relaxed max-w-sm">Portal berita resmi IKSPI Kera Sakti
                    Cabang Jakarta Pusat. Wadah informasi untuk warga, pengurus, dan masyarakat umum.</p>
            </div>
            <div>
                <h4 class="font-bold text-xs uppercase mb-4">Navigasi</h4>
                <ul class="text-[11px] text-slate-400 space-y-2">
                    <li><a href="#" class="hover:text-white">Tentang Cabang</a></li>
                    <li><a href="#" class="hover:text-red-500">Struktur Organisasi</a></li>
                    <li><a href="#" class="hover:text-red-500">Galeri Foto</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-xs uppercase mb-4">Kontak</h4>
                <p class="text-[11px] text-slate-400">Jl. Contoh No. 123,<br>Jakarta Pusat, Indonesia.</p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto mt-12 pt-8 border-t border-slate-800 text-center text-[10px] text-slate-500">
            &copy; 2026 IKSPI KERA SAKTI CABANG JAKARTA PUSAT. ALL RIGHTS RESERVED.
        </div>
    </footer>

</body>

</html>
