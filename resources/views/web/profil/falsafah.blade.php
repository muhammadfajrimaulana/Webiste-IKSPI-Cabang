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
                        Filosofi & Nilai Perguruan
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-3">
                        Falsafah Ajaran IKSPI Kera Sakti
                    </h1>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Menyelami prinsip moral, etika, dan landasan spiritual yang menjadi pedoman hidup bagi setiap warga
                        dan pendekar perguruan.
                    </p>
                </div>
            </div>

            {{-- Main Content Card (Falsafah dengan Data Dummy) --}}
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
                    <div
                        class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 text-xl shadow-xs shrink-0">
                        <i class="fa-solid fa-fire-flame-curved"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 uppercase tracking-wider">Prinsip & Falsafah Luhur
                        </h2>
                        <p class="text-xs text-gray-400 mt-0.5">Pedoman moral dan karakter pendekar Kera Sakti</p>
                    </div>
                </div>

                {{-- Teks Falsafah Dummy --}}
                <div class="text-xs sm:text-sm text-gray-600 leading-relaxed space-y-4">
                    <p>
                        Ikatan Keluarga Silat Putra Indonesia (IKSPI) Kera Sakti tidak hanya membekali setiap anggotanya
                        dengan kemampuan teknik bela diri fisik yang tangguh, tetapi juga menanamkan fondasi mental dan
                        spiritual yang kokoh. Falsafah perguruan berakar pada prinsip keseimbangan antara kekuatan jasmani
                        dan keluhuran rohani.
                    </p>
                    <p>
                        <strong>1. Berbudi Pekerti Luhur dan Rendah Hati</strong><br>
                        Seorang warga atau pendekar IKSPI diajarkan untuk senantiasa mengutamakan kedamaian, menjunjung
                        tinggi rasa kekeluargaan, serta tidak sombong atas ilmu yang dimiliki. Semakin tinggi ilmu yang
                        dikuasai, hendaknya semakin merendah pula hatinya.
                    </p>
                    <p>
                        <strong>2. Ketahanan Mental dan Pantang Menyerah</strong><br>
                        Terinspirasi dari karakteristik gerak jurus kera yang lincah, adaptif, namun penuh kewaspadaan,
                        setiap anggota dididik untuk memiliki mental pantang menyerah dalam menghadapi berbagai tantangan
                        hidup serta mampu beradaptasi dengan cepat di setiap situasi.
                    </p>
                    <p>
                        <strong>3. Membela Kebenaran dan Keadilan</strong><br>
                        Ilmu bela diri yang dipelajari mutlak digunakan untuk tujuan kebaikan, menolong sesama yang
                        membutuhkan, serta menjaga kehormatan perguruan dan persatuan bangsa di bawah naungan Pancasila dan
                        Undang-Undang Dasar 1945.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
