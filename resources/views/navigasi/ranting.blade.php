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
            <button
                class="inline-flex items-center space-x-1.5 bg-red-600 text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-red-700 shadow-xs transition cursor-pointer">
                <i class="fa-solid fa-circle-plus"></i> <span>Tambah Ranting</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div
                class="bg-white rounded-xl border border-gray-200 shadow-xs p-5 flex flex-col justify-between space-y-4">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <span
                            class="bg-red-50 text-red-700 text-[9px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider border border-red-100">Ranting
                            Utama</span>
                        <h4 class="text-sm font-bold text-slate-900 mt-1.5">Ranting Tanah Abang</h4>
                        <p class="text-xs text-gray-400"><i class="fa-solid fa-location-dot mr-1"></i> Lapangan
                            Serbaguna RW 04, Kec. Tanah Abang</p>
                    </div>
                    <span class="text-slate-300 text-lg"><i class="fa-solid fa-gavel"></i></span>
                </div>
                <div class="bg-gray-50 rounded-lg p-2.5 flex items-center justify-between text-[11px]">
                    <span class="text-gray-500"><i class="fa-regular fa-clock mr-1"></i> Selasa & Jumat (19.30)</span>
                    <span class="font-bold text-red-600"><i class="fa-solid fa-user-shield mr-1"></i> Mas Ahmad</span>
                </div>
                <div class="pt-2 border-t border-gray-100 flex justify-end">
                    <button
                        class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 cursor-pointer">
                        <span>Lihat Peta Lokasi</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </button>
                </div>
            </div>

            <div
                class="bg-white rounded-xl border border-gray-200 shadow-xs p-5 flex flex-col justify-between space-y-4">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <span
                            class="bg-slate-100 text-slate-700 text-[9px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider border border-gray-200">Ranting
                            Binaan</span>
                        <h4 class="text-sm font-bold text-slate-900 mt-1.5">Ranting Kemayoran</h4>
                        <p class="text-xs text-gray-400"><i class="fa-solid fa-location-dot mr-1"></i> Aula Komplek
                            Kemayoran Blok C, Kec. Kemayoran</p>
                    </div>
                    <span class="text-slate-300 text-lg"><i class="fa-solid fa-gavel"></i></span>
                </div>
                <div class="bg-gray-50 rounded-lg p-2.5 flex items-center justify-between text-[11px]">
                    <span class="text-gray-500"><i class="fa-regular fa-clock mr-1"></i> Rabu & Sabtu (20.00)</span>
                    <span class="font-bold text-red-600"><i class="fa-solid fa-user-shield mr-1"></i> Mas Hanafi</span>
                </div>
                <div class="pt-2 border-t border-gray-100 flex justify-end">
                    <button
                        class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 cursor-pointer">
                        <span>Lihat Peta Lokasi</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>