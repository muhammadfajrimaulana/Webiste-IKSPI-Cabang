<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-building-shield')
    @slot('title', 'Flow B: Verifikasi Pengurus')

    <div class="max-w-6xl mx-auto space-y-6">
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div
                class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium">
                <i class="fa-solid fa-circle-exclamation text-base text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="border-b border-gray-200 pb-4">
            <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pusat Verifikasi Berkas</h2>
            <p class="text-xs text-gray-500 mt-1">Periksa kelengkapan fisik, foto sakral, dan dokumen pdf calon warga
                sebelum menerbitkan nomor anggota.</p>
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
                        <th class="p-4 text-right">Aksi Keputusan</th>
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
                                Ranting {{ $data->ranting?->nama_ranting ?? 'Tidak Terdaftar' }}
                            </td>
                            <td class="p-4 text-gray-500">
                                {{ $data->created_at->translatedFormat('d F Y') }}
                            </td>
                            <td class="p-4 text-center">
                                <a href="#"
                                    class="inline-flex items-center space-x-1 text-red-600 font-bold bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded border border-red-100 text-[11px] transition">
                                    <i class="fa-regular fa-file-pdf"></i>
                                    <span>Lihat {{ $data->nama_file_berkas }}</span>
                                </a>
                            </td>
                            <td class="p-4 text-right">
                                <form action="{{ route('verifikasi.proses', $data->id) }}" method="POST"
                                    class="inline-flex items-center gap-2">
                                    @csrf
                                    <input type="text" name="catatan" placeholder="Alasan jika ditolak..."
                                        class="px-2 py-1 border border-gray-200 rounded text-[11px] focus:outline-none focus:border-red-500 w-36">

                                    <button type="submit" name="action" value="setujui"
                                        class="px-3 py-1.5 bg-slate-950 text-white font-bold text-[11px] rounded hover:bg-slate-800 transition cursor-pointer">
                                        Terima
                                    </button>

                                    <button type="submit" name="action" value="tolak"
                                        class="px-3 py-1.5 bg-red-50 text-red-600 font-bold text-[11px] rounded border border-red-100 hover:bg-red-100 transition cursor-pointer">
                                        Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-400 italic">
                                <i class="fa-solid fa-clipboard-check text-2xl block mb-2 text-gray-300"></i>
                                Bersih! Tidak ada berkas calon anggota yang menunggu verifikasi saat ini.
                            </td>
                        </tr>
                    @endempty
            </tbody>
        </table>
    </div>
</div>
</x-dashboard-layout>
