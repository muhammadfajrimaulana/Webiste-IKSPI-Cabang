<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
@include('web.layout.header')

<body class="bg-slate-50 text-slate-800 antialiased">
    @include('web.layout.navbar')

    <main>
        @yield('content')
    </main>

    @include('web.layout.footer')

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        // Toggle menu utama di Mobile
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Logika Dropdown Universal (Desktop & Mobile)
        function toggleDropdown(event, id) {
            event.stopPropagation();
            const dropdown = document.getElementById(id);
            const currentIcon = event.currentTarget.querySelector('.fa-chevron-down');
            const isHidden = dropdown.classList.contains('hidden');

            // Tutup semua dropdown lain terlebih dahulu
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('.fa-chevron-down').forEach(icon => {
                icon.classList.remove('rotate-180');
            });

            // Jika sebelumnya tertutup, sekarang buka
            if (isHidden && dropdown) {
                dropdown.classList.remove('hidden');
                if (currentIcon) currentIcon.classList.add('rotate-180');
            }
        }

        // Menutup menu dan dropdown otomatis jika klik di luar area resmi komponen
        window.addEventListener('click', (e) => {
            if (mobileMenu && menuBtn) {
                if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            }
            if (!e.target.closest('.dropdown-container')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
                document.querySelectorAll('.fa-chevron-down').forEach(icon => icon.classList.remove('rotate-180'));
            }
        });

        // Slider Galeri (Aman & Kondisional jika elemen tersedia di halaman)
        const container = document.getElementById('slider-container');
        const prevBtn = document.getElementById('slide-prev');
        const nextBtn = document.getElementById('slide-next');

        if (container && prevBtn && nextBtn) {
            const getScrollAmount = () => {
                return container.firstElementChild ? container.firstElementChild.clientWidth + 16 : 300;
            };

            nextBtn.addEventListener('click', () => {
                container.scrollLeft += getScrollAmount();
            });

            prevBtn.addEventListener('click', () => {
                container.scrollLeft -= getScrollAmount();
            });
        }
    </script>
</body>

</html>
