<x-app-layout :title="$title ?? 'Keanggotaan IKSPI Kera Sakti Cabang Jakpus'">
    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-slate-900 text-white flex flex-col h-full shrink-0">
            <div class="p-5 bg-slate-950 border-b border-slate-800">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('assets/img/logo-ikspi.png') }}" alt="Logo IKSPI Kera Sakti"
                        class="w-10 h-10 object-contain rounded-md filter drop-shadow-md">

                    <div>
                        <h1 class="text-sm font-bold tracking-wide">IKSPI KERA SAKTI</h1>
                        <p class="text-xs text-gray-400">Cabang Jakarta Pusat</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto p-4 space-y-6 scrollbar-thin scrollbar-thumb-slate-800 scrollbar-track-transparent"
                style="scrollbar-width: thin; scrollbar-color: #1e293b transparent;">

                @if (auth()->user()->role !== 'anggota')
                    {{-- MENU ADMIN (Cabang/Ranting) --}}
                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Ringkasan</span>
                        <div class="space-y-1">
                            <x-nav-link route="dashboard" icon="fa-solid fa-house-chimney">Dashboard</x-nav-link>
                        </div>
                    </div>

                    <div>
                        <span
                            class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Pusat
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
                            class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Workflow
                            Administrasi</span>
                        <div class="space-y-1">
                            <x-nav-link route="pendaftaran.index" icon="fa-solid fa-file-signature" color="yellow">Flow
                                A: Input Data Baru</x-nav-link>
                            <x-nav-link route="verifikasi.index" icon="fa-solid fa-user-check" color="yellow">
                                Flow B: Verifikasi Pengurus

                                @if (isset($badgeData) && $badgeData['count'] > 0)
                                    <span
                                        class="absolute top-2 right-1 {{ $badgeData['color'] }} text-white text-[9px] px-1.5 py-0.5 rounded-full font-black {{ $badgeData['color'] == 'bg-red-600' ? 'animate-pulse' : '' }} shadow-md">
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
                            class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Manajemen
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

            <div class="p-4 ml-2 bg-slate-950 border-t border-slate-800 flex items-center justify-between">
                <div>
                    <a href="{{ route('anggota.profile') }}" class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold uppercase">
                            {{ collect(explode(' ', auth()->user()->nama_pengurus))->map(fn($word) => $word[0])->take(2)->implode('') }}
                        </div>

                        <div class="text-xs">
                            <p class="font-semibold block truncate w-32">{{ auth()->user()->nama_pengurus }}</p>

                            <p class="text-gray-400 text-[8px]">
                                {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}

                                @if (auth()->user()->ranting)
                                    ({{ auth()->user()->ranting->nama_ranting }})
                                @endif
                            </p>
                        </div>
                    </a>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="p-2">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 text-xs font-semibold text-red-400 hover:bg-slate-800 rounded-lg transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-full overflow-hidden">
            <header
                class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-xs shrink-0">
                <div class="flex items-center space-x-2.5">
                    <span class="text-slate-400 text-xs w-5 text-center">
                        <i class="fa-solid {{ $icon ?? 'fa-solid fa-folder-tree' }}"></i>
                    </span>
                    <span
                        class="text-xs font-bold text-slate-800 tracking-wide uppercase">{{ $title ?? 'Beranda' }}</span>
                </div>

                <div
                    class="text-[11px] text-slate-500 font-semibold bg-slate-50 border border-gray-100 px-3 py-1.5 rounded-lg flex items-center gap-2">
                    <i class="fa-regular fa-calendar-days text-slate-400 text-xs"></i>
                    <span>{{ date('l, d F Y') }}</span>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
                {{ $slot }}
            </main>
        </div>

    </div>
</x-app-layout>
