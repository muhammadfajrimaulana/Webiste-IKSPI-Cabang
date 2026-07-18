<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKSPI Kera Sakti - Cabang Jakarta Pusat</title>
    <!-- Tailwind CSS v4 -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700,900" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- TOP BAR -->
    <div
        class="hidden sm:flex bg-red-950 text-slate-200 text-xs py-2.5 px-6 justify-between items-center font-medium border-b border-red-900/30">
        <div class="flex gap-6">
            <span><i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Jakarta Pusat, Indonesia</span>
            <span><i class="fas fa-envelope mr-2 text-red-500"></i>info@ikspi.or.id</span>
        </div>
        <div class="flex gap-4">
            <a href="#" class="hover:text-red-400 transition"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="hover:text-red-400 transition"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-red-400 transition"><i class="fab fa-youtube"></i></a>
        </div>
    </div>

    <!-- NAVBAR (Modern Transparan dengan efek Blur) -->
    <nav class="bg-white/90 py-4 px-6 sticky top-0 z-50 shadow-md backdrop-blur-md border-b border-slate-100">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3 shrink-0">
                <img src="assets/img/logo1.png" alt="Logo IKSPI" class="h-10 w-auto object-contain">
                <h1 class="text-xs md:text-sm font-bold tracking-tight text-slate-800">
                    <span class="text-red-600 font-black">IKS.PI</span> JAKARTA PUSAT
                </h1>
            </div>

            <!-- DESKTOP MENU -->
            <div class="hidden lg:flex items-center gap-6 text-xs font-bold uppercase tracking-wider text-slate-600">
                <a href="{{ route('landing') }}" class="hover:text-red-600 transition">Beranda</a>

                <!-- Dropdown Profil Desktop -->
                <div class="relative dropdown-container">
                    <button onclick="toggleDropdown(event, 'dropdown-profil-desktop')"
                        class="hover:text-red-600 transition flex items-center gap-1 uppercase font-bold text-xs focus:outline-none cursor-pointer">
                        Profil <i
                            class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
                    </button>
                    <div id="dropdown-profil-desktop"
                        class="dropdown-menu absolute top-full left-0 mt-4 w-48 bg-white border border-slate-100 shadow-2xl rounded-xl py-2 hidden text-slate-800 z-50">
                        <a href="{{ route('menu.tentang') }}"
                            class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Sejarah</a>
                        <a href="{{ route('menu.tentang') }}"
                            class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Visi
                            Misi</a>
                        <a href="{{ route('menu.tentang') }}"
                            class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Falsafah</a>
                        <a href="{{ route('menu.tentang') }}"
                            class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Legalitas</a>
                        <a href="{{ route('menu.tentang') }}"
                            class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Panca
                            prasetya</a>
                    </div>
                </div>

                <a href="{{ route('menu.struktur') }}" class="hover:text-red-600 transition">Struktur</a>

                <!-- Dropdown Anggota Desktop -->
                <div class="relative dropdown-container">
                    <button onclick="toggleDropdown(event, 'dropdown-anggota-desktop')"
                        class="hover:text-red-600 transition flex items-center gap-1 uppercase font-bold text-xs focus:outline-none cursor-pointer">
                        Ranting<i
                            class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
                    </button>
                    <div id="dropdown-anggota-desktop"
                        class="dropdown-menu absolute top-full left-0 mt-4 w-48 bg-white border border-slate-100 shadow-2xl rounded-xl py-2 hidden text-slate-800 z-50">
                        <a href="#"
                            class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Anggota
                            IKSPI</a>
                        <a href="#"
                            class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Lokasi
                            Ranting</a>
                    </div>
                </div>

                <a href="{{ route('menu.media') }}" class="hover:text-red-600 transition">Berita</a>
                <a href="#galeri" class="hover:text-red-600 transition">Galeri</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="/login"
                    class="bg-red-600 text-white px-5 py-2.5 text-xs font-bold rounded-full hover:bg-slate-900 transition tracking-wider uppercase shadow-md shadow-red-600/20">LOGIN</a>
                <button id="menu-btn" class="lg:hidden p-2 text-slate-800 focus:outline-none cursor-pointer"><i
                        class="fas fa-bars text-lg"></i></button>
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobile-menu"
            class="hidden lg:hidden mt-3 border-t border-slate-100 pt-3 pb-2 text-xs font-bold uppercase tracking-wider text-slate-600 space-y-1">
            <a href="{{ route('landing') }}"
                class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Beranda</a>

            <div class="dropdown-container">
                <button onclick="toggleDropdown(event, 'dropdown-profil-mobile')"
                    class="w-full text-left py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition flex justify-between items-center uppercase font-bold text-xs focus:outline-none cursor-pointer">
                    Profil <i class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
                </button>
                <div id="dropdown-profil-mobile"
                    class="dropdown-menu bg-slate-50 rounded-xl mx-2 my-1 py-1 hidden space-y-1">
                    <a href="{{ route('menu.tentang') }}"
                        class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Sejarah</a>
                    <a href="{{ route('menu.tentang') }}"
                        class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Visi Misi</a>
                </div>
            </div>

            <a href="{{ route('menu.struktur') }}"
                class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Struktur</a>

            <div class="dropdown-container">
                <button onclick="toggleDropdown(event, 'dropdown-anggota-mobile')"
                    class="w-full text-left py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition flex justify-between items-center uppercase font-bold text-xs focus:outline-none cursor-pointer">
                    Anggota <i class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
                </button>
                <div id="dropdown-anggota-mobile"
                    class="dropdown-menu bg-slate-50 rounded-xl mx-2 my-1 py-1 hidden space-y-1">
                    <a href="#" class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Anggota Ranting
                        1</a>
                    <a href="#" class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Anggota Ranting
                        2</a>
                </div>
            </div>

            <a href="{{ route('menu.media') }}"
                class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Berita</a>
            <a href="#galeri"
                class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Galeri</a>
        </div>
    </nav>
    <!-- HERO SECTION (Bersih & Tanpa Kartu) -->
    <header class="w-full relative bg-slate-950">
        <!-- Banner Utama: Padding disesuaikan agar pas langsung ke section berikutnya -->
        <div class="w-full bg-cover bg-center flex items-center pt-20 pb-20 md:pt-28 md:pb-28 px-5 sm:px-12 md:px-24"
            style="background-image: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.85)), url('assets/img/ikspi1.jpg');">
            <div class="max-w-3xl text-left">
                <span class="text-red-600 font-bold text-[10px] md:text-xs uppercase tracking-widest mb-2 block">Ikatan
                    Keluarga Silat Putra Indonesia</span>

                <h2 class="text-3xl md:text-5xl font-black text-white leading-tight mb-3 uppercase tracking-tight">
                    IKS.PI KERA SAKTI <br>
                    <span class="text-red-600">CABANG JAKARTA PUSAT</span>
                </h2>

                <p class="text-slate-400 mb-6 text-xs md:text-sm max-w-xl font-light leading-relaxed">
                    Wadah resmi pelestarian seni budaya bela diri, pembinaan prestasi atlet, serta pemersatu seluruh
                    pendekar di wilayah Jakarta Pusat.
                </p>

                <a href="#profil"
                    class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold text-[11px] py-2.5 px-5 rounded-sm uppercase tracking-wider transition duration-300">
                    Pelajari Selengkapnya
                </a>
            </div>
        </div>
    </header>

    <!-- DATA SECTION (Pita Counter - Langsung Menyambung Rapi) -->
    <section id="data"
        class="bg-gradient-to-r from-red-950 via-red-900 to-red-950 text-white py-10 md:py-12 border-b-4 border-red-600 shadow-inner">
        <div class="max-w-6xl mx-auto px-6">
            <div
                class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 text-center divide-y sm:divide-y-0 sm:divide-x divide-red-800/40">
                <div class="pt-2 sm:pt-0">
                    <h3 class="text-3xl md:text-4xl font-black text-white mb-0.5 tracking-tight">Angkatan 140</h3>
                    <p class="text-[9px] md:text-[10px] text-red-400 font-bold uppercase tracking-widest">Pengesahan
                        Terakhir</p>
                </div>
                <div class="pt-4 sm:pt-0">
                    <h3 class="text-3xl md:text-4xl font-black text-white mb-0.5 tracking-tight">250+</h3>
                    <p class="text-[9px] md:text-[10px] text-red-400 font-bold uppercase tracking-widest">Warga Baru
                        Disahkan</p>
                </div>
                <div class="pt-4 sm:pt-0">
                    <h3 class="text-3xl md:text-4xl font-black text-white mb-0.5 tracking-tight">2026</h3>
                    <p class="text-[9px] md:text-[10px] text-red-400 font-bold uppercase tracking-widest">Periode
                        Pengesahan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PROFIL SECTION (Foto Bertumpuk Halus / Melengkung Modern) -->
    <section id="profil" class="max-w-6xl mx-auto px-6 py-24 md:py-32">
        <div class="grid md:grid-cols-2 gap-16 items-center">

            <!-- Susunan Foto Estetik Melengkung -->
            <div class="relative min-h-[380px] sm:min-h-[460px]">
                <div
                    class="w-4/5 h-[340px] sm:h-[420px] overflow-hidden rounded-2xl shadow-xl border border-slate-100">
                    <img src="assets/img/Pendiri.JPG" alt="Pendiri IKSPI"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div
                    class="absolute right-0 bottom-4 w-1/2 h-[200px] sm:h-[260px] border-4 border-white overflow-hidden rounded-2xl shadow-2xl">
                    <img src="assets/img/ikspi1.jpg" alt="IKSPI Latihan" class="w-full h-full object-cover">
                </div>
                <!-- Floating Badge Ornamen -->
                <div
                    class="absolute left-6 bottom-0 bg-slate-900 text-white p-5 text-center rounded-2xl shadow-xl border-b-4 border-red-600 animate-bounce-slow">
                    <span class="block text-3xl font-black text-red-500">1980</span>
                    <span class="text-[9px] uppercase font-bold tracking-widest text-slate-400">Sejak Berdiri</span>
                </div>
            </div>

            <!-- Konten Teks -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-8 h-1 bg-red-600 rounded-full"></span>
                    <span class="text-red-600 font-bold text-xs uppercase tracking-widest">Tentang Kami</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 leading-tight tracking-tight">
                    Mengenal Lebih Dekat <br>
                    <span class="bg-gradient-to-r from-red-600 to-red-950 bg-clip-text text-transparent">IKSPI Kera
                        Sakti</span>
                </h2>
                <div class="space-y-4 text-slate-600 text-sm sm:text-[15px] leading-relaxed mb-8">
                    <p>
                        Perguruan Seni Ilmu Beladiri Kung Fu IKS.PI. Kera Sakti merupakan kombinasi dari seni ilmu
                        beladiri kungfu dataran Tiongkok dengan pengembangan teknik yang dilakukan oleh pendiri
                        sekaligus Guru Besar, dilengkapi dengan teknik seni pernapasan ilmu tenaga dalam.
                    </p>
                    <p>
                        Berdiri pada 15 Januari 1980 di Madiun, nama asli perguruan ini adalah <strong
                            class="text-slate-900 font-semibold">Ikatan Keluarga Silat “Putera Indonesia”</strong>.
                        Seiring berkembangnya perguruan, masyarakat lebih mengenal teknik jurus kera yang diajarkan,
                        sehingga ditambahkanlah nama “Kera Sakti”.
                    </p>
                </div>
                <a href="#profil"
                    class="inline-flex items-center gap-2 bg-red-600 text-white px-6 py-3.5 text-xs font-bold uppercase rounded-full hover:bg-slate-900 transition shadow-lg shadow-red-600/20 group">
                    Jelajahi Profil <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION VISI, MISI, FALSAFAH (Kotak Modern - Melengkung & Hover Mengambang) -->
    <section class="relative bg-slate-900 text-white py-24 px-6 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center opacity-5"
            style="background-image: url('assets/img/ikspi1.jpg');"></div>

        <!-- Ornamen Latar Belakang Estetik -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-red-600/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-red-900/20 rounded-full blur-3xl"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="grid md:grid-cols-3 gap-8 items-stretch">

                <!-- FALSAFAH (Kotak Melengkung Estetik) -->
                <div
                    class="bg-white text-slate-800 p-8 rounded-2xl shadow-xl flex flex-col justify-between border-t-4 border-red-600 hover:-translate-y-2 transition duration-300">
                    <div>
                        <div
                            class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-lg font-bold mb-6">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-3">Falsafah & Moto</h3>
                        <p class="text-slate-600 text-sm leading-relaxed italic mb-4">
                            "Warga IKS dapat patah tangannya dapat pula patah kakinya akan tetapi tidak dapat dipatahkan
                            selama tidak patah IKSnya."
                        </p>
                    </div>
                    <p class="text-slate-500 text-xs border-t border-slate-100 pt-4 mt-2">
                        <strong class="text-red-600 block uppercase mb-1 text-[10px] tracking-wider">Moto:</strong>
                        Keempat penjuru kita mencari saudara akan tetapi bila ada musuh pantang untuk tunduk kepala.
                    </p>
                </div>

                <!-- VISI MISI -->
                <div
                    class="bg-white text-slate-800 p-8 rounded-2xl shadow-xl flex flex-col justify-between border-t-4 border-slate-900 hover:-translate-y-2 transition duration-300">
                    <div>
                        <div
                            class="w-12 h-12 bg-slate-100 text-slate-900 rounded-xl flex items-center justify-center text-lg font-bold mb-6">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-4">Visi & Misi</h3>
                        <ul class="text-slate-600 text-sm space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-red-600 mt-1"><i class="fas fa-check-circle"></i></span>
                                <span>Mengembangkan potensi bela diri silat berlapis nasional maupun internasional
                                    dengan akhlak luhur.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- TUJUAN -->
                <div
                    class="bg-white text-slate-800 p-8 rounded-2xl shadow-xl flex flex-col justify-between border-t-4 border-red-600 hover:-translate-y-2 transition duration-300">
                    <div>
                        <div
                            class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-lg font-bold mb-6">
                            <i class="fas fa-flag"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-4">Tujuan Utama</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Mendidik kader bangsa yang beriman, berakhlak mulia, dan berbudi pekerti luhur dengan
                            mengkombinasikan bela diri kungfu-silat dan kerohanian untuk menghasilkan manusia sehat
                            lahir batin berjiwa Pancasila.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- STRUKTUR SECTION (Gaya Team Melengkung Modern) -->
    <section id="struktur" class="bg-slate-100/70 py-24 border-t border-b border-slate-200/30">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <span class="w-6 h-1 bg-red-600 rounded-full"></span>
                    <span class="text-red-600 font-bold text-xs uppercase tracking-wider">Manajemen Organisasi</span>
                    <span class="w-6 h-1 bg-red-600 rounded-full"></span>
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Struktur Organisasi</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-5xl mx-auto">

                <!-- Ketua -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md border-b-4 border-red-600 text-center group hover:-translate-y-2 transition duration-300">
                    <div class="h-44 bg-gradient-to-br from-slate-800 to-slate-950 relative overflow-hidden">
                        <i
                            class="fas fa-user-shield text-5xl text-white/20 absolute inset-0 m-auto h-fit w-fit group-hover:scale-110 transition duration-300"></i>
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] text-red-600 font-bold uppercase tracking-widest block mb-1">Ketua
                            Cabang</span>
                        <h4 class="font-black text-slate-900 text-base">Nama Ketua Cabang</h4>
                    </div>
                </div>

                <!-- Sekretaris -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md border-b-4 border-slate-900 text-center group hover:-translate-y-2 transition duration-300">
                    <div class="h-44 bg-gradient-to-br from-slate-800 to-slate-950 relative overflow-hidden">
                        <i
                            class="fas fa-user-pen text-5xl text-white/20 absolute inset-0 m-auto h-fit w-fit group-hover:scale-110 transition duration-300"></i>
                    </div>
                    <div class="p-6">
                        <span
                            class="text-[10px] text-slate-500 font-bold uppercase tracking-widest block mb-1">Sekretaris</span>
                        <h4 class="font-black text-slate-900 text-base">Nama Sekretaris</h4>
                    </div>
                </div>

                <!-- Bendahara -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md border-b-4 border-red-600 text-center group hover:-translate-y-2 transition duration-300">
                    <div class="h-44 bg-gradient-to-br from-slate-800 to-slate-950 relative overflow-hidden">
                        <i
                            class="fas fa-wallet text-5xl text-white/20 absolute inset-0 m-auto h-fit w-fit group-hover:scale-110 transition duration-300"></i>
                    </div>
                    <div class="p-6">
                        <span
                            class="text-[10px] text-red-600 font-bold uppercase tracking-widest block mb-1">Bendahara</span>
                        <h4 class="font-black text-slate-900 text-base">Nama Bendahara</h4>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ANGGOTA SECTION (Call To Action Premium) -->
    <section id="anggota" class="relative bg-cover bg-center py-24 px-6 text-white text-center"
        style="background-image: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url('assets/img/ikspi1.jpg');">
        <div class="max-w-4xl mx-auto relative z-10">
            <span class="text-red-500 font-bold text-xs uppercase tracking-widest block mb-2">Keluarga Besar</span>
            <h2 class="text-3xl md:text-4xl font-black mb-4 tracking-tight uppercase">Keanggotaan Jakpus</h2>
            <p class="text-slate-300 text-sm font-light max-w-2xl mx-auto leading-relaxed mb-10">
                Menjadi bagian dari keluarga besar IKSPI Kera Sakti Cabang Jakarta Pusat berarti siap memegang teguh
                komitmen, disiplin, dan persaudaraan tanpa batas. Silakan hubungi sekretariat atau ranting terdekat
                untuk validasi kartu tanda anggota (KTA).
            </p>

            <div class="flex flex-wrap justify-center gap-16 mb-10">
                <div>
                    <h5 class="text-4xl font-black text-red-500 tracking-tight">1,200+</h5>
                    <p class="text-xs text-slate-400 mt-1 uppercase font-bold tracking-wider">Total Anggota Aktif</p>
                </div>
                <div>
                    <h5 class="text-4xl font-black text-red-500 tracking-tight">80+</h5>
                    <p class="text-xs text-slate-400 mt-1 uppercase font-bold tracking-wider">Pelatih Tersertifikasi
                    </p>
                </div>
            </div>

            <button
                class="bg-red-600 hover:bg-white hover:text-slate-900 text-white font-bold text-xs py-4 px-8 rounded-full uppercase transition duration-300 tracking-wider shadow-lg shadow-red-600/20">
                Hubungi Admin Keanggotaan <i class="fas fa-chevron-right text-[9px] ml-1"></i>
            </button>
        </div>
    </section>


    <!-- RANTING SECTION (Seksi Wilayah) -->
    <section id="ranting" class="max-w-6xl mx-auto px-6 py-24">
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="w-6 h-1 bg-red-600 rounded-full"></span>
                <span class="text-red-600 font-bold text-xs uppercase tracking-wider">Wilayah Latihan</span>
                <span class="w-6 h-1 bg-red-600 rounded-full"></span>
            </div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Daftar Ranting / Tempat Latihan</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <div
                class="bg-white p-6 rounded-2xl border-l-4 border-red-600 shadow-md shadow-slate-100 hover:-translate-y-1.5 transition duration-300">
                <div class="text-red-600 text-lg mb-3"><i class="fas fa-map-marker-alt"></i></div>
                <h4 class="font-black text-base text-slate-900 mb-1">Ranting Gambir</h4>
                <p class="text-xs text-slate-500">Lokasi: Lapangan Olahraga Hubdam</p>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border-l-4 border-slate-900 shadow-md shadow-slate-100 hover:-translate-y-1.5 transition duration-300">
                <div class="text-red-600 text-lg mb-3"><i class="fas fa-map-marker-alt"></i></div>
                <h4 class="font-black text-base text-slate-900 mb-1">Ranting Kemayoran</h4>
                <p class="text-xs text-slate-500">Lokasi: Area Komplek Olahraga Kemayoran</p>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border-l-4 border-red-600 shadow-md shadow-slate-100 hover:-translate-y-1.5 transition duration-300">
                <div class="text-red-600 text-lg mb-3"><i class="fas fa-map-marker-alt"></i></div>
                <h4 class="font-black text-base text-slate-900 mb-1">Ranting Menteng</h4>
                <p class="text-xs text-slate-500">Lokasi: Aula Terbuka Taman Menteng</p>
            </div>

        </div>
    </section>


    <!-- GALERI SECTION (Slider Aktif Bisa Digeser) -->
    <section id="galeri" class="max-w-6xl mx-auto px-6 py-16 md:py-24">
        <!-- Header Galeri + Tombol Navigasi -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div class="text-left">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-6 h-1 bg-red-600 rounded-full"></span>
                    <span class="text-red-600 font-bold text-xs uppercase tracking-wider">Dokumentasi</span>
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Galeri Foto Kegiatan</h2>
            </div>

            <!-- Tombol Geser Kiri & Kanan -->
            <div class="flex gap-2">
                <button id="slide-prev"
                    class="w-10 h-10 rounded-full border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-300 flex items-center justify-center transition shadow-sm active:scale-95">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button id="slide-next"
                    class="w-10 h-10 rounded-full bg-red-600 text-white hover:bg-red-700 flex items-center justify-center transition shadow-md active:scale-95">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Area Foto yang Bisa Di-scroll / Di-slide -->
        <div id="slider-container" class="flex overflow-x-auto gap-4 pb-4 scroll-smooth snap-x snap-mandatory"
            style="scrollbar-width: none; -ms-overflow-style: none;">

            <!-- Foto 1 -->
            <div
                class="w-[80%] sm:w-1/3 md:w-1/4 flex-shrink-0 h-48 sm:h-52 bg-slate-200 overflow-hidden rounded-2xl group shadow-md border border-slate-100 snap-start">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            </div>

            <!-- Foto 2 -->
            <div
                class="w-[80%] sm:w-1/3 md:w-1/4 flex-shrink-0 h-48 sm:h-52 bg-slate-200 overflow-hidden rounded-2xl group shadow-md border border-slate-100 snap-start">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            </div>

            <!-- Foto 3 -->
            <div
                class="w-[80%] sm:w-1/3 md:w-1/4 flex-shrink-0 h-48 sm:h-52 bg-slate-200 overflow-hidden rounded-2xl group shadow-md border border-slate-100 snap-start">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            </div>

            <!-- Foto 4 -->
            <div
                class="w-[80%] sm:w-1/3 md:w-1/4 flex-shrink-0 h-48 sm:h-52 bg-slate-200 overflow-hidden rounded-2xl group shadow-md border border-slate-100 snap-start">
                <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=400"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            </div>

            <!-- Anda bisa duplikat struktur di atas jika ingin menambah foto baru -->

        </div>
    </section>


    <!-- BERITA SECTION -->
    <section id="berita" class="bg-white py-24 border-t border-slate-100">
        <div class="max-w-6xl mx-auto px-6">
            <div
                class="flex flex-col sm:flex-row sm:justify-between sm:items-end mb-12 border-b border-slate-100 pb-4 gap-2">
                <div>
                    <span class="text-red-600 font-bold text-xs uppercase tracking-wider block mb-1">Informasi
                        Terkini</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Kabar & Kegiatan Cabang</h2>
                </div>
                <a href="#"
                    class="text-xs font-bold text-red-600 hover:text-slate-900 transition flex items-center gap-1 self-start sm:self-auto">
                    Lihat Semua Berita <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="relative rounded-2xl overflow-hidden h-[360px] sm:h-[440px] shadow-lg group">
                        <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=1200"
                            class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent">
                        </div>
                        <div class="absolute bottom-0 inset-x-0 p-6 md:p-8 flex flex-col items-start justify-end">
                            <span
                                class="inline-flex items-center gap-1 bg-red-600 text-white text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase mb-3">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Berita Utama
                            </span>
                            <h3
                                class="text-xl sm:text-2xl font-black text-white leading-tight mb-2 hover:text-red-400 transition">
                                <a href="#">Latihan Gabungan Akbar Se-Jakarta Pusat Sukses Menyatukan Ratusan
                                    Pendekar</a>
                            </h3>
                            <div class="flex items-center gap-3 text-[11px] text-slate-300">
                                <span>05 Juli 2026</span>
                                <span>•</span>
                                <span>Humas Jakpus</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <h3
                        class="text-xs font-black text-slate-900 uppercase tracking-widest border-b-2 border-red-600 pb-1 self-start">
                        Berita Terbaru
                    </h3>
                    <div class="space-y-4">
                        <div class="flex gap-3 items-start group">
                            <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=150"
                                class="w-16 h-16 rounded-xl object-cover shrink-0 shadow-sm">
                            <div>
                                <span class="text-[9px] text-red-600 font-bold uppercase block mb-0.5">Prestasi</span>
                                <h4
                                    class="font-bold text-xs text-slate-900 leading-snug group-hover:text-red-600 transition line-clamp-2">
                                    <a href="#">Atlet IKSPI Cabang Jakpus Sabet Juara Umum di Kejuaraan Kota</a>
                                </h4>
                                <span class="text-[10px] text-slate-400 block mt-1">04 Juli 2026</span>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start group">
                            <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=150"
                                class="w-16 h-16 rounded-xl object-cover shrink-0 shadow-sm">
                            <div>
                                <span
                                    class="text-[9px] text-red-600 font-bold uppercase block mb-0.5">Pengumuman</span>
                                <h4
                                    class="font-bold text-xs text-slate-900 leading-snug group-hover:text-red-600 transition line-clamp-2">
                                    <a href="#">Jadwal Lengkap Latihan Gabungan dan Persiapan Pengesahan Angkatan
                                        141</a>
                                </h4>
                                <span class="text-[10px] text-slate-400 block mt-1">02 Juli 2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-950 text-white py-16 px-6 border-t border-slate-900 text-xs font-light">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-2 space-y-4">
                <h2 class="text-2xl font-black tracking-wider text-white"><span class="text-red-600">IKSPI</span>
                    JAKPUS</h2>
                <p class="text-slate-400 max-w-sm leading-relaxed text-sm">
                    Portal berita dan informasi resmi Ikatan Keluarga Silat Putra Indonesia (IKSPI) Kera Sakti Cabang
                    Jakarta Pusat.
                </p>
                <div class="flex gap-4 pt-2">
                    <a href="#"
                        class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center hover:bg-red-600 transition"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#"
                        class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center hover:bg-red-600 transition"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#"
                        class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center hover:bg-red-600 transition"><i
                            class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-bold text-white text-sm uppercase tracking-wider mb-4 border-l-2 border-red-600 pl-2">
                    Quick Links</h4>
                <ul class="text-slate-400 space-y-2.5">
                    <li><a href="#profil" class="hover:text-red-500 transition flex items-center gap-1">› Tentang
                            Cabang</a></li>
                    <li><a href="#struktur" class="hover:text-red-500 transition flex items-center gap-1">› Struktur
                            Organisasi</a></li>
                    <li><a href="#ranting" class="hover:text-red-500 transition flex items-center gap-1">› Daftar
                            Ranting</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white text-sm uppercase tracking-wider mb-4 border-l-2 border-red-600 pl-2">
                    Kontak Utama</h4>
                <p class="text-slate-400 leading-relaxed">
                    <strong>Alamat Pusat:</strong><br>
                    Jakarta Pusat, DKI Jakarta, Indonesia.
                </p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto mt-12 pt-6 border-t border-slate-900 text-center text-slate-500 text-[11px]">
            <p>Allright Reserved - © 2026 IKSPI Jakarta Pusat Cabang Resmi.</p>
        </div>
    </footer>

    <!-- LOGIKA JAVASCRIPT UTAMA -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        // Toggle menu utama di Mobile
        menuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            mobileMenu.classList.toggle('hidden');
        });

        // Logika Dropdown Universal (Desktop & Mobile)
        function toggleDropdown(event, id) {
            event.stopPropagation();
            const dropdown = document.getElementById(id);
            const currentIcon = event.currentTarget.querySelector('.fa-chevron-down');
            const isHidden = dropdown.classList.contains('hidden');

            // Tutup semua dropdown lain terlebih dahulu
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('.fa-chevron-down').forEach(icon => {
                icon.classList.remove('rotate-180');
            });

            // Jika sebelumnya tertutup, sekarang buka
            if (isHidden) {
                dropdown.classList.remove('hidden');
                if (currentIcon) currentIcon.classList.add('rotate-180');
            }
        }

        // Menutup menu dan dropdown otomatis jika klik di luar area resmi komponen
        window.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
            if (!e.target.closest('.dropdown-container')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
                document.querySelectorAll('.fa-chevron-down').forEach(icon => icon.classList.remove('rotate-180'));
            }
        });
    </script>

    <!-- SCRIPT JAVASCRIPT (Taruh di bagian paling bawah sebelum tag </body>) -->
    <script>
        const container = document.getElementById('slider-container');
        const prevBtn = document.getElementById('slide-prev');
        const nextBtn = document.getElementById('slide-next');

        // Mengatur jarak geser sekali klik mengikuti lebar satu kartu foto
        const getScrollAmount = () => {
            return container.firstElementChild ? container.firstElementChild['clientWidth'] + 16 : 300;
        };

        nextBtn.addEventListener('click', () => {
            container.scrollLeft += getScrollAmount();
        });

        prevBtn.addEventListener('click', () => {
            container.scrollLeft -= getScrollAmount();
        });
    </script>
</body>

</html>
