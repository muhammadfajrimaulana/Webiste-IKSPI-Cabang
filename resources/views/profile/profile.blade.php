<x-dashboard-layout>
    @slot('icon', 'fa-solid fa-user')
    @slot('title', 'Profil')

    <div class="max-w-6xl mx-auto space-y-6">
        @if (session('success'))
            <div id="alert-success"
                class="fixed top-5 right-5 z-50 bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500 shadow-lg">
                <i class="fa-solid fa-circle-check text-base text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error"
                class="fixed top-5 right-5 z-50 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs flex items-center gap-2 font-medium transition-opacity duration-500 shadow-lg">
                <i class="fa-solid fa-circle-exclamation text-base text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Banner / Header Informasi Utama -->
        <div
            class="relative bg-gradient-to-r from-slate-900 via-red-950 to-slate-900 rounded-2xl border border-slate-800 shadow-sm p-6 overflow-hidden relative text-white">
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <i class="fa-solid fa-id-badge text-9xl text-white"></i>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 relative z-10">
                <div
                    class="w-16 h-16 rounded-2xl overflow-hidden shadow-md bg-red-600 text-white flex items-center justify-center text-2xl font-black shrink-0">
                    @if ($user->avatar)
                        <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}"
                            alt="{{ $user->nama_pengurus }}" class="w-full h-full object-cover">
                    @else
                        {{ collect(explode(' ', $user->nama_pengurus))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->implode('') }}
                    @endif
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="text-base font-black uppercase tracking-wider">{{ $user->nama_pengurus }}</h3>
                        <span
                            class="px-2.5 py-0.5 bg-white/10 text-red-400 border border-white/10 rounded-full text-[9px] font-bold uppercase">
                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-0.5">Username: <span
                            class="font-mono text-gray-200">{{ $user->username }}</span></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 pt-6 border-t border-slate-800 text-xs">
                <div class="bg-white/5 p-3.5 rounded-xl border border-white/5">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Nama
                        Pengurus</span>
                    <span class="font-semibold text-gray-200 text-sm mt-0.5 block">{{ $user->nama_pengurus }}</span>
                </div>

                @if ($user->ranting)
                    <div class="bg-white/5 p-3.5 rounded-xl border border-white/5">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Unit
                            Ranting</span>
                        <span
                            class="font-semibold text-gray-200 text-sm mt-0.5 block">{{ $user->ranting->nama_ranting }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Grid Container untuk Form Edit Profil & Form Ubah Password -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Card 1: Edit Informasi Profil -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div class="h-9 w-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-user-pen"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Informasi Profil</h3>
                            <p class="text-[11px] text-gray-500 font-medium">Perbarui informasi profil dan foto Anda.
                            </p>
                        </div>
                    </div>

                    <!-- Tambahkan enctype="multipart/form-data" agar form bisa mengupload file -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4" id="formUpdateProfile">
                        @csrf
                        @method('PUT')

                        <!-- Input Upload Foto Profil -->
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Foto Profil</label>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 border border-gray-200 shrink-0">
                                    @if ($user->avatar)
                                        <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}"
                                            alt="Preview" class="w-full h-full object-cover" id="avatarPreview">
                                    @else
                                        <div class="w-full h-full bg-red-600 text-white flex items-center justify-center text-sm font-black"
                                            id="avatarFallback">
                                            {{ collect(explode(' ', $user->nama_pengurus))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->implode('') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="avatar" id="avatarInput"
                                        accept="image/png, image/jpeg, image/jpg"
                                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 cursor-pointer">
                                    <span class="text-[9px] text-gray-400 mt-1 block">Format: JPG, JPEG, PNG (Maks.
                                        2MB)</span>
                                </div>
                            </div>
                            @error('avatar')
                                <span class="text-[10px] text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nama Pengurus -->
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama
                                Pengurus</label>
                            <input type="text" name="nama_pengurus"
                                value="{{ old('nama_pengurus', $user->nama_pengurus) }}" required
                                class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition">
                            @error('nama_pengurus')
                                <span class="text-[10px] text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Username</label>
                            <input type="text" name="username" id="username"
                                value="{{ old('username', $user->username) }}" required
                                oninput="checkUsernameAvailability()"
                                class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition">
                            <span id="username_status" class="text-[10px] mt-1 hidden font-medium"></span>
                            @error('username')
                                <span class="text-[10px] text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Unit Ranting (Readonly) -->
                        @if ($user->ranting)
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Unit
                                    Ranting</label>
                                <input type="text"
                                    value="{{ old('nama_ranting', $user->ranting->nama_ranting ?? '-') }}" readonly
                                    class="w-full bg-gray-100 border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs text-gray-500 cursor-not-allowed focus:outline-none">
                            </div>
                        @endif
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" id="submitProfileBtn"
                        class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
                </form>
            </div>

            <!-- Card 2: Ubah Password -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div
                            class="h-9 w-9 rounded-xl bg-slate-900 text-white flex items-center justify-center text-sm">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Keamanan & Ubah
                                Password</h3>
                            <p class="text-[11px] text-gray-500 font-medium">Perbarui kata sandi secara berkala demi
                                keamanan sistem.</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4"
                        id="formUpdatePassword">
                        @csrf
                        @method('PUT')

                        <!-- Password Saat Ini -->
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Password Saat
                                Ini</label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password"
                                    placeholder="••••••••" required
                                    class="w-full bg-gray-50/50 border border-gray-200 rounded-xl pl-3.5 pr-10 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition">
                                <button type="button" onclick="togglePassword('current_password', 'icon_current')"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-slate-600 focus:outline-none cursor-pointer">
                                    <i id="icon_current" class="fa-solid fa-eye-slash text-xs"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <span class="text-[10px] text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Baru -->
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Password
                                Baru</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    required oninput="validatePassword()"
                                    class="w-full bg-gray-50/50 border border-gray-200 rounded-xl pl-3.5 pr-10 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition">
                                <button type="button" onclick="togglePassword('password', 'icon_new')"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-slate-600 focus:outline-none cursor-pointer">
                                    <i id="icon_new" class="fa-solid fa-eye-slash text-xs"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-[10px] text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Konfirmasi Password
                                Baru</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="••••••••" required oninput="validatePassword()"
                                    class="w-full bg-gray-50/50 border border-gray-200 rounded-xl pl-3.5 pr-10 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition">
                                <button type="button"
                                    onclick="togglePassword('password_confirmation', 'icon_confirm')"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-slate-600 focus:outline-none cursor-pointer">
                                    <i id="icon_confirm" class="fa-solid fa-eye-slash text-xs"></i>
                                </button>
                            </div>
                            <!-- Indikator Syarat Password -->
                            <div id="password_requirements" class="mt-1.5 space-y-1 text-[10px]">
                                <p id="req_length" class="text-gray-400 flex items-center gap-1 font-medium"><i
                                        class="fa-solid fa-circle text-[6px]"></i> Minimal 6 karakter</p>
                                <p id="req_mix" class="text-gray-400 flex items-center gap-1 font-medium"><i
                                        class="fa-solid fa-circle text-[6px]"></i> Harus mengandung huruf dan angka</p>
                            </div>
                            <span id="match_status" class="text-[10px] mt-1 hidden font-medium"></span>
                        </div>
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" id="submitBtn"
                        class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-all shadow-sm cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved"></i> Perbarui Password
                    </button>
                </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Menutup alert otomatis
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = ['alert-success', 'alert-error'];
            alerts.forEach(id => {
                const alertElement = document.getElementById(id);
                if (alertElement) {
                    setTimeout(() => {
                        alertElement.style.opacity = '0';
                        setTimeout(() => alertElement.remove(), 500);
                    }, 3000);
                }
            });
        });

        const currentUsername = "{{ $user->username }}";
        let typingTimer;
        const doneTypingInterval = 500;

        function checkUsernameAvailability() {
            clearTimeout(typingTimer);
            const usernameInput = document.getElementById('username');
            const usernameStatus = document.getElementById('username_status');
            const submitBtn = document.getElementById('submitProfileBtn');
            const val = usernameInput.value.trim();

            usernameStatus.classList.remove('hidden');

            if (val === '') {
                usernameStatus.classList.add('hidden');
                usernameInput.classList.remove('border-red-300', 'border-green-300');
                return;
            }

            // Cek format dasar
            if (val.length < 4) {
                usernameStatus.innerHTML =
                    '<i class="fa-solid fa-triangle-exclamation text-amber-500"></i> Username minimal 4 karakter.';
                usernameStatus.className = 'text-[10px] mt-1 block font-medium text-amber-500';
                usernameInput.classList.add('border-red-300');
                return;
            }

            const isValidFormat = /^[a-zA-Z0-9_.]+$/.test(val);
            if (!isValidFormat) {
                usernameStatus.innerHTML =
                    '<i class="fa-solid fa-circle-xmark text-red-500"></i> Tidak boleh pakai spasi atau simbol khusus.';
                usernameStatus.className = 'text-[10px] mt-1 block font-medium text-red-500';
                usernameInput.classList.add('border-red-300');
                return;
            }

            // Jika sama persis dengan username miliknya sendiri sekarang
            if (val === currentUsername) {
                usernameStatus.innerHTML =
                    '<i class="fa-solid fa-circle-check text-green-500"></i> Username Anda saat ini.';
                usernameStatus.className = 'text-[10px] mt-1 block font-medium text-green-600';
                usernameInput.classList.remove('border-red-300');
                usernameInput.classList.add('border-green-300');
                submitBtn.disabled = false;
                return;
            }

            // Status sedang memeriksa database
            usernameStatus.innerHTML =
                '<i class="fa-solid fa-spinner fa-spin text-gray-400"></i> Memeriksa ketersediaan...';
            usernameStatus.className = 'text-[10px] mt-1 block font-medium text-gray-400';

            // Eksekusi AJAX Fetch setelah user selesai mengetik sebentar
            typingTimer = setTimeout(() => {
                fetch("{{ route('profile.check-username') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            username: val
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.available) {
                            usernameStatus.innerHTML =
                                '<i class="fa-solid fa-circle-check text-green-500"></i> Username tersedia!';
                            usernameStatus.className = 'text-[10px] mt-1 block font-medium text-green-600';
                            usernameInput.classList.remove('border-red-300');
                            usernameInput.classList.add('border-green-300');
                            submitBtn.disabled = false;
                        } else {
                            usernameStatus.innerHTML =
                                '<i class="fa-solid fa-circle-xmark text-red-500"></i> Username sudah digunakan.';
                            usernameStatus.className = 'text-[10px] mt-1 block font-medium text-red-500';
                            usernameInput.classList.remove('border-green-300');
                            usernameInput.classList.add('border-red-300');
                            submitBtn.disabled = true;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }, doneTypingInterval);
        }

        // Fungsi untuk toggle lihat/sembunyikan password
        function togglePassword(fieldId, iconId) {
            const inputField = document.getElementById(fieldId);
            const iconElement = document.getElementById(iconId);

            if (inputField.type === 'password') {
                inputField.type = 'text';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            } else {
                inputField.type = 'password';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            }
        }

        // Fungsi Validasi Real-Time (Panjang, Kombinasi Huruf/Angka, dan Kecocokan)
        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            const reqLength = document.getElementById('req_length');
            const reqMix = document.getElementById('req_mix');
            const matchStatus = document.getElementById('match_status');
            const confirmInput = document.getElementById('password_confirmation');

            // Regex untuk cek minimal ada 1 huruf dan 1 angka
            const hasLetter = /[a-zA-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const isLengthValid = password.length >= 6;

            // Validasi Indikator Panjang Karakter
            if (password.length > 0) {
                if (isLengthValid) {
                    reqLength.className = 'text-green-600 flex items-center gap-1 font-medium';
                    reqLength.innerHTML = '<i class="fa-solid fa-check text-[10px]"></i> Minimal 6 karakter';
                } else {
                    reqLength.className = 'text-red-500 flex items-center gap-1 font-medium';
                    reqLength.innerHTML = '<i class="fa-solid fa-xmark text-[10px]"></i> Minimal 6 karakter';
                }
            } else {
                reqLength.className = 'text-gray-400 flex items-center gap-1 font-medium';
                reqLength.innerHTML = '<i class="fa-solid fa-circle text-[6px]"></i> Minimal 6 karakter';
            }

            // Validasi Indikator Kombinasi Huruf & Angka
            if (password.length > 0) {
                if (hasLetter && hasNumber) {
                    reqMix.className = 'text-green-600 flex items-center gap-1 font-medium';
                    reqMix.innerHTML = '<i class="fa-solid fa-check text-[10px]"></i> Mengandung huruf dan angka';
                } else {
                    reqMix.className = 'text-red-500 flex items-center gap-1 font-medium';
                    reqMix.innerHTML = '<i class="fa-solid fa-xmark text-[10px]"></i> Harus mengandung huruf dan angka';
                }
            } else {
                reqMix.className = 'text-gray-400 flex items-center gap-1 font-medium';
                reqMix.innerHTML = '<i class="fa-solid fa-circle text-[6px]"></i> Harus mengandung huruf dan angka';
            }

            // Cek Kecocokan Konfirmasi Password
            if (confirmPassword.length > 0) {
                matchStatus.classList.remove('hidden');
                if (password === confirmPassword) {
                    matchStatus.innerHTML = '<i class="fa-solid fa-circle-check text-green-500"></i> Password cocok!';
                    matchStatus.className = 'text-[10px] mt-1 block font-medium text-green-600';
                    confirmInput.classList.remove('border-red-300', 'focus:border-red-500');
                    confirmInput.classList.add('border-green-300', 'focus:border-green-500');
                } else {
                    matchStatus.innerHTML = '<i class="fa-solid fa-circle-xmark text-red-500"></i> Password tidak cocok!';
                    matchStatus.className = 'text-[10px] mt-1 block font-medium text-red-500';
                    confirmInput.classList.remove('border-green-300', 'focus:border-green-500');
                    confirmInput.classList.add('border-red-300', 'focus:border-red-500');
                }
            } else {
                matchStatus.classList.add('hidden');
                confirmInput.classList.remove('border-green-300', 'focus:border-green-500', 'border-red-300',
                    'focus:border-red-500');
            }
        }
    </script>
</x-dashboard-layout>
