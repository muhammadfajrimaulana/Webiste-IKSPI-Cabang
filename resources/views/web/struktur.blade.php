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
                        Organisasi Perguruan
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Struktur Organisasi Cabang
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Bagan dan susunan pengurus resmi Ikatan Keluarga Silat Putra Indonesia Kera Sakti Cabang Jakarta
                        Pusat.
                    </p>
                    <div
                        class="mt-4 inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl border border-white/10 text-xs font-medium">
                        <i class="fa-solid fa-users text-red-400"></i>
                        <span>Total Pengurus Terdaftar: <strong class="text-white">{{ $totalPengurus }}
                                Orang</strong></span>
                    </div>
                </div>
            </div>

            {{-- List Struktur Organisasi --}}
            @if ($struktur->count() > 0)
                <div class="space-y-6">
                    @foreach ($struktur as $pimpinan)
                        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">

                            {{-- Pimpinan Utama (Parent) --}}
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center gap-5 border-b border-gray-100 pb-6">
                                <div
                                    class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-100 border border-gray-200 shrink-0 flex items-center justify-center text-slate-700 font-bold text-xl uppercase">
                                    @if ($pimpinan->foto)
                                        <img src="{{ Str::startsWith($pimpinan->foto, 'http') ? $pimpinan->foto : asset('storage/' . $pimpinan->foto) }}"
                                            alt="{{ $pimpinan->nama }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($pimpinan->nama, 0, 2)) }}
                                    @endif
                                </div>
                                <div class="space-y-1">
                                    <span
                                        class="px-2.5 py-0.5 bg-red-50 text-red-600 rounded-md text-[10px] font-bold uppercase border border-red-100">
                                        {{ $pimpinan->jabatan }}
                                    </span>
                                    <h3 class="text-base font-bold text-slate-900 uppercase tracking-wider mt-1">
                                        {{ $pimpinan->nama }}
                                    </h3>
                                    @if ($pimpinan->telepon || $pimpinan->email)
                                        <p class="text-xs text-gray-400 flex items-center gap-3 pt-1">
                                            @if ($pimpinan->telepon)
                                                <span><i class="fa-solid fa-phone mr-1 text-gray-300"></i>
                                                    {{ $pimpinan->telepon }}</span>
                                            @endif
                                            @if ($pimpinan->email)
                                                <span><i class="fa-solid fa-envelope mr-1 text-gray-300"></i>
                                                    {{ $pimpinan->email }}</span>
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- Anggota / Anak Buah (Sub-Pengurus) --}}
                            @if ($pimpinan->anakBuah && $pimpinan->anakBuah->count() > 0)
                                <div>
                                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-4">Jajaran /
                                        Bidang Terkait</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach ($pimpinan->anakBuah as $anggota)
                                            <div
                                                class="p-4 rounded-xl bg-gray-50/50 border border-gray-100 flex items-center gap-4 hover:bg-gray-50 transition">
                                                <div
                                                    class="w-12 h-12 rounded-xl overflow-hidden bg-slate-200 shrink-0 flex items-center justify-center text-slate-700 font-bold text-xs uppercase">
                                                    @if ($anggota->foto)
                                                        <img src="{{ Str::startsWith($anggota->foto, 'http') ? $anggota->foto : asset('storage/' . $anggota->foto) }}"
                                                            alt="{{ $anggota->nama }}" class="w-full h-full object-cover">
                                                    @else
                                                        {{ strtoupper(substr($anggota->nama, 0, 2)) }}
                                                    @endif
                                                </div>
                                                <div class="overflow-hidden">
                                                    <span
                                                        class="text-[9px] font-bold text-red-600 uppercase tracking-wide block truncate">
                                                        {{ $anggota->jabatan }}
                                                    </span>
                                                    <h5
                                                        class="text-xs font-bold text-slate-800 uppercase tracking-wide truncate mt-0.5">
                                                        {{ $anggota->nama }}
                                                    </h5>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            @else
                {{-- State Jika Kosong --}}
                <div class="bg-white p-12 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div
                        class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto text-xl">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Struktur Organisasi Belum Tersedia
                    </h3>
                    <p class="text-xs text-gray-500 max-w-sm mx-auto">
                        Data bagan kepengurusan akan segera diperbarui oleh admin cabang.
                    </p>
                </div>
            @endif

        </div>
    </div>
@endsection
