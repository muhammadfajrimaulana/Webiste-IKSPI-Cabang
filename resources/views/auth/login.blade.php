<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengurus - IKSPI Jakarta Pusat</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-ikspi.png') }}" type="image/png">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-950 min-h-screen flex items-center justify-center p-4">

    <!-- Container Utama -->
    <div
        class="w-full max-w-4xl bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row">

        <!-- Sisi Kiri: Dekorasi & Branding -->
        <div
            class="hidden md:flex flex-1 bg-gradient-to-br from-red-900 to-slate-950 p-12 flex-col justify-between text-white">
            <div>
                <img src="{{ asset('assets/img/ikspi-jakpus.png') }}" alt="Logo" class="w-16 h-16 opacity-90">
                <h1 class="text-3xl font-black text-yellow-500 mt-6 leading-tight"><span
                        class="text-white">IKS.PI</span><br>KERA
                    SAKTI</h1>
                <p class="text-red-200 mt-2 text-sm font-medium">Cabang Jakarta Pusat</p>
            </div>
            <div class="text-xs text-red-300/60 font-semibold tracking-widest uppercase">
                Sistem Administrasi Pengurus
            </div>
        </div>

        <!-- Sisi Kanan: Form Login -->
        <div class="flex-1 p-8 md:p-12 bg-white">
            <div class="mb-8">
                <h2 class="text-2xl font-black text-slate-900">Selamat Datang</h2>
                <p class="text-slate-500 text-sm mt-1">Silakan masukkan akun kredensial Anda.</p>
            </div>

            @if ($errors->any())
                <div id="alert-error"
                    class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl text-xs mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label
                        class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Username</label>
                    <input type="text" name="username" required placeholder="username"
                        class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
                </div>

                <div class="relative">
                    <label
                        class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Password</label>

                    <input type="password" id="password" name="password" required placeholder="••••••••"
                        class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">

                    <button type="button" onclick="togglePassword()"
                        class="absolute right-4 top-[34px] text-slate-400 hover:text-red-600 transition">
                        <i id="eye-icon" class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-xl shadow-slate-900/10 cursor-pointer text-sm">
                    Masuk ke Dashboard
                </button>
            </form>

            <p class="mt-8 text-center text-[10px] text-slate-400 uppercase tracking-widest font-semibold">
                &copy; {{ date('Y') }} IKSPI Cabang Jakarta Pusat
            </p>
        </div>
    </div>

    <script>
        // Menutup alert
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = ['alert-success', 'alert-error'];

            alerts.forEach(id => {
                const alertElement = document.getElementById(id);
                if (alertElement) {
                    setTimeout(() => {
                        alertElement.style.opacity = '0';

                        setTimeout(() => {
                            alertElement.remove();
                        }, 500);
                    }, 3000);
                }
            });
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
