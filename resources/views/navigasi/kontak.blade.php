<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-headset')
    @slot('title', 'Kontak Informasi')

    <div class="max-w-4xl mx-auto space-y-8">
        {{-- Section Cabang --}}
        <div>
            <h3 class="text-xs font-bold text-red-600 mb-4 uppercase">Kontak Cabang</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($kontakCabang as $c)
                    <div class="bg-white p-4 rounded-xl border border-gray-200 flex justify-between items-center">
                        <div>
                            <p class="text-xs font-bold">{{ $c->nama }}</p>
                            <p class="text-[10px] text-gray-500">{{ $c->jabatan }}</p>
                        </div>
                        <a href="https://wa.me/{{ $c->nomor_wa }}" target="_blank" class="text-green-500 text-lg"><i
                                class="fa-brands fa-whatsapp"></i></a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section Ranting --}}
        <div>
            <h3 class="text-xs font-bold text-slate-900 mb-4 uppercase">Kontak Ranting Anda</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($kontakRanting as $r)
                    <div class="bg-white p-4 rounded-xl border border-gray-200 flex justify-between items-center">
                        <div>
                            <p class="text-xs font-bold">{{ $r->nama }}</p>
                            <p class="text-[10px] text-gray-500">{{ $r->jabatan }}</p>
                        </div>
                        <a href="https://wa.me/{{ $r->nomor_wa }}" target="_blank" class="text-green-500 text-lg"><i
                                class="fa-brands fa-whatsapp"></i></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-dashboard-layout>
