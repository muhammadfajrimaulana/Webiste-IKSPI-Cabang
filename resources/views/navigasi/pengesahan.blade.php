<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-id-card-clip')
    @slot('title', 'Data Pengesahan Anggota')

    <div class="space-y-6 max-w-5xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
            <div
                class="p-4 bg-gray-50/50 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center space-x-2">
                    <div class="text-red-600 text-xs"><i class="fa-solid fa-address-book"></i></div>
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Arsip Kelulusan Warga /
                        Pendekar</span>
                </div>
                <div class="relative max-w-xs w-full">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-[11px]">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text"
                        class="w-full pl-8 pr-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                        placeholder="Cari nama anggota...">
                </div>
            </div>

            <div class="p-4">
                <table class="w-full text-left text-sm text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nomor Anggota</th>
                            <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3">Asal Ranting</th>
                            <th scope="col" class="px-6 py-3">Tingkatan</th>
                            <th scope="col" class="px-6 py-3">Tanggal Pengesahan</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataPengesahan as $pengesahan)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $pengesahan->nomor_anggota }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $pengesahan->nama_lengkap }}</td>
                                <td class="px-6 py-4">{{ $pengesahan->ranting->nama_ranting ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $pengesahan->tingkatan ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $pengesahan->tanggal_pengesahan->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if ($pengesahan->status == 'lulus')
                                        <span
                                            class="bg-green-100 text-green-800 text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider border border-green-200">
                                            Lulus
                                        </span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider border border-red-200">
                                            Tidak Lulus
                                        </span>
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
                                        <p class="font-medium text-sm text-gray-600">Tidak ada data pengesahan yang
                                            tersedia</p>
                                        <p class="text-xs">Silakan periksa kembali nanti atau pastikan ada anggota yang
                                            telah disahkan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>
