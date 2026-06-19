<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-images')
    @slot('title', 'Ruang Media & Galeri')

    <div class="space-y-6 max-w-5xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 pb-3">
            <div class="flex items-center space-x-2.5">
                <div class="text-red-600 text-sm"><i class="fa-regular fa-images"></i></div>
                <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Dokumentasi & Galeri Kegiatan</h3>
            </div>
            <button onclick="openModal()"
                class="inline-flex items-center space-x-1.5 bg-slate-900 text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-slate-800 transition">
                <i class="fa-solid fa-cloud-arrow-up"></i> <span>Unggah Media</span>
            </button>
        </div>

        {{-- Grid Galeri --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            @foreach ($posts as $post)
                <div
                    class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-xs flex flex-col group relative">

                    {{-- Tombol Aksi (Edit & Hapus) --}}
                    <div class="absolute top-2 right-2 z-10 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                        <button type="button"
                            onclick="openModal('{{ route('menu.media.update', $post->id) }}', 'PUT', '{{ addslashes($post->judul) }}', '{{ addslashes($post->kategori) }}', '{{ addslashes($post->isi) }}')"
                            class="bg-blue-600 text-white p-1.5 rounded-lg text-[10px]">
                            <i class="fa-solid fa-edit"></i>
                        </button>

                        <form action="{{ route('menu.media.destroy', $post->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus media ini?')"
                                class="bg-red-600 text-white p-1.5 rounded-lg text-[10px]">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Konten Media --}}
                    <div class="w-full h-40 bg-slate-100 flex items-center justify-center border-b border-gray-100">
                        @if ($post->thumbnail)
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-regular fa-image text-gray-400 text-xl"></i>
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

    {{-- Modal Form (Digunakan untuk Tambah & Edit) --}}
    <div id="mediaModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <form id="mediaForm" action="{{ route('menu.media.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl w-full max-w-sm">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <h3 id="modalTitle" class="text-sm font-bold mb-4">Unggah Foto Kegiatan</h3>

            <input type="text" id="judul" name="judul" placeholder="Judul Kegiatan"
                class="w-full border p-2 mb-2 text-xs rounded" required>
            <input type="text" id="kategori" name="kategori" placeholder="Kategori"
                class="w-full border p-2 mb-2 text-xs rounded" required>
            <input type="file" name="thumbnail" id="thumbnail" class="w-full border p-2 mb-4 text-xs rounded"
                accept="image/*">
            <textarea id="isi" name="isi" placeholder="Deskripsi Singkat" class="w-full border p-2 mb-4 text-xs rounded"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="text-xs px-3 py-1">Batal</button>
                <button type="submit" class="bg-red-600 text-white text-xs px-3 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function openModal(action = "{{ route('menu.media.store') }}", method = "POST", judul = "", kategori = "", isi =
            "") {
            document.getElementById('mediaForm').action = action;
            document.getElementById('formMethod').value = method;
            document.getElementById('judul').value = judul;
            document.getElementById('kategori').value = kategori;
            document.getElementById('isi').value = isi;
            document.getElementById('modalTitle').innerText = method === "PUT" ? "Edit Media" : "Unggah Foto Kegiatan";
            document.getElementById('mediaModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('mediaModal').classList.add('hidden');
        }
    </script>
</x-dashboard-layout>
