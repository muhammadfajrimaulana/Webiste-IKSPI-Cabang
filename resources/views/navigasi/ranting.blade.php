<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-map-location-dot')
    @slot('title', 'Data Ranting & Tempat Latihan')

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

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Icon dengan background halus -->
                <div class="h-8 w-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>

                <div>
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">
                        {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Manajemen Wilayah' : 'Informasi Latihan' }}
                    </h3>
                    <p class="text-[10px] text-gray-500 font-medium">
                        {{ auth()->user()->role === 'admin_ranting' || auth()->user()->role === 'admin_cabang' ? 'Kelola titik latihan dan data wilayah.' : 'Detail lokasi latihan resmi untuk seluruh anggota' }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="bg-white border border-gray-100 px-4 py-2 rounded-xl shadow-sm flex items-center gap-3">
                    <div class="h-8 w-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                        <i class="fa-solid fa-layer-group text-[12px]"></i>
                    </div>
                    <div>
                        <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Total Ranting</p>
                        <p class="text-xs font-black text-slate-900">{{ $totalTitik }} <span
                                class="font-medium text-gray-400 text-[10px]">Data</span></p>
                    </div>
                </div>

                <div
                    class="bg-emerald-50 border border-emerald-100 px-4 py-2 rounded-xl shadow-sm flex items-center gap-3">
                    <div class="h-8 w-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <i class="fa-solid fa-circle-check text-[12px]"></i>
                    </div>
                    <div>
                        <p class="text-[9px] text-emerald-600/70 uppercase font-bold tracking-wider">Aktif</p>
                        <p class="text-xs font-black text-emerald-800">{{ $totalAktif }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                @if (auth()->user()->role === 'admin_ranting')
                    {{-- Tampilan Card khusus untuk Admin Ranting --}}
                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition duration-300">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-xl font-extrabold text-slate-950 flex items-center gap-2">
                                    <i class="fa-solid fa-building-shield text-red-600"></i>
                                    {{ $dataRanting->first()->nama_ranting }}
                                </h2>
                                <p class="text-xs text-slate-400 mt-1 uppercase tracking-wider font-bold">Informasi
                                    Profil Ranting</p>
                            </div>

                            <button type="button" onclick="bukaModalEdit({{ json_encode($dataRanting->first()) }})"
                                class="px-4 py-2 bg-slate-950 text-white text-xs font-bold rounded-xl hover:bg-slate-800 active:scale-95 transition flex items-center gap-2">
                                <i class="fa-solid fa-pen-to-square"></i> Edit Profil
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                            {{-- Item Info --}}
                            <div class="flex items-start gap-3">
                                <div
                                    class="bg-slate-100 p-2 rounded-lg text-slate-600 w-8 h-8 flex items-center justify-center">
                                    <i class="fa-solid fa-user-tie text-[12px]"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-slate-400">Ketua Ranting</p>
                                    <p class="text-xs font-semibold text-slate-700">
                                        {{ $dataRanting->first()->ketua_ranting ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="bg-slate-100 p-2 rounded-lg text-slate-600 w-8 h-8 flex items-center justify-center">
                                    <i class="fa-solid fa-chalkboard-user text-[12px]"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-slate-400">Pelatih</p>
                                    <p class="text-xs font-semibold text-slate-700">
                                        {{ $dataRanting->first()->nama_pelatih ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="bg-slate-100 p-2 rounded-lg text-slate-600 w-8 h-8 flex items-center justify-center">
                                    <i class="fa-solid fa-phone text-[12px]"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-slate-400">Kontak</p>
                                    <a href="https://wa.me/{{ $dataRanting->first()->kontak_ranting }}" target="_blank"
                                        class="text-xs font-bold text-blue-600 hover:underline">
                                        {{ $dataRanting->first()->kontak_ranting ?? '-' }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="bg-slate-100 p-2 rounded-lg text-slate-600 w-8 h-8 flex items-center justify-center">
                                    <i class="fa-solid fa-location-dot text-[12px]"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-slate-400">Alamat</p>
                                    <p class="text-xs font-semibold text-slate-700">
                                        {{ $dataRanting->first()->alamat_ranting ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100">
                            <p class="text-[10px] uppercase font-bold text-slate-400 mb-1">Titik Lokasi Latihan</p>
                            <p class="text-xs text-slate-600 italic bg-slate-50 p-3 rounded-lg border border-slate-100">
                                "{{ $dataRanting->first()->lokasi_latihan ?? 'Lokasi belum ditentukan' }}"
                            </p>
                        </div>
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
                                            <button type="button"
                                                onclick="bukaModalEdit({{ json_encode($ranting) }})"
                                                class="ml-2 px-3 py-1.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition cursor-pointer">
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

    <!-- MODAL EDIT & HAPUS -->
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
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Kontak Ranting</label>
                        <input type="text" name="kontak_ranting" id="edit_kontak_ranting"
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
                </div>

                <!-- Footer Modal (Tombol Hapus di Kiri, Batal & Simpan di Kanan) -->
                <div class="pt-4 border-t border-gray-100 mt-4 flex items-center justify-between">
                    <button type="button" onclick="hapusRanting()"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-[10px] font-semibold rounded-lg cursor-pointer transition flex items-center gap-1">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>

                    <div class="flex items-center gap-2">
                        <button type="button" onclick="tutupModal()"
                            class="px-4 py-2 border border-gray-200 text-[10px] rounded-lg text-gray-600 font-semibold cursor-pointer">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-slate-950 text-white text-[10px] font-bold rounded-lg cursor-pointer">Simpan
                            Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Global untuk Delete -->
    <form id="globalDeleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

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

        let currentRantingId = null;

        function bukaModalEdit(ranting) {
            const modal = document.getElementById('modalEditRanting');
            const formEdit = document.getElementById('formEditRanting');

            currentRantingId = ranting.id;

            const baseUrlEdit = "{{ route('menu.ranting.update', ':id') }}";
            formEdit.action = baseUrlEdit.replace(':id', ranting.id);

            document.getElementById('edit_nama_ranting').value = ranting.nama_ranting || '';
            document.getElementById('edit_ketua_ranting').value = ranting.ketua_ranting || '';
            document.getElementById('edit_alamat_ranting').value = ranting.alamat_ranting || '';
            document.getElementById('edit_nama_pelatih').value = ranting.nama_pelatih || '';
            document.getElementById('edit_lokasi_latihan').value = ranting.lokasi_latihan || '';
            document.getElementById('edit_kontak_ranting').value = ranting.kontak_ranting || ''; // <-- Ini tadinya terlewat

            modal.classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modalEditRanting').classList.add('hidden');
        }

        function hapusRanting() {
            if (confirm('Yakin ingin menghapus ranting ini? Akun admin ranting terkait juga akan terhapus.')) {
                const deleteForm = document.getElementById('globalDeleteForm');
                const baseUrlDelete = "{{ route('menu.ranting.destroy', ':id') }}";

                deleteForm.action = baseUrlDelete.replace(':id', currentRantingId);

                deleteForm.submit();
            }
        }
    </script>

</x-dashboard-layout>
