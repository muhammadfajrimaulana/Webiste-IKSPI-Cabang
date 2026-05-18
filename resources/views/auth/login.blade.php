<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-200">

            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-red-600 rounded-xl flex items-center justify-center shadow-md">
                    <span class="text-xl font-bold text-yellow-400">IK</span>
                </div>
                <h2 class="mt-6 text-2xl font-bold text-slate-900 tracking-tight">
                    LOGIN PENGURUS
                </h2>
                <p class="mt-2 text-sm text-gray-500">
                    Akses Sistem Administrasi & Internal <br>
                    <span class="font-semibold text-red-600">Level 1 - Authorized Personnel Only</span>
                </p>
            </div>

            <form class="mt-8 space-y-4" action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email / Nomor
                        Anggota</label>
                    <input id="email" name="email" type="text" required
                        class="appearance-none rounded-lg relative block w-full px-3 py-2.5 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm"
                        placeholder="Masukkan email atau no. anggota">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Akun</label>
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded-lg relative block w-full px-3 py-2.5 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center text-gray-600">
                        <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-1.5">
                        Ingat Saya
                    </label>
                    <a href="#" class="font-medium text-red-600 hover:text-red-500">Lupa Password?</a>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-colors duration-150 shadow-md cursor-pointer">
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>

            <div class="text-center pt-2">
                <a href="{{ route('gerbang.form') }}"
                    class="text-xs text-gray-400 hover:text-gray-600 transition-colors">
                    ⬅️ Kembali ke Gerbang Utama
                </a>
            </div>

        </div>
    </div>
</x-app-layout>