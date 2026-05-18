<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-file-invoice')
    @slot('title', 'Flow C: Output Laporan & Tanggal Awasul')

    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Penerbitan Laporan & Penjadwalan
                </h2>
                <p class="text-xs text-gray-500 mt-1">Data yang tampil di sini adalah anggota yang telah lolos
                    verifikasi Flow B. Siap untuk dicetak dan diset tanggal awasulnya.</p>
            </div>
            <span
                class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full uppercase tracking-wider">
                Flow C - Output
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
                <div class="p-4 bg-slate-50 border-b border-gray-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Siap Terbit Laporan</span>
                    <button
                        class="bg-red-600 hover:bg-red-700 text-white text-[10px] px-3 py-1.5 rounded font-bold transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-print mb-[0.5px]"></i> CETAK SEMUA LAPORAN
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 uppercase font-semibold border-b border-gray-200">
                            <tr>
                                <th class="p-4">No. Pendaftaran</th>
                                <th class="p-4">Nama Anggota</th>
                                <th class="p-4">Ranting</th>
                                <th class="p-4">Status Output</th>
                                <th class="p-4 text-center">Arsip</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-green-50/50 transition-colors">
                                <td class="p-4 font-mono font-bold text-slate-500">#REG-2026-001</td>
                                <td class="p-4 font-bold text-slate-900 uppercase">Wahyu Supono</td>
                                <td class="p-4 text-slate-700">Tanah Abang</td>
                                <td class="p-4">
                                    <span
                                        class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold">Lolos
                                        Verifikasi</span>
                                </td>
                                <td class="p-4 text-center">
                                    <button class="text-slate-400 hover:text-red-600 transition cursor-pointer"
                                        title="Cetak Label Arsip">
                                        <i class="fa-solid fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 space-y-4">
                <h3
                    class="text-sm font-bold text-slate-900 uppercase border-b border-gray-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-days"></i> Penjadwalan Awasul
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Target Anggota</label>
                        <input type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs bg-gray-50 font-bold text-slate-900"
                            value="Wahyu Supono" readonly>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Pilih Tanggal
                            Awasul</label>
                        <input type="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Catatan Tambahan
                            (Opsional)</label>
                        <textarea rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="Contoh: Gelombang 1 - Jakarta Pusat"></textarea>
                    </div>
                    <button
                        class="w-full py-2.5 bg-slate-900 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition shadow-md shadow-slate-900/10 cursor-pointer">
                        SIMPAN & PINDAH KE ARSIP
                    </button>
                </div>
                <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-lg">
                    <p class="text-[9px] text-blue-700 leading-relaxed italic">
                        *Menyimpan data di sini akan otomatis memperbarui database <strong>Arsip Khusus (Menu
                            7)</strong> dan menghapus data dari antrean verifikasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>