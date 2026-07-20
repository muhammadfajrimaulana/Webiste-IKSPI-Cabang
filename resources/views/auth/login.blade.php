<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengurus IKSPI - Cabang Jakarta Pusat</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-ikspi.png') }}" type="image/png">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-950 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-2xl space-y-6">
        <div class="text-center space-y-2">
            <div
                class="w-12 h-12 bg-red-600 text-white rounded-xl mx-auto flex items-center justify-center text-xl font-bold shadow-lg shadow-red-600/20">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <h2 class="mt-4 text-center text-lg font-bold text-white uppercase">
                Form Login
            </h2>
            <p class="mt-2 text-center text-xs text-gray-400">
                Manajemen Administrasi IKSPI Kera Sakti <br>
                <span class="text-yellow-400 font-semibold">Cabang Jakarta Pusat</span>
            </p>
        </div>

        @if ($errors->any())
            <div
                class="bg-red-950 border border-red-800 text-red-400 p-3 rounded-lg text-[11px] flex items-center gap-2 mb-4">
                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Username</label>
                <input type="text" name="username" required placeholder="Masukkan username"
                    class="w-full text-xs bg-slate-950 border border-slate-800 rounded-lg px-3 py-2.5 text-white placeholder-slate-600 focus:outline-none focus:border-red-600 transition">
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full text-xs bg-slate-950 border border-slate-800 rounded-lg px-3 py-2.5 text-white placeholder-slate-600 focus:outline-none focus:border-red-600 transition">
            </div>

            <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2.5 rounded-lg transition shadow-md shadow-red-600/10 cursor-pointer">
                Masuk Ke Dashboard
            </button>
        </form>
    </div>

</body>

</html>
