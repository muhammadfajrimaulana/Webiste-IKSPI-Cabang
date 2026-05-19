<x-dashboard-layout>
    @slot('title', 'Keuangan & Logistik Cabang')
    @slot('icon', 'fa-solid fa-wallet')

    <div class="max-w-6xl mx-auto space-y-6">

        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="border-b border-gray-200 pb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pusat Transparansi Kas & Logistik
                </h2>
                <p class="text-xs text-gray-500 mt-1">Sistem pencatatan arus kas masuk pendaftaran, operasional
                    pengesahan, dan inventarisasi logistik.</p>
            </div>

            <button onclick="bukaModalKas()"
                class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition shadow-xs flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-file-invoice-dollar"></i> Catat Transaksi Baru
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Kas Bersih / Saldo</p>
                <h4 class="text-2xl font-black text-slate-950 mt-1">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                </h4>
                <div class="text-[10px] {{ $saldoAkhir >= 0 ? 'text-green-600' : 'text-red-600' }} font-medium mt-1">
                    <i class="fa-solid fa-shield-halved"></i>
                    {{ $saldoAkhir >= 0 ? 'Dana Cabang Aman' : 'Kas Defisit / Minus' }}
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pemasukan</p>
                <h4 class="text-2xl font-black text-green-600 mt-1">Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                </h4>
                <div class="text-[10px] text-gray-400 mt-1">Akumulasi iuran & pendaftaran</div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pengeluaran</p>
                <h4 class="text-2xl font-black text-red-600 mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h4>
                <div class="text-[10px] text-gray-400 mt-1">Alokasi logistik & operasional</div>
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
                        <th class="p-4">Keterangan Transaksi</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4 text-right">Nominal</th>
                        <th class="p-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs">
                    @forelse($transaksi as $item)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 text-gray-500 font-medium">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                            </td>
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
                            <td colspan="5" class="p-12 text-center text-gray-400 italic">
                                <i class="fa-solid fa-receipt text-2xl block mb-2 text-gray-300"></i>
                                Belum ada riwayat transaksi keuangan kas masuk/keluar.
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
                            <option value="masuk">Kas MASUK (+) Pemasukan</option>
                            <option value="keluar">Kas KELUAR (-) Pengeluaran</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Kategori
                            Anggaran</label>
                        <select name="kategori" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none focus:border-red-500">
                            <option value="Pendaftaran">Uang Pendaftaran Anggota</option>
                            <option value="Iuran">Iuran Bulanan / Kas Rutin</option>
                            <option value="Logistik">Logistik Atribut / Sabuk / Sakral</option>
                            <option value="Operasional">Sewa GOR / Operasional Acara</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nominal
                            (Rupiah)</label>
                        <input type="number" name="nominal" required placeholder="Contoh: 500000"
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
                            <option value="masuk">Kas MASUK (+) Pemasukan</option>
                            <option value="keluar">Kas KELUAR (-) Pengeluaran</option>
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
    </script>
</x-dashboard-layout>
