<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-file-signature')
    @slot('title', 'Flow A: Input Data Pendaftaran Baru')

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-950 uppercase tracking-wide">Pendaftaran Calon Anggota</h2>
                <p class="text-xs text-gray-500 mt-1">Silakan lengkapi formulir di bawah ini dengan data yang valid
                    untuk masuk ke sistem verifikasi.</p>
            </div>
            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full uppercase tracking-wider">
                Flow A - Input
            </span>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 space-y-4">
                <h3
                    class="text-sm font-bold text-slate-900 uppercase border-b border-gray-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-id-card"></i> Data Identitas Utama
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Nama Lengkap</label>
                        <input type="text" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="Masukkan nama sesuai KTP">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Tempat, Tanggal
                            Lahir</label>
                        <input type="text" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="Jakarta, 01 Januari 2000">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Ranting / Tempat Latihan
                            Tujuan</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs bg-white focus:ring-1 focus:ring-red-500 focus:outline-none">
                            <option value="">-- Pilih Ranting --</option>
                            <option value="kemayoran">Ranting Gambir</option>
                            <option value="sawah-besar">Ranting Tanah Abang</option>
                            <option value="sawah-besar">Ranting Menteng</option>
                            <option value="tanah-abang">Ranting Senen</option>
                            <option value="sawah-besar">Ranting Cempaka Putih</option>
                            <option value="sawah-besar">Ranting Johar Baru</option>
                            <option value="sawah-besar">Ranting Kemayoran</option>
                            <option value="sawah-besar">Ranting Sawah Besar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Nomor Kontak /
                            WhatsApp</label>
                        <input type="tel" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                            placeholder="08xxxxxxxxxx">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Alamat Domisili
                        Lengkap</label>
                    <textarea rows="3" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-1 focus:ring-red-500 focus:outline-none"
                        placeholder="Tuliskan alamat jalan, RT/RW, dan kecamatan..."></textarea>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 space-y-4">
                <h3
                    class="text-sm font-bold text-slate-900 uppercase border-b border-gray-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-map-marker-alt"></i> Koordinat Google Maps Domisili
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Latitude</label>
                        <input type="text" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs bg-gray-50 text-gray-500"
                            placeholder="-6.175392" readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Longitude</label>
                        <input type="text" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs bg-gray-50 text-gray-500"
                            placeholder="106.827153" readonly>
                    </div>
                </div>
                <div
                    class="w-full h-48 bg-slate-100 border border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-gray-400 gap-1">
                    <i class="fa-solid fa-map-marked-alt text-2xl mb-2"></i>
                    <p class="text-[11px] font-medium">Area Mockup Peta Lokasi Domisili Anggota</p>
                    <p class="text-[9px] text-gray-400">(Sistem otomatis lock koordinat saat pin di-drop)</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 space-y-4">
                <h3
                    class="text-sm font-bold text-slate-900 uppercase border-b border-gray-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-folder-open"></i> Upload Dokumen Kelengkapan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-700 uppercase">Pas Foto (Berbaju
                            Sakral)</label>
                        <p class="text-[10px] text-gray-400 mb-2">Format JPG/PNG, ukuran maksimal 2MB.</p>
                        <div class="border border-gray-300 rounded-lg p-3 bg-gray-50 flex items-center gap-3"> 
                            <input type="file" required
                                class="text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-white hover:file:bg-slate-800 cursor-pointer">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-700 uppercase">Berkas Administrasi Utama
                            (<span class="text-red-600 font-bold">Iks.pdf</span>)</label>
                        <p class="text-[10px] text-gray-400 mb-2">Wajib mengunggah berkas kompilasi dalam format PDF.
                        </p>
                        <div class="border border-gray-300 rounded-lg p-3 bg-gray-50 flex items-center gap-3">
                            <input type="file" required accept=".pdf"
                                class="text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 cursor-pointer">
                        </div>
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