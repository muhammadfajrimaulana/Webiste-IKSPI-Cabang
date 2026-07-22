<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-building-shield')
    @slot('title', 'Flow B: Verifikasi Pengurus')

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
                    {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}</h2>
                <p class="text-xs text-gray-500 mt-1">Periksa kelengkapan fisik, foto sakral, dan dokumen pdf calon warga
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
                        <th class="p-4">Calon Anggota</th>
                        <th class="p-4">Ranting Latihan</th>
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
                                <div class="font-bold text-slate-900 uppercase">{{ $data->nama_lengkap }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">NIK: {{ $data->nik }}</div>
                            </td>
                            <td class="p-4 text-slate-600 font-medium">
                                {{ $data->ranting?->nama_ranting ?? 'Tidak Terdaftar' }}
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
                                    {{-- Tampilan Form untuk Admin Cabang --}}
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
                                    {{-- Tampilan Status untuk Admin Ranting --}}
                                    @if ($data->status_verifikasi === 'verified')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase">
                                            <i class="fa-solid fa-check-circle mr-1"></i> Terverifikasi
                                        </span>
                                    @elseif($data->status_verifikasi === 'rejected')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700 uppercase">
                                            <i class="fa-solid fa-times-circle mr-1"></i> Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 uppercase">
                                            <i class="fa-solid fa-clock mr-1"></i> Menunggu Verifikasi
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
</script>

</x-dashboard-layout>
