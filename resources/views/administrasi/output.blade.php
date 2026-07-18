<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-id-card-clip')
    @slot('title', 'Flow C: Output Data Kelulusan')

    <div class="max-w-6xl mx-auto space-y-6">
        @if (session('success'))
            <div id="alert-success"
                class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error"
                class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500">
                <i class="fa-solid fa-circle-exclamation text-base text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Buku Induk Anggota Resmi
                    {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Daftar nomor anggota resmi yang telah diterbitkan sistem. Anda
                    dapat mengatur tanggal pengesahan di sini.</p>
            </div>
            <a href="{{ route('output.cetak', ['ranting_id' => request('ranting_id')]) }}" target="_blank"
                class="px-4 py-2 bg-yellow-600 text-white font-bold text-xs rounded-lg hover:bg-slate-800 shadow-xs transition inline-flex items-center gap-2 cursor-pointer print:hidden">
                <i class="fa-solid fa-print"></i> Cetak Laporan
            </a>
        </div>

        <div
            class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden print:border-0 print:shadow-none">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-gray-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="p-4">Nomor Anggota</th>
                        <th class="p-4">Nama Warga</th>
                        @if (auth()->user()->role === 'admin_cabang')
                            <th class="p-4">
                                <div class="flex items-center gap-1 group">
                                    <span class="{{ request('ranting_id') ? 'text-red-600' : '' }}">Ranting Asal</span>
                                    <div class="relative">
                                        <button onclick="toggleRantingFilter()"
                                            class="text-slate-400 hover:text-slate-900">
                                            <i class="fa-solid fa-filter text-[9px]"></i>
                                        </button>

                                        <!-- Menu Filter Ranting -->
                                        <div id="filterRantingMenu"
                                            class="hidden absolute top-full left-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-xl z-20 max-h-60 overflow-y-auto">
                                            <a href="{{ route('output.index', array_merge(request()->query(), ['ranting_id' => ''])) }}"
                                                class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Semua
                                                Ranting</a>
                                            @foreach ($dataRanting as $ranting)
                                                <a href="{{ route('output.index', array_merge(request()->query(), ['ranting_id' => $ranting->id])) }}"
                                                    class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50 {{ request('ranting_id') == $ranting->id ? 'bg-slate-100' : '' }}">
                                                    {{ $ranting->nama_ranting }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </th>
                        @endif
                        <th class="p-4">Tingkatan</th>
                        <th class="p-4">Tanggal Pengesahan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs">
                    @forelse($anggotaResmi as $row)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 font-mono font-bold text-red-600 tracking-wider">
                                {{ $row->nomor_anggota }}
                            </td>
                            <td class="p-4 font-bold text-slate-900 uppercase">
                                {{ $row->pendaftaran->nama_lengkap }}
                            </td>
                            <td class="p-4 text-gray-600 font-medium">
                                {{ $row->ranting->nama_ranting }}
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2 py-0.5 bg-slate-100 text-slate-800 text-[10px] font-bold rounded border border-slate-200 uppercase">
                                    {{ $row->tingkatan }}
                                </span>
                            </td>
                            <td class="p-4">
                                @if (auth()->user()->role === 'admin_cabang')
                                    {{-- Hanya Admin Cabang yang melihat form input ini --}}
                                    <form action="{{ route('output.update-tanggal', $row->id) }}" method="POST"
                                        class="flex items-center gap-2 print:hidden">
                                        @csrf
                                        @method('PATCH')
                                        <input type="date" name="tanggal_pengesahan"
                                            value="{{ $row->tanggal_pengesahan }}" required
                                            class="px-2 py-1 border border-gray-200 rounded text-[11px] text-slate-700">
                                        <button type="submit"
                                            class="p-1.5 bg-slate-100 hover:bg-slate-200 rounded text-slate-700">
                                            <i class="fa-solid fa-floppy-disk"></i>
                                        </button>
                                    </form>
                                @else
                                    {{-- User lain (Admin Ranting/Anggota) hanya bisa melihat teks --}}
                                    <span
                                        class="text-xs font-bold {{ $row->tanggal_pengesahan ? 'text-slate-900' : 'text-gray-400' }}">
                                        {{ $row->tanggal_pengesahan ? \Carbon\Carbon::parse($row->tanggal_pengesahan)->translatedFormat('d F Y') : 'Belum Disahkan' }}
                                    </span>
                                @endif

                                {{-- Tetap tampilkan ini untuk kebutuhan print --}}
                                <span class="hidden print:inline text-slate-900">
                                    {{ $row->tanggal_pengesahan ? \Carbon\Carbon::parse($row->tanggal_pengesahan)->translatedFormat('d F Y') : 'Belum Disahkan' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-users-slash text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="font-medium text-sm text-gray-600">Belum Ada Data Anggota</p>
                                    <p class="text-xs">Data anggota resmi akan muncul di sini setelah proses verifikasi
                                        selesai.</p>
                                </div>
                            </td>
                        </tr>
                    @endempty
            </tbody>
        </table>
    </div>
</div>

<script>
    // Menutup alert
    document.addEventListener('DOMContentLoaded', () => {
        const alerts = ['alert-success', 'alert-error'];

        alerts.forEach(id => {
            const alertElement = document.getElementById(id);
            if (alertElement) {
                setTimeout(() => {
                    alertElement.style.opacity = '0';

                    setTimeout(() => {
                        alertElement.remove();
                    }, 500);
                }, 3000);
            }
        });
    });

    // Fungsi untuk toggle menu filter Ranting
    function toggleRantingFilter() {
        const rantingMenu = document.getElementById('filterRantingMenu');
        const kategoriMenu = document.getElementById('filterKategoriMenu'); // Pastikan ini ID menu kategori kamu

        rantingMenu.classList.toggle('hidden');
        kategoriMenu.classList.add('hidden'); // Tutup menu kategori jika sedang buka ranting
    }

    // Menutup menu jika klik di area mana saja di luar menu
    window.onclick = function(event) {
        if (!event.target.matches('.fa-filter')) {
            document.getElementById('filterRantingMenu').classList.add('hidden');
        }
    }
</script>

</x-dashboard-layout>
