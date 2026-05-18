<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-user-check')
    @slot('title', 'Flow B: Verifikasi Pengurus Cabang')

    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Antrean Verifikasi Pendaftaran</h2>
                <p class="text-xs text-gray-500 mt-1">Periksa kelengkapan identitas, titik koordinat, dan berkas formal
                    sebelum melakukan validasi data.</p>
            </div>
            <span
                class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full uppercase tracking-wider animate-pulse">
                Flow B - Review
            </span>
        </div>

        <div class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
            <div class="p-4 bg-slate-50 border-b border-gray-100 flex items-center justify-between">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Pengajuan Masuk</span>
                <span class="text-[11px] bg-slate-200 text-slate-800 px-2 py-0.5 rounded-sm font-medium">2 Data
                    Menunggu</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase font-semibold border-b border-gray-200">
                        <tr>
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4">Ranting / Tempat Latihan</th>
                            <th class="p-4">Koordinat Domisili</th>
                            <th class="p-4">Berkas Kelengkapan</th>
                            <th class="p-4 text-center">Aksi Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-medium text-slate-900 flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden flex items-center justify-center font-bold text-slate-500">
                                    WS</div>
                                <div>
                                    <p class="font-semibold text-slate-900">Wahyu Supono</p>
                                    <p class="text-[10px] text-gray-400">081234567890</p>
                                </div>
                            </td>
                            <td class="p-4">
                                <p class="font-medium text-slate-800">Ranting Tanah Abang</p>
                                <p class="text-[10px] text-gray-400">Jakarta Pusat</p>
                            </td>
                            <td class="p-4">
                                <span
                                    class="bg-gray-100 px-2 py-1 rounded text-[10px] font-mono text-slate-700 block w-max">📍
                                    -6.1754, 106.8271</span>
                            </td>
                            <td class="p-4">
                                <a href="#"
                                    class="inline-flex items-center space-x-1 text-red-600 font-semibold hover:underline bg-red-50 px-2 py-1 rounded">
                                    <span>📄</span> <span>Iks.pdf</span>
                                </a>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded font-semibold transition cursor-pointer">Tolak</button>
                                    <button
                                        class="bg-slate-900 hover:bg-slate-800 text-white px-3 py-1.5 rounded font-semibold transition cursor-pointer">Terima
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-medium text-slate-900 flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden flex items-center justify-center font-bold text-slate-500">
                                    LP</div>
                                <div>
                                    <p class="font-semibold text-slate-900">Lukman Pratama</p>
                                    <p class="text-[10px] text-gray-400">089876543210</p>
                                </div>
                            </td>
                            <td class="p-4">
                                <p class="font-medium text-slate-800">Ranting Kemayoran</p>
                                <p class="text-[10px] text-gray-400">Jakarta Pusat</p>
                            </td>
                            <td class="p-4">
                                <span
                                    class="bg-gray-100 px-2 py-1 rounded text-[10px] font-mono text-slate-700 block w-max">📍
                                    -6.1601, 106.8415</span>
                            </td>
                            <td class="p-4">
                                <a href="#"
                                    class="inline-flex items-center space-x-1 text-red-600 font-semibold hover:underline bg-red-50 px-2 py-1 rounded">
                                    <span>📄</span> <span>Iks.pdf</span>
                                </a>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded font-semibold transition cursor-pointer">Tolak</button>
                                    <button
                                        class="bg-slate-900 hover:bg-slate-800 text-white px-3 py-1.5 rounded font-semibold transition cursor-pointer">Terima
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-4 bg-slate-900 text-white rounded-xl shadow-xs text-xs flex items-center justify-between">
            <p>💡 <strong>Info Mekanisme Flow:</strong> Ketika tombol <span class="text-yellow-400 font-bold">"Terima"
                </span> diklik, sistem akan otomatis melempar data ke **Flow C (Output)** untuk
                men-generate laporan berkala dan membuka form input **Tanggal Awasul** secara otomatis.</p>
        </div>
    </div>
</x-dashboard-layout>