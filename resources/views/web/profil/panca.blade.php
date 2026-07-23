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
                        Janji Setia Warga
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Panca Prasetya IKSPI Kera Sakti
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Lima sumpah dan ikrar suci yang senantiasa dipegang teguh oleh setiap warga serta pendekar perguruan
                        dalam kehidupan sehari-hari.
                    </p>
                </div>
            </div>

            {{-- Main Content Card (Panca Prasetya Dummy) --}}
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    <div
                        class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 text-xl shadow-xs shrink-0">
                        <i class="fa-solid fa-hand-holding-hand"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 uppercase tracking-wider">Ikrar & Sumpah Warga</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Pedoman kehormatan moral anggota perguruan</p>
                    </div>
                </div>

                {{-- Daftar Panca Prasetya --}}
                <div class="space-y-4 text-xs sm:text-sm text-gray-700">
                    <div
                        class="flex items-start gap-4 p-4 rounded-xl bg-gray-50/50 border border-gray-100 transition hover:bg-gray-50">
                        <span
                            class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">1</span>
                        <p class="leading-relaxed pt-1">
                            Bertakwa kepada Tuhan Yang Maha Esa serta taat menjalankan perintah dan menjauhi segala
                            larangan-Nya.
                        </p>
                    </div>

                    <div
                        class="flex items-start gap-4 p-4 rounded-xl bg-gray-50/50 border border-gray-100 transition hover:bg-gray-50">
                        <span
                            class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">2</span>
                        <p class="leading-relaxed pt-1">
                            Setia dan patuh kepada Anggaran Dasar, Anggaran Rumah Tangga, serta peraturan perguruan IKSPI
                            Kera Sakti.
                        </p>
                    </div>

                    <div
                        class="flex items-start gap-4 p-4 rounded-xl bg-gray-50/50 border border-gray-100 transition hover:bg-gray-50">
                        <span
                            class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">3</span>
                        <p class="leading-relaxed pt-1">
                            Menjunjung tinggi nama baik perguruan, menjaga kerhormatan sesama anggota, serta memelihara
                            persatuan dan kesatuan bangsa.
                        </p>
                    </div>

                    <div
                        class="flex items-start gap-4 p-4 rounded-xl bg-gray-50/50 border border-gray-100 transition hover:bg-gray-50">
                        <span
                            class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">4</span>
                        <p class="leading-relaxed pt-1">
                            Menggunakan ilmu bela diri perguruan hanya untuk kebenaran, membela diri, serta menolong sesama
                            yang tertindas.
                        </p>
                    </div>

                    <div
                        class="flex items-start gap-4 p-4 rounded-xl bg-gray-50/50 border border-gray-100 transition hover:bg-gray-50">
                        <span
                            class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">5</span>
                        <p class="leading-relaxed pt-1">
                            Berbudi pekerti luhur, jujur, berani, serta bertanggung jawab dalam setiap tindakan dan
                            perbuatan.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
