@extends('web.layout.app')

@section('content')
    <main class="bg-slate-50 min-h-screen py-24">
        <article class="max-w-7xl mx-auto px-6">
            <!-- Tombol Kembali -->
            <a href="{{ url('/') }}#berita"
                class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-red-600 transition mb-6">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>

            <!-- Header Berita -->
            <div class="mb-8">
                <span class="inline-block bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase mb-3">
                    {{ $berita->kategori ?? 'Informasi Cabang' }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 leading-tight mb-4">
                    {{ $berita->judul }}
                </h1>
                <div class="flex items-center gap-3 text-xs text-slate-500">
                    <span><i class="far fa-calendar-alt mr-1"></i>
                        {{ $berita->created_at->translatedFormat('d F Y') }}</span>
                    <span>•</span>
                    <span><i class="far fa-user mr-1"></i> {{ $berita->author->name ?? 'Humas IKSPI Jakpus' }}</span>
                </div>
            </div>

            <!-- Gambar Utama -->
            @if ($berita->thumbnail)
                <div class="rounded-2xl overflow-hidden shadow-lg mb-10 h-[350px] sm:h-[480px] bg-slate-200">
                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Konten Berita -->
            <div
                class="bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100 prose prose-slate max-w-none text-slate-700 leading-relaxed">
                {!! $berita->isi ?? ($berita->konten ?? 'Belum ada isi berita.') !!}
            </div>
        </article>
    </main>
@endsection
