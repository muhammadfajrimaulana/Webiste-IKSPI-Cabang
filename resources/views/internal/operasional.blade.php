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

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Ranting Terdaftar</p>
                    <h4 class="text-xl font-extrabold text-slate-950 mt-1">{{ $totalRanting }} <span
                            class="text-xs font-normal text-gray-400">Tempat Latihan</span></h4>
                </div>
                <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pelatih Kepala Aktif</p>
                    <h4 class="text-xl font-extrabold text-slate-950 mt-1">{{ $totalPelatihAktif }} <span
                            class="text-xs font-normal text-gray-400">Personel Pelatih</span></h4>
                </div>
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            @forelse($dataRanting as $ranting)
                <div
                    class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex items-start justify-between">
                        <div>
                            <span
                                class="inline-block text-[10px] uppercase font-bold tracking-widest text-red-500 mb-1">Ranting
                                Resmi</span>
                            <h3 class="text-lg font-extrabold text-slate-900 uppercase tracking-tight">
                                {{ $ranting->nama_ranting }}</h3>
                        </div>
                        <div class="flex flex-col items-end">
                            <span
                                class="inline-flex items-center px-2 py-1 bg-slate-200 text-slate-700 text-[10px] font-bold rounded-md border border-slate-300">
                                <i class="fa-solid fa-users mr-1.5 text-slate-400"></i> {{ $ranting->anggota_count }}
                                Warga
                            </span>
                        </div>
                    </div>

                    <div class="p-6 space-y-4 bg-slate-50/50 flex-grow">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 shadow-sm">
                                <i class="fa-solid fa-user-tie text-xs"></i>
                            </div>
                            <div class="text-xs">
                                <p class="text-slate-400 font-medium">Pelatih Kepala</p>
                                <p class="text-slate-800 font-bold">{{ $ranting->nama_pelatih ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 shadow-sm">
                                <i class="fa-solid fa-location-dot text-xs"></i>
                            </div>
                            <div class="text-xs">
                                <p class="text-slate-400 font-medium">Lokasi Latihan</p>
                                <p class="text-slate-800 font-bold leading-tight">{{ $ranting->lokasi_latihan }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-emerald-500 shadow-sm">
                                <i class="fa-brands fa-whatsapp text-xs"></i>
                            </div>
                            <div class="text-xs">
                                <p class="text-slate-400 font-medium">Kontak WhatsApp</p>
                                <p class="text-emerald-700 font-bold font-mono">{{ $ranting->kontak_ranting ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-white flex items-center gap-2">
                        <button
                            onclick="bukaModalEdit({{ $ranting->id }}, '{{ $ranting->nama_ranting }}', '{{ $ranting->nama_pelatih }}', '{{ $ranting->lokasi_latihan }}', '{{ $ranting->kontak_ranting }}')"
                            class="flex-1 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[11px] uppercase tracking-wider rounded-xl transition cursor-pointer">
                            Edit
                        </button>
                        <a href="{{ route('internal.keanggotaan', ['ranting_id' => $ranting->id]) }}"
                            class="flex-[2] px-4 py-2 bg-slate-900 hover:bg-black text-white font-bold text-[11px] uppercase tracking-wider rounded-xl transition text-center shadow-lg shadow-slate-200">
                            Data Warga
                        </a>
                    </div>
                </div>
            @empty
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
