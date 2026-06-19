<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-sitemap')
    @slot('title', 'Struktur Organisasi Cabang')


    <div class="max-w-7xl mx-auto py-10 px-4">
        @if (auth()->check() && auth()->user()->role === 'admin_cabang')
            <div class="mb-8 text-center">
                <button onclick="openModal()"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-700">
                    <i class="fa-solid fa-plus mr-2"></i>Tambah Pengurus
                </button>
            </div>
        @endif

        <div class="flex justify-center flex-wrap gap-8">
            @foreach ($struktur as $item)
                @include('navigasi._pengurus-item', ['item' => $item])
            @endforeach
        </div>
    </div>

    <div id="pengurusModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <form id="pengurusForm" action="" method="POST" class="bg-white p-6 rounded-xl w-full max-w-sm">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <h3 id="modalTitle" class="text-sm font-bold mb-4">Tambah Pengurus</h3>

            <input type="text" id="nama" name="nama" placeholder="Nama Lengkap"
                class="w-full border p-2 mb-2 text-xs rounded" required>
            <input type="text" id="jabatan" name="jabatan" placeholder="Jabatan"
                class="w-full border p-2 mb-2 text-xs rounded" required>
            <input type="number" name="urutan" placeholder="Nomor Urut (ex: 1)"
                class="w-full border p-2 mb-2 text-xs rounded" required>

            <select name="parent_id" id="parent_id" class="w-full border p-2 mb-4 text-xs rounded">
                <option value="">-- Pilih Atasan (Parent) --</option>
                @foreach (\App\Models\Pengurus::all() as $p)
                    <option value="{{ $p->id }}">{{ $p->jabatan }} - {{ $p->nama }}</option>
                @endforeach
            </select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="text-xs px-3 py-1">Batal</button>
                <button type="submit" class="bg-red-600 text-white text-xs px-3 py-1 rounded">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function openModal(actionUrl = "{{ route('menu.struktur.store') }}", method = "POST", nama = "", jabatan = "",
            parentId = "") {
            document.getElementById('pengurusForm').action = actionUrl;
            document.getElementById('formMethod').value = method;
            document.getElementById('nama').value = nama;
            document.getElementById('jabatan').value = jabatan;
            document.getElementById('parent_id').value = parentId;
            document.getElementById('modalTitle').innerText = method === "PUT" ? "Edit Pengurus" : "Tambah Pengurus";
            document.getElementById('pengurusModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('pengurusModal').classList.add('hidden');
        }
    </script>
</x-dashboard-layout>
