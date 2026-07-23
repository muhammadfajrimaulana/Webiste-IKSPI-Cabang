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
                        Direktori Wilayah
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Lokasi & Daftar Ranting
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Informasi sebaran wilayah, alamat sekretariat, serta jumlah anggota di setiap ranting Ikatan
                        Keluarga Silat Putra Indonesia Kera Sakti Cabang Jakarta Pusat.
                    </p>
                    <div
                        class="mt-4 inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl border border-white/10 text-xs font-medium">
                        <i class="fa-solid fa-map-location-dot text-red-400"></i>
                        <span>Total Ranting Aktif: <strong class="text-white">{{ $totalRanting ?? 0 }}
                                Ranting</strong></span>
                    </div>
                </div>
            </div>

            {{-- Grid Daftar Ranting --}}
            @if (isset($dataRanting) && $dataRanting->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($dataRanting as $ranting)
                        <div
                            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-5 flex flex-col justify-between hover:shadow-md transition">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 text-lg shadow-xs">
                                        <i class="fa-solid fa-building-shield"></i>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-[10px] font-bold uppercase">
                                        {{ $ranting->anggota_count ?? 0 }} Anggota
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                                    {{ $ranting->nama_ranting }}
                                </h3>
                                <div class="space-y-2 text-xs text-gray-500 pt-2 border-t border-gray-100">
                                    <div class="flex items-start gap-2">
                                        <i class="fa-solid fa-location-dot text-red-500 mt-0.5 shrink-0"></i>
                                        <span>{{ $ranting->alamat ?? 'Alamat sekretariat belum dicantumkan.' }}</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-user-tie text-slate-400 shrink-0"></i>
                                        <span>Ketua: <strong
                                                class="text-slate-800">{{ $ranting->ketua_ranting ?? '-' }}</strong></span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-chalkboard-user text-slate-400 shrink-0"></i>
                                        <span>Pelatih: <strong
                                                class="text-slate-800">{{ $ranting->nama_pelatih ?? '-' }}</strong></span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 leading-relaxed flex items-start gap-2">
                                    <i class="fa-solid fa-location-dot text-red-500 mt-0.5 shrink-0"></i>
                                    <span>{{ $ranting->alamat_ranting ?? 'Alamat sekretariat ranting belum dicantumkan.' }}</span>
                                </p>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs">
                                <span class="text-gray-400 font-medium">Wilayah Jakarta Pusat</span>
                                @if ($ranting->telepon)
                                    <a href="https://wa.me/{{ $ranting->telepon }}" target="_blank"
                                        class="px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-600 rounded-lg font-bold transition flex items-center gap-1.5">
                                        <i class="fa-brands fa-whatsapp"></i> Kontak
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- State Jika Kosong --}}
                <div class="bg-white p-12 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div
                        class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto text-xl">
                        <i class="fa-solid fa-map"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Data Ranting Tidak Ditemukan</h3>
                    <p class="text-xs text-gray-500 max-w-sm mx-auto">
                        Belum ada informasi ranting yang terdaftar di dalam sistem.
                    </p>
                </div>
            @endif

        </div>
    </div>
@endsection
