<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-sitemap')
    @slot('title', 'Struktur Organisasi')

    <div class="space-y-6 max-w-6xl mx-auto">
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

        {{-- Header Konsisten --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <!-- Kiri: Judul & Deskripsi -->
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Manajemen Struktur Organisasi' : 'Informasi Latihan' }}
                        </h3>
                        <p class="text-[11px] text-gray-500 font-medium">
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Kelola hierarki struktur organisasi IKSPI Jakarta Pusat di sini.' : 'Detail lokasi latihan resmi untuk seluruh anggota' }}
                        </p>
                    </div>
                </div>

                <!-- Kanan: Statistik & Tombol Aksi -->
                <div class="flex items-center gap-4">
                    <!-- Badge Statistik -->
                    <div class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl flex items-center gap-3">
                        <div
                            class="h-7 w-7 rounded-lg bg-white text-slate-600 flex items-center justify-center border border-slate-100">
                            <i class="fa-solid fa-users text-[10px]"></i>
                        </div>
                        <div>
                            <p class="text-[8px] text-gray-400 uppercase font-bold tracking-wider">Total Pengurus</p>
                            <p class="text-xs font-black text-slate-900">{{ $totalPengurus ?? 0 }} <span
                                    class="font-medium text-gray-400 text-[9px]">Data</span></p>
                        </div>
                    </div>

                    <!-- Tombol Tambah (Hanya untuk Admin Cabang) -->
                    @if (auth()->check() && auth()->user()->role === 'admin_cabang')
                        <button onclick="openModal()"
                            class="h-[44px] inline-flex items-center gap-2 bg-red-600 text-white text-[10px] font-bold px-5 rounded-xl hover:bg-red-700 transition shadow-sm shadow-red-200 cursor-pointer">
                            <i class="fa-solid fa-plus"></i> TAMBAH PENGURUS
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- Konten Struktur Organisasi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
            @foreach ($struktur as $item)
                <div
                    class="bg-white border border-gray-100 rounded-2xl p-5 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative group overflow-hidden bg-gradient-to-b from-white to-slate-50/30">

                    {{-- Aksen Garis Top Gradient saat Hover --}}
                    <div
                        class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-red-600 via-rose-500 to-red-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div>
                        {{-- Header Card: Badge Urutan & Tombol Aksi --}}
                        <div class="flex items-center justify-between mb-4">
                            <span
                                class="inline-flex items-center gap-1.5 text-[10px] bg-red-50 text-red-600 font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-red-100/60 shadow-2xs">
                                <i class="fa-solid fa-ranking-star text-[9px]"></i> Urutan {{ $item->urutan }}
                            </span>

                            {{-- Tombol Aksi (Muncul Interaktif saat Card di-hover) --}}
                            @if (auth()->check() && (auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang'))
                                <div
                                    class="flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-all duration-200 translate-y-1 group-hover:translate-y-0">
                                    {{-- Tombol Edit --}}
                                    <button type="button"
                                        onclick="openModal('{{ route('menu.struktur.update', $item->id) }}', 'PUT', '{{ addslashes($item->nama) }}', '{{ addslashes($item->jabatan) }}', '{{ $item->urutan }}', '{{ $item->parent_id }}')"
                                        class="bg-amber-500 hover:bg-amber-600 text-white w-8 h-8 flex items-center justify-center rounded-xl text-xs shadow-sm transition-transform hover:scale-105 cursor-pointer"
                                        title="Edit Pengurus">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('menu.struktur.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white w-8 h-8 flex items-center justify-center rounded-xl text-xs shadow-sm transition-transform hover:scale-105 cursor-pointer"
                                            title="Hapus Pengurus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        {{-- Informasi Utama: Avatar & Profil --}}
                        <div class="flex items-start gap-4 mt-2">
                            {{-- Avatar Modern dengan Efek Dual-Layer Shadow --}}
                            <div class="relative shrink-0">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-red-600 to-rose-500 text-white font-black text-xs flex items-center justify-center shadow-md shadow-red-500/20 tracking-wider">
                                    {{ strtoupper(substr($item->nama, 0, 2)) }}
                                </div>
                                <span
                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full"
                                    title="Aktif"></span>
                            </div>

                            <div class="overflow-hidden">
                                <h4 class="font-black text-slate-900 text-xs tracking-tight truncate uppercase"
                                    title="{{ $item->nama }}">
                                    {{ $item->nama }}
                                </h4>
                                <div class="flex items-center gap-1.5 mt-1 text-red-600 font-bold text-[11px]">
                                    <i class="fa-solid fa-id-badge text-[10px]"></i>
                                    <span class="truncate" title="{{ $item->jabatan }}">{{ $item->jabatan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Card: Informasi Metadata Hierarki --}}
                    <div
                        class="mt-6 pt-3.5 border-t border-slate-100 flex items-center justify-between text-[10px] text-gray-400 font-medium">
                        <span class="flex items-center gap-1 bg-slate-100/80 px-2.5 py-1 rounded-lg text-slate-600">
                            <i class="fa-solid fa-sitemap text-[9px]"></i> ID: {{ $item->id }}
                        </span>

                        <span
                            class="flex items-center gap-1 {{ $item->parent_id ? 'text-slate-500 bg-slate-50' : 'text-red-700 bg-red-50 font-bold' }} px-2.5 py-1 rounded-lg border border-slate-100/80">
                            <i
                                class="fa-solid {{ $item->parent_id ? 'fa-user-tag' : 'fa-crown text-red-500' }} text-[9px]"></i>
                            {{ $item->parent_id ? 'Anggota / Staf' : 'Pimpinan Utama' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Form Tambah / Edit Pengurus --}}
    <div id="pengurusModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <form id="pengurusForm" action="" method="POST" class="bg-white p-6 rounded-xl w-full max-w-sm">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <h3 id="modalTitle"
                class="font-bold text-slate-950 text-sm uppercase tracking-wide flex items-center gap-1.5 border-b border-gray-100 pb-3 mb-5">
                <i class="fa-solid fa-pen-to-square text-red-600" id="modalIcon"></i>
                <span id="modalText">Tambah Pengurus</span>
            </h3>

            <label class="text-xs font-bold text-slate-700 block mb-1">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Nama Lengkap Beserta Gelar"
                class="w-full border p-2 mb-2 text-xs rounded" required>

            <label class="text-xs font-bold text-slate-700 block mb-1">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" placeholder="Contoh: Ketua Cabang"
                class="w-full border p-2 mb-2 text-xs rounded" required>

            <label class="text-xs font-bold text-slate-700 block mb-1">Nomor Urut</label>
            <input type="number" id="urutan" name="urutan" placeholder="Nomor Urut (ex: 1)"
                class="w-full border p-2 mb-2 text-xs rounded" required>

            <label class="text-xs font-bold text-slate-700 block mb-1">Atasan (Parent)</label>
            <select name="parent_id" id="parent_id" class="w-full border p-2 mb-4 text-xs rounded">
                <option value="">-- Pilih Atasan (Opsional) --</option>
                @foreach (\App\Models\Pengurus::all() as $p)
                    <option value="{{ $p->id }}">{{ $p->jabatan }} - {{ $p->nama }}</option>
                @endforeach
            </select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="text-xs bg-slate-200 rounded px-3 py-1 cursor-pointer">Batal</button>
                <button type="submit"
                    class="bg-red-600 text-white cursor-pointer text-xs px-3 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        // Menutup alert otomatis
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

        // Membuka modal (Tambah / Edit)
        function openModal(actionUrl = "{{ route('menu.struktur.store') }}", method = "POST", nama = "", jabatan = "",
            urutan = "", parentId = "") {
            document.getElementById('pengurusForm').action = actionUrl;
            document.getElementById('formMethod').value = method;
            document.getElementById('nama').value = nama;
            document.getElementById('jabatan').value = jabatan;
            document.getElementById('urutan').value = urutan;
            document.getElementById('parent_id').value = parentId;

            const isEdit = method === "PUT";
            document.getElementById('modalText').innerText = isEdit ? "Edit Pengurus" : "Tambah Pengurus";

            const iconElement = document.getElementById('modalIcon');
            iconElement.className = isEdit ? "fa-solid fa-pen-to-square text-amber-600" :
                "fa-solid fa-cloud-arrow-up text-red-600";

            document.getElementById('pengurusModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('pengurusModal').classList.add('hidden');
        }
    </script>
</x-dashboard-layout>
