@extends('web.layout.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8 space-y-10">

        {{-- Header / Breadcrumb Portal Berita --}}
        <div class="border-b border-gray-200 pb-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold text-red-600 uppercase tracking-widest mb-1">
                    <span class="h-2 w-2 rounded-full bg-red-600 animate-pulse"></span>
                    Pusat Informasi & Publikasi
                </div>
                <h1 class="text-2xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Berita & Kegiatan Resmi
                </h1>
            </div>
            <p class="text-xs text-gray-500 max-w-sm">
                Menyajikan informasi terkini, laporan kegiatan, serta pengumuman resmi organisasi secara transparan dan
                akurat.
            </p>
        </div>

        @if ($posts->count() > 0)
            @php
                $featuredPost = $posts->first();
                $regularPosts = $posts->skip(1);
            @endphp

            {{-- Hero / Berita Utama (Featured News) --}}
            @if (request()->get('page', 1) == 1)
                <div class="relative bg-slate-900 rounded-3xl overflow-hidden shadow-xl border border-slate-800 group">
                    <div class="absolute inset-0 z-10 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

                    <div class="w-full h-[380px] md:h-[450px] bg-slate-800 overflow-hidden relative">
                        @if ($featuredPost->thumbnail)
                            <img src="{{ asset('storage/' . $featuredPost->thumbnail) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-700 opacity-80">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-600">
                                <i class="fa-regular fa-image text-5xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="absolute bottom-0 inset-x-0 z-20 p-6 md:p-10 space-y-3">
                        <div class="flex items-center gap-3">
                            <span
                                class="bg-red-600 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                                Berita Utama
                            </span>
                            <span
                                class="text-xs font-medium text-slate-300 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full capitalize">
                                <i class="fa-solid fa-tag mr-1 text-[10px]"></i> {{ $featuredPost->kategori }}
                            </span>
                        </div>

                        <h2
                            class="text-xl md:text-3xl font-black text-white leading-tight group-hover:text-red-400 transition">
                            {{ $featuredPost->judul }}
                        </h2>

                        <p class="text-xs md:text-sm text-slate-300 line-clamp-2 max-w-3xl font-normal">
                            {{ $featuredPost->isi }}
                        </p>

                        <div class="pt-2 flex items-center justify-between text-xs text-slate-400 border-t border-white/10">
                            <span><i class="fa-regular fa-calendar mr-1.5"></i>
                                {{ $featuredPost->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Layout Utama: Daftar Berita & Sidebar --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pt-4">

                {{-- Kolom Kiri: Grid Berita Lainnya --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-newspaper text-red-600"></i> Artikel & Informasi Terbaru
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach ($regularPosts as $post)
                            <div
                                class="bg-white border border-gray-200/80 rounded-2xl overflow-hidden shadow-xs flex flex-col group hover:shadow-lg hover:border-red-200 transition duration-300">
                                <div class="w-full h-48 bg-slate-100 overflow-hidden relative border-b border-gray-100">
                                    @if ($post->thumbnail)
                                        <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fa-regular fa-image text-2xl"></i>
                                        </div>
                                    @endif
                                    <span
                                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-xs text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider shadow-sm">
                                        {{ $post->kategori }}
                                    </span>
                                </div>

                                <div class="p-5 flex flex-col flex-grow justify-between space-y-4">
                                    <div class="space-y-2">
                                        <div class="text-[10px] text-gray-400 font-medium flex items-center gap-1.5">
                                            <i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('d M Y') }}
                                        </div>
                                        <h4
                                            class="text-sm font-bold text-slate-900 line-clamp-2 group-hover:text-red-600 transition leading-snug">
                                            {{ $post->judul }}
                                        </h4>
                                        <p class="text-xs text-gray-500 line-clamp-2">
                                            {{ $post->isi }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Kolom Kanan: Sidebar --}}
                <div class="space-y-6">
                    <div class="bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs space-y-4">
                        <h4
                            class="text-xs font-black text-slate-900 uppercase tracking-widest border-b border-gray-100 pb-3 flex items-center gap-2">
                            <i class="fa-solid fa-folder-open text-red-600"></i> Kategori Berita
                        </h4>
                        <div class="space-y-2">
                            @php
                                $categories = $posts->pluck('kategori')->unique();
                            @endphp
                            @foreach ($categories as $cat)
                                <div
                                    class="flex items-center justify-between text-xs py-2 px-3 rounded-xl bg-slate-50 hover:bg-red-50 text-slate-700 hover:text-red-600 transition font-medium cursor-pointer">
                                    <span class="capitalize"><i
                                            class="fa-solid fa-angle-right text-[9px] mr-2 text-gray-400"></i>
                                        {{ $cat }}</span>
                                    <span
                                        class="bg-white px-2 py-0.5 rounded-md border border-gray-200 text-[10px] font-bold">
                                        {{ $posts->where('kategori', $cat)->count() }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl p-6 text-white shadow-lg space-y-3 relative overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 text-red-700/40 text-8xl pointer-events-none">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <h4 class="text-xs font-black uppercase tracking-widest text-red-200">
                            Informasi Penting
                        </h4>
                        <p class="text-xs text-white/90 leading-relaxed font-medium">
                            Pastikan Anda selalu memantau halaman resmi ini untuk mendapatkan pembaruan informasi kegiatan
                            organisasi secara real-time.
                        </p>
                    </div>
                </div>

            </div>
        @else
            {{-- State Jika Kosong --}}
            <div class="bg-white border border-gray-200 rounded-3xl p-16 text-center space-y-3 shadow-xs">
                <div class="h-16 w-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto text-2xl">
                    <i class="fa-regular fa-folder-open"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Belum Ada Berita</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto">
                    Belum ada artikel atau informasi kegiatan yang dipublikasikan saat ini. Silakan periksa kembali nanti.
                </p>
            </div>
        @endif

        {{-- Pagination --}}
        @if (method_exists($posts, 'links'))
            <div class="pt-6">
                {{ $posts->links() }}
            </div>
        @endif

    </div>
@endsection
