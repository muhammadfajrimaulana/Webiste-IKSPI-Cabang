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
                        Direktori Anggota
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Daftar Anggota / Pendekar
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Database resmi anggota dan warga Ikatan Keluarga Silat Putra Indonesia Kera Sakti yang terdaftar
                        secara sah.
                    </p>
                    <div
                        class="mt-4 inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl border border-white/10 text-xs font-medium">
                        <i class="fa-solid fa-id-card text-red-400"></i>
                        <span>Total Anggota: <strong class="text-white">{{ $totalAnggota ?? 0 }} Orang</strong></span>
                    </div>
                </div>
            </div>

            {{-- Filter & Search Bar --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <form action="{{ route('ranting.anggota') }}" method="GET"
                    class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                            placeholder="Cari berdasarkan Nomor Anggota atau Nama Lengkap..."
                            class="w-full text-xs text-gray-700 bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition shadow-sm flex items-center justify-center gap-2 shrink-0">
                            <i class="fa-solid fa-filter"></i> Cari
                        </button>
                        @if (filled($search))
                            <a href="{{ route('web.ranting.anggota') }}"
                                class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-bold rounded-xl transition flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tabel Data Anggota --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @if (isset($semuaAnggota) && $semuaAnggota->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50/75 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    <th class="py-4 px-6">No. Anggota</th>
                                    <th class="py-4 px-6">Nama Lengkap</th>
                                    <th class="py-4 px-6">Ranting</th>
                                    <th class="py-4 px-6">Tingkatan / Sabuk</th>
                                    <th class="py-4 px-6 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-xs text-gray-600">
                                @foreach ($semuaAnggota as $item)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="py-4 px-6 font-semibold text-slate-900">
                                            {{ $item->nomor_anggota }}
                                        </td>
                                        <td class="py-4 px-6 font-medium text-slate-800">
                                            {{ $item->pendaftaran->nama_lengkap ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6 text-gray-500">
                                            {{ $item->ranting->nama_ranting ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-[10px] font-bold uppercase">
                                                {{ $item->tingkatan ?? 'Warga' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span
                                                class="px-2.5 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-bold uppercase border border-green-100">
                                                Aktif
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- State Jika Kosong / Tidak Ditemukan --}}
                    <div class="p-12 text-center space-y-3">
                        <div
                            class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto text-xl">
                            <i class="fa-solid fa-users-slash"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Data Anggota Tidak Ditemukan
                        </h3>
                        <p class="text-xs text-gray-500 max-w-sm mx-auto">
                            @if (filled($search))
                                Tidak ada anggota yang cocok dengan kata kunci "{{ $search }}".
                            @else
                                Belum ada data anggota yang terdaftar di sistem.
                            @endif
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
