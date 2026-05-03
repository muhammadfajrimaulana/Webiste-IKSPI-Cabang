<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKSPI Kera Sakti - Jiwa Satria</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,600,700,800" rel="stylesheet" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 100%);
        }
        .accent-border { border-left: 4px solid #ef4444; } /* Merah IKS */
    </style>
</head>
<body class="bg-[#fafafa] antialiased">

    <!-- Navbar (Sticky & Glassmorphism) -->
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-8 md:px-16 py-6 text-white transition-all duration-300">
        <div class="text-2xl font-black tracking-tighter flex items-center gap-2">
            <span class="bg-red-600 px-2 py-0.5 rounded italic">IKSPI</span> KERA SAKTI
        </div>
        <div class="hidden md:flex gap-10 text-sm font-bold uppercase tracking-widest">
            <a href="#" class="hover:text-red-500 transition">Beranda</a>
            <a href="#" class="hover:text-red-500 transition">Sejarah</a>
            <a href="#" class="hover:text-red-500 transition">Cabang</a>
            <a href="#" class="hover:text-red-500 transition">Galeri</a>
        </div>
        <div class="flex gap-4">
             @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-white text-black text-sm font-bold rounded-full">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 border border-white/50 backdrop-blur-md text-sm font-bold rounded-full hover:bg-white hover:text-black transition">Masuk</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section (Immersive Like image_5f71db.jpg) -->
    <header class="relative h-screen w-full overflow-hidden">
        <!-- Ganti URL ini dengan foto latihan atau lambang IKSPI yang gagah -->
        <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?auto=format&fit=crop&q=80&w=2000" 
             class="absolute inset-0 w-full h-full object-cover grayscale-[20%]" alt="Silat Background">
        <div class="absolute inset-0 hero-overlay flex flex-col items-center justify-center text-center text-white px-6">
            <span class="mb-4 text-red-500 font-bold tracking-[0.3em] uppercase animate-pulse text-sm">Keempat Penjuru Cari Saudara</span>
            <h1 class="text-6xl md:text-8xl font-black tracking-tighter mb-6 leading-[0.9]">
                JIWA <span class="text-red-600">SATRIA</span> <br> BELA DIRI.
            </h1>
            <p class="max-w-xl text-lg opacity-80 mb-10 leading-relaxed font-light">
                Lestarikan warisan budaya bangsa melalui kekuatan fisik dan kemantapan hati di Ikatan Kera Sakti Putra Indonesia.
            </p>
            <div class="flex flex-col md:row gap-4">
                <button class="px-10 py-4 bg-red-600 text-white font-bold rounded-full shadow-2xl hover:bg-red-700 transition transform hover:-translate-y-1">Daftar Anggota</button>
                <button class="px-10 py-4 bg-white/10 backdrop-blur-lg border border-white/20 font-bold rounded-full hover:bg-white/20 transition">Pelajari Teknik</button>
            </div>
        </div>
    </header>

    <!-- Info & Statistik Section -->
    <section class="max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-20 items-center">
        <div class="relative">
            <div class="accent-border pl-6">
                <h2 class="text-4xl font-extrabold tracking-tight mb-6 leading-tight text-gray-900">Membangun Karakter Melalui Gerak & Doa.</h2>
            </div>
            <p class="text-gray-500 mb-10 leading-relaxed text-lg">IKSPI Kera Sakti bukan sekadar bela diri, melainkan wadah pembentukan mental satria yang menjunjung tinggi persaudaraan dan nilai spiritual.</p>
            
            <div class="grid grid-cols-3 gap-8 pt-6 border-t border-gray-100">
                <div>
                    <div class="text-3xl font-black text-red-600">1980</div>
                    <div class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mt-1">Tahun Berdiri</div>
                </div>
                <div>
                    <div class="text-3xl font-black">500+</div>
                    <div class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mt-1">Cabang Aktif</div>
                </div>
                <div>
                    <div class="text-3xl font-black">1M+</div>
                    <div class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mt-1">Warga Anggota</div>
                </div>
            </div>
        </div>

        <!-- Features Cards Like image_5f71db.jpg -->
        <div class="space-y-6">
            <div class="p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm flex items-start gap-6 hover:shadow-xl transition duration-500 group">
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition duration-500">🥊</div>
                <div>
                    <h4 class="font-bold text-xl mb-1">Teknik Perkelahian</h4>
                    <p class="text-sm text-gray-500">Kombinasi kelincahan kera dan kekuatan fisik yang efektif.</p>
                </div>
            </div>
            <div class="p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm flex items-start gap-6 hover:shadow-xl transition duration-500 group">
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition duration-500">🧘</div>
                <div>
                    <h4 class="font-bold text-xl mb-1">Kekuatan Rohani</h4>
                    <p class="text-sm text-gray-500">Pendalaman spiritual untuk ketenangan jiwa dan pikiran.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery/Destinations Section -->
    <section class="bg-gray-900 py-28 px-6 text-white rounded-[3rem] mx-4 mb-10 shadow-inner">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="text-4xl font-black tracking-tight uppercase italic">Galeri Kegiatan</h2>
                    <p class="text-gray-400 mt-2">Melihat lebih dekat semangat para pendekar.</p>
                </div>
                <button class="px-6 py-2 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-black transition">Lihat Semua</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="relative h-[450px] rounded-[2.5rem] overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1552072092-7f9b8d63efcb?auto=format&fit=crop&q=80&w=1000" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Latihan">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent p-10 flex flex-col justify-end">
                        <h4 class="text-2xl font-bold">Latihan Gabungan</h4>
                        <p class="text-sm text-gray-400 mt-2 italic">Membangun sinergi antar cabang.</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="relative h-[450px] rounded-[2.5rem] overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&q=80&w=1000" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Tradisi">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent p-10 flex flex-col justify-end">
                        <h4 class="text-2xl font-bold">Tradisi Pengesahan</h4>
                        <p class="text-sm text-gray-400 mt-2 italic">Momen sakral pengukuhan warga baru.</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="relative h-[450px] rounded-[2.5rem] overflow-hidden group">
                    <div class="absolute inset-0 bg-red-600 flex flex-col items-center justify-center p-10 text-center">
                        <h4 class="text-3xl font-black uppercase mb-4 tracking-tighter">Bergabung Sekarang</h4>
                        <p class="text-sm text-white/80 mb-8">Jadilah bagian dari keluarga besar IKSPI Kera Sakti di seluruh dunia.</p>
                        <button class="px-8 py-3 bg-white text-red-600 font-bold rounded-full">Daftar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>