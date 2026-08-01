<x-app-layout :title="$title ?? 'Keanggotaan IKSPI Kera Sakti Cabang Jakpus'">
    <!-- Inisialisasi State AlpineJS -->
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden relative">

        <!-- Overlay Backdrop (Tampil saat sidebar terbuka di HP) -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

        <!-- ASIDE / SIDEBAR -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#650000] text-white flex flex-col h-full shrink-0 transition-transform duration-300 ease-in-out md:static md:translate-x-0">

            <!-- Header Sidebar -->
            <div class="p-5 bg-red-950 border-b border-stone-800 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('assets/img/ikspi-jakpus.png') }}" alt="Logo IKSPI Kera Sakti"
                        class="w-10 h-10 object-contain rounded-md filter drop-shadow-md">

                    <div>
                        <h1 class="text-sm font-bold tracking-wide">IKSPI KERA SAKTI</h1>
                        <p class="text-xs text-stone-500">Cabang Jakarta Pusat</p>
                    </div>
                </a>

                <!-- Tombol Close Sidebar (Hanya Muncul di HP) -->
                <button @click="sidebarOpen = false"
                    class="md:hidden text-stone-400 hover:text-white focus:outline-none p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-6 scrollbar-thin scrollbar-thumb-stone-800 scrollbar-track-transparent"
                style="scrollbar-width: thin; scrollbar-color: #1e293b transparent;">

                @if (auth()->user()->role !== 'anggota')
                    {{-- MENU ADMIN (Cabang/Ranting) --}}
                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-stone-500 uppercase tracking-widest block mb-2">Ringkasan</span>
                        <div class="space-y-1">
                            <x-nav-link route="dashboard" icon="fa-solid fa-house-chimney">Dashboard</x-nav-link>
                        </div>
                    </div>

                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-stone-500 uppercase tracking-widest block mb-2">Pusat
                            Navigasi</span>
                        <div class="space-y-1">
                            <x-nav-link route="menu.tentang" icon="fa-solid fa-info-circle">Tentang IKSPI</x-nav-link>
                            <x-nav-link route="menu.legalitas" icon="fa-regular fa-file-lines">Tata Kelola &
                                Legalitas</x-nav-link>
                            <x-nav-link route="menu.ranting" icon="fa-solid fa-map-location-dot">Data Ranting &
                                Latihan</x-nav-link>
                            <x-nav-link route="menu.struktur" icon="fa-solid fa-sitemap">Struktur
                                Organisasi</x-nav-link>
                            <x-nav-link route="menu.media" icon="fa-regular fa-images">Ruang Media & Galeri</x-nav-link>
                            <x-nav-link route="menu.pengesahan" icon="fa-solid fa-id-card-clip">Data
                                Pengesahan</x-nav-link>
                            <x-nav-link route="menu.kontak" icon="fa-solid fa-headset">Kontak Organisasi</x-nav-link>
                        </div>
                    </div>

                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-stone-500 uppercase tracking-widest block mb-2">Workflow
                            Administrasi</span>
                        <div class="space-y-1">
                            <x-nav-link route="pendaftaran.index" icon="fa-solid fa-file-signature" color="yellow">Flow
                                A: Input Data Baru</x-nav-link>
                            <x-nav-link route="verifikasi.index" icon="fa-solid fa-user-check" color="yellow">
                                Flow B: Verifikasi Anggota

                                @if (isset($badgeData) && $badgeData['count'] > 0)
                                    <span
                                        class="absolute top-2 -right-1.5 {{ $badgeData['color'] }} text-white text-[9px] px-1.5 py-0.5 rounded-full font-black {{ $badgeData['color'] == 'bg-red-600' ? 'animate-pulse' : '' }} shadow-md">
                                        {{ $badgeData['count'] }}
                                    </span>
                                @endif
                            </x-nav-link>
                            <x-nav-link route="output.index" icon="fa-solid fa-file-invoice" color="yellow">Flow C:
                                Output Laporan</x-nav-link>
                        </div>
                    </div>

                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-stone-500 uppercase tracking-widest block mb-2">Manajemen
                            Internal</span>
                        <div class="space-y-1">
                            <x-nav-link route="internal.keanggotaan" icon="fa-solid fa-users" color="blue">1.
                                Keanggotaan</x-nav-link>
                            <x-nav-link route="internal.operasional" icon="fa-solid fa-building-shield"
                                color="blue">2. Operasional Ranting</x-nav-link>
                            <x-nav-link route="internal.keuangan" icon="fa-solid fa-wallet" color="blue">3. Keuangan &
                                Logistik</x-nav-link>
                        </div>
                    </div>
                @else
                    {{-- MENU ANGGOTA --}}
                    <div>
                        <div>
                            <span
                                class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Ringkasan</span>
                            <div class="space-y-1">
                                <x-nav-link route="dashboard" icon="fa-solid fa-house-chimney">Dashboard</x-nav-link>
                            </div>
                        </div>
                    </div>

                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Pusat
                            Informasi</span>
                        <div class="space-y-1">
                            <x-nav-link route="anggota.informasi" icon="fa-solid fa-info-circle">Informasi
                                Ranting</x-nav-link>
                            <x-nav-link route="anggota.dokumen" icon="fa-solid fa-envelope">Dokumen Ranting</x-nav-link>
                            <x-nav-link route="anggota.struktur" icon="fa-solid fa-sitemap">Struktur
                                Ranting</x-nav-link>
                            <x-nav-link route="anggota.berita" icon="fa-solid fa-newspaper">Berita &
                                Artikel</x-nav-link>
                            <x-nav-link route="anggota.media" icon="fa-solid fa-images">Media & Galeri</x-nav-link>
                            <x-nav-link route="anggota.pengumuman" icon="fa-solid fa-bullhorn">Pengumuman</x-nav-link>
                        </div>
                    </div>

                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Layanan
                            Anggota</span>
                        <div class="space-y-1">
                            <x-nav-link route="anggota.pengesahan" icon="fa-solid fa-stamp">Riwayat
                                Pengesahan</x-nav-link>
                            <x-nav-link route="anggota.kta" icon="fa-solid fa-id-card">Cetak Kartu Anggota</x-nav-link>
                            <x-nav-link route="anggota.laporan" icon="fa-solid fa-file-invoice">Laporan
                                Pembayaran</x-nav-link>
                        </div>
                    </div>

                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Manajemen
                            Akun</span>
                        <div class="space-y-1">
                            <x-nav-link route="anggota.pengaturan" icon="fa-solid fa-gear">Pengaturan</x-nav-link>
                            <x-nav-link route="anggota.bantuan" icon="fa-solid fa-headset">Pusat Bantuan</x-nav-link>
                        </div>
                    </div>
                @endif
            </nav>

            <!-- Footer Sidebar (User Info & Logout) -->
            <div class="p-4 mx-auto w-full bg-red-950 border-t border-stone-800 flex items-center justify-between">
                <div>
                    <a href="{{ route('profile') }}" class="flex items-center space-x-2">
                        <!-- Foto Profil / Inisial -->
                        <div
                            class="w-8 h-8 rounded-full bg-stone-700 flex items-center justify-center text-xs font-bold uppercase overflow-hidden shrink-0">
                            @if (auth()->user()->avatar)
                                <img src="{{ Str::startsWith(auth()->user()->avatar, 'http') ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}"
                                    alt="{{ auth()->user()->nama_pengurus }}" class="w-full h-full object-cover">
                            @else
                                {{ collect(explode(' ', auth()->user()->nama_pengurus))->map(fn($word) => $word[0])->take(2)->implode('') }}
                            @endif
                        </div>

                        <div class="text-xs">
                            <p class="font-semibold block truncate w-28 md:w-32">{{ auth()->user()->nama_pengurus }}
                            </p>

                            <p class="text-stone-400 text-[8px]">
                                <span class="font-mono">
                                    {{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}
                                </span>

                                @if (auth()->user()->ranting)
                                    ({{ auth()->user()->ranting->nama_ranting }})
                                @endif
                            </p>
                        </div>
                    </a>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="p-1">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengakhiri sesi?');"
                        title="Logout"
                        class="text-left p-2 text-xs font-semibold text-red-400 hover:bg-stone-800 rounded-lg transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col h-full overflow-hidden min-w-0">
            <!-- Header Atas -->
            <header
                class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-8 shadow-xs shrink-0">
                <div class="flex items-center space-x-3">
                    <!-- Tombol Hamburger (Muncul di layar HP untuk buka sidebar) -->
                    <button @click="sidebarOpen = true"
                        class="md:hidden text-slate-600 hover:text-slate-900 focus:outline-none p-1">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>

                    <div class="flex items-center space-x-2.5">
                        <span class="text-slate-400 text-xs w-5 text-center">
                            <i class="fa-solid {{ $icon ?? 'fa-solid fa-folder-tree' }}"></i>
                        </span>
                        <span
                            class="text-xs font-bold text-slate-800 tracking-wide uppercase truncate max-w-[150px] sm:max-w-xs md:max-w-none">{{ $title ?? 'Beranda' }}</span>
                    </div>
                </div>

                <div
                    class="text-[11px] text-slate-500 font-semibold bg-slate-50 border border-gray-100 px-3 py-1.5 rounded-lg flex items-center gap-2">
                    <i class="fa-regular fa-calendar-days text-slate-400 text-xs"></i>
                    <span class="hidden sm:inline">{{ date('l, d F Y') }}</span>
                    <span class="sm:hidden">{{ date('d/m/Y') }}</span>
                </div>
            </header>

            <!-- Halaman Utama / Slot Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8 bg-gray-50">
                {{ $slot }}
            </main>
        </div>

    </div>
</x-app-layout>
