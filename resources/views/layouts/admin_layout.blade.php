<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Admin Panel | e-Prakerin')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --color-primary-dark: #1e3a8a;
            --color-primary-light: #2563eb;
            --sidebar-width: 16rem; /* 64 (w-64) */
            --sidebar-collapsed-width: 5rem; /* 20 (w-20) */
        }

        /* Transisi Halus */
        .sidebar-transition {
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        /* Scrollbar Custom */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        /* Logic Sembunyikan Teks saat Collapsed */
        .collapsed .sidebar-text,
        .collapsed .sidebar-header-text {
            display: none;
        }
        .collapsed .sidebar-icon {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }
        .collapsed .sidebar-logo {
            width: 32px;
            height: 32px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased overflow-hidden">

    <div class="flex h-screen w-full">

        @include('admin.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative transition-all duration-300" id="main-content">

            <header class="bg-white shadow-sm z-20 min-h-[64px] sm:min-h-[72px] flex items-center justify-between px-3 sm:px-8 py-2 sticky top-0">

                <div class="flex items-center min-w-0 pr-2">
                    <button id="sidebar-toggle-btn" class="text-gray-600 focus:outline-none p-1.5 sm:p-2 rounded-md hover:bg-gray-100 transition shrink-0">
                        <i class="fas fa-bars text-base sm:text-xl"></i>
                    </button>
                    <h2 class="ml-2 sm:ml-5 text-sm sm:text-lg font-bold text-[--color-primary-dark] truncate">
                        @yield('page_title', 'Admin Dashboard')
                    </h2>
                </div>

                {{-- AREA PROFIL HEADER DENGAN DROPDOWN RUNDOWN (VERSI ADMIN) --}}
                <div class="relative shrink-0 my-auto" id="user-dropdown-wrapper">
                    {{-- Button Trigger Profil Admin --}}
                    <button type="button" onclick="toggleUserDropdown()" class="flex items-center gap-2.5 sm:gap-3.5 px-3 py-1.5 sm:px-4 sm:py-2 rounded-xl sm:rounded-2xl bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 hover:from-blue-800 hover:to-indigo-800 text-white border sm:border-2 border-blue-400/50 shadow-md sm:shadow-lg shadow-blue-900/30 hover:shadow-xl hover:shadow-blue-900/50 hover:border-white/80 transition-all duration-300 focus:outline-none cursor-pointer group transform hover:-translate-y-0.5">
                        
                        {{-- Wrapper Teks Nama & Role --}}
                        <div class="flex flex-col justify-center text-right select-none">
                            <div class="text-[11px] sm:text-sm font-black text-white group-hover:text-blue-100 transition-colors flex items-center justify-end gap-1.5">
                                <span class="truncate max-w-[120px] sm:max-w-[200px] leading-tight">{{ Auth::user()->name }}</span>
                                <span class="h-4 w-4 sm:h-5 sm:w-5 rounded-full bg-white/20 border border-white/40 group-hover:bg-white group-hover:text-blue-900 flex items-center justify-center transition-all duration-300 shrink-0 shadow-xs ml-0.5">
                                    <i class="fas fa-chevron-down text-[8px] sm:text-[9px] text-white group-hover:text-blue-900 transition-transform duration-300" id="dropdown-chevron"></i>
                                </span>
                            </div>
                            <div class="text-[8px] sm:text-[9px] text-amber-300 font-black tracking-wider uppercase mt-1 drop-shadow-xs truncate">{{ Auth::user()->role ?? 'ADMINISTRATOR' }}</div>
                        </div>

                        {{-- Avatar Icon Admin --}}
                        <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-lg sm:rounded-xl bg-white text-blue-900 font-black text-xs sm:text-base flex items-center justify-center shadow-md shadow-black/20 transform group-hover:scale-105 group-hover:rotate-3 transition duration-300 shrink-0 border sm:border-2 border-blue-200/80 relative my-auto">
                            {{ substr(Auth::user()->name, 0, 1) }}
                            {{-- Indikator Titik Aktif Menyala --}}
                            <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 sm:h-3 sm:w-3 bg-emerald-400 border border-slate-900 sm:border-2 rounded-full shadow-xs animate-pulse"></span>
                        </div>
                    </button>

                    {{-- MENU DROPDOWN RUNDOWN ADMIN --}}
                    <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 sm:mt-3 w-64 sm:w-70 bg-white rounded-xl sm:rounded-2xl shadow-2xl shadow-blue-950/40 border sm:border-2 border-blue-500/30 ring-2 sm:ring-4 ring-blue-500/10 py-0 z-50 transform origin-top-right transition-all duration-200 opacity-0 scale-95 overflow-hidden">
                        
                        {{-- Header Info Pengguna Admin --}}
                        <div class="px-3 py-2.5 sm:px-4 sm:py-3.5 bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-900 text-white border-b sm:border-b-2 border-blue-500/30 flex items-center gap-2.5 sm:gap-3 relative overflow-hidden">
                            <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-white/10 rounded-full blur-md pointer-events-none"></div>

                            <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-lg sm:rounded-xl bg-white text-blue-900 flex items-center justify-center font-black text-xs sm:text-sm shadow-lg shadow-black/20 shrink-0 border sm:border-2 border-white/90">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="min-w-0 flex-1 z-10">
                                <p class="text-[11px] sm:text-xs font-black text-white truncate leading-tight drop-shadow-xs">{{ Auth::user()->name }}</p>
                                <span class="inline-block mt-0.5 sm:mt-1 px-2 py-0.5 text-[8px] sm:text-[9px] font-black text-amber-900 bg-amber-300 border border-amber-200 rounded-full tracking-wider uppercase shadow-xs">{{ Auth::user()->role ?? 'ADMINISTRATOR' }}</span>
                            </div>
                        </div>

                        {{-- Daftar Item Rundown --}}
                        <div class="p-1.5 sm:p-2 space-y-1 sm:space-y-1.5 bg-slate-50">
                            {{-- Menu Halaman Profil --}}
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-2.5 py-2 sm:px-3.5 sm:py-3 rounded-lg sm:rounded-xl text-xs font-black text-slate-700 hover:bg-blue-700 hover:text-white border border-slate-200/80 hover:border-blue-600 shadow-2xs hover:shadow-md hover:shadow-blue-600/30 transition duration-200 gap-2.5 sm:gap-3.5 group">
                                <span class="h-7 w-7 sm:h-8 sm:w-8 bg-blue-100 text-blue-800 rounded-md sm:rounded-lg group-hover:bg-white group-hover:text-blue-700 transition duration-200 flex items-center justify-center shrink-0 shadow-xs border border-blue-200 group-hover:border-transparent">
                                    <i class="fas fa-id-card text-xs sm:text-sm group-hover:scale-110 transition-transform"></i>
                                </span>
                                <div class="flex flex-col">
                                    <span class="leading-none group-hover:text-white">Profil Saya</span>
                                    <span class="text-[8px] sm:text-[9px] font-bold text-slate-400 group-hover:text-blue-100 mt-0.5 sm:mt-1">Kelola data akun</span>
                                </div>
                            </a>

                            {{-- Menu Pop-up Logout --}}
                            <button type="button" onclick="triggerLogoutFromDropdown()" class="w-full flex items-center px-2.5 py-2 sm:px-3.5 sm:py-3 rounded-lg sm:rounded-xl text-xs font-black text-red-600 hover:bg-red-600 hover:text-white border border-red-100 hover:border-red-500 shadow-2xs hover:shadow-md hover:shadow-red-500/30 transition duration-200 gap-2.5 sm:gap-3.5 text-left group cursor-pointer">
                                <span class="h-7 w-7 sm:h-8 sm:w-8 bg-red-100 text-red-600 rounded-md sm:rounded-lg group-hover:bg-white group-hover:text-red-600 transition duration-200 flex items-center justify-center shrink-0 shadow-xs border border-red-200 group-hover:border-transparent">
                                    <i class="fas fa-sign-out-alt text-xs sm:text-sm group-hover:scale-110 transition-transform"></i>
                                </span>
                                <div class="flex flex-col">
                                    <span class="leading-none group-hover:text-white">Keluar</span>
                                    <span class="text-[8px] sm:text-[9px] font-bold text-red-400 group-hover:text-red-100 mt-0.5 sm:mt-1">Selesai sesi login</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 md:p-6 lg:p-8">

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                        <p class="font-bold">Sukses</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                        <p class="font-bold">Error</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden glass-effect" onclick="toggleSidebar()"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const overlay = document.getElementById('mobile-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle-btn');

        // Cek LocalStorage: Apakah user sebelumnya mengecilkan sidebar?
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';

        // Fungsi inisialisasi saat load
        function initSidebar() {
            if (window.innerWidth >= 1024) { // Desktop Mode
                if (isCollapsed) {
                    sidebar.classList.add('collapsed', 'w-20');
                    sidebar.classList.remove('w-64');
                } else {
                    sidebar.classList.remove('collapsed', 'w-20');
                    sidebar.classList.add('w-64');
                }
            } else { // Mobile Mode
                sidebar.classList.add('-translate-x-full'); // Sembunyi default
                sidebar.classList.remove('w-20', 'collapsed'); // Reset width
                sidebar.classList.add('w-64');
            }
        }

        // Jalankan saat load
        initSidebar();

        // Event Listener Tombol Toggle
        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth >= 1024) {
                // Logic Desktop: Toggle Width (Collapse)
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');
                sidebar.classList.toggle('collapsed');

                // Simpan preferensi user
                const collapsedState = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebar-collapsed', collapsedState);
            } else {
                // Logic Mobile: Toggle Slide (Off-canvas)
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        });

        // Resize Event (Biar responsif saat layar diputar/resize)
        window.addEventListener('resize', () => {
            initSidebar();
            if (window.innerWidth >= 1024) {
                overlay.classList.add('hidden'); // Hilangkan overlay di desktop
                sidebar.classList.remove('-translate-x-full'); // Pastikan sidebar muncul di desktop
            }
        });

        // --- PENANGANAN DROPDOWN PROFIL HEADER ADMIN ---
        function toggleUserDropdown() {
            const menu = document.getElementById('user-dropdown-menu');
            const chevron = document.getElementById('dropdown-chevron');
            
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.classList.remove('opacity-0', 'scale-95');
                    menu.classList.add('opacity-100', 'scale-100');
                }, 10);
                if(chevron) chevron.classList.add('rotate-180');
            } else {
                closeUserDropdown();
            }
        }

        function closeUserDropdown() {
            const menu = document.getElementById('user-dropdown-menu');
            const chevron = document.getElementById('dropdown-chevron');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.remove('opacity-100', 'scale-100');
                menu.classList.add('opacity-0', 'scale-95');
                if(chevron) chevron.classList.remove('rotate-180');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 200);
            }
        }

        function triggerLogoutFromDropdown() {
            closeUserDropdown();
            
            // Cek jika fungsi openLogoutModal() dari file sidebar.blade.php tersedia
            if (typeof openLogoutModal === 'function') {
                openLogoutModal();
            } else {
                // Pop-Up Konfirmasi Logout SweetAlert2 Bergaya Modern & Elegan
                Swal.fire({
                    html: `
                        <div class="p-2">
                            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-red-50">
                                <i class="fas fa-sign-out-alt text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-black text-gray-800 mb-1">Konfirmasi Keluar</h3>
                            <p class="text-xs text-gray-500">Apakah Anda yakin ingin mengakhiri sesi login ini?</p>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-sign-out-alt mr-2"></i>Ya, Keluar',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-2xl border-0 shadow-2xl',
                        confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-red-500/30 text-xs focus:outline-none cursor-pointer mx-1',
                        cancelButton: 'bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2.5 rounded-xl text-xs focus:outline-none cursor-pointer mx-1'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        const logoutForm = document.getElementById('logout-form');
                        if (logoutForm) {
                            logoutForm.submit();
                        } else {
                            // Fallback jika id form tidak dinamai logout-form
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = "{{ route('logout') }}";
                            
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = "{{ csrf_token() }}";
                            
                            form.appendChild(csrfToken);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    }
                });
            }
        }

        // Menutup Dropdown saat pengguna mengklik di luar area dropdown
        document.addEventListener('click', function(event) {
            const wrapper = document.getElementById('user-dropdown-wrapper');
            if (wrapper && !wrapper.contains(event.target)) {
                closeUserDropdown();
            }
        });
    </script>
</body>
</html>