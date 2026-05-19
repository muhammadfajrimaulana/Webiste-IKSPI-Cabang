<x-app-layout>
    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-slate-900 text-white flex flex-col h-full shrink-0">
            <div class="p-5 bg-slate-950 flex items-center space-x-3 border-b border-slate-800">
                <img src="{{ asset('assets/img/logo-ikspi.png') }}" alt="Logo IKSPI Kera Sakti"
                    class="w-10 h-10 object-contain rounded-md filter drop-shadow-md">
                <div>
                    <h1 class="text-sm font-bold tracking-wide">IKSPI KERA SAKTI</h1>
                    <p class="text-xs text-gray-400">Cab. Jakarta Pusat</p>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto p-4 space-y-6 scrollbar-thin scrollbar-thumb-slate-800 scrollbar-track-transparent"
                style="scrollbar-width: thin; scrollbar-color: #1e293b transparent;">

                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">
                        Menu Utama
                    </span>
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-semibold bg-red-600 rounded-lg text-white shadow-xs hover:bg-red-700 transition duration-200">
                            <i class="fa-solid fa-house-chimney text-sm w-5 text-center"></i>
                            <span>Beranda</span>
                        </a>
                    </div>
                </div>

                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">
                        Pusat Manajemen
                    </span>
                    <div class="space-y-1">
                        <a href="{{ route('menu.tentang') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-info-circle text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                            <span>Tentang IKSPI</span>
                        </a>
                        <a href="{{ route('menu.legalitas') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-regular fa-file-lines text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                            <span>Tata Kelola & Legalitas</span>
                        </a>
                        <a href="{{ route('menu.ranting') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-map-location-dot text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                            <span>Data Ranting & Latihan</span>
                        </a>
                        <a href="{{ route('menu.struktur') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-sitemap text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                            <span>Struktur Organisasi</span>
                        </a>
                        <a href="{{ route('menu.media') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-regular fa-images text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                            <span>Ruang Media & Galeri</span>
                        </a>
                        <a href="{{ route('menu.pengesahan') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-id-card-clip text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                            <span>Data Pengesahan</span>
                        </a>
                        <a href="{{ route('menu.kontak') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-headset text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                            <span>Kontak Cabang</span>
                        </a>
                    </div>
                </div>

                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">
                        Administrasi
                    </span>
                    <div class="space-y-1">
                        <a href="{{ route('pendaftaran.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-file-signature text-sm w-5 text-center text-slate-500 group-hover:text-yellow-500 transition"></i>
                            <span>Flow A: Input Data Baru</span>
                        </a>
                        <a href="{{ route('verifikasi.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-user-check text-sm w-5 text-center text-slate-500 group-hover:text-yellow-500 transition"></i>
                            <span>Flow B: Verifikasi Pengurus</span>
                        </a>
                        <a href="{{ route('output.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-file-invoice text-sm w-5 text-center text-slate-500 group-hover:text-yellow-500 transition"></i>
                            <span>Flow C: Output Laporan</span>
                        </a>
                    </div>
                </div>

                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">
                        Manajemen Internal
                    </span>
                    <div class="space-y-1">
                        <a href="{{ route('internal.keanggotaan') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-users text-sm w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                            <span>1. Keanggotaan</span>
                        </a>
                        <a href="{{ route('internal.operasional') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-building-shield text-sm w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                            <span>2. Operasional Ranting</span>
                        </a>
                        <a href="{{ route('internal.keuangan') }}"
                            class="flex items-center space-x-3 px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-slate-100 rounded-lg transition duration-200 group">
                            <i
                                class="fa-solid fa-wallet text-sm w-5 text-center text-slate-500 group-hover:text-blue-400 transition"></i>
                            <span>3. Keuangan & Logistik</span>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="p-4 ml-2 bg-slate-950 border-t border-slate-800 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold">AD
                    </div>
                    <div class="text-xs">
                        <p class="font-semibold block truncate w-32">Admin Cabang</p>
                        <p class="text-gray-400 text-[10px]">Level 1 - Full Access</p>
                    </div>
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
