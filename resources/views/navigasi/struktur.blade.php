<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-sitemap')
    @slot('title', 'Struktur Organisasi Cabang')

    <div class="space-y-6 max-w-4xl mx-auto">
        <div class="bg-white p-8 rounded-xl border border-gray-200 shadow-xs text-center space-y-6">
            <div class="flex items-center justify-center space-x-2 border-b border-gray-100 pb-4 max-w-xs mx-auto">
                <div class="text-red-600 text-sm"><i class="fa-solid fa-sitemap"></i></div>
                <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Bagan Komando Kepengurusan</h3>
            </div>

            <div
                class="inline-block bg-slate-900 text-white p-4 rounded-xl min-w-[240px] shadow-sm border border-slate-800">
                <div class="text-[9px] font-bold text-yellow-400 uppercase tracking-widest">Ketua Cabang</div>
                <p class="text-xs font-bold mt-1.5 uppercase tracking-wide">Wahyu Supono</p>
            </div>

            <div class="h-8 w-0.5 bg-gray-200 mx-auto"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-xl mx-auto">
                <div class="bg-white border border-gray-200 p-4 rounded-xl shadow-xs flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-600 text-xs"><i
                            class="fa-regular fa-id-card"></i></div>
                    <div class="text-left">
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Sekretaris Cabang</p>
                        <p class="text-xs font-bold text-slate-900 mt-0.5">Lukman Pratama</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-4 rounded-xl shadow-xs flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center text-green-600 text-xs">
                        <i class="fa-solid fa-wallet"></i></div>
                    <div class="text-left">
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Bendahara Keuangan</p>
                        <p class="text-xs font-bold text-slate-900 mt-0.5">Sintia Saputri</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>