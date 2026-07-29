@extends('web.layout.app')

@section('content')
    <main class="bg-slate-50 min-h-screen py-12 md:py-20">
        <article class="max-w-6xl mx-auto px-6">
            <!-- Tombol Kembali -->
            <a href="{{ route('web.berita') }}"
                class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-red-600 transition mb-6 group">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Daftar Berita
            </a>

            <!-- Header Berita -->
            <div class="mb-8 space-y-3">
                <span
                    class="inline-block bg-red-600 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                    {{ $berita->kategori ?? 'Informasi Cabang' }}
                </span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 leading-tight">
                    {{ $berita->judul }}
                </h1>
                <div class="flex items-center gap-3 text-xs text-slate-500 font-medium pt-2">
                    <span><i class="far fa-calendar-alt mr-1 text-red-600"></i>
                        {{ $berita->created_at->translatedFormat('d F Y') }}</span>
                    <span>•</span>
                    <span><i class="far fa-user mr-1 text-red-600"></i>
                        {{ $berita->author->name ?? 'Humas IKSPI Jakpus' }}</span>
                </div>
            </div>

            <!-- Gambar Utama (Disesuaikan dari thumbnail ke file_path) -->
            @if ($berita->file_path)
                <div
                    class="rounded-3xl overflow-hidden shadow-lg mb-10 h-[300px] sm:h-[450px] bg-slate-200 border border-slate-200/60">
                    <img src="{{ asset('storage/' . $berita->file_path) }}" alt="{{ $berita->judul }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Konten Berita -->
            <div
                class="bg-white p-6 sm:p-12 rounded-3xl shadow-sm border border-slate-200/80 prose prose-slate max-w-none text-slate-700 leading-relaxed">
                {!! $berita->isi ?? 'Belum ada isi berita.' !!}
            </div>
        </article>
    </main>
@endsection
