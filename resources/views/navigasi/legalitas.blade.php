<x-dashboard-layout>
    @slot('icon', 'fa-regular fa-file-lines')
    @slot('title', 'Tata Kelola & Legalitas')

    <div class="space-y-6 max-w-4xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center space-x-3">
                <div class="text-red-600 text-base"><i class="fa-solid fa-shield-halved"></i></div>
                <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Pusat Dokumen Legalitas & SK Resmi
                </h3>
            </div>

            <div class="p-5 divide-y divide-gray-100">
                <div class="flex items-center justify-between py-4.5 first:pt-0 last:pb-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600 text-sm">
                            <i class="fa-regular fa-file-pdf"></i></div>
                        <div>
                            <p class="text-xs font-bold text-slate-900">AD / ART Perguruan IKSPI Kera Sakti</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">Format: PDF • Ukuran: 2.4 MB • Hak Akses:
                                Internal</p>
                        </div>
                    </div>
                    <button
                        class="inline-flex items-center space-x-1.5 bg-slate-900 text-white text-[10px] font-bold px-3 py-2 rounded-lg hover:bg-slate-800 transition cursor-pointer">
                        <i class="fa-solid fa-arrow-down-to-line"></i> <span>Unduh Berkas</span>
                    </button>
                </div>

                <div class="flex items-center justify-between py-4.5">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600 text-sm">
                            <i class="fa-regular fa-file-pdf"></i></div>
                        <div>
                            <p class="text-xs font-bold text-slate-900">SK Kepengurusan Cabang Jakarta Pusat (Aktif)</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">Format: PDF • Ukuran: 1.1 MB • Hak Akses:
                                Pengurus</p>
                        </div>
                    </div>
                    <button
                        class="inline-flex items-center space-x-1.5 bg-slate-900 text-white text-[10px] font-bold px-3 py-2 rounded-lg hover:bg-slate-800 transition cursor-pointer">
                        <i class="fa-solid fa-arrow-down-to-line"></i> <span>Unduh Berkas</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>