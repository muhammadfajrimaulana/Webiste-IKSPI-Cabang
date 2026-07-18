<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-file-signature')
    @slot('title', 'Flow A: Input Data Pendaftaran Baru')

    <div class="max-w-4xl mx-auto space-y-6">
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pendaftaran Calon Anggota</h2>
                <p class="text-xs text-gray-500 mt-1">Silakan lengkapi formulir di bawah ini dengan data yang valid untuk
                    masuk ke sistem verifikasi.</p>
            </div>
            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full uppercase tracking-wider">
                Flow A - Input
            </span>
        </div>

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 space-y-4">
                <h3
                    class="text-sm font-bold text-slate-900 uppercase border-b border-gray-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-id-card"></i> Data Identitas Utama <span
                        class="text-[9px] text-gray-400 font-normal normal-case">(Wajib Diisi)</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                            class="w-full px-3 py-2 border @error('nama_lengkap') border-red-500 @else border-gray-300 @enderror rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="Masukkan nama sesuai KTP">
                        @error('nama_lengkap')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">NIK KTP (16
                            Digit)</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" required
                            class="w-full px-3 py-2 border @error('nik') border-red-500 @else border-gray-300 @enderror rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="3171xxxxxxxxxxxx">
                        @error('nik')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                            class="w-full px-3 py-2 border @error('tempat_lahir') border-red-500 @else border-gray-300 @enderror rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="Contoh: Jakarta">
                        @error('tempat_lahir')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                            class="w-full px-3 py-2 border @error('tanggal_lahir') border-red-500 @else border-gray-300 @enderror rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none">
                        @error('tanggal_lahir')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">No. HP /
                            WhatsApp</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                            class="w-full px-3 py-2 border @error('no_hp') border-red-500 @else border-gray-300 @enderror rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="Contoh: 0812xxxxxxxx">
                        @error('no_hp')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Ranting Tujuan</label>
                        <select name="ranting_id" required
                            class="w-full px-3 py-2 border @error('ranting_id') border-red-500 @else border-gray-300 @enderror rounded-lg text-xs bg-white focus:ring-1 focus:ring-red-500 focus:outline-none cursor-pointer">
                            <option value="">-- Pilih Ranting --</option>
                            @foreach ($rantings as $ranting)
                                <option value="{{ $ranting->id }}"
                                    {{ old('ranting_id') == $ranting->id ? 'selected' : '' }}>
                                    {{ $ranting->nama_ranting }}
                                </option>
                            @endforeach
                        </select>
                        @error('ranting_id')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-2">
                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Alamat Lengkap
                        Domisili</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full px-3 py-2 border @error('alamat') border-red-500 @else border-gray-300 @enderror rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none placeholder:text-gray-400"
                        placeholder="Nama jalan, RT/RW, Nomor Rumah, Kelurahan, Kecamatan, Kota/Kabupaten">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 space-y-4">
                <h3
                    class="text-sm font-bold text-slate-900 uppercase border-b border-gray-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-map-marker-alt"></i> Koordinat Google Maps Domisili <span
                        class="text-[9px] text-gray-400 font-normal normal-case">(Opsional)</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">
                            Latitude
                        </label>
                        <input type="text" name="latitude" value="{{ old('latitude', '-6.175392') }}"
                            placeholder="Contoh: -6.175..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs bg-gray-50 text-gray-500"
                            readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">
                            Longitude
                        </label>
                        <input type="text" name="longitude" value="{{ old('longitude', '106.827153') }}"
                            placeholder="Contoh: 106.827..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs bg-gray-50 text-gray-500"
                            readonly>
                    </div>
                </div>
                <div id="map"
                    class="w-full h-48 bg-slate-100 border border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-gray-400 gap-1">
                    <i class="fa-solid fa-map-marked-alt text-2xl mb-2"></i>
                    <p class="text-[11px] font-medium">Area Mockup Peta Lokasi Domisili Anggota</p>
                    <p class="text-[9px] text-gray-400">(Sistem otomatis lock koordinat saat pin di-drop)</p>
                </div>
                <span class="text-[9px] text-gray-400 font-normal italic normal-case">Note: Pindahkan mark lokasi
                    berwarna biru
                    untuk menentukan angka koordinat.</span>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 space-y-4">
                <h3
                    class="text-sm font-bold text-slate-900 uppercase border-b border-gray-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-folder-open"></i> Upload Dokumen Kelengkapan <span
                        class="text-[9px] text-gray-400 font-normal normal-case">(Opsional)</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-700 uppercase">Pas Foto (Berpakaian
                            Formal)</label>
                        <p class="text-[10px] text-gray-400 mb-2">Format JPG/PNG, ukuran maksimal 2MB.</p>
                        <div
                            class="border @error('foto_sakral') border-red-500 @else border-gray-300 @enderror rounded-lg p-3 bg-gray-50 flex items-center gap-3">
                            <input type="file" name="foto_sakral" accept="image/*"
                                class="text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-white hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        @error('foto_sakral')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-700 uppercase">Berkas Administrasi Utama
                            (<span class="text-red-600 font-bold">Iks.pdf</span>)</label>
                        <p class="text-[10px] text-gray-400 mb-2">Unggah berkas kompilasi dalam format PDF.
                        </p>
                        <div
                            class="border @error('berkas_pdf') border-red-500 @else border-gray-300 @enderror rounded-lg p-3 bg-gray-50 flex items-center gap-3">
                            <input type="file" name="berkas_pdf" accept=".pdf"
                                class="text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 cursor-pointer">
                        </div>
                        @error('berkas_pdf')
                            <p class="text-[10px] text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="reset"
                    class="px-4 py-2 border border-gray-300 text-gray-700 font-medium text-xs rounded-lg hover:bg-gray-100 transition cursor-pointer">
                    Reset Form
                </button>
                <button type="submit"
                    class="px-5 py-2 bg-red-600 text-white font-semibold text-xs rounded-lg hover:bg-red-700 shadow-sm transition cursor-pointer">
                    Kirim Data Ke Pengurus
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>

<script>
    // Koordinat default (Tengah Jakarta)
    const lat = document.querySelector('input[name="latitude"]').value;
    const lng = document.querySelector('input[name="longitude"]').value;

    const map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker yang bisa digeser
    const marker = L.marker([lat, lng], {
        draggable: true
    }).addTo(map);

    // Event saat marker selesai digeser
    marker.on('moveend', function(e) {
        const position = marker.getLatLng();
        document.querySelector('input[name="latitude"]').value = position.lat.toFixed(6);
        document.querySelector('input[name="longitude"]').value = position.lng.toFixed(6);
    });
</script>
