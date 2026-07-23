<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-images')
    @slot('title', 'Ruang Media & Galeri')

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

        {{-- Header --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <!-- Kiri: Judul & Deskripsi -->
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Manajemen Media' : 'Galeri Kegiatan' }}
                        </h3>
                        <p class="text-[11px] text-gray-500 font-medium">
                            {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Kelola aset visual & dokumentasi.' : 'Koleksi dokumentasi resmi organisasi.' }}
                        </p>
                    </div>
                </div>

                <!-- Kanan: Statistik & Aksi -->
                <div class="flex items-center gap-4">
                    <!-- Badge Statistik -->
                    <div class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl flex items-center gap-3">
                        <div
                            class="h-7 w-7 rounded-lg bg-white text-slate-600 flex items-center justify-center border border-slate-100">
                            <i class="fa-solid fa-folder-open text-[10px]"></i>
                        </div>
                        <div>
                            <p class="text-[8px] text-gray-400 uppercase font-bold tracking-wider">Total Media</p>
                            <p class="text-xs font-black text-slate-900">{{ $totalMedia ?? 0 }} <span
                                    class="font-medium text-gray-400 text-[9px]">File</span></p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    @if (auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang')
                        <button onclick="openModal()"
                            class="h-[44px] inline-flex items-center gap-2 bg-red-600 text-white text-[10px] font-bold px-5 rounded-xl hover:bg-red-700 transition shadow-sm shadow-red-200">
                            <i class="fa-solid fa-cloud-arrow-up"></i> UPLOAD MEDIA
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div x-data="{ activeTab: 'semua' }" class="space-y-6">

            {{-- Filter Kategori / Tab Interaktif --}}
            <div
                class="flex flex-wrap items-center justify-center sm:justify-start gap-2 border-b border-gray-100 pb-4">
                <button @click="activeTab = 'semua'"
                    :class="activeTab === 'semua' ? 'bg-red-600 text-white shadow-md shadow-red-200' :
                        'bg-white border border-gray-200 text-slate-600 hover:bg-slate-50'"
                    class="text-xs font-bold px-5 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-border-all"></i> Semua Media
                </button>

                <button @click="activeTab = 'berita'"
                    :class="activeTab === 'berita' ? 'bg-red-600 text-white shadow-md shadow-red-200' :
                        'bg-white border border-gray-200 text-slate-600 hover:bg-slate-50'"
                    class="text-xs font-bold px-5 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-newspaper"></i> Berita / Artikel
                </button>

                <button @click="activeTab = 'gambar'"
                    :class="activeTab === 'gambar' ? 'bg-red-600 text-white shadow-md shadow-red-200' :
                        'bg-white border border-gray-200 text-slate-600 hover:bg-slate-50'"
                    class="text-xs font-bold px-5 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-2">
                    <i class="fa-regular fa-image"></i> Foto / Gambar
                </button>

                <button @click="activeTab = 'video'"
                    :class="activeTab === 'video' ? 'bg-red-600 text-white shadow-md shadow-red-200' :
                        'bg-white border border-gray-200 text-slate-600 hover:bg-slate-50'"
                    class="text-xs font-bold px-5 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-video"></i> Video Kegiatan
                </button>
            </div>

            {{-- Grid Galeri --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                @foreach ($posts as $post)
                    <div x-show="activeTab === 'semua' || activeTab === '{{ $post->tipe }}'" x-transition
                        class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-xs flex flex-col group relative">

                        <div
                            class="absolute top-2 right-2 z-10 flex gap-1 opacity-0 group-hover:opacity-100 transition duration-200">
                            {{-- Tombol Edit --}}
                            <button type="button"
                                onclick="openModal('{{ route('menu.media.update', $post->id) }}', 'PUT', '{{ addslashes($post->judul) }}', '{{ $post->tipe }}', '{{ addslashes($post->kategori) }}', '{{ addslashes($post->isi) }}')"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white w-7 h-7 flex items-center justify-center cursor-pointer rounded-lg text-xs shadow-md transition"
                                title="Edit Konten">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('menu.media.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus media ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white w-7 h-7 flex items-center justify-center cursor-pointer rounded-lg text-xs shadow-md transition"
                                    title="Hapus Konten">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Konten Media --}}
                        <div class="w-full h-40 bg-slate-100 flex items-center justify-center border-b border-gray-100">
                            @if ($post->file_path)
                                <img src="{{ asset('storage/' . $post->file_path) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('assets/img/default.png') }}" class="w-full h-full object-cover"
                                    alt="{{ $post->file_path }}">
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-xs font-bold text-slate-900 truncate">{{ $post->judul }}</p>
                            <div class="flex items-center justify-between mt-2 text-[10px] text-gray-400">
                                <span><i class="fa-regular fa-calendar mr-1"></i>
                                    {{ $post->created_at->format('M Y') }}</span>
                                <span class="text-red-600 font-medium capitalize"><i class="fa-solid fa-tags mr-1"></i>
                                    {{ $post->kategori }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Modal Form (Digunakan untuk Tambah & Edit) --}}
    <div id="mediaModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <form id="mediaForm" action="{{ route('menu.media.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl w-full max-w-sm">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <h3 id="modalTitle"
                class="font-bold text-slate-950 text-sm uppercase tracking-wide flex items-center gap-1.5 border-b border-gray-100 pb-3 mb-5">
                <i id="modalIcon" class="fa-solid fa-cloud-arrow-up text-red-600"></i>
                <span id="modalText">Upload Media</span>
            </h3>

            <label class="text-xs font-bold text-slate-700 block mb-1">Jenis Konten</label>
            <select name="tipe" id="tipe" class="w-full border p-2 mb-3 text-xs rounded" required>
                <option value="berita">Berita / Artikel</option>
                <option value="gambar">Foto / Galeri</option>
                <option value="video">Video Kegiatan</option>
            </select>

            <label class="text-xs font-bold text-slate-700 block mb-1">File Media</label>
            <input type="file" name="file_path" id="file_path" class="w-full border p-2 mb-3 text-xs rounded"
                accept="image/*,video/mp4,video/mkv,video/webm">

            <label class="text-xs font-bold text-slate-700 block mb-1">Judul Media</label>
            <input type="text" id="judul" name="judul" placeholder="Judul Kegiatan / Berita"
                class="w-full border p-2 mb-2 text-xs rounded" required>

            <label class="text-xs font-bold text-slate-700 block mb-1">Kategori</label>
            <select name="kategori" id="kategori" class="w-full border p-2 mb-2 text-xs rounded" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="Rapat">Rapat</option>
                <option value="Kegiatan">Kegiatan</option>
                <option value="Pengumuman">Pengumuman</option>
                <option value="Prestasi">Prestasi</option>
            </select>

            <label class="text-xs font-bold text-slate-700 block mb-1">Isi Konten <span
                    class="text-[9px] text-gray-400 font-normal normal-case">(Opsional)</span></label>
            <textarea id="isi" name="isi" placeholder="Deskripsi Singkat / Isi Konten"
                class="w-full border p-2 mb-4 text-xs rounded"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="text-xs bg-slate-200 rounded px-3 py-1 cursor-pointer">Batal</button>
                <button type="submit"
                    class="bg-red-600 text-white cursor-pointer text-xs px-3 py-2
                    rounded">Simpan</button>
            </div>
        </form>
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

        // Membuka modal
        function openModal(action = "{{ route('menu.media.store') }}", method = "POST", judul = "", tipe = "berita",
            kategori = "", isi = "") {
            document.getElementById('mediaForm').action = action;
            document.getElementById('formMethod').value = method;
            document.getElementById('judul').value = judul;
            document.getElementById('tipe').value = tipe;
            document.getElementById('kategori').value = kategori;
            document.getElementById('isi').value = isi;

            // Ubah teks dan icon berdasarkan mode (Tambah / Edit)
            const isEdit = method === "PUT";
            document.getElementById('modalText').innerText = isEdit ? "Edit Konten" : "Upload Media";

            // Ganti icon jika diperlukan (opsional, misal edit pakai icon pen)
            const iconElement = document.getElementById('modalIcon');
            iconElement.className = isEdit ? "fa-solid fa-pen-to-square text-red-600" :
                "fa-solid fa-cloud-arrow-up text-red-600";

            document.getElementById('mediaModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('mediaModal').classList.add('hidden');
        }
    </script>
</x-dashboard-layout>
