<x-AppLayout>
    @slot('title', 'Gerbang Utama - Proteksi Akses Level 2')

    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-950 to-red-950 px-4">

        <div
            class="max-w-md w-full space-y-8 bg-white/5 backdrop-blur-md p-8 rounded-2xl border border-white/10 shadow-2xl">

            <div class="text-center">
                <div
                    class="mx-auto h-24 w-24 bg-red-600 rounded-full flex items-center justify-center shadow-lg shadow-red-600/30 border-2 border-yellow-400">
                    <span class="text-3xl text-yellow-400 font-bold">IKSPI</span>
                </div>
                <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-white uppercase">
                    Gerbang Utama
                </h2>
                <p class="mt-2 text-center text-xs text-gray-400">
                    Manajemen Administrasi IKSPI Kera Sakti <br>
                    <span class="text-yellow-400 font-semibold">Cabang Jakarta Pusat</span>
                </p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('gerbang.check') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm">
                    <div>
                        @error('password_gerbang')
                            <div class="text-red-500 text-xs text-center font-bold bg-red-950/50 py-2 rounded mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                        <input id="password_gerbang" name="password_gerbang" type="password" required
                            class="appearance-none rounded-lg relative block w-full px-4 py-3 border border-white/10 bg-slate-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm text-center tracking-widest font-bold"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-gray-400 px-1">
                    <span class="flex items-center">
                        Keamanan Akses
                    </span>
                    <span>
                        Pengurus / Anggota
                    </span>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-slate-950 bg-yellow-400 hover:bg-yellow-300 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-yellow-400 transition-all duration-200 shadow-lg shadow-yellow-400/20 cursor-pointer">
                        <span class="mr-2 hidden group-hover:inline">🔓</span>
                        Buka Akses Login
                    </button>
                </div>
            </form>

            <div class="text-center text-[10px] text-gray-500 pt-4 border-t border-white/5">
                Masukkan password gerbang untuk mengakses form login.
            </div>

        </div>
    </div>
</x-AppLayout>
