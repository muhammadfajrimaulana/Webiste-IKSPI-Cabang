<x-dashboard-layout>
    @slot('title', 'Keuangan & Logistik Cabang')
    @slot('icon', 'fa-solid fa-wallet')

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

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg text-[10px] mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-8 border-b border-gray-200 pb-6">

            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pusat Transparansi Kas & Logistik
                    {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Sistem pencatatan arus kas masuk, operasional, dan inventarisasi
                    logistik {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-end sm:items-center gap-3">
                <a href="{{ route('internal.keuangan.cetak', request()->query()) }}" target="_blank"
                    class="px-4 py-2 mt-5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Cetak Laporan
                    {{ request('ranting_id') ? 'Ranting Terpilih' : 'Semua Ranting' }}
                </a>

                <button onclick="bukaModalKas()"
                    class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition shadow-sm flex items-center gap-2 cursor-pointer mt-5 sm:mt-5">
                    <i class="fa-solid fa-file-invoice-dollar"></i> Catat Transaksi
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- 1. Total Kas Keseluruhan --}}
            <div class="bg-slate-950 p-5 rounded-2xl border border-slate-800 shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kas Keseluruhan</p>
                    <h4 class="text-xl font-black text-white mt-1">Rp
                        {{ number_format($saldoTotalCabang, 0, ',', '.') }}</h4>
                    <div class="text-[9px] text-slate-500 font-medium mt-2 flex items-center gap-1">
                        <i class="fa-solid fa-building-columns"></i> Seluruh Ranting
                    </div>
                </div>
                <i class="fa-solid fa-vault absolute -bottom-2 -right-2 text-5xl text-slate-900"></i>
            </div>

            {{-- 2. Kas Bersih (Saldo Ranting/User) --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    {{ auth()->user()->role === 'admin_ranting' ? 'Kas Ranting Anda' : 'Total Saldo Anda' }}
                </p>
                <h4 class="text-xl font-black text-slate-950 mt-1">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h4>
                <div
                    class="text-[9px] {{ $saldoAkhir >= 0 ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50' }} px-2 py-1 rounded-md font-bold mt-2 inline-block">
                    <i
                        class="fa-solid {{ $saldoAkhir >= 0 ? 'fa-shield-halved' : 'fa-triangle-exclamation' }} mr-1"></i>
                    {{ $saldoAkhir >= 0 ? 'DANA AMAN' : 'PERHATIAN: DEFISIT' }}
                </div>
            </div>

            {{-- 3. Pemasukan --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pemasukan</p>
                <h4 class="text-xl font-black text-emerald-600 mt-1">Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                </h4>
                <p class="text-[9px] text-slate-400 mt-2 font-medium">Akumulasi iuran & masuk</p>
            </div>

            {{-- 4. Pengeluaran --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pengeluaran</p>
                <h4 class="text-xl font-black text-rose-600 mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                </h4>
                <p class="text-[9px] text-slate-400 mt-2 font-medium">Operasional & logistik</p>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-slate-50">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Riwayat Jurnal Transaksi Terbaru
                </h3>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50/50 border-b border-gray-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="p-4">Tanggal</th>
                        @if (auth()->user()->role === 'admin_cabang')
                            <th class="p-4">
                                <div class="flex items-center gap-1 group">
                                    <span class="{{ request('ranting_id') ? 'text-red-600' : '' }}">Ranting</span>
                                    <div class="relative">
                                        <button onclick="toggleRantingFilter()"
                                            class="text-slate-400 hover:text-slate-900">
                                            <i class="fa-solid fa-filter text-[9px]"></i>
                                        </button>

                                        <!-- Menu Filter Ranting -->
                                        <div id="filterRantingMenu"
                                            class="hidden absolute top-full left-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-xl z-20 max-h-60 overflow-y-auto">
                                            <a href="{{ route('internal.keuangan', array_merge(request()->query(), ['ranting_id' => ''])) }}"
                                                class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Semua
                                                Ranting</a>
                                            @foreach ($dataRanting as $ranting)
                                                <a href="{{ route('internal.keuangan', array_merge(request()->query(), ['ranting_id' => $ranting->id])) }}"
                                                    class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50 {{ request('ranting_id') == $ranting->id ? 'bg-slate-100' : '' }}">
                                                    {{ $ranting->nama_ranting }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </th>
                        @endif
                        <th class="p-4">Keterangan Transaksi</th>
                        <th class="p-4 group">
                            <div class="flex items-center gap-1">
                                <span class="{{ request('kategori') ? 'text-red-600' : '' }}">Kategori</span>
                                <!-- Dropdown filter sederhana di header -->
                                <div class="relative">
                                    <button onclick="toggleFilterMenu()"
                                        class="text-slate-400 hover:text-slate-900 focus:outline-none">
                                        <i class="fa-solid fa-filter text-[9px] ml-1"></i>
                                    </button>

                                    <!-- Menu Filter Kategori -->
                                    <div id="filterMenu"
                                        class="hidden absolute top-full left-0 mt-2 w-40 bg-white border border-slate-200 rounded-lg shadow-xl z-20 overflow-hidden">
                                        <a href="{{ route('internal.keuangan', array_merge(request()->query(), ['kategori' => ''])) }}"
                                            class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Semua
                                            Kategori</a>
                                        <a href="{{ route('internal.keuangan', array_merge(request()->query(), ['kategori' => 'Pendaftaran'])) }}"
                                            class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Pendaftaran</a>
                                        <a href="{{ route('internal.keuangan', array_merge(request()->query(), ['kategori' => 'Iuran'])) }}"
                                            class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Iuran</a>
                                        <a href="{{ route('internal.keuangan', array_merge(request()->query(), ['kategori' => 'Logistik'])) }}"
                                            class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Logistik</a>
                                        <a href="{{ route('internal.keuangan', array_merge(request()->query(), ['kategori' => 'Operasional'])) }}"
                                            class="block px-4 py-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50">Operasional</a>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th class="p-4 text-right">Nominal</th>
                        <th class="p-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs">
                    @forelse($transaksi as $item)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 text-gray-500 font-medium">
                                <div class="flex flex-col">
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB
                                    </span>
                                </div>
                            </td>
                            @if (auth()->user()->role === 'admin_cabang')
                                <td class="p-4 font-bold">
                                    @if ($item->ranting_id === null)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-bold bg-blue-100 text-blue-700 uppercase tracking-wider">
                                            <i class="fa-solid fa-building-columns mr-1"></i> Cabang
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-700">
                                            {{ $item->ranting->nama_ranting ?? '-' }}
                                        </span>
                                    @endif
                                </td>
                            @endif
                            <td class="p-4 font-semibold text-slate-900">
                                {{ $item->keterangan }}
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2 py-0.5 text-[10px] font-medium bg-slate-100 text-slate-700 rounded border border-slate-200">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td
                                class="p-4 text-right font-mono font-bold {{ $item->tipe === 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $item->tipe === 'masuk' ? '+' : '-' }} Rp
                                {{ number_format($item->nominal, 0, ',', '.') }}
                            </td>
                            <td class="p-4 flex items-center justify-center gap-1.5">
                                <button
                                    onclick="bukaModalEditKas({{ $item->id }}, '{{ $item->tanggal }}', '{{ $item->tipe }}', '{{ $item->kategori }}', {{ $item->nominal }}, '{{ $item->keterangan }}')"
                                    class="text-slate-600 hover:text-slate-900 text-xs p-1.5 rounded-md hover:bg-slate-100 transition cursor-pointer">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <form action="{{ route('internal.keuangan.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin mau hapus catatan kas ini, nyet?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 text-xs p-1.5 rounded-md hover:bg-red-50 transition cursor-pointer">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-receipt text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="font-medium text-sm text-gray-600">Belum Ada Transaksi</p>
                                    <p class="text-xs">Riwayat arus kas akan muncul di sini saat
                                        transaksi baru dicatat.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="modalKas"
            class="hidden fixed inset-0 bg-slate-950/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl border border-gray-100 space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-slate-950 text-sm uppercase tracking-wide"><i
                            class="fa-solid fa-file-invoice-dollar text-red-600 mr-1"></i> Catat Kas Baru</h3>
                    <button onclick="tutupModalKas()"
                        class="text-gray-400 hover:text-gray-600 text-sm cursor-pointer"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <form action="{{ route('internal.keuangan.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Tanggal
                            Transaksi</label>
                        <input type="date" name="tanggal" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none focus:border-red-500">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Jenis Arus
                            Kas</label>
                        <select name="tipe" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none focus:border-red-500">
                            <option value="masuk">(+) Pemasukan</option>
                            <option value="keluar">(-) Pengeluaran</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Kategori</label>
                        <select name="kategori" required
                            class="w-full pl-3 pr-8 py-2 text-xs font-semibold bg-white border border-gray-200 rounded-lg appearance-none cursor-pointer">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pendaftaran">Pendaftaran</option>
                            <option value="Iuran">Iuran</option>
                            <option value="Logistik">Logistik</option>
                            <option value="Operasional">Operasional</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nominal
                            (Rupiah)</label>
                        <input type="text" id="inputNominal" name="nominal" required
                            placeholder="Contoh: 500.000"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 font-mono focus:outline-none focus:border-red-500">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Keterangan /
                            Deskripsi</label>
                        <input type="text" name="keterangan" required placeholder="Contoh: Pembelian Atribut..."
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none focus:border-red-500">
                    </div>
                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                        <button type="button" onclick="tutupModalKas()"
                            class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 font-semibold cursor-pointer">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-slate-950 text-white font-bold rounded-lg cursor-pointer">Simpan
                            Kas</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modalEditKas"
            class="hidden fixed inset-0 bg-slate-950/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl border border-gray-100 space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-slate-950 text-sm uppercase tracking-wide"><i
                            class="fa-solid fa-pen-to-square text-amber-500 mr-1"></i> Edit Catatan Kas</h3>
                    <button onclick="tutupModalEditKas()"
                        class="text-gray-400 hover:text-gray-600 text-sm cursor-pointer"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <form id="formEditKas" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Tanggal
                            Transaksi</label>
                        <input type="date" id="edit_tanggal" name="tanggal" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Jenis Arus
                            Kas</label>
                        <select id="edit_tipe" name="tipe" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                            <option value="masuk">(+) Pemasukan</option>
                            <option value="keluar">(-) Pengeluaran</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Kategori
                            Anggaran</label>
                        <select id="edit_kategori" name="kategori" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                            <option value="Pendaftaran">Uang Pendaftaran Anggota</option>
                            <option value="Iuran">Iuran Bulanan / Kas Rutin</option>
                            <option value="Logistik">Logistik Atribut / Sabuk / Sakral</option>
                            <option value="Operasional">Sewa GOR / Operasional Acara</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nominal
                            (Rupiah)</label>
                        <input type="number" id="edit_nominal" name="nominal" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 font-mono focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Keterangan /
                            Deskripsi</label>
                        <input type="text" id="edit_keterangan" name="keterangan" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                        <button type="button" onclick="tutupModalEditKas()"
                            class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 font-semibold cursor-pointer">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-slate-950 text-white font-bold rounded-lg cursor-pointer">Simpan
                            Perubahan</button>
                    </div>
                </form>
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

        // Modal Tambah
        function bukaModalKas() {
            document.getElementById('modalKas').classList.remove('hidden');
        }

        function tutupModalKas() {
            document.getElementById('modalKas').classList.add('hidden');
        }

        // Modal Edit (Injeksi Data Dinamis)
        function bukaModalEditKas(id, tanggal, tipe, kategori, nominal, keterangan) {
            // 1. Set action form mengarah ke ID transaksi yang dituju
            document.getElementById('formEditKas').action = "/internal/keuangan-logistik/" + id;

            // 2. Pasang nilai lama ke form input modal edit
            document.getElementById('edit_tanggal').value = tanggal;
            document.getElementById('edit_tipe').value = tipe;
            document.getElementById('edit_kategori').value = kategori;
            document.getElementById('edit_nominal').value = nominal;
            document.getElementById('edit_keterangan').value = keterangan;

            // 3. Tampilkan modal edit
            document.getElementById('modalEditKas').classList.remove('hidden');
        }

        function tutupModalEditKas() {
            document.getElementById('modalEditKas').classList.add('hidden');
        }

        // Fungsi filter kategori transaksi
        function toggleFilterMenu() {
            const menu = document.getElementById('filterMenu');
            menu.classList.toggle('hidden');
        }

        // Menutup menu jika klik di luar
        window.onclick = function(event) {
            if (!event.target.matches('.fa-filter')) {
                const menu = document.getElementById('filterMenu');
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            }
        }

        // Fungsi untuk toggle menu filter Ranting
        function toggleRantingFilter() {
            const rantingMenu = document.getElementById('filterRantingMenu');
            const kategoriMenu = document.getElementById('filterKategoriMenu'); // Pastikan ini ID menu kategori kamu

            rantingMenu.classList.toggle('hidden');
            kategoriMenu.classList.add('hidden'); // Tutup menu kategori jika sedang buka ranting
        }

        // Menutup menu jika klik di area mana saja di luar menu
        window.onclick = function(event) {
            if (!event.target.matches('.fa-filter')) {
                document.getElementById('filterRantingMenu').classList.add('hidden');
                document.getElementById('filterKategoriMenu').classList.add('hidden');
            }
        }

        // Fungsi Nominal
        const inputNominal = document.getElementById('inputNominal');

        inputNominal.addEventListener('input', function(e) {
            // Hapus karakter selain angka
            let value = e.target.value.replace(/[^0-9]/g, '');

            // Format dengan titik
            if (value !== "") {
                e.target.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                e.target.value = "";
            }
        });

        document.querySelector('form').addEventListener('submit', function() {
            let rawValue = inputNominal.value.replace(/\./g, '');
            inputNominal.value = rawValue;
        });
    </script>
</x-dashboard-layout>
