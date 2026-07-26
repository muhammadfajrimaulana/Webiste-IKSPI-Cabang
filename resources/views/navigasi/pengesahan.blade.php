<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-id-card-clip')
    @slot('title', 'Data Pengesahan Anggota')

    <style type="text/css" media="print">
        /* Sembunyikan elemen dashboard saat print */
        nav,
        aside,
        header,
        .no-print {
            display: none !important;
        }

        /* Pastikan area dokumen tampil penuh */
        #printableArea {
            box-shadow: none !important;
            border: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>

    <div class="space-y-6 max-w-6xl mx-auto">
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
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Manajemen Pengesahan' : '' }}
                        </h3>
                        <p class="text-[11px] text-gray-500 font-medium">
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Kelola pengesahan anggota IKSPI Jakarta Pusat.' : '' }}
                        </p>
                    </div>
                </div>

                <!-- Kanan: Statistik & Aksi -->
                <div class="flex items-center gap-4">
                    <!-- Badge Statistik -->
                    <div class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl flex items-center gap-3">
                        <div
                            class="h-7 w-7 rounded-lg bg-white text-slate-600 flex items-center justify-center border border-slate-100">
                            <i class="fa-solid fa-id-card-clip text-[10px]"></i>
                        </div>
                        <div>
                            <p class="text-[8px] text-gray-400 uppercase font-bold tracking-wider">Total Pengesahan</p>
                            <p class="text-xs font-black text-slate-900">{{ $totalPengesahan ?? 0 }} <span
                                    class="font-medium text-gray-400 text-[9px]">Anggota Telah Disahkan</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Daftar Pengesahan --}}
        @if (auth()->user()->role === 'admin_cabang' || auth()->user()->role === 'admin_ranting')
            <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
                <div
                    class="p-4 bg-gray-50/50 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Arsip Kelulusan
                            Anggota</span>
                    </div>

                    <form action="{{ route('menu.pengesahan') }}" method="GET" class="flex items-center gap-2">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            </span>
                            <input type="text" name="search" value="{{ $search }}"
                                placeholder="Cari nama atau nomor anggota..."
                                class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none w-64 bg-white text-slate-900">
                        </div>
                        @if ($search)
                            <a href="{{ route('menu.pengesahan') }}"
                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">Reset</a>
                        @endif
                        <button type="submit"
                            class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition shadow-xs cursor-pointer">Cari</button>
                    </form>
                </div>

                <div class="p-4 overflow-x-auto">

                    <table class="w-full text-left text-sm text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Nomor Anggota</th>
                                <th class="px-6 py-3">Nama Lengkap</th>
                                <th class="px-6 py-3">Ranting</th>
                                <th class="px-6 py-3">Tingkatan</th>
                                <th class="px-6 py-3">Status</th>
                                @if (auth()->user()->role !== 'anggota')
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($dataPengesahan as $pengesahan)
                                <tr class="bg-white hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-red-700">{{ $pengesahan->nomor_anggota }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $pengesahan->nama_lengkap ?? 'N/A' }}</td>
                                    </td>
                                    <td class="px-6 py-4">{{ $pengesahan->ranting->nama_ranting ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $pengesahan->tingkatan ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="{{ $pengesahan->status_aktif == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider border">
                                            {{ ucfirst($pengesahan->status_aktif) }}
                                        </span>
                                    </td>
                                    @if (auth()->user()->role !== 'anggota')
                                        <td class="px-6 py-4 text-center">
                                            <button type="button"
                                                onclick="bukaModalEdit({{ json_encode($pengesahan) }})"
                                                class="ml-2 px-3 py-1.5 bg-blue-600 text-white font-sm text-xs rounded-lg hover:bg-blue-700 transition cursor-pointer">
                                                Edit
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'anggota' ? 5 : 6 }}"
                                        class="p-10 text-center text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-clipboard-check text-xl mb-2"></i>
                                            <p class="text-sm">Tidak ada data tersedia.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    @if (auth()->user()->role === 'anggota')
        <div class="max-w-2xl mx-auto my-8 bg-white p-10 shadow-lg border border-gray-200" id="printableArea">
            <div class="flex justify-between border-b pb-6 mb-6">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tighter">Data
                        Pengesahan</h1>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">Sistem Manajemen
                        Keanggotaan</p>
                </div>
                <div class="text-right">
                    <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center ml-auto mb-2">
                        <i class="fa-solid fa-id-card text-white"></i>
                    </div>
                </div>
            </div>

            @forelse($dataPengesahan as $pengesahan)
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[9px] font-bold text-gray-400 uppercase">Nomor Anggota</p>
                            <p class="text-sm font-bold text-slate-900">{{ $pengesahan->nomor_anggota }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-gray-400 uppercase">Tingkatan</p>
                            <p class="text-sm font-bold text-slate-900">{{ $pengesahan->tingkatan }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-gray-400 uppercase">Nama Lengkap</p>
                            <p class="text-sm font-bold text-slate-900">{{ $pengesahan->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-gray-400 uppercase">Asal Ranting</p>
                            <p class="text-sm font-bold text-slate-900">
                                {{ $pengesahan->ranting->nama_ranting ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="border-t pt-6 mt-6">
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Status Kelulusan</p>
                        <div
                            class="{{ $pengesahan->status_aktif == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider border">
                            {{ ucfirst($pengesahan->status_aktif) }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400">Data tidak ditemukan.</p>
            @endforelse

            <div class="mt-12 pt-6 border-t text-[10px] text-gray-400 text-center">
                Dokumen ini dicetak otomatis oleh sistem. | {{ now()->format('d F Y, H:i') }}
            </div>
        </div>

        <div class="max-w-2xl mx-auto flex justify-center mb-10">
            <a href="{{ route('menu.pengesahan.cetak') }}" target="_blank"
                class="px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-print mr-2"></i> Cetak Dokumen Pengesahan
            </a>
        </div>
    @endif

    <div id="modalEditPengesahan"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 p-4">
        <div class="bg-white rounded-xl w-full max-w-lg shadow-2xl p-6">
            <h3 class="text-sm font-bold text-slate-950 mb-4">Edit Data Pengesahan</h3>

            <form id="formEditPengesahan" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Nomor Anggota</label>
                        <input type="text" name="nomor_anggota" id="edit_nomor_anggota"
                            class="w-full bg-slate-200 mt-1 p-2 text-xs border rounded-lg" readonly disabled>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="edit_nama_lengkap"
                            class="w-full mt-1 p-2 text-xs border rounded-lg">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Asal Ranting</label>
                        <textarea name="nama_ranting" id="edit_nama_ranting" class="w-full mt-1 p-2 text-xs border rounded-lg" readonly></textarea>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Tingkatan</label>
                        <select name="tingkatan" id="edit_tingkatan"
                            class="w-full mt-1 p-2 text-xs border rounded-lg">
                            <option value="Siswa">Siswa</option>
                            <option value="Warga TK 1">Warga TK 1</option>
                            <option value="Warga TK 2">Warga TK 2</option>
                            <option value="Warga TK 3">Warga TK 3</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Status</label>
                        <select name="status" id="edit_status" class="w-full mt-1 p-2 text-xs border rounded-lg">
                            <option value="aktif">Aktif</option>
                            <option value="non-aktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="tutupModal()"
                        class="px-4 py-2 text-xs bg-slate-200 rounded font-bold text-gray-600 cursor-pointer">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg cursor-pointer">Simpan
                    </button>
                </div>
            </form>
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

        function bukaModalEdit(pengesahan) {
            const modal = document.getElementById('modalEditPengesahan');
            const form = document.getElementById('formEditPengesahan');

            // Set Action Form (Update Route)
            form.action = '/pengesahan/update/' + pengesahan.id;

            // Isi field form
            document.getElementById('edit_nomor_anggota').value = pengesahan.nomor_anggota;
            document.getElementById('edit_nama_lengkap').value = pengesahan.nama_lengkap;
            document.getElementById('edit_nama_ranting').value = pengesahan.nama_ranting;
            document.getElementById('edit_tingkatan').value = pengesahan.tingkatan;
            document.getElementById('edit_status').value = pengesahan.status;
            modal.classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modalEditPengesahan').classList.add('hidden');
        }
    </script>

</x-dashboard-layout>
