<x-dashboard-layout>
    @slot('title', '1. Manajemen Keanggotaan')
    @slot('icon', 'fa-solid fa-users')

    <div class="max-w-6xl mx-auto space-y-6">
        @if (session('success'))
            <div id="alert-success"
                class="fixed top-5 right-5 z-50 bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500 shadow-lg">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error"
                class="fixed top-5 right-5 z-50 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500 shadow-lg">
                <i class="fa-solid fa-circle-exclamation text-base text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="border-b border-gray-200 pb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pusat Data Master
                    {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}</h2>
                <p class="text-xs text-gray-500 mt-1">Sistem kontrol internal sebaran tingkatan sabuk dan monitoring
                    status keaktifan anggota {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}.</p>
            </div>

            <form action="{{ route('internal.keanggotaan') }}" method="GET" class="flex items-center gap-2">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari nama atau nomor anggota..."
                        class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none w-64 bg-white text-slate-900">
                </div>
                @if ($search)
                    <a href="{{ route('internal.keanggotaan') }}"
                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">Reset</a>
                @endif
                <button type="submit"
                    class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition shadow-xs cursor-pointer">Cari</button>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tingkatan Warga</p>
                    <h4 class="text-xl font-extrabold text-slate-950 mt-1">{{ $statWarga }} <span
                            class="text-xs font-normal text-gray-400">Jiwa</span></h4>
                </div>
                <div
                    class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs font-bold">
                    W</div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tingkatan Pendekar</p>
                    <h4 class="text-xl font-extrabold text-slate-950 mt-1">{{ $statPendekar }} <span
                            class="text-xs font-normal text-gray-400">Jiwa</span></h4>
                </div>
                <div
                    class="w-8 h-8 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center text-xs font-bold">
                    P</div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Status Aktif</p>
                    <h4 class="text-xl font-extrabold text-green-600 mt-1">{{ $statAktif }} <span
                            class="text-xs font-normal text-gray-400">Jiwa</span></h4>
                </div>
                <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center text-xs"><i
                        class="fa-solid fa-user-check"></i></div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Non-Aktif / Pasif</p>
                    <h4 class="text-xl font-extrabold text-gray-500 mt-1">{{ $statNonAktif }} <span
                            class="text-xs font-normal text-gray-400">Jiwa</span></h4>
                </div>
                <div class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 flex items-center justify-center text-xs"><i
                        class="fa-solid fa-user-slash"></i></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-gray-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="p-4">No. Anggota</th>
                        <th class="p-4">Nama Lengkap</th>
                        <th class="p-4">Ranting Latihan</th>
                        <th class="p-4">Tingkatan</th>
                        <th class="p-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs">
                    @forelse($semuaAnggota as $anggota)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 font-mono font-bold text-slate-900 tracking-wide">
                                {{ $anggota->nomor_anggota }}
                            </td>
                            <td class="p-4 uppercase font-semibold text-slate-900">
                                {{ $anggota->pendaftaran->nama_lengkap }}
                                <span class="block text-[9px] text-gray-400 normal-case font-normal mt-0.5">Lahir di
                                    {{ $anggota->pendaftaran->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($anggota->pendaftaran->tanggal_lahir)->format('d/m/Y') }}</span>
                            </td>
                            <td class="p-4 text-gray-600">
                                Ranting {{ $anggota->ranting->nama_ranting }}
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2 py-0.5 text-[10px] font-bold rounded border uppercase {{ $anggota->tingkatan === 'Pendekar' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 'bg-slate-50 text-slate-700 border-slate-200' }}">
                                    {{ $anggota->tingkatan }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase {{ $anggota->status_aktif === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $anggota->status_aktif }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-users-slash text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="font-medium text-sm text-gray-600">Belum Ada Data Anggota</p>
                                    <p class="text-xs">Data anggota resmi akan muncul di sini setelah proses verifikasi
                                        selesai.</p>
                                </div>
                            </td>
                        </tr>
                    @endempty
            </tbody>
        </table>
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
