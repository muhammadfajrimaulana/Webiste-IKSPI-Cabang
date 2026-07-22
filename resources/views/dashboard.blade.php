<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-house-chimney')
    @slot('title', 'Dashboard')

    @if (auth()->user()->role === 'anggota')
        {{-- BAGIAN DASHBOARD KHUSUS ANGGOTA --}}
        <div class="space-y-6">
            <div class="bg-slate-900 p-6 rounded-2xl shadow-lg text-white">
                <h2 class="text-xl font-bold">Halo, {{ auth()->user()->nama_pengurus }}!</h2>
                <p class="text-sm text-slate-400">Selamat datang di portal anggota IKSPI Kera Sakti.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white p-5 rounded-xl border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Status Anggota</p>
                        <h3 class="text-md font-bold text-green-600">{{ auth()->user()->status_aktif ?? 'Aktif' }}</h3>
                    </div>
                    <i class="fa-solid fa-check-circle text-green-500 text-xl"></i>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Tingkatan</p>
                        <h3 class="text-md font-bold text-slate-900">{{ auth()->user()->tingkatan ?? 'Warga' }}</h3>
                    </div>
                    <i class="fa-solid fa-medal text-yellow-500 text-xl"></i>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Iuran Terakhir</p>
                        <h3 class="text-sm font-bold text-slate-900">Rp 50.000</h3>
                    </div>
                    <i class="fa-solid fa-wallet text-blue-500 text-xl"></i>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Jadwal Latihan</p>
                        <h3 class="text-sm font-bold text-slate-900">Sabtu, 19:30</h3>
                    </div>
                    <i class="fa-solid fa-calendar text-red-500 text-xl"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-100">
                    <h4 class="font-bold text-slate-900 mb-4">Pengumuman Terbaru</h4>
                    <ul class="space-y-4">
                        <li class="border-l-4 border-red-500 pl-4 py-1">
                            <p class="text-sm font-semibold">Persiapan Pengesahan Anggota Baru</p>
                            <p class="text-xs text-gray-500">Diharapkan seluruh anggota hadir pada kegiatan bakti sosial
                                mendatang.</p>
                        </li>
                    </ul>
                </div>

                <div class="bg-red-50 p-6 rounded-xl border border-red-100 text-center">
                    <i class="fa-solid fa-id-card text-4xl text-red-500 mb-3"></i>
                    <h4 class="font-bold text-slate-900">KTA Digital</h4>
                    <p class="text-xs text-gray-600 mb-4">Download atau cetak KTA digital kamu di sini.</p>
                    <a href="{{ route('anggota.profile') }}"
                        class="block w-full bg-red-600 text-white py-2 rounded-lg text-xs font-bold hover:bg-red-700">Lihat
                        Profil</a>
                </div>
            </div>
        </div>
    @else
        {{-- BAGIAN DASHBOARD KHUSUS PENGURUS --}}

        <div class="space-y-6">
            <div
                class="relative bg-gradient-to-r from-slate-900 via-red-950 to-slate-900 p-6 rounded-2xl shadow-xs border border-slate-800 overflow-hidden">
                <div class="absolute right-0 top-1/2 -translate-y-1/2 opacity-5 text-white pr-6 pointer-events-none">
                    <i class="fa-solid fa-yin-yang text-9xl"></i>
                </div>
                <div class="relative z-10 max-w-2xl space-y-1">
                    <h2 class="text-xl font-bold tracking-wide uppercase text-white flex items-center gap-2">
                        Selamat Datang, {{ auth()->user()->nama_pengurus }}!
                    </h2>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Manajemen Keanggotaan & Administrasi IKSPI Kera Sakti Cabang Jakarta Pusat
                        {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}. Pantau alur pendaftaran,
                        validasi berkas internal, output laporan administrasi dan manajemen ranting secara real-time.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <div
                    class="bg-white p-5 rounded-xl shadow-xs border border-gray-100 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Anggota</p>
                        <h3 class="text-lg font-bold text-slate-900">{{ $totalAnggota }}</h3>
                        <span class="text-[10px] text-blue-600 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-user-shield"></i>
                            {{ auth()->user()->role === 'admin_ranting' ? 'Warga Ranting' : 'Total Cabang' }}
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
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                            {{ auth()->user()->role === 'admin_ranting' ? 'Nama Ranting' : 'Total Ranting' }}
                        </p>
                        <h3 class="text-sm font-bold text-slate-900 truncate">
                            {{ auth()->user()->role === 'admin_ranting' ? auth()->user()->ranting->nama_ranting : $totalRanting }}
                        </h3>
                        <span class="text-[10px] text-slate-500 font-medium flex items-center gap-1 mt-2">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ auth()->user()->role === 'admin_ranting' ? 'Ranting Aktif' : 'Semua Cabang' }}
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
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Menunggu Review</p>
                        <h3 class="text-lg font-bold text-yellow-600">{{ $totalVerifikasi }}</h3>
                        <span
                            class="text-[10px] text-yellow-600 font-bold flex items-center gap-1 {{ $totalVerifikasi > 0 ? 'animate-pulse' : '' }}">
                            <i class="fa-solid fa-circle-notch {{ $totalVerifikasi > 0 ? 'animate-spin' : '' }}"></i>
                            {{ $totalVerifikasi > 0 ? 'Perlu Diproses' : 'Selesai' }}
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
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Saldo Kas</p>
                        <h3 class="text-xl font-extrabold text-slate-950 tracking-tight">
                            Rp {{ number_format($totalSaldo, 0, ',', '.') }}
                        </h3>

                        <span class="text-[10px] text-slate-500 font-bold flex items-center gap-1.5">
                            @if (auth()->user()->role === 'admin_ranting')
                                {{-- Menggunakan relasi ranting user yang login untuk nama yang akurat --}}
                                <i class="fa-solid fa-building-shield text-red-500"></i>
                                {{ auth()->user()->ranting->nama_ranting ?? 'Ranting' }}
                            @else
                                {{-- Tampilan untuk Admin Cabang --}}
                                <i class="fa-solid fa-vault text-green-600"></i>
                                Total Kas Cabang
                            @endif
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
                                <thead
                                    class="bg-gray-50 text-gray-700 uppercase font-semibold border-b border-gray-100">
                                    <tr>
                                        <th class="p-3">Tanggal Daftar</th>
                                        <th class="p-3">Nama Pendaftar</th>
                                        <th class="p-3">Ranting Tujuan</th>
                                        <th class="p-3 text-center">Berkas</th> <!-- Kolom aksi dihapus -->
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($antreanPendaftaran as $pendaftar)
                                        <tr class="hover:bg-slate-50/40 transition">
                                            <td class="p-3 font-bold text-slate-900 uppercase">
                                                {{ $pendaftar->created_at->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="p-3 font-bold text-slate-900 uppercase">
                                                {{ $pendaftar->nama_lengkap }}
                                            </td>
                                            <td class="p-3 text-slate-500">
                                                <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i>
                                                {{ $pendaftar->ranting->nama_ranting }}
                                            </td>
                                            <td class="p-3 text-center">
                                                @if ($pendaftar->berkas_pdf)
                                                    <a href="{{ asset('storage/' . $pendaftar->berkas_pdf) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center space-x-1 bg-slate-900 text-white text-[11px] font-semibold px-2.5 py-1.5 rounded-md hover:bg-slate-800 transition cursor-pointer">
                                                        <i class="fa-regular fa-eye"></i> <span>Lihat</span>
                                                    </a>
                                                @else
                                                    <span class="text-[10px] text-gray-400 italic">Tidak ada
                                                        file</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="p-10 text-center">
                                                <div class="flex flex-col items-center justify-center text-gray-400">
                                                    <div
                                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                        <i class="fa-solid fa-inbox text-gray-400 text-xl"></i>
                                                    </div>
                                                    <p class="font-medium text-sm text-gray-600">Tidak ada antrean</p>
                                                    <p class="text-xs">Saat ini semua pendaftaran sudah diproses.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
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
                            <h4 class="font-bold text-slate-950 text-xs uppercase tracking-wider">Akses Cepat Alur
                                Kerja
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

                            <a href="{{ route('verifikasi.index') }}"
                                class="w-full text-left p-3 text-xs font-semibold bg-gray-50 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg border border-gray-100 transition duration-200 flex items-center justify-between group">
                                <span class="flex items-center space-x-2.5">
                                    <i
                                        class="fa-solid fa-user-check text-slate-400 group-hover:text-red-600 transition w-4 text-center"></i>
                                    <span>Verifikasi Anggota (Flow B)</span>
                                </span>
                                <i
                                    class="fa-solid fa-arrow-right text-[10px] opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
                            </a>

                            <a href="{{ route('output.index') }}"
                                class="w-full text-left p-3 text-xs font-semibold bg-gray-50 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg border border-gray-100 transition duration-200 flex items-center justify-between group">
                                <span class="flex items-center space-x-2.5">
                                    <i
                                        class="fa-solid fa-file-invoice-dollar text-slate-400 group-hover:text-red-600 transition w-4 text-center"></i>
                                    <span>Cetak Laporan Output (Flow C)</span>
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
                            khusus di modul <strong>Data Pengesahan</strong> pada kategori Manajemen.</span>
                    </div>
                </div>
            </div>
    @endif
    </div>


</x-dashboard-layout>
