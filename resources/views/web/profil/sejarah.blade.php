@extends('web.layout.app')

@section('content')
    <div class="bg-gray-50 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header Section --}}
            <div
                class="bg-gradient-to-r from-slate-900 via-red-950 to-slate-900 p-8 rounded-2xl shadow-md text-white relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 text-white/5 text-9xl font-bold">IKSPI</div>
                <div class="relative z-10 max-w-2xl">
                    <span
                        class="bg-red-500/20 text-red-400 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider border border-red-500/30">
                        Jejak Langkah Perguruan
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Sejarah Singkat IKSPI Kera Sakti
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Menelusuri awal mula berdirinya Ikatan Keluarga Silat Putra Indonesia Kera Sakti serta perkembangan
                        perjuangannya hingga ke Cabang Jakarta Pusat.
                    </p>
                </div>
            </div>

            {{-- Main Content Card (Sejarah) --}}
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    <div
                        class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-800 text-xl shadow-xs shrink-0">
                        <i class="fa-solid fa-scroll"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 uppercase tracking-wider">Sejarah Perjalanan Perguruan
                        </h2>
                        <p class="text-xs text-gray-400 mt-0.5">Dokumentasi historis dan latar belakang berdirinya perguruan
                        </p>
                    </div>
                </div>

                {{-- Teks Sejarah dengan Spasi Baca yang Nyaman --}}
                <div class="text-xs sm:text-sm text-gray-600 leading-relaxed whitespace-pre-line space-y-4">
                    {{ $content->sejarah ?? 'Sejarah perguruan belum diatur oleh admin cabang.' }}
                </div>
            </div>

        </div>
    </div>
@endsection
