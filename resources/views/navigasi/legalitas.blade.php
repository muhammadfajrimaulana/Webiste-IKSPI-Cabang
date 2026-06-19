<x-dashboard-layout>
    @slot('icon', 'fa-regular fa-file-lines')
    @slot('title', 'Tata Kelola & Legalitas')

    <div class="space-y-6 max-w-4xl mx-auto">

        {{-- Form Upload (Khusus Admin Cabang) --}}
        @if (auth()->user()->role === 'admin_cabang')
            <div class="bg-white p-5 rounded-xl border border-red-200 shadow-xs">
                <h3 class="text-xs font-bold text-slate-950 uppercase mb-4">Upload Dokumen Baru</h3>
                <form action="{{ route('menu.legalitas.store') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col md:flex-row gap-3">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Dokumen (Contoh: SK Cabang 2026)"
                        class="text-xs border border-gray-200 rounded-lg p-2 flex-1" required>
                    <input type="file" name="dokumen" class="text-xs border border-gray-200 rounded-lg p-2" required>
                    <button type="submit"
                        class="bg-red-600 text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-red-700">Upload</button>
                </form>
            </div>
        @endif

        {{-- Daftar Dokumen --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center space-x-3">
                <div class="text-red-600 text-base"><i class="fa-solid fa-shield-halved"></i></div>
                <h3 class="text-xs font-bold text-slate-950 uppercase tracking-wider">Pusat Dokumen Legalitas & SK Resmi
                </h3>
            </div>

            <div class="p-5 divide-y divide-gray-100">
                @forelse($legals as $legal)
                    <div class="flex items-center justify-between py-4.5">
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600 text-sm">
                                <i class="fa-regular fa-file-pdf"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">{{ $legal->legalitas_nama }}</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">Format: PDF • Hak Akses: Resmi Cabang</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $legal->legalitas_file) }}" target="_blank"
                            class="inline-flex items-center space-x-1.5 bg-slate-900 text-white text-[10px] font-bold px-3 py-2 rounded-lg hover:bg-slate-800 transition">
                            <i class="fa-solid fa-arrow-down-to-line"></i> <span>Unduh</span>
                        </a>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 py-4 text-center">Belum ada dokumen legalitas yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-dashboard-layout>
