<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-info-circle')
    @slot('title', 'Tentang IKSPI Kera Sakti')

    <div class="space-y-6 max-w-5xl mx-auto">
        <div
            class="relative bg-gradient-to-r from-slate-900 via-red-950 to-slate-900 p-8 rounded-2xl shadow-sm overflow-hidden border border-slate-800">
            <div class="absolute -right-10 -bottom-10 text-white/5 text-9xl font-bold">IKSPI</div>
            <div class="relative z-10 max-w-2xl">
                <span
                    class="bg-red-500/10 text-red-400 text-[10px] uppercase tracking-widest font-bold px-2.5 py-1 rounded-md border border-red-500/20">Profil
                    Pusat & Cabang</span>
                <h2 class="text-2xl font-bold tracking-wide uppercase text-white mt-3">Ikatan Keluarga Silat Putra
                    Indonesia</h2>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">Mengenal lebih dekat sejarah luhur, filosofi
                    pergerakan, dan nilai-nilai fundamental perguruan Kera Sakti di wilayah Jakarta Pusat.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs space-y-3">
                <div
                    class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600 text-sm shadow-xs">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Visi Perguruan</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Mendidik manusia yang berbudi luhur, tahu benar dan
                    salah, serta bertakwa kepada Tuhan Yang Maha Esa.</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs space-y-3">
                <div
                    class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center text-yellow-600 text-sm shadow-xs">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Misi Perguruan</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Melestarikan seni budaya bangsa berupa pencak silat
                    aliran Kera Sakti (Kungfu) sebagai wadah bela diri fisik dan mental.</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs space-y-3">
                <div
                    class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-800 text-sm shadow-xs">
                    <i class="fa-solid fa-scroll"></i>
                </div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Sejarah Singkat</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Didirikan oleh Bapak R. Totong Kiemdarto pada 15
                    Januari 1980 di Madiun, memadukan silat nusantara dan kungfu lincah.</p>
            </div>
        </div>
    </div>
</x-dashboard-layout>