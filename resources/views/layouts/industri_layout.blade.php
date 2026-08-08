<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Area Mentor | e-Prakerin')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    {{-- SweetAlert2 untuk Pop-up Logout Modern --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            /* Warna Mentor disesuaikan menjadi nuansa Hijau / Emerald Premium */
            --color-primary-dark: #064e3b; /* emerald-900 */
            --color-primary-light: #059669; /* emerald-600 */
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
<body class="bg-gray-50 text-gray-800 font-sans antialiased overflow-hidden">

    <div class="flex h-screen w-full">

        @include('industri.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative transition-all duration-300" id="main-content">

            {{-- HEADER / NAVBAR --}}
            <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 z-20 min-h-[64px] sm:min-h-[72px] flex items-center justify-between px-3 sm:px-6 py-2 sticky top-0">
                <div class="flex items-center min-w-0 pr-2">
                    <button id="sidebar-toggle-btn" class="text-gray-500 focus:outline-none p-1.5 sm:p-2 rounded-xl hover:bg-gray-100 text-gray-600 transition-all duration-200 active:scale-95 shrink-0">
                        <i class="fas fa-bars text-lg sm:text-xl"></i>
                    </button>
                    <h2 class="ml-2 sm:ml-4 text-sm sm:text-lg font-extrabold text-[--color-primary-dark] tracking-tight truncate">
                        @yield('page_title', 'Dashboard Mentor')
                    </h2>
                </div>

                {{-- USER PROFILE INFO WITH RUNDOWN DROPDOWN (VERSI INDUSTRI - EMERALD TEMA) --}}
                <div class="relative shrink-0 my-auto" id="user-dropdown-wrapper">
                    {{-- Button Trigger Profil Mentor --}}
                    <button type="button" onclick="toggleUserDropdown()" class="flex items-center gap-2.5 sm:gap-3.5 px-3 py-1.5 sm:px-4 sm:py-2 rounded-xl sm:rounded-2xl bg-gradient-to-r from-emerald-950 via-emerald-900 to-teal-950 hover:from-emerald-900 hover:to-teal-900 text-white border sm:border-2 border-emerald-400/40 shadow-md sm:shadow-lg shadow-emerald-950/20 hover:shadow-xl hover:shadow-emerald-950/40 hover:border-white/80 transition-all duration-300 focus:outline-none cursor-pointer group transform hover:-translate-y-0.5">
                        
                        {{-- Wrapper Teks Nama & Instansi --}}
                        <div class="flex flex-col justify-center text-right select-none">
                            <div class="text-[11px] sm:text-sm font-black text-white group-hover:text-emerald-100 transition-colors flex items-center justify-end gap-1.5">
                                <span class="truncate max-w-[120px] sm:max-w-[200px] leading-tight">{{ Auth::user()->name }}</span>
                                <span class="h-4 w-4 sm:h-5 sm:w-5 rounded-full bg-white/20 border border-white/40 group-hover:bg-white group-hover:text-emerald-950 flex items-center justify-center transition-all duration-300 shrink-0 shadow-xs ml-0.5">
                                    <i class="fas fa-chevron-down text-[8px] sm:text-[9px] text-white group-hover:text-emerald-950 transition-transform duration-300" id="dropdown-chevron"></i>
                                </span>
                            </div>
                            <div class="text-[8px] sm:text-[9px] text-emerald-200 font-extrabold tracking-wider uppercase mt-1 drop-shadow-xs truncate">
                                {{ Auth::user()->instansi->nama_perusahaan ?? 'Mentor Industri' }}
                            </div>
                        </div>

                        {{-- Avatar Icon Mentor --}}
                        <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-lg sm:rounded-xl bg-white text-emerald-950 font-black text-xs sm:text-base flex items-center justify-center shadow-md shadow-black/20 transform group-hover:scale-105 group-hover:rotate-3 transition duration-300 shrink-0 border sm:border-2 border-emerald-200/80 relative my-auto uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                            {{-- Indikator Status Online --}}
                            <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 sm:h-3 sm:w-3 bg-emerald-400 border border-slate-900 sm:border-2 rounded-full shadow-xs animate-pulse"></span>
                        </div>
                    </button>

                    {{-- MENU DROPDOWN RUNDOWN MENTOR --}}
                    <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 sm:mt-3 w-64 sm:w-70 bg-white rounded-xl sm:rounded-2xl shadow-2xl shadow-emerald-950/30 border sm:border-2 border-emerald-400/30 ring-2 sm:ring-4 ring-emerald-500/10 py-0 z-50 transform origin-top-right transition-all duration-200 opacity-0 scale-95 overflow-hidden">
                        
                        {{-- Header Info Pengguna Mentor --}}
                        <div class="px-3 py-2.5 sm:px-4 sm:py-3.5 bg-gradient-to-br from-emerald-950 via-emerald-900 to-teal-950 text-white border-b sm:border-b-2 border-emerald-400/30 flex items-center gap-2.5 sm:gap-3 relative overflow-hidden">
                            <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-white/10 rounded-full blur-md pointer-events-none"></div>

                            <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-lg sm:rounded-xl bg-white text-emerald-950 flex items-center justify-center font-black text-xs sm:text-sm shadow-lg shadow-black/20 shrink-0 border sm:border-2 border-white/90 uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="min-w-0 flex-1 z-10">
                                <p class="text-[11px] sm:text-xs font-black text-white truncate leading-tight drop-shadow-xs">{{ Auth::user()->name }}</p>
                                <span class="inline-block mt-0.5 sm:mt-1 px-2 py-0.5 text-[8px] sm:text-[9px] font-black text-emerald-950 bg-emerald-200 border border-emerald-100 rounded-full tracking-wider uppercase shadow-xs truncate max-w-full">
                                    {{ Auth::user()->instansi->nama_perusahaan ?? 'Mentor Industri' }}
                                </span>
                            </div>
                        </div>

                        {{-- Daftar Item Rundown --}}
                        <div class="p-1.5 sm:p-2 space-y-1 sm:space-y-1.5 bg-slate-50">
                            {{-- Menu Halaman Profil --}}
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-2.5 py-2 sm:px-3.5 sm:py-3 rounded-lg sm:rounded-xl text-xs font-black text-slate-700 hover:bg-emerald-700 hover:text-white border border-slate-200/80 hover:border-emerald-600 shadow-2xs hover:shadow-md hover:shadow-emerald-700/30 transition duration-200 gap-2.5 sm:gap-3.5 group">
                                <span class="h-7 w-7 sm:h-8 sm:w-8 bg-emerald-100 text-emerald-800 rounded-md sm:rounded-lg group-hover:bg-white group-hover:text-emerald-700 transition duration-200 flex items-center justify-center shrink-0 shadow-xs border border-emerald-200 group-hover:border-transparent">
                                    <i class="fas fa-id-card text-xs sm:text-sm group-hover:scale-110 transition-transform"></i>
                                </span>
                                <div class="flex flex-col">
                                    <span class="leading-none group-hover:text-white">Profil Saya</span>
                                    <span class="text-[8px] sm:text-[9px] font-bold text-slate-400 group-hover:text-emerald-100 mt-0.5 sm:mt-1">Kelola data profil mentor</span>
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

            {{-- MAIN CONTENT CONTAINER --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-6 lg:p-8 custom-scrollbar">
                @if(session('success'))
                    <div class="mb-5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-xl shadow-sm border border-emerald-100/80 animate-fadeIn flex flex-col gap-0.5">
                        <p class="font-bold text-sm tracking-tight">Sukses Berhasil</p>
                        <p class="text-xs text-emerald-700/90 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- SIDEBAR TOGGLE & DROPDOWN SCRIPT --}}
    <script>
        const sidebar = document.getElementById('sidebar');
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
            }
        });
        window.addEventListener('resize', initSidebar);

        // --- PENANGANAN DROPDOWN PROFIL & LOGOUT POP-UP MENTOR INDUSTRI ---
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
            
            // Pop-Up SweetAlert2 Konfirmasi Logout Mentor
            Swal.fire({
                html: `
                    <div class="p-2">
                        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-red-50">
                            <i class="fas fa-sign-out-alt text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-800 mb-1">Konfirmasi Keluar</h3>
                        <p class="text-xs text-gray-500">Apakah Anda yakin ingin mengakhiri sesi mentor industri ini?</p>
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
                        // Form logout otomatis jika belum dibuat di halaman
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

        // Menutup dropdown jika area luar di-klik
        document.addEventListener('click', function(event) {
            const wrapper = document.getElementById('user-dropdown-wrapper');
            if (wrapper && !wrapper.contains(event.target)) {
                closeUserDropdown();
            }
        });
    </script>
</body>
</html>