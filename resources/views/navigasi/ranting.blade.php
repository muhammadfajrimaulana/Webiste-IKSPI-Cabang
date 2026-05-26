<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-map-location-dot')
    @slot('title', 'Data Ranting & Tempat Latihan')

    <div class="space-y-6 max-w-5xl mx-auto">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <div class="text-red-600 text-sm"><i class="fa-solid fa-map-location-dot"></i></div>
                @if (auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang')
                    <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Manajemen Wilayah & Titik
                        Latihan
                    </h3>
                @else
                    <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Informasi ranting dan lokasi
                        latihan resmi untuk anggota</h3>
                @endif
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                @if (auth()->user()->role === 'admin_ranting')
                    {{-- Tampilan Card khusus untuk Admin Ranting --}}
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                        <h2 class="text-lg font-bold">{{ $dataRanting->first()->nama_ranting }}</h2>
                        <p>Ketua Ranting: {{ $dataRanting->first()->ketua_ranting }}</p>
                        <p>Kontak Ranting: {{ $dataRanting->first()->kontak_ranting }}</p>
                        <p>Nama Pelatih: {{ $dataRanting->first()->nama_pelatih }}</p>
                        <p>Tempat Latihan: {{ $dataRanting->first()->lokasi_latihan }}</p>
                    </div>
                @elseif (auth()->user()->role === 'anggota')
                    {{-- Tampilan Grid Card untuk Anggota (Lebih Informatif & Rapi) --}}
                    <div class="bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden p-6">
                        @forelse($dataRanting as $ranting)
                            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <h2 class="text-xl font-bold text-slate-950">{{ $ranting->nama_ranting }}</h2>
                                        <p class="text-xs text-gray-500">Tempat latihan resmi ranting Anda</p>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="text-[11px]">
                                            <span class="block text-gray-400 font-bold uppercase">Nama Pelatih</span>
                                            <span
                                                class="text-slate-700 font-semibold">{{ $ranting->nama_pelatih ?? '-' }}</span>
                                        </div>
                                        <div class="text-[11px]">
                                            <span class="block text-gray-400 font-bold uppercase">Kontak Ranting</span>
                                            <a href="https://wa.me/{{ $ranting->kontak_ranting }}" target="_blank"
                                                class="text-blue-600 font-semibold hover:underline">
                                                {{ $ranting->kontak_ranting ?? 'N/A' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <button onclick="bukaPeta({{ $ranting->latitude }}, {{ $ranting->longitude }})"
                                    class="px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition cursor-pointer">
                                    <i class="fa-solid fa-map-marker-alt mr-2"></i> Lihat Lokasi Latihan
                                </button>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-xs text-gray-400">Data ranting belum terhubung dengan akun Anda.</p>
                            </div>
                        @endforelse
                    </div>
                @else
                    <table class="w-full text-xs text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase font-bold border-b border-gray-200">
                            <tr class="text-[10px] text-black font-bold">
                                <th class="px-6 py-4">Ranting</th>
                                <th class="px-6 py-4">Ketua Ranting</th>
                                <th class="px-6 py-4">Alamat Ranting</th>
                                <th class="px-6 py-4">Kontak Ranting</th>
                                <th class="px-6 py-4">Nama Pelatih</th>
                                <th class="px-6 py-4">Tempat Latihan</th>
                                @if (auth()->user()->role !== 'anggota')
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($dataRanting as $ranting)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-semibold">{{ $ranting->nama_ranting }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $ranting->ketua_ranting ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $ranting->alamat_ranting ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">
                                        <a href="https://wa.me/{{ $ranting->kontak_ranting }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            {{ $ranting->kontak_ranting ?? 'N/A' }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $ranting->nama_pelatih ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-gray-500 max-w-[200px] truncate">
                                        {{ $ranting->lokasi_latihan ?? 'N/A' }}
                                    </td>
                                    @if (auth()->user()->role !== 'anggota')
                                        <td class="px-6 py-4 text-center">
                                            <button type="button" onclick="bukaModalEdit({{ json_encode($ranting) }})"
                                                class="ml-2 px-3 py-1.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">
                                                Edit
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada data
                                        ranting.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div id="modalEditRanting" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 p-4">
        <div class="bg-white rounded-xl w-full max-w-lg shadow-2xl p-6">
            <h3 class="text-sm font-bold text-slate-950 mb-4">Edit Data Ranting</h3>

            <form id="formEditRanting" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Nama Ranting</label>
                        <input type="text" name="nama_ranting" id="edit_nama_ranting"
                            class="w-full mt-1 p-2 text-xs border rounded-lg" required>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Ketua Ranting</label>
                        <input type="text" name="ketua_ranting" id="edit_ketua_ranting"
                            class="w-full mt-1 p-2 text-xs border rounded-lg">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Alamat Ranting</label>
                        <input type="text" name="alamat_ranting" id="edit_alamat_ranting"
                            class="w-full mt-1 p-2 text-xs border rounded-lg">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Nama Pelatih</label>
                        <input type="text" name="nama_pelatih" id="edit_nama_pelatih"
                            class="w-full mt-1 p-2 text-xs border rounded-lg">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Lokasi Latihan</label>
                        <textarea name="lokasi_latihan" id="edit_lokasi_latihan" class="w-full mt-1 p-2 text-xs border rounded-lg" required></textarea>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Kontak Ranting</label>
                        <input type="text" name="kontak_ranting" id="edit_kontak_ranting"
                            class="w-full mt-1 p-2 text-xs border rounded-lg">
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="tutupModal()"
                        class="px-4 py-2 text-xs font-bold text-gray-600">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-lg">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function bukaModalEdit(ranting) {
            const modal = document.getElementById('modalEditRanting');
            const form = document.getElementById('formEditRanting');

            // Ganti route-nya sesuai route update ranting lu (asumsi nama routenya 'menu.ranting.update')
            const baseUrl = "{{ route('menu.ranting.update', ':id') }}";
            form.action = baseUrl.replace(':id', ranting.id);

            // Isi field form
            document.getElementById('edit_nama_ranting').value = ranting.nama_ranting;
            document.getElementById('edit_ketua_ranting').value = ranting.ketua_ranting || '';
            document.getElementById('edit_alamat_ranting').value = ranting.alamat_ranting || '';
            document.getElementById('edit_nama_pelatih').value = ranting.nama_pelatih || '';
            document.getElementById('edit_lokasi_latihan').value = ranting.lokasi_latihan || '';
            document.getElementById('edit_kontak_ranting').value = ranting.kontak_ranting || '';

            modal.classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modalEditRanting').classList.add('hidden');
        }
    </script>

</x-dashboard-layout>
