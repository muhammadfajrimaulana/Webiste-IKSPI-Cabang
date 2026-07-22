@extends('web.layout.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8 space-y-10" x-data="{ activeTab: 'semua' }">

        {{-- Header / Breadcrumb Galeri --}}
        <div class="border-b border-gray-200 pb-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold text-red-600 uppercase tracking-widest mb-1">
                    <span class="h-2 w-2 rounded-full bg-red-600 animate-pulse"></span>
                    Dokumentasi Visual Organisasi
                </div>
                <h1 class="text-2xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Galeri Foto & Video
                </h1>
            </div>
            <p class="text-xs text-gray-500 max-w-sm">
                Kumpulan dokumentasi lengkap kegiatan, rapat, dan momen penting organisasi yang disajikan dalam bentuk foto
                dan video.
            </p>
        </div>

        {{-- Filter Kategori / Tab Interaktif --}}
        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 border-b border-gray-100 pb-4">
            <button @click="activeTab = 'semua'"
                :class="activeTab === 'semua' ? 'bg-red-600 text-white shadow-md shadow-red-200' :
                    'bg-white border border-gray-200 text-slate-600 hover:bg-slate-50'"
                class="text-xs font-bold px-5 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-border-all"></i> Semua Media
            </button>
            <button @click="activeTab = 'gambar'"
                :class="activeTab === 'gambar' ? 'bg-red-600 text-white shadow-md shadow-red-200' :
                    'bg-white border border-gray-200 text-slate-600 hover:bg-slate-50'"
                class="text-xs font-bold px-5 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-2">
                <i class="fa-regular fa-image"></i> Foto / Gambar
            </button>
            <button @click="activeTab = 'video'"
                :class="activeTab === 'video' ? 'bg-red-600 text-white shadow-md shadow-red-200' :
                    'bg-white border border-gray-200 text-slate-600 hover:bg-slate-50'"
                class="text-xs font-bold px-5 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-video"></i> Video Kegiatan
            </button>
        </div>

        {{-- Grid Galeri --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($galleries as $item)
                <div x-show="activeTab === 'semua' || activeTab === '{{ $item->tipe }}'"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white border border-gray-200/80 rounded-2xl overflow-hidden shadow-xs flex flex-col group hover:shadow-xl hover:border-red-200 transition duration-300">

                    {{-- Konten Media --}}
                    <div
                        class="w-full h-56 bg-slate-900 relative overflow-hidden flex items-center justify-center border-b border-gray-100">
                        @if ($item->tipe === 'gambar')
                            <img src="{{ asset('storage/media/' . $item->file_path) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span
                                class="absolute top-3 left-3 bg-white/90 backdrop-blur-xs text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider shadow-sm">
                                <i class="fa-regular fa-image mr-1 text-red-600"></i> Gambar
                            </span>
                        @else
                            {{-- Tampilan Preview Video --}}
                            <div
                                class="w-full h-full bg-slate-900 flex items-center justify-center relative group-hover:scale-105 transition duration-500">
                                {{-- Jika file_path berupa URL video atau file lokal, bisa disesuaikan. Ini contoh menggunakan latar/thumbnail dengan tombol play --}}
                                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition"></div>
                                <div
                                    class="h-12 w-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg z-10 group-hover:scale-110 transition">
                                    <i class="fa-solid fa-play text-sm ml-0.5"></i>
                                </div>
                                <span
                                    class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider z-10 shadow-sm">
                                    <i class="fa-solid fa-video mr-1"></i> Video
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Deskripsi Media --}}
                    <div class="p-5 flex flex-col flex-grow justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-[10px] text-gray-400 font-medium">
                                <span><i class="fa-regular fa-calendar mr-1"></i>
                                    {{ $item->created_at->format('d M Y') }}</span>
                                <span class="text-red-600 font-bold capitalize bg-red-50 px-2 py-0.5 rounded-md">
                                    {{ $item->kategori ?? 'Umum' }}
                                </span>
                            </div>
                            <h3
                                class="text-sm font-bold text-slate-900 line-clamp-2 group-hover:text-red-600 transition leading-snug">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2">
                                {{ $item->deskripsi }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white border border-gray-200 rounded-3xl p-16 text-center space-y-3 shadow-xs">
                    <div
                        class="h-16 w-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-regular fa-folder-open"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Belum Ada Media</h3>
                    <p class="text-xs text-gray-400 max-w-sm mx-auto">
                        Belum ada dokumentasi foto atau video kegiatan yang dipublikasikan saat ini.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if (method_exists($galleries, 'links'))
            <div class="pt-6">
                {{ $galleries->links() }}
            </div>
        @endif

    </div>
@endsection
