<x-dashboard-layout>
    @slot('title', 'Operasional Data Ranting')
    @slot('icon', 'fa-solid fa-building-shield')

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
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pusat Kendali Operasional Tempat
                    Latihan di {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}</h2>
                <p class="text-xs text-gray-500 mt-1">Monitoring lokasi latihan resmi, penanggung jawab ranting, dan
                    distribusi jumlah warga aktif di {{ auth()->user()->ranting?->nama_ranting ?? 'Setiap Ranting' }}.
                </p>
            </div>

            @if (auth()->user()->role === 'admin_cabang')
                <button onclick="bukaModal()"
                    class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition shadow-xs flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Tambah Ranting
                </button>
            @endif
        </div>

        <!-- STAT CARDS: Diberi sedikit gradient dan shadow lebih lembut -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <div
                class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm shadow-slate-200/50 flex items-center justify-between hover:border-red-200 transition-colors">
                <div>
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Total Ranting</p>
                    <h4 class="text-3xl font-black text-slate-900 mt-1">{{ $totalRanting }} <span
                            class="text-sm font-medium text-slate-400">Ranting</span></h4>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm shadow-slate-200/50 flex items-center justify-between hover:border-slate-300 transition-colors">
                <div>
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Pelatih Aktif</p>
                    <h4 class="text-3xl font-black text-slate-900 mt-1">{{ $totalPelatihAktif }} <span
                            class="text-sm font-medium text-slate-400">Personel</span></h4>
                </div>
                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </div>

        <!-- LIST GRID: Menggunakan spacing yang lebih lega dan visual hierarchy yang jelas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($dataRanting as $ranting)
                <div
                    class="group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 flex flex-col overflow-hidden">
                    <!-- Header dengan sedikit aksen warna -->
                    <div class="p-7 border-b border-slate-100 flex items-start justify-between bg-slate-50/50">
                        <div>
                            <span
                                class="inline-block text-[9px] uppercase font-black tracking-[0.2em] text-red-500 mb-1 bg-red-50 px-2 py-0.5 rounded">Ranting
                                Resmi</span>
                            <h3 class="text-xl font-black text-slate-950 uppercase tracking-tight">
                                {{ $ranting->nama_ranting }}</h3>
                        </div>
                        <div
                            class="px-3 py-1 bg-slate-900 text-white text-[10px] font-bold rounded-lg tracking-wider flex items-center shadow-lg shadow-slate-300">
                            <i class="fa-solid fa-users mr-2 opacity-70"></i> {{ $ranting->anggota_count }} Warga
                        </div>
                    </div>

                    <!-- Body detail dengan icon minimalis -->
                    <div class="p-7 space-y-5 flex-grow">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                <i class="fa-solid fa-user-tie text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Ketua Ranting
                                </p>
                                <p class="text-sm text-slate-900 font-semibold">{{ $ranting->ketua_ranting ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                <i class="fa-solid fa-dumbbell"></i>
                            </div>
                            <div>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Pelatih
                                </p>
                                <p class="text-sm text-slate-900 font-semibold">{{ $ranting->nama_pelatih ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                <i class="fa-solid fa-location-dot text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Lokasi Latihan
                                </p>
                                <p class="text-sm text-slate-900 font-semibold leading-snug">
                                    {{ $ranting->lokasi_latihan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action footer -->
                    <div class="px-7 py-6 flex items-center gap-3">
                        <button type="button"
                            onclick="bukaModalEdit(
            '{{ $ranting->id }}', 
            '{{ addslashes($ranting->nama_ranting) }}', 
            '{{ addslashes($ranting->ketua_ranting) }}', 
            '{{ addslashes($ranting->nama_pelatih) }}', 
            '{{ addslashes($ranting->lokasi_latihan) }}', 
            '{{ addslashes($ranting->kontak_ranting) }}'
        )"
                            class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-black text-[10px] uppercase tracking-widest rounded-xl transition cursor-pointer">
                            Edit
                        </button>

                        <a href="{{ route('internal.keanggotaan', ['ranting_id' => $ranting->id]) }}"
                            class="flex-1 px-5 py-3 bg-red-600 hover:bg-red-700 text-white font-black text-[10px] uppercase tracking-widest rounded-xl transition text-center shadow-lg shadow-red-200">
                            Lihat Data Warga
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-slate-400">
                    <i class="fa-solid fa-folder-open text-4xl mb-4 opacity-50"></i>
                    <p class="font-bold">Belum ada data ranting yang terdaftar.</p>
                </div>
            @endforelse
        </div>

        <div id="modalRanting"
            class="hidden fixed inset-0 bg-slate-950/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl border border-gray-100 space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-slate-950 text-sm uppercase tracking-wide"><i
                            class="fa-solid fa-map-pin text-red-600 mr-1"></i> Form Ranting Baru</h3>
                    <button onclick="tutupModal()" class="text-gray-400 hover:text-gray-600 text-sm cursor-pointer"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <form action="{{ route('internal.operasional.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nama Ranting
                            (Kecamatan)</label>
                        <input type="text" name="nama_ranting" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Ketua
                            Ranting</label>
                        <input type="text" name="ketua_ranting"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Ranting</label>
                        <textarea name="alamat_ranting" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-slate-950"
                            placeholder="Masukkan alamat lengkap ranting"></textarea>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nama Pelatih
                        </label>
                        <input type="text" name="nama_pelatih"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Lokasi
                            Latihan</label>
                        <textarea name="lokasi_latihan" required rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none"></textarea>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nomor HP /
                            WhatsApp</label>
                        <input type="text" name="kontak_ranting"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                        <button type="button" onclick="tutupModal()"
                            class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 font-semibold cursor-pointer">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-slate-950 text-white font-bold rounded-lg cursor-pointer">Simpan
                            Ranting</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modalEditRanting"
            class="hidden fixed inset-0 bg-slate-950/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl border border-gray-100 space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-slate-950 text-sm uppercase tracking-wide"><i
                            class="fa-solid fa-pen-to-square text-amber-500 mr-1"></i> Edit Data Ranting</h3>
                    <button onclick="tutupModalEdit()"
                        class="text-gray-400 hover:text-gray-600 text-sm cursor-pointer"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <form id="formEditRanting" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nama Ranting
                            (Kecamatan)</label>
                        <input type="text" id="edit_nama" name="nama_ranting" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nama Pelatih
                            Kepala</label>
                        <input type="text" id="edit_pelatih" name="nama_pelatih"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Alamat Lengkap /
                            GOR Latihan</label>
                        <textarea id="edit_lokasi" name="lokasi_latihan" required rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none"></textarea>
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nomor HP /
                            WhatsApp</label>
                        <input type="text" id="edit_kontak" name="kontak_ranting"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <!-- Tombol Hapus di sebelah kiri -->
                        <form action="{{ route('internal.operasional.destroy', $ranting->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus ranting ini? Akun admin ranting terkait juga akan terhapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg cursor-pointer transition">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                            </button>
                        </form>

                        <!-- Tombol Batal & Simpan di sebelah kanan -->
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="tutupModalEdit()"
                                class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 font-semibold cursor-pointer">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-slate-950 text-white font-bold rounded-lg cursor-pointer">Simpan
                                Perubahan</button>
                        </div>
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
        function bukaModal() {
            document.getElementById('modalRanting').classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modalRanting').classList.add('hidden');
        }

        // Modal Edit (Injeksi Data Langsung)
        function bukaModalEdit(id, nama, pelatih, lokasi, kontak) {
            // 1. Set action form secara dinamis mengarah ke id ranting yang dipilih
            document.getElementById('formEditRanting').action = "/internal/operasional/" + id;

            // 2. Isi value input modal dengan data lama dari parameter tombol
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_pelatih').value = pelatih;
            document.getElementById('edit_lokasi').value = lokasi;
            document.getElementById('edit_kontak').value = kontak;

            // 3. Munculkan modal edit
            document.getElementById('modalEditRanting').classList.remove('hidden');
        }

        function tutupModalEdit() {
            document.getElementById('modalEditRanting').classList.add('hidden');
        }
    </script>
</x-dashboard-layout>
