<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-headset')
    @slot('title', 'Kontak Organisasi')

    <div class="max-w-6xl mx-auto space-y-8">
        @if (session('success'))
            <div id="alert-success"
                class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error"
                class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500">
                <i class="fa-solid fa-circle-exclamation text-base text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Header --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <!-- Kiri: Judul & Deskripsi -->
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Pusat Komunikasi' : '' }}
                        </h3>
                        <p class="text-[11px] text-gray-500 font-medium">
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Kontak setiap ranting IKSPI Jakarta Pusat.' : '' }}
                        </p>
                    </div>
                </div>

                <!-- Kanan: Statistik & Aksi -->
                <div class="flex items-center gap-4">
                    <!-- Badge Statistik -->
                    <div class="px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-full flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-[9px] font-bold text-emerald-700 uppercase">Live Sistem</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Cabang (Grid Layout) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            @foreach ($kontakCabang as $c)
                <div class="relative bg-slate-900 p-5 rounded-xl border border-slate-800 overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fa-solid fa-building-shield text-5xl text-white"></i>
                    </div>
                    <div class="relative z-10">
                        <span class="text-[9px] font-bold text-red-400 uppercase tracking-wider">Pimpinan Cabang</span>
                        <h4 class="text-sm font-black text-white mt-1">{{ $c->nama }}</h4>

                        <a href="https://wa.me/{{ $c->nomor_wa }}" target="_blank"
                            class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-[10px] font-bold text-white transition-all">
                            <i class="fa-brands fa-whatsapp text-green-400"></i> CONNECT
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Section Ranting (Data Grid) -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div
                class="p-5 bg-gray-50/50 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Kontak Ranting
                </h3>
                <i class="fa-solid fa-table-list text-gray-400"></i>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 border-collapse">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-bold">Ranting ID</th>
                            <th class="px-6 py-4 font-bold">Nama Ranting</th>
                            <th class="px-6 py-4 font-bold">Ketua</th>
                            <th class="px-6 py-4 font-bold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($kontakRanting as $r)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-[10px] font-mono text-gray-500">
                                    #RN-{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 text-xs font-bold text-slate-900">{{ $r->nama_ranting }}</td>
                                <td class="px-6 py-4 text-xs text-gray-600">{{ $r->ketua_ranting }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="https://wa.me/{{ $r->kontak_ranting }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-900 text-white text-[9px] font-bold rounded-md hover:bg-red-600 transition-colors">
                                        <i class="fa-brands fa-whatsapp"></i> CHAT
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Menutup alert
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = ['alert-success', 'alert-error'];

            alerts.forEach(id => {
                const alertElement = document.getElementById(id);
                if (alertElement) {
                    setTimeout(() => {
                        alertElement.style.opacity = '0';

                        setTimeout(() => {
                            alertElement.remove();
                        }, 500);
                    }, 3000);
                }
            });
        });
    </script>

</x-dashboard-layout>
