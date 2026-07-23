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
                        Legalitas & Perizinan
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Dokumen Legalitas Perguruan
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Transparansi legalitas formal dan dokumen perizinan resmi Ikatan Keluarga Silat Putra Indonesia Kera
                        Sakti Cabang Jakarta Pusat.
                    </p>
                    <div
                        class="mt-4 inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl border border-white/10 text-xs font-medium">
                        <i class="fa-solid fa-file-shield text-red-400"></i>
                        <span>Total Dokumen Terdaftar: <strong class="text-white">{{ $totalDokumen }} Berkas</strong></span>
                    </div>
                </div>
            </div>

            {{-- List Dokumen Legalitas (Grid) --}}
            @if ($legals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($legals as $legal)
                        <div
                            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4 flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <div
                                    class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 text-lg shadow-xs mb-4">
                                    <i class="fa-solid fa-file-contract"></i>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2">
                                    {{ $legal->legalitas_nama }}
                                </h3>
                                <p class="text-xs text-gray-500 leading-relaxed">
                                    {{ $legal->legalitas_deskripsi ?? 'Dokumen legalitas resmi terdaftar dan diakui secara hukum.' }}
                                </p>
                            </div>

                            @if (isset($legal->legalitas_file))
                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-[10px] text-gray-400 font-medium uppercase">Status: Aktif /
                                        Valid</span>
                                    <a href="{{ asset('storage/' . $legal->legalitas_file) }}" target="_blank"
                                        class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-xs font-bold transition flex items-center gap-1.5">
                                        <i class="fa-solid fa-eye"></i> Lihat
                                    </a>
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
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Belum Ada Dokumen Legalitas</h3>
                    <p class="text-xs text-gray-500 max-w-sm mx-auto">
                        Dokumen legalitas dan perizinan akan segera diperbarui oleh admin cabang.
                    </p>
                </div>
            @endif

        </div>
    </div>
@endsection
