<x-dashboard-layout>
    @slot('title', 'Operasional Data Ranting')
    @slot('icon', 'fa-solid fa-building-shield')

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
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pusat Kendali Operasional Tempat
                    Latihan</h2>
                <p class="text-xs text-gray-500 mt-1">Monitoring lokasi latihan resmi, penanggung jawab ranting, dan
                    distribusi jumlah warga aktif.</p>
            </div>

            <button onclick="bukaModal()"
                class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition shadow-xs flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-plus"></i> Tambah Ranting
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Ranting Terdaftar</p>
                    <h4 class="text-xl font-extrabold text-slate-950 mt-1">{{ $totalRanting }} <span
                            class="text-xs font-normal text-gray-400">Titik GOR</span></h4>
                </div>
                <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pelatih Kepala Aktif</p>
                    <h4 class="text-xl font-extrabold text-slate-950 mt-1">{{ $totalPelatihAktif }} <span
                            class="text-xs font-normal text-gray-400">Personel</span></h4>
                </div>
                <div class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center text-xs">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($dataRanting as $ranting)
                <div
                    class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden flex flex-col justify-between">
                    <div class="p-5 space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="space-y-0.5">
                                <span class="text-[10px] uppercase font-extrabold tracking-wider text-red-600">Ranting
                                    Resmi Cabang</span>
                                <h3 class="text-base font-bold text-slate-950 uppercase">Ranting
                                    {{ $ranting->nama_ranting }}</h3>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-50 text-slate-800 border border-slate-200">
                                <i class="fa-solid fa-users mr-1.5 text-slate-400"></i> {{ $ranting->anggota_count }}
                                Warga
                            </span>
                        </div>

                        <div class="space-y-2 text-xs text-slate-600">
                            <div class="flex items-center gap-2.5">
                                <div class="w-5 text-gray-400 text-center"><i class="fa-solid fa-user-tie"></i></div>
                                <div><span class="text-gray-400">Pelatih Kepala:</span> <strong
                                        class="text-slate-900">{{ $ranting->nama_pelatih ?? 'Belum Ditentukan' }}</strong>
                                </div>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <div class="w-5 text-gray-400 text-center mt-0.5"><i
                                        class="fa-solid fa-location-dot"></i></div>
                                <div><span class="text-gray-400">Lokasi Latihan:</span> <span
                                        class="text-slate-800 font-medium">{{ $ranting->lokasi_latihan }}</span></div>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <div class="w-5 text-gray-400 text-center"><i class="fa-solid fa-phone"></i></div>
                                <div><span class="text-gray-400">Kontak/WA:</span> <span
                                        class="text-slate-800 font-mono">{{ $ranting->kontak_ranting ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 border-t border-gray-100 px-5 py-3 flex items-center justify-end gap-2">
                        <button
                            onclick="bukaModalEdit({{ $ranting->id }}, '{{ $ranting->nama_ranting }}', '{{ $ranting->nama_pelatih }}', '{{ $ranting->lokasi_latihan }}', '{{ $ranting->kontak_ranting }}')"
                            class="px-3 py-1.5 border border-gray-200 text-gray-600 font-semibold text-[11px] rounded-md hover:bg-white transition cursor-pointer">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Data
                        </button>
                        <a href="{{ route('internal.keanggotaan', ['ranting_id' => $ranting->id]) }}"
                            class="px-3 py-1.5 bg-slate-950 text-white font-bold text-[11px] rounded-md hover:bg-slate-800 transition text-center">
                            Lihat Anggota Ranting
                        </a>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-2 bg-white p-12 text-center text-gray-400 italic border border-gray-200 rounded-xl">
                    <i class="fa-solid fa-map-pin text-2xl block mb-2 text-gray-300"></i> Belum ada data ranting resmi.
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
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Nama Pelatih
                            Kepala</label>
                        <input type="text" name="nama_pelatih"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-slate-900 focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Alamat Lengkap /
                            GOR Latihan</label>
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
                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                        <button type="button" onclick="tutupModalEdit()"
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
