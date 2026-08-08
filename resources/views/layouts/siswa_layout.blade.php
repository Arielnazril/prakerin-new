<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Panel Siswa | e-Prakerin')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <style>
        :root {
            /* Nuansa Emerald / Teal Hijau Segar */
            --color-primary-dark: #064e3b;
            --color-primary-light: #059669;
            --sidebar-width: 16rem;
            --sidebar-collapsed-width: 5rem;
        }
        .sidebar-transition { transition: width 0.3s ease-in-out, transform 0.3s ease-in-out; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        .collapsed .sidebar-text, .collapsed .sidebar-header-text { display: none; }
        .collapsed .sidebar-icon { margin-right: 0; text-align: center; width: 100%; }
        .collapsed .sidebar-logo { width: 32px; height: 32px; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased overflow-hidden">

    <div class="flex h-screen w-full">

        @include('siswa.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative transition-all duration-300" id="main-content">

            <header class="bg-white shadow-sm z-20 h-16 sm:h-20 flex items-center justify-between px-3 sm:px-8 py-2 sm:py-3 sticky top-0">
                <div class="flex items-center min-w-0">
                    <button id="sidebar-toggle-btn" class="text-gray-600 focus:outline-none p-1.5 sm:p-2 rounded-md hover:bg-gray-100 transition cursor-pointer shrink-0">
                        <i class="fas fa-bars text-base sm:text-xl"></i>
                    </button>
                    <h2 class="ml-2 sm:ml-5 text-sm sm:text-lg font-bold text-[--color-primary-dark] truncate">
                        @yield('page_title', 'Dashboard Siswa')
                    </h2>
                </div>

                {{-- AREA PROFIL HEADER DENGAN DROPDOWN RUNDOWN (ICON USER PUTIH BERSIH) --}}
                <div class="relative shrink-0 my-auto" id="user-dropdown-wrapper">
                    {{-- Button Trigger Profil - Responsif & Proporsional di Mobile --}}
                    <button type="button" onclick="toggleUserDropdown()" class="flex items-center gap-2 sm:gap-3.5 p-1.5 pl-3 pr-1.5 sm:p-2 sm:pl-4 sm:pr-2 rounded-xl sm:rounded-2xl bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 hover:from-emerald-500 hover:to-teal-600 text-white border sm:border-2 border-emerald-400/50 shadow-md sm:shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/50 hover:border-white/80 transition-all duration-300 focus:outline-none cursor-pointer group transform hover:-translate-y-0.5">
                        <div class="text-right select-none max-w-[90px] xs:max-w-[120px] sm:max-w-none">
                            <div class="text-[11px] sm:text-sm font-black text-white group-hover:text-emerald-100 transition-colors flex items-center justify-end gap-1 sm:gap-2">
                                <span class="truncate leading-tight">{{ Auth::user()->name }}</span>
                                <span class="h-3.5 w-3.5 sm:h-4 sm:w-4 rounded-full bg-white/20 border border-white/40 group-hover:bg-white group-hover:text-emerald-700 flex items-center justify-center transition-all duration-300 shrink-0 shadow-xs">
                                    <i class="fas fa-chevron-down text-[7px] sm:text-[8px] text-white group-hover:text-emerald-700 transition-transform duration-300" id="dropdown-chevron"></i>
                                </span>
                            </div>
                            <div class="text-[8px] sm:text-[9px] text-amber-300 font-black tracking-wider sm:tracking-widest uppercase mt-0.5 sm:mt-1 drop-shadow-xs truncate">SISWA MAGANG</div>
                        </div>

                        {{-- Avatar Icon - Warna Putih Bersih --}}
                        <div class="h-8 w-8 sm:h-11 sm:w-11 rounded-lg sm:rounded-xl bg-white text-emerald-700 font-black text-xs sm:text-base flex items-center justify-center shadow-md shadow-black/20 transform group-hover:scale-105 group-hover:rotate-3 transition duration-300 shrink-0 border sm:border-2 border-emerald-200/80 relative">
                            {{ substr(Auth::user()->name, 0, 1) }}
                            {{-- Indikator Titik Aktif Menyala --}}
                            <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 sm:h-3.5 sm:w-3.5 bg-emerald-400 border border-slate-900 sm:border-2 rounded-full shadow-xs animate-pulse"></span>
                        </div>
                    </button>

                    {{-- MENU DROPDOWN RUNDOWN (WARNA KONTRAS & POPPING) --}}
                    <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 sm:mt-3 w-64 sm:w-70 bg-white rounded-xl sm:rounded-2xl shadow-2xl shadow-emerald-950/40 border sm:border-2 border-emerald-500/30 ring-2 sm:ring-4 ring-emerald-500/10 py-0 z-50 transform origin-top-right transition-all duration-200 opacity-0 scale-95 overflow-hidden">
                        
                        {{-- Header Info Pengguna - Vibrant Emerald Gradient --}}
                        <div class="px-3 py-2.5 sm:px-4 sm:py-3.5 bg-gradient-to-br from-emerald-700 via-teal-700 to-emerald-900 text-white border-b sm:border-b-2 border-emerald-500/30 flex items-center gap-2.5 sm:gap-3 relative overflow-hidden">
                            {{-- Hiasan Aksesori Pattern --}}
                            <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-white/10 rounded-full blur-md pointer-events-none"></div>

                            {{-- Avatar Icon di Dropdown Header - Warna Putih --}}
                            <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-lg sm:rounded-xl bg-white text-emerald-800 flex items-center justify-center font-black text-xs sm:text-sm shadow-lg shadow-black/20 shrink-0 border sm:border-2 border-white/90">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="min-w-0 flex-1 z-10">
                                <p class="text-[11px] sm:text-xs font-black text-white truncate leading-tight drop-shadow-xs">{{ Auth::user()->name }}</p>
                                <span class="inline-block mt-0.5 sm:mt-1 px-2 py-0.5 text-[8px] sm:text-[9px] font-black text-amber-900 bg-amber-300 border border-amber-200 rounded-full tracking-wider uppercase shadow-xs">SISWA MAGANG</span>
                            </div>
                        </div>

                        {{-- Daftar Item Rundown --}}
                        <div class="p-1.5 sm:p-2 space-y-1 sm:space-y-1.5 bg-slate-50">
                            {{-- Menu Halaman Profil --}}
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-2.5 py-2 sm:px-3.5 sm:py-3 rounded-lg sm:rounded-xl text-xs font-black text-slate-700 hover:bg-emerald-600 hover:text-white border border-slate-200/80 hover:border-emerald-500 shadow-2xs hover:shadow-md hover:shadow-emerald-500/30 transition duration-200 gap-2.5 sm:gap-3.5 group">
                                <span class="h-7 w-7 sm:h-8 sm:w-8 bg-emerald-100 text-emerald-700 rounded-md sm:rounded-lg group-hover:bg-white group-hover:text-emerald-600 transition duration-200 flex items-center justify-center shrink-0 shadow-xs border border-emerald-200 group-hover:border-transparent">
                                    <i class="fas fa-id-card text-xs sm:text-sm group-hover:scale-110 transition-transform"></i>
                                </span>
                                <div class="flex flex-col">
                                    <span class="leading-none group-hover:text-white">Profil Saya</span>
                                    <span class="text-[8px] sm:text-[9px] font-bold text-slate-400 group-hover:text-emerald-100 mt-0.5 sm:mt-1">Kelola data akun</span>
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
                    <div class="mb-6 bg-emerald-50 border-l-4 border-[--color-primary-light] text-emerald-800 p-4 rounded-xl shadow-sm flex items-start gap-3">
                        <div class="bg-emerald-100 text-[--color-primary-light] p-1.5 rounded-lg shrink-0 mt-0.5">
                            <i class="fas fa-check-circle text-sm"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm">Sukses</p>
                            <p class="text-xs text-emerald-700/90 mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden glass-effect" onclick="toggleSidebar()"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';

        function initSidebar() {
            if (window.innerWidth >= 1024) {
                if (isCollapsed) {
                    sidebar.classList.add('collapsed', 'w-20');
                    sidebar.classList.remove('w-64');
                } else {
                    sidebar.classList.remove('collapsed', 'w-20');
                    sidebar.classList.add('w-64');
                }
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('w-20', 'collapsed');
                sidebar.classList.add('w-64');
            }
        }
        initSidebar();

        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
            } else {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        });

        window.addEventListener('resize', () => {
            initSidebar();
            if (window.innerWidth >= 1024) overlay.classList.add('hidden');
        });

        // --- PENANGANAN DROPDOWN PROFIL HEADER ---
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
            // Memanggil fungsi openLogoutModal() milik file sidebar.blade.php
            if (typeof openLogoutModal === 'function') {
                openLogoutModal();
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