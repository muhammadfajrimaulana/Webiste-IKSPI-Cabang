<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-images')
    @slot('title', 'Ruang Media & Galeri')

    <div class="space-y-6 max-w-5xl mx-auto">
        <div class="flex items-center justify-between border-b border-gray-200 pb-3">
            <div class="flex items-center space-x-2.5">
                <div class="text-red-600 text-sm"><i class="fa-regular fa-images"></i></div>
                <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Dokumentasi & Galeri Kegiatan</h3>
            </div>
            <button
                class="inline-flex items-center space-x-1.5 bg-slate-900 text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-slate-800 transition cursor-pointer">
                <i class="fa-solid fa-cloud-arrow-up"></i> <span>Unggah Media</span>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            <div
                class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-xs flex flex-col justify-between group">
                <div
                    class="w-full h-40 bg-slate-100 flex flex-col items-center justify-center text-gray-400 text-xs border-b border-gray-100 relative">
                    <i class="fa-regular fa-image text-xl mb-1 group-hover:scale-110 transition-transform"></i>
                    <span>Photo Placeholder</span>
                </div>
                <div class="p-4">
                    <p class="text-xs font-bold text-slate-900 truncate">Latihan Gabungan Jakarta Pusat</p>
                    <div class="flex items-center justify-between mt-2 text-[10px] text-gray-400">
                        <span><i class="fa-regular fa-calendar mr-1"></i> Mei 2026</span>
                        <span class="text-red-600 font-medium"><i class="fa-solid fa-tags mr-1"></i> Kegiatan</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-xs flex flex-col justify-between group">
                <div
                    class="w-full h-40 bg-slate-100 flex flex-col items-center justify-center text-gray-400 text-xs border-b border-gray-100 relative">
                    <i class="fa-regular fa-image text-xl mb-1 group-hover:scale-110 transition-transform"></i>
                    <span>Photo Placeholder</span>
                </div>
                <div class="p-4">
                    <p class="text-xs font-bold text-slate-900 truncate">Acara Pengesahan Warga Baru</p>
                    <div class="flex items-center justify-between mt-2 text-[10px] text-gray-400">
                        <span><i class="fa-regular fa-calendar mr-1"></i> Maret 2026</span>
                        <span class="text-red-600 font-medium"><i class="fa-solid fa-tags mr-1"></i> Pengesahan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>