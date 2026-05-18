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

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase font-semibold border-b border-gray-200">
                        <tr>
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4">Angkatan Kelulusan</th>
                            <th class="p-4">Tingkatan Sabuk</th>
                            <th class="p-4 text-center">Status Sinkronisasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-4 font-bold text-slate-900 uppercase tracking-wide">Wahyu Supono</td>
                            <td class="p-4 text-slate-600 font-mono">Angkatan 140 / Tahun 2026</td>
                            <td class="p-4">
                                <span
                                    class="bg-red-50 text-red-700 border border-red-100 px-2.5 py-0.5 rounded text-[10px] font-bold">Warga
                                    Tingkat I</span>
                            </td>
                            <td class="p-4 text-center text-green-600 font-semibold text-[11px]">
                                <i class="fa-solid fa-circle-check mr-1"></i> Terverifikasi Pusat
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>