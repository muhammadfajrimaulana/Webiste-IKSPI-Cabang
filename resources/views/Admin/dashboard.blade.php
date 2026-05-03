@foreach($members as $member)
<tr class="hover:bg-gray-50 border-b">
    <td class="px-4 py-3 text-sm text-gray-700">
        {{ $member->nama }}
    </td>
    <td class="px-4 py-3 text-sm text-gray-700">
        {{ $member->alamat }} <!-- Tambahkan alamat biar informatif -->
    </td>
    <td class="px-4 py-3">
        @if($member->foto)
            <div class="relative w-20 h-24 overflow-hidden rounded-lg shadow-sm border">
                <img src="{{ asset('storage/' . $member->foto) }}" 
                     class="object-cover w-full h-full" 
                     alt="Foto {{ $member->nama }}">
            </div>
        @else
            <span class="text-xs text-gray-400 italic">Tanpa Foto</span>
        @endif
    </td>
    <td class="px-4 py-3">
        @if($member->status_verifikasi == 'pending')
            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                Menunggu
            </span>
        @else
            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                Terverifikasi
            </span>
        @endif
    </td>
    <td class="px-4 py-3 text-sm">
        @if($member->status_verifikasi == 'pending')
            <form action="{{ route('member.verify', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengesahkan anggota ini?')">
                @csrf
                @method('PATCH')
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-4 rounded-md transition duration-200 ease-in-out shadow-sm">
                    Sahkan Anggota
                </button>
            </form>
        @else
            <div class="flex items-center text-blue-600 font-medium">
                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Sudah Disahkan
            </div>
        @endif
    </td>
</tr>
@endforeach