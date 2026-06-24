<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-user')
    @slot('title', 'Profile')

    <div class="flex flex-col gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-2">Informasi Pengguna</h2>
            <p><strong>Nama:</strong> {{ $user->nama_pengurus }}</p>
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Role:</strong> {{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
            @if ($user->ranting)
                <p><strong>Ranting:</strong> {{ $user->ranting->nama_ranting }}</p>
            @endif
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-2">Aksi</h2>
            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Edit Profil</a>
        </div>
    </div>

</x-dashboard-layout>
