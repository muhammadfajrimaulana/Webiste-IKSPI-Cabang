<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-gauge')
    @slot('title', 'Dashboard')

    <div class="space-y-6">
        <div
            class="relative bg-gradient-to-r from-slate-900 via-red-950 to-slate-900 p-6 rounded-2xl shadow-xs border border-slate-800 overflow-hidden">
            <div class="absolute right-0 top-1/2 -translate-y-1/2 opacity-5 text-white pr-6 pointer-events-none">
                <i class="fa-solid fa-yin-yang text-9xl"></i>
            </div>
            <div class="relative z-10 max-w-2xl space-y-1">
                <h2 class="text-xl font-bold tracking-wide uppercase text-white flex items-center gap-2">
                    Selamat Datang, Admin
                </h2>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Sistem Informasi & Administrasi IKSPI Kera Sakti Cabang Jakarta Pusat. Pantau alur pendaftaran,
                    validasi berkas internal, dan manajemen ranting secara real-time dari panel pusat.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div
                class="bg-white p-5 rounded-xl shadow-xs border border-gray-100 flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Anggota</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalAnggota }}</h3>
                    <span class="text-[10px] text-green-600 font-semibold flex items-center gap-1">
                        <i class="fa-solid fa-user-shield"></i> Warga & Pendekar
                    </span>
                </div>
                <div
                    class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-base transition group-hover:scale-105">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl shadow-xs border border-gray-100 flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Ranting</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalRanting }}</h3>
                    <span class="text-[10px] text-slate-500 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-location-dot"></i> Tempat Latihan Aktif
                    </span>
                </div>
                <div
                    class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-base transition group-hover:scale-105">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl shadow-xs border border-gray-100 flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Verifikasi Form</p>
                    <h3 class="text-2xl font-bold text-yellow-600">{{ $totalVerifikasi }}</h3>
                    <span class="text-[10px] text-yellow-600 font-bold flex items-center gap-1 animate-pulse">
                        <i class="fa-solid fa-circle-notch animate-spin"></i> Menunggu Review
                    </span>
                </div>
                <div
                    class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center text-base transition group-hover:scale-105">
                    <i class="fa-solid fa-user-check"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl shadow-xs border border-gray-100 flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kas Keuangan</p>
                    <h3 class="text-2xl font-bold text-slate-900">Rp 4.5M</h3>
                    <span class="text-[10px] text-green-600 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-vault"></i> Termasuk Modal Ijon 25
                    </span>
                </div>
                <div
                    class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-base transition group-hover:scale-105">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-white p-5 rounded-xl shadow-xs border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="text-red-600 text-xs"><i class="fa-solid fa-users-viewfinder"></i></div>
                            <h4 class="font-bold text-slate-950 text-xs uppercase tracking-wider">Flow B: Antrean
                                Pendaftaran Calon Anggota</h4>
                        </div>
                        <a href="{{ route('verifikasi.index') }}"
                            class="text-[11px] font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                            <span>Lihat Semua</span> <i class="fa-solid fa-angle-right text-[9px]"></i>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-gray-600">
                            <thead class="bg-gray-50 text-gray-700 uppercase font-semibold border-b border-gray-100">
                                <tr>
                                    <th class="p-3">Nama Pendaftar</th>
                                    <th class="p-3">Ranting Tujuan</th>
                                    <th class="p-3">Berkas</th>
                                    <th class="p-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($antreanPendaftaran as $pendaftar)
                                    <tr class="hover:bg-slate-50/40 transition">
                                        <td class="p-3 font-bold text-slate-900 uppercase">
                                            {{ $pendaftar->nama_lengkap }}</td>
                                        <td class="p-3 text-slate-500">
                                            <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i>
                                            {{ $pendaftar->ranting->nama_ranting }}
                                        </td>
                                        <td class="p-3">
                                            <span
                                                class="inline-flex items-center space-x-1.5 text-red-600 font-bold bg-red-50 px-2 py-0.5 rounded border border-red-100 text-[11px]">
                                                <i class="fa-regular fa-file-pdf"></i>
                                                <span>{{ $pendaftar->nama_file_berkas }}</span>
                                            </span>
                                        </td>
                                        <td class="p-3 text-center">
                                            <button
                                                class="inline-flex items-center space-x-1 bg-slate-900 text-white text-[11px] font-semibold px-2.5 py-1.5 rounded-md hover:bg-slate-800 transition cursor-pointer">
                                                <i class="fa-regular fa-eye"></i> <span>Review</span>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-8 text-center text-xs text-gray-400 italic">
                                            <i class="fa-solid fa-inbox text-lg block mb-1 text-gray-300"></i>
                                            Belum ada antrean pendaftaran baru saat ini.
                                        </td>
                                    </tr>
                                @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div
            class="bg-white p-5 rounded-xl shadow-xs border border-gray-100 flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-center space-x-2 border-b border-gray-100 pb-4 mb-4">
                    <div class="text-red-600 text-xs"><i class="fa-solid fa-bolt"></i></div>
                    <h4 class="font-bold text-slate-950 text-xs uppercase tracking-wider">Akses Cepat Alur Kerja
                    </h4>
                </div>

                <div class="space-y-2">
                    <a href="{{ route('pendaftaran.index') }}"
                        class="w-full text-left p-3 text-xs font-semibold bg-gray-50 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg border border-gray-100 transition duration-200 flex items-center justify-between group">
                        <span class="flex items-center space-x-2.5">
                            <i
                                class="fa-solid fa-cloud-arrow-up text-slate-400 group-hover:text-red-600 transition w-4 text-center"></i>
                            <span>Input Data Baru (Flow A)</span>
                        </span>
                        <i
                            class="fa-solid fa-arrow-right text-[10px] opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('output.index') }}"
                        class="w-full text-left p-3 text-xs font-semibold bg-gray-50 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg border border-gray-100 transition duration-200 flex items-center justify-between group">
                        <span class="flex items-center space-x-2.5">
                            <i
                                class="fa-solid fa-file-invoice-dollar text-slate-400 group-hover:text-red-600 transition w-4 text-center"></i>
                            <span>Cetak Laporan & Set Tgl Awasul (Flow C)</span>
                        </span>
                        <i
                            class="fa-solid fa-arrow-right text-[10px] opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="#"
                        class="w-full text-left p-3 text-xs font-semibold bg-gray-50 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg border border-gray-100 transition duration-200 flex items-center justify-between group">
                        <span class="flex items-center space-x-2.5">
                            <i
                                class="fa-solid fa-box-open text-slate-400 group-hover:text-red-600 transition w-4 text-center"></i>
                            <span>Cek Inventaris & Logistik Atribut</span>
                        </span>
                        <i
                            class="fa-solid fa-arrow-right text-[10px] opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
                    </a>
                </div>
            </div>

            <div
                class="bg-slate-50 p-3 rounded-lg border border-gray-100 text-[11px] text-gray-500 leading-relaxed flex items-start gap-2">
                <span class="text-yellow-600 shrink-0"><i class="fa-solid fa-lightbulb"></i></span>
                <span><strong>Tips:</strong> Data pendaftaran yang lolos verifikasi otomatis memperbarui arsip
                    khusus di modul <strong>Ruang Media</strong> dan <strong>Data Ranting</strong>.</span>
            </div>
        </div>
    </div>
</div>
</x-dashboard-layout>
