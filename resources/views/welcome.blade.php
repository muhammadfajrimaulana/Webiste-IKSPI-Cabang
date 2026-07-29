@extends('web.layout.app')

@section('content')
    <!-- HERO SECTION (Bersih & Tanpa Kartu) -->
    <header class="w-full relative bg-slate-950">
        <!-- Banner Utama: Padding disesuaikan agar pas langsung ke section berikutnya -->
        <div class="w-full bg-cover bg-center flex items-center pt-20 pb-20 md:pt-28 md:pb-28 px-5 sm:px-12 md:px-24"
            style="background-image: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.85)), url('{{ asset('assets/img/ikspi1.jpg') }}');">
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

                <a href="{{ route('profil.sejarah') }}"
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
                <div class="w-4/5 h-[340px] sm:h-[420px] overflow-hidden rounded-2xl shadow-xl border border-slate-100">
                    <img src="{{ asset('assets/img/Pendiri.JPG') }}" alt="Pendiri IKSPI"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div
                    class="absolute right-0 bottom-4 w-1/2 h-[200px] sm:h-[260px] border-4 border-white overflow-hidden rounded-2xl shadow-2xl">
                    <img src="{{ asset('assets/img/Komisaris.JPG') }}" alt="Komisaris IKSPI"
                        class="w-full h-full object-cover">
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
        <div class="absolute inset-0 bg-cover bg-center opacity-5" style="background-image: url('assets/img/ikspi1.jpg');">
        </div>

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
                    <div
                        class="h-44 bg-gradient-to-br from-slate-800 to-slate-950 relative overflow-hidden flex items-center justify-center">
                        @if (isset($ketua) && $ketua->avatar)
                            <img src="{{ Str::startsWith($ketua->avatar, 'http') ? $ketua->avatar : asset('storage/' . $ketua->avatar) }}"
                                alt="{{ $ketua->nama_pengurus ?? 'Ketua Cabang' }}" class="w-full h-full object-cover">
                        @else
                            <i
                                class="fas fa-user-shield text-5xl text-white/20 absolute inset-0 m-auto h-fit w-fit group-hover:scale-110 transition duration-300"></i>
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] text-red-600 font-bold uppercase tracking-widest block mb-1">
                            {{ $ketua->jabatan ?? 'Ketua Cabang' }}
                        </span>
                        <h4 class="font-black text-slate-900 text-base">
                            {{ $ketua->nama_pengurus ?? 'Belum Ditentukan' }}
                        </h4>
                    </div>
                </div>

                <!-- Sekretaris -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md border-b-4 border-slate-900 text-center group hover:-translate-y-2 transition duration-300">
                    <div
                        class="h-44 bg-gradient-to-br from-slate-800 to-slate-950 relative overflow-hidden flex items-center justify-center">
                        @if (isset($sekretaris) && $sekretaris->avatar)
                            <img src="{{ Str::startsWith($sekretaris->avatar, 'http') ? $sekretaris->avatar : asset('storage/' . $sekretaris->avatar) }}"
                                alt="{{ $sekretaris->nama_pengurus ?? 'Sekretaris' }}" class="w-full h-full object-cover">
                        @else
                            <i
                                class="fas fa-user-pen text-5xl text-white/20 absolute inset-0 m-auto h-fit w-fit group-hover:scale-110 transition duration-300"></i>
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest block mb-1">
                            {{ $sekretaris->jabatan ?? 'Sekretaris' }}
                        </span>
                        <h4 class="font-black text-slate-900 text-base">
                            {{ $sekretaris->nama_pengurus ?? 'Belum Ditentukan' }}
                        </h4>
                    </div>
                </div>

                <!-- Bendahara -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md border-b-4 border-red-600 text-center group hover:-translate-y-2 transition duration-300">
                    <div
                        class="h-44 bg-gradient-to-br from-slate-800 to-slate-950 relative overflow-hidden flex items-center justify-center">
                        @if (isset($bendahara) && $bendahara->avatar)
                            <img src="{{ Str::startsWith($bendahara->avatar, 'http') ? $bendahara->avatar : asset('storage/' . $bendahara->avatar) }}"
                                alt="{{ $bendahara->nama_pengurus ?? 'Bendahara' }}" class="w-full h-full object-cover">
                        @else
                            <i
                                class="fas fa-wallet text-5xl text-white/20 absolute inset-0 m-auto h-fit w-fit group-hover:scale-110 transition duration-300"></i>
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] text-red-600 font-bold uppercase tracking-widest block mb-1">
                            {{ $bendahara->jabatan ?? 'Bendahara' }}
                        </span>
                        <h4 class="font-black text-slate-900 text-base">
                            {{ $bendahara->nama_pengurus ?? 'Belum Ditentukan' }}
                        </h4>
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
    <section id="ranting" class="max-w-7xl mx-auto px-6 py-24">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="h-2 w-2 rounded-full bg-red-600 animate-ping"></span>
                    <span class="text-red-600 font-bold text-xs uppercase tracking-widest">Wilayah & Zona Latihan</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Daftar Ranting / Tempat Latihan
                </h2>
            </div>
            <p class="text-xs md:text-sm text-slate-500 max-w-sm">
                Temukan lokasi latihan resmi terdekat di wilayah Anda dan bergabunglah bersama ribuan anggota lainnya.
            </p>
        </div>

        <!-- Grid Menggunakan 4 Kolom (Menampilkan 4 di atas, 4 di bawah) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($rantings as $index => $ranting)
                <div
                    class="bg-slate-900 text-white p-6 rounded-3xl relative overflow-hidden flex flex-col justify-between group shadow-xl hover:-translate-y-2 transition-all duration-500">

                    <!-- Efek Background Glow Merah Abstrak di dalam Card -->
                    <div
                        class="absolute -right-10 -bottom-10 w-32 h-32 bg-red-600/20 rounded-full blur-2xl group-hover:bg-red-600/40 transition-all duration-500 pointer-events-none">
                    </div>

                    <div>
                        <!-- Header Kartu: Nomor Urut Estetik & Icon Baru -->
                        <div class="flex items-center justify-between mb-6">
                            <span
                                class="text-2xl font-black text-slate-700 group-hover:text-red-500 transition-colors duration-300">
                                #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div
                                class="w-10 h-10 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-red-500 group-hover:bg-red-600 group-hover:text-white transition-all duration-300 shadow-inner">
                                <i class="fa-solid fa-building-shield text-xs"></i>
                            </div>
                        </div>

                        <!-- Nama Ranting -->
                        <h3
                            class="font-extrabold text-base text-white mb-2 tracking-tight group-hover:text-red-400 transition-colors line-clamp-1">
                            {{ $ranting->nama_ranting }}
                        </h3>

                        <!-- Alamat / Lokasi -->
                        <div class="flex items-start gap-2 text-xs text-slate-400 mb-6 leading-relaxed">
                            <i class="fa-solid fa-map-pin text-red-500 mt-0.5 shrink-0"></i>
                            <p class="line-clamp-2">
                                {{ $ranting->lokasi_latihan ?? ($ranting->alamat ?? 'Lokasi latihan belum ditentukan') }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Card: Total Anggota dengan Badge Glassmorphism -->
                    <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                        <div
                            class="inline-flex items-center gap-1.5 bg-white/5 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/10 text-[11px] font-semibold text-slate-300">
                            <i class="fa-solid fa-users text-red-500 text-[9px]"></i>
                            <span>{{ $ranting->anggota_count ?? 0 }} Anggota</span>
                        </div>

                        <div
                            class="w-7 h-7 rounded-full bg-white/5 flex items-center justify-center text-slate-400 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </div>
                    </div>

                </div>
            @empty
                <div
                    class="col-span-full bg-white border border-dashed border-slate-300 rounded-3xl p-16 text-center space-y-3 shadow-xs">
                    <div
                        class="h-16 w-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Belum Ada Ranting</h3>
                    <p class="text-xs text-slate-400 max-w-sm mx-auto">
                        Belum ada data ranting atau tempat latihan yang ditambahkan ke dalam sistem saat ini.
                    </p>
                </div>
            @endforelse
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
                    class="w-10 h-10 rounded-full border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-300 flex items-center justify-center transition shadow-sm active:scale-95 cursor-pointer">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button id="slide-next"
                    class="w-10 h-10 rounded-full bg-red-600 text-white hover:bg-red-700 flex items-center justify-center transition shadow-md active:scale-95 cursor-pointer">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Area Foto yang Bisa Di-scroll / Di-slide -->
        <div id="slider-container" class="flex overflow-x-auto gap-4 pb-4 scroll-smooth snap-x snap-mandatory"
            style="scrollbar-width: none; -ms-overflow-style: none;">

            @forelse($galeris as $galeri)
                <div
                    class="w-[80%] sm:w-1/3 md:w-1/4 flex-shrink-0 h-48 sm:h-52 bg-slate-200 overflow-hidden rounded-2xl group shadow-md border border-slate-100 snap-start relative">

                    @if ($galeri->file_path)
                        <img src="{{ asset('storage/' . $galeri->file_path) }}"
                            alt="{{ $galeri->judul ?? 'Dokumentasi IKSPI' }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <img src="{{ asset('assets/img/default.png') }}" alt="Default Image"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @endif

                    @if (isset($galeri->judul))
                        <div
                            class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3 pt-6 opacity-0 group-hover:opacity-100 transition duration-300">
                            <p class="text-white text-xs font-semibold truncate">{{ $galeri->judul }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div
                    class="w-full text-center py-10 text-slate-400 text-xs font-semibold bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    Belum ada dokumentasi foto kegiatan yang diunggah.
                </div>
            @endforelse

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
                <a href="{{ route('web.berita') }}"
                    class="text-xs font-bold text-red-600 hover:text-slate-900 transition flex items-center gap-1 self-start sm:self-auto">
                    Lihat Semua Berita <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Berita Utama -->
                <div class="lg:col-span-2">
                    @if ($beritaUtama)
                        <div class="relative rounded-2xl overflow-hidden h-[360px] sm:h-[440px] shadow-lg group">
                            {{-- Diperbarui dari ->gambar ke ->file_path --}}
                            <img src="{{ asset('storage/' . $beritaUtama->file_path) }}" alt="{{ $beritaUtama->judul }}"
                                class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent">
                            </div>
                            <div class="absolute bottom-0 inset-x-0 p-6 md:p-8 flex flex-col items-start justify-end">
                                <span
                                    class="inline-flex items-center gap-1 bg-red-600 text-white text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase mb-3 shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Berita Utama
                                </span>
                                <h3
                                    class="text-xl sm:text-2xl font-black text-white leading-tight mb-2 hover:text-red-400 transition">
                                    <a
                                        href="{{ route('berita.show', $beritaUtama->slug ?? $beritaUtama->id) }}">{{ $beritaUtama->judul }}</a>
                                </h3>
                                <div class="flex items-center gap-3 text-[11px] text-slate-300">
                                    <span>{{ $beritaUtama->created_at->translatedFormat('d F Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $beritaUtama->author->name ?? 'Humas Cabang' }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div
                            class="h-[360px] sm:h-[440px] bg-slate-50 rounded-2xl border border-dashed border-slate-200 flex items-center justify-center text-slate-400 text-xs font-semibold">
                            Belum ada Berita Utama yang diunggah.
                        </div>
                    @endif
                </div>

                <!-- Berita Terbaru -->
                <div class="flex flex-col gap-5">
                    <h3
                        class="text-xs font-black text-slate-900 uppercase tracking-widest border-b-2 border-red-600 pb-1 self-start">
                        Berita Terbaru
                    </h3>
                    <div class="space-y-4">
                        @forelse($beritaTerbarus as $berita)
                            <div class="flex gap-3 items-start group">
                                {{-- Diperbarui dari ->gambar ke ->file_path --}}
                                <img src="{{ asset('storage/' . $berita->file_path) }}" alt="{{ $berita->judul }}"
                                    class="w-16 h-16 rounded-xl object-cover shrink-0 shadow-sm">
                                <div>
                                    <span
                                        class="text-[9px] text-red-600 font-bold uppercase block mb-0.5">{{ $berita->kategori ?? 'Informasi' }}</span>
                                    <h4
                                        class="font-bold text-xs text-slate-900 leading-snug group-hover:text-red-600 transition line-clamp-2">
                                        <a
                                            href="{{ route('berita.show', $berita->slug ?? $berita->id) }}">{{ $berita->judul }}</a>
                                    </h4>
                                    <span
                                        class="text-[10px] text-slate-400 block mt-1">{{ $berita->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic">Belum ada berita lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Script Tambahan untuk Tombol Geser Slider Galeri --}}
    @push('scripts')
        <script>
            const slider = document.getElementById('slider-container');
            const prevBtn = document.getElementById('slide-prev');
            const nextBtn = document.getElementById('slide-next');

            if (slider && prevBtn && nextBtn) {
                nextBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: 300,
                        behavior: 'smooth'
                    });
                });

                prevBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                });
            }
        </script>
    @endpush
@endsection
