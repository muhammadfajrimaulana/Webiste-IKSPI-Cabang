<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-info-circle')
    @slot('title', 'Tentang IKSPI Kera Sakti')

    <form action="{{ route('menu.tentang.update') }}" method="POST" class="space-y-6 max-w-5xl mx-auto">
        @csrf
        @method('PUT')

        {{-- Header Section --}}
        <div
            class="relative bg-gradient-to-r from-slate-900 via-red-950 to-slate-900 p-8 rounded-2xl shadow-sm overflow-hidden border border-slate-800">
            <div class="absolute -right-10 -bottom-10 text-white/5 text-9xl font-bold">IKSPI</div>
            <div class="relative z-10 max-w-2xl">
                <span
                    class="bg-red-500/10 text-red-400 text-[10px] uppercase tracking-widest font-bold px-2.5 py-1 rounded-md border border-red-500/20">
                    Profil Pusat & Cabang
                </span>
                <h2 class="text-2xl font-bold tracking-wide uppercase text-white mt-3">
                    Ikatan Keluarga Silat Putra Indonesia
                </h2>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">
                    Mengenal lebih dekat sejarah luhur, filosofi pergerakan, dan nilai-nilai fundamental perguruan Kera
                    Sakti di wilayah Jakarta Pusat.
                </p>
            </div>
        </div>

        {{-- Konten Dinamis --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Visi --}}
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs space-y-3">
                <div
                    class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600 text-sm shadow-xs">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Visi Perguruan</h3>

                @if (auth()->user()->role === 'admin_cabang')
                    <textarea name="visi" rows="4"
                        class="w-full text-xs text-gray-600 border border-gray-200 rounded p-2 focus:ring-1 focus:ring-red-500 outline-none">{{ $content->visi ?? '' }}</textarea>
                @else
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $content->visi ?? 'Belum diisi.' }}</p>
                @endif
            </div>

            {{-- Misi --}}
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs space-y-3">
                <div
                    class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center text-yellow-600 text-sm shadow-xs">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Misi Perguruan</h3>

                @if (auth()->user()->role === 'admin_cabang')
                    <textarea name="misi" rows="4"
                        class="w-full text-xs text-gray-600 border border-gray-200 rounded p-2 focus:ring-1 focus:ring-red-500 outline-none">{{ $content->misi ?? '' }}</textarea>
                @else
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $content->misi ?? 'Belum diisi.' }}</p>
                @endif
            </div>

            {{-- Sejarah --}}
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs space-y-3">
                <div
                    class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-800 text-sm shadow-xs">
                    <i class="fa-solid fa-scroll"></i>
                </div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Sejarah Singkat</h3>

                @if (auth()->user()->role === 'admin_cabang')
                    <textarea name="sejarah" rows="4"
                        class="w-full text-xs text-gray-600 border border-gray-200 rounded p-2 focus:ring-1 focus:ring-red-500 outline-none">{{ $content->sejarah ?? '' }}</textarea>
                @else
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $content->sejarah ?? 'Belum diisi.' }}</p>
                @endif
            </div>
        </div>

        {{-- Tombol Simpan (Hanya untuk Admin Cabang) --}}
        @if (auth()->user()->role === 'admin_cabang')
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-xs font-bold transition duration-200 shadow-lg shadow-red-600/20">
                    <i class="fa-solid fa-save mr-1"></i> Simpan Perubahan
                </button>
            </div>
        @endif
    </form>
</x-dashboard-layout>
