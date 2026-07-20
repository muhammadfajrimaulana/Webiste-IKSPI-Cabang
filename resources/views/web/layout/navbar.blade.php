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
            <img src="{{ asset('assets/img/logo-ikspi.png') }}" alt="Logo IKSPI" class="h-10 w-auto object-contain">
            <h1 class="text-xs md:text-sm font-bold tracking-tight text-slate-800">
                <span class="text-red-600 font-black">IKS.PI</span> JAKARTA PUSAT
            </h1>
        </div>

        <!-- DESKTOP MENU -->
        <div class="hidden lg:flex items-center gap-6 text-xs font-bold uppercase tracking-wider text-slate-600">
            <a href="{{ route('beranda') }}" class="hover:text-red-600 transition">Beranda</a>

            <!-- Dropdown Profil Desktop -->
            <div class="relative dropdown-container">
                <button onclick="toggleDropdown(event, 'dropdown-profil-desktop')"
                    class="hover:text-red-600 transition flex items-center gap-1 uppercase font-bold text-xs focus:outline-none cursor-pointer">
                    Profil <i class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
                </button>
                <div id="dropdown-profil-desktop"
                    class="dropdown-menu absolute top-full left-0 mt-4 w-48 bg-white border border-slate-100 shadow-2xl rounded-xl py-2 hidden text-slate-800 z-50">
                    <a href="{{ route('profil.sejarah') }}"
                        class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Sejarah</a>
                    <a href="{{ route('profil.visi') }}"
                        class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Visi
                        Misi</a>
                    <a href="{{ route('profil.falsafah') }}"
                        class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Falsafah</a>
                    <a href="{{ route('profil.legalitas') }}"
                        class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Legalitas</a>
                    <a href="{{ route('profil.panca-prasetya') }}"
                        class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Panca
                        prasetya</a>
                </div>
            </div>

            <a href="{{ route('web.struktur') }}" class="hover:text-red-600 transition">Struktur</a>

            <!-- Dropdown Anggota Desktop -->
            <div class="relative dropdown-container">
                <button onclick="toggleDropdown(event, 'dropdown-anggota-desktop')"
                    class="hover:text-red-600 transition flex items-center gap-1 uppercase font-bold text-xs focus:outline-none cursor-pointer">
                    Ranting<i class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
                </button>
                <div id="dropdown-anggota-desktop"
                    class="dropdown-menu absolute top-full left-0 mt-4 w-48 bg-white border border-slate-100 shadow-2xl rounded-xl py-2 hidden text-slate-800 z-50">
                    <a href="{{ route('ranting.anggota') }}"
                        class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Anggota
                        IKSPI</a>
                    <a href="{{ route('ranting.lokasi') }}"
                        class="block px-4 py-2.5 text-xs text-slate-600 hover:bg-red-50 hover:text-red-600 transition rounded-lg mx-1">Lokasi
                        Ranting</a>
                </div>
            </div>

            <a href="{{ route('web.berita') }}" class="hover:text-red-600 transition">Berita</a>
            <a href="{{ route('web.galeri') }}" class="hover:text-red-600 transition">Galeri</a>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}"
                class="bg-red-600 text-white px-5 py-2.5 text-xs font-bold rounded-full hover:bg-slate-900 transition tracking-wider uppercase shadow-md shadow-red-600/20">LOGIN</a>
            <button id="menu-btn" class="lg:hidden p-2 text-slate-800 focus:outline-none cursor-pointer"><i
                    class="fas fa-bars text-lg"></i></button>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu"
        class="hidden lg:hidden mt-3 border-t border-slate-100 pt-3 pb-2 text-xs font-bold uppercase tracking-wider text-slate-600 space-y-1">
        <a href="{{ route('beranda') }}"
            class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Beranda</a>

        <div class="dropdown-container">
            <button onclick="toggleDropdown(event, 'dropdown-profil-mobile')"
                class="w-full text-left py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition flex justify-between items-center uppercase font-bold text-xs focus:outline-none cursor-pointer">
                Profil <i class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
            </button>
            <div id="dropdown-profil-mobile"
                class="dropdown-menu bg-slate-50 rounded-xl mx-2 my-1 py-1 hidden space-y-1">
                <a href="{{ route('profil.sejarah') }}"
                    class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Sejarah</a>
                <a href="{{ route('profil.visi') }}"
                    class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Visi Misi</a>
                <a href="{{ route('profil.falsafah') }}"
                    class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Falsafah</a>
                <a href="{{ route('profil.legalitas') }}"
                    class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Legalitas</a>
                <a href="{{ route('profil.panca-prasetya') }}"
                    class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Panca Prasetya</a>
            </div>
        </div>

        <a href="{{ route('web.struktur') }}"
            class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Struktur</a>

        <div class="dropdown-container">
            <button onclick="toggleDropdown(event, 'dropdown-anggota-mobile')"
                class="w-full text-left py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition flex justify-between items-center uppercase font-bold text-xs focus:outline-none cursor-pointer">
                Anggota <i class="fas fa-chevron-down text-[10px] opacity-50 transition-transform duration-200"></i>
            </button>
            <div id="dropdown-anggota-mobile"
                class="dropdown-menu bg-slate-50 rounded-xl mx-2 my-1 py-1 hidden space-y-1">
                <a href="{{ route('ranting.anggota') }}"
                    class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Anggota
                    IKSPI</a>
                <a href="{{ route('ranting.anggota') }}"
                    class="block px-4 py-2 text-xs text-slate-600 hover:text-red-600">Lokasi
                    Ranting
                </a>
            </div>
        </div>

        <a href="{{ route('web.berita') }}"
            class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Berita</a>
        <a href="{{ route('web.galeri') }}"
            class="block py-2.5 px-3 hover:bg-red-50 hover:text-red-600 rounded-xl transition">Galeri</a>
    </div>
</nav>
