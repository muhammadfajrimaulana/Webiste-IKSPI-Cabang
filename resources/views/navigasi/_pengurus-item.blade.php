<div class="flex flex-col items-center mx-2 group">
    <div
        class="bg-slate-900 text-white p-4 rounded-xl min-w-[160px] text-center shadow-lg border-b-4 border-yellow-500 relative">
        <p class="text-[9px] text-yellow-400 font-bold uppercase">{{ $item->jabatan }}</p>
        <p class="text-xs font-bold mt-1.5 uppercase">{{ $item->nama }}</p>

        @if (auth()->check() && auth()->user()->role === 'admin_cabang')
            <div class="absolute -top-2 -right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                <button type="button" onclick="openModal(...)"
                    class="bg-blue-500 text-white p-1 rounded-full text-[8px]"><i class="fa-solid fa-edit"></i></button>

                <form action="{{ route('menu.struktur.destroy', $item->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 text-white p-1 rounded-full text-[8px]"><i
                            class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        @endif
    </div>

    @if ($item->anakBuah && $item->anakBuah->count() > 0)
        <div class="h-6 w-px bg-gray-400"></div>
        <div class="flex justify-center border-t border-gray-400 w-full pt-4">
            @foreach ($item->anakBuah as $anak)
                @include('navigasi._pengurus-item', ['item' => $anak])
            @endforeach
        </div>
    @endif
</div>
