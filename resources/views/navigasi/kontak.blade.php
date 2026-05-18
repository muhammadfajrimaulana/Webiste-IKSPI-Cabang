<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-headset')
    @slot('title', 'Kontak Informasi Cabang')

    <div class="max-w-2xl mx-auto bg-white border border-gray-200 shadow-xs rounded-xl overflow-hidden">
        <div class="p-5 bg-slate-900 text-white flex items-center space-x-3 border-b border-slate-800">
            <div class="text-yellow-400 text-base"><i class="fa-solid fa-circle-info"></i></div>
            <h3 class="text-xs font-bold uppercase tracking-wider">Sekretariat IKSPI Jakarta Pusat</h3>
        </div>

        <div class="p-6 space-y-5 text-xs">
            <div class="flex items-start gap-4">
                <div
                    class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-slate-600 shrink-0">
                    <i class="fa-solid fa-building-flag"></i></div>
                <div>
                    <p class="font-bold text-slate-900 mb-0.5">Alamat Kantor Sekretariat</p>
                    <p class="text-gray-500 leading-relaxed">Jl. Contoh Alamat Sekretariat Resmi No. 12, Kec. Senen,
                        Kota Jakarta Pusat, DKI Jakarta</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div
                    class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-green-600 shrink-0">
                    <i class="fa-brands fa-whatsapp"></i></div>
                <div>
                    <p class="font-bold text-slate-900 mb-0.5">Hotline Pelayanan / WhatsApp Admin</p>
                    <p class="text-gray-500 font-mono">0812-3456-7890 (Mas Admin Cabang)</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div
                    class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-blue-600 shrink-0">
                    <i class="fa-regular fa-envelope"></i></div>
                <div>
                    <p class="font-bold text-slate-900 mb-0.5">Korespondensi Email Resmi</p>
                    <p class="text-gray-500 font-mono">admin@ikspijakpus.org</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>