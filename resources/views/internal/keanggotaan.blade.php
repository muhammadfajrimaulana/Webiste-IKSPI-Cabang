<x-dashboard-layout>
    @slot('title', '1. Manajemen Keanggotaan')
    @slot('icon', 'fa-users')

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-xs space-y-4">
        <div class="flex items-center space-x-3 border-b border-gray-100 pb-3">
            <div class="text-blue-500 text-base"><i class="fa-solid fa-users"></i></div>
            <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Database Induk Anggota</h3>
        </div>
        <p class="text-xs text-gray-500">Halaman ini digunakan untuk mengelola data induk warga dan pendekar IKSPI
            Jakpus berdasarkan nomor anggota.</p>
    </div>
</x-dashboard-layout>