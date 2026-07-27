<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-building-shield')
    @slot('title', 'Flow B: Verifikasi Calon Anggota')

    <div class="max-w-6xl mx-auto space-y-6">
        @if (session('success'))
            <div id="alert-success"
                class="fixed top-5 right-5 z-50 bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500 shadow-lg">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error"
                class="fixed top-5 right-5 z-50 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500 shadow-lg">
                <i class="fa-solid fa-circle-exclamation text-base text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pusat Verifikasi Berkas Calon
                    Anggota
                    {{ auth()->user()->ranting?->nama_ranting ? 'Ranting ' . auth()->user()->ranting->nama_ranting : 'Setiap Ranting' }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Periksa kelengkapan fisik, pas foto, dan dokumen pdf calon anggota
                    sebelum menerbitkan nomor anggota.</p>
            </div>
            <span
                class="px-3 py-1 bg-yellow-100 text-yellow-600 text-xs font-semibold rounded-full uppercase tracking-wider">
                Flow B - Verifikasi
            </span>
        </div>

        <div class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-gray-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="p-4">Pas Foto</th>
                        <th class="p-4">Nama Lengkap</th>
                        @if (auth()->user()->role === 'admin_cabang')
                            <th class="p-4">
                                <div class="flex items-center gap-1 group">
                                    <span class="{{ request('ranting_id') ? 'text-red-600' : '' }}">Ranting
                                        Tujuan</span>
                                    <div class="relative">
                                        <button onclick="toggleRantingFilter()"
                                            class="text-slate-400 hover:text-slate-900 cursor-pointer">
                                            <i class="fa-solid fa-filter text-[9px]"></i>
                                        </button>

                                        <!-- Menu Filter Ranting -->
                                        <div id="filterRantingMenu"
                                            class="hidden absolute top-full left-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-xl z-20 max-h-60 overflow-y-auto">
                                            <a href="{{ route('verifikasi.index', array_merge(request()->query(), ['ranting_id' => ''])) }}"
                                                class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Semua
                                                Ranting</a>
                                            @foreach ($dataRanting as $ranting)
                                                <a href="{{ route('verifikasi.index', array_merge(request()->query(), ['ranting_id' => $ranting->id])) }}"
                                                    class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50 {{ request('ranting_id') == $ranting->id ? 'bg-slate-100' : '' }}">
                                                    Ranting {{ $ranting->nama_ranting }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </th>
                        @endif
                        <th class="p-4">Tingkatan Anggota</th>
                        <th class="p-4">Tanggal Daftar</th>
                        <th class="p-4 text-center">Dokumen Kelengkapan</th>
                        <th class="p-4 text-right">
                            {{ auth()->user()->role === 'admin_cabang' ? 'Aksi Keputusan' : 'Status Verifikasi' }}
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs">
                    @forelse($antrean as $data)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4">
                                <img src="{{ $data->pas_foto ? (Str::startsWith($data->pas_foto, 'http') ? $data->pas_foto : asset('storage/' . $data->pas_foto)) : asset('images/default.png') }}"
                                    alt="Pas Foto" class="w-13 h-13 rounded object-cover border border-gray-200">
                            </td>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-slate-900 uppercase">{{ $data->nama_lengkap }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">NIK: {{ $data->nik }}</div>
                            </td>
                            @if (auth()->user()->role === 'admin_cabang')
                                <td class="p-4 text-slate-600 font-medium">
                                    Ranting {{ $data->ranting?->nama_ranting ?? 'Tidak Terdaftar' }}
                                </td>
                            @endif
                            <td class="p-4 text-slate-600 font-medium">
                                {{ $data->tingkatan }}
                            </td>
                            <td class="p-4 text-gray-500">
                                {{ $data->created_at->translatedFormat('d F Y') }}
                            </td>
                            <td class="p-4 text-center">
                                @if (!empty($data->berkas_pdf))
                                    <a href="{{ route('berkas.lihat', ['filename' => $data->berkas_pdf]) }}"
                                        target="_blank"
                                        class="inline-flex items-center space-x-1 text-red-600 font-bold bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded border border-red-100 text-[11px] transition">
                                        <i class="fa-regular fa-file-pdf"></i>
                                        <span>Lihat File</span>
                                    </a>
                                @else
                                    <span class="text-[10px] text-gray-400 italic">Tidak upload berkas</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                @if (auth()->user()->role === 'admin_cabang')
                                    {{-- Cek apakah statusnya masih pending atau belum diproses --}}
                                    @if ($data->status_verifikasi === 'pending')
                                        <form action="{{ route('verifikasi.proses', $data->id) }}" method="POST"
                                            class="inline-flex items-center gap-2">
                                            @csrf
                                            <button type="submit" name="action" value="setujui"
                                                class="px-3 py-1.5 bg-green-100 text-green-600 font-bold text-[11px] rounded border border-green-300 hover:bg-green-200 transition cursor-pointer">
                                                Terima
                                            </button>

                                            <button type="submit" name="action" value="tolak"
                                                class="px-3 py-1.5 bg-red-100 text-red-600 font-bold text-[11px] rounded border border-red-300 hover:bg-red-200 transition cursor-pointer">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        {{-- Jika sudah disetujui / ditolak, tampilkan badge status saja --}}
                                        @if ($data->status_verifikasi === 'verified')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase">
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700 uppercase">
                                                Ditolak
                                            </span>
                                        @endif
                                    @endif
                                @else
                                    {{-- Tampilan untuk Admin Ranting --}}
                                    @if ($data->status_verifikasi === 'verified')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase">
                                            Terverifikasi
                                        </span>
                                    @elseif($data->status_verifikasi === 'rejected')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700 uppercase">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 uppercase">
                                            Menunggu Verifikasi
                                        </span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-clipboard-check text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="font-medium text-sm text-gray-600">Semua Data Sudah Terverifikasi</p>
                                    <p class="text-xs">Tidak ada berkas calon anggota yang menunggu verifikasi saat ini.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endempty
            </tbody>
        </table>
    </div>
</div>

<script>
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

    // Toggle filter menu ranting
    function toggleRantingFilter() {
        const rantingMenu = document.getElementById('filterRantingMenu');
        const kategoriMenu = document.getElementById('filterKategoriMenu');

        if (rantingMenu) {
            rantingMenu.classList.toggle('hidden');
        }

        // Gunakan pengecekan (if) agar tidak error jika elemen kategori tidak ada
        if (kategoriMenu) {
            kategoriMenu.classList.add('hidden');
        }
    }
</script>

</x-dashboard-layout>
