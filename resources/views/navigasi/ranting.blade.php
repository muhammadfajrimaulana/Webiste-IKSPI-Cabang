<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-map-location-dot')
    @slot('title', 'Data Ranting & Tempat Latihan')

    <div class="space-y-6 max-w-5xl mx-auto">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <div class="text-red-600 text-sm"><i class="fa-solid fa-map-location-dot"></i></div>
                <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Manajemen Wilayah & Titik Latihan
                </h3>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase font-bold border-b border-gray-200">
                        <tr class="text-[10px] text-black font-bold">
                            <th class="px-6 py-4">Ranting</th>
                            <th class="px-6 py-4">Ketua Ranting</th>
                            <th class="px-6 py-4">Alamat Ranting</th>
                            <th class="px-6 py-4">Kontak Ranting</th>
                            <th class="px-6 py-4">Nama Pelatih</th>
                            <th class="px-6 py-4">Tempat Latihan</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($dataRanting as $ranting)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-semibold">{{ $ranting->nama_ranting }}</td>
                                <td class="px-6 py-4 text-slate-600">N/A</td>
                                <td class="px-6 py-4 text-slate-600">N/A</td>
                                <td class="px-6 py-4">
                                    <a href="https://wa.me/{{ $ranting->kontak_ranting }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ $ranting->kontak_ranting ?? '-' }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $ranting->nama_pelatih ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-500 max-w-[200px] truncate">
                                    {{ $ranting->lokasi_latihan }}</td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="bukaPeta({{ $ranting->latitude }}, {{ $ranting->longitude }})"
                                        class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-lg transition cursor-pointer">
                                        <i class="fa-solid fa-map-marker-alt mr-1"></i> Peta
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada data ranting.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>
