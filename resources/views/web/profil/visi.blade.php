@extends('web.layout.app')

@section('content')
    <div class="bg-gray-50 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header Section --}}
            <div
                class="bg-gradient-to-r from-slate-900 via-red-950 to-slate-900 p-8 rounded-2xl shadow-md text-white relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 text-white/5 text-9xl font-bold">IKSPI</div>
                <div class="relative z-10 max-w-2xl">
                    <span
                        class="bg-red-500/20 text-red-400 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider border border-red-500/30">
                        Arah & Tujuan Perguruan
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Visi & Misi IKSPI Kera Sakti
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Landasan fundamental dan komitmen strategis Ikatan Keluarga Silat Putra Indonesia Kera Sakti Cabang
                        Jakarta Pusat dalam membina generasi yang berkarakter.
                    </p>
                </div>
            </div>

            {{-- Grid Visi & Misi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Visi Card --}}
                <div
                    class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-4 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div
                            class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 text-lg shadow-xs mb-4">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3">Visi Perguruan</h3>
                        <div
                            class="text-xs text-gray-600 leading-relaxed whitespace-pre-line bg-gray-50 p-4 rounded-xl border border-gray-100">
                            Menjadi wadah pembinaan generasi muda yang berkarakter, bermoral luhur, menjunjung tinggi
                            sportivitas, serta tangguh dalam membela kebenaran dan kedamaian.
                        </div>
                    </div>
                </div>

                {{-- Misi Card --}}
                <div
                    class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-4 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div
                            class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center text-yellow-600 text-lg shadow-xs mb-4">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3">Misi Perguruan</h3>
                        <div
                            class="text-xs text-gray-600 leading-relaxed whitespace-pre-line bg-gray-50 p-4 rounded-xl border border-gray-100">
                            1. Menyelenggarakan pelatihan fisik dan mental yang terstruktur serta profesional bagi seluruh
                            anggota.
                            2. Membentuk kader yang memiliki kedisiplinan tinggi dan jiwa korsa yang kuat.
                            3. Berperan aktif dalam kegiatan sosial dan pengabdian kepada masyarakat di setiap wilayah
                            ranting.
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
