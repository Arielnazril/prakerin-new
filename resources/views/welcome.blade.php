<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Prakerin | Sistem Informasi Praktik Kerja Industri</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Inisialisasi Deteksi Tema Gelap (Mencegah Flashing Saat Load Page) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Aktifkan kelas Dark Mode Tailwind
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Figtree', 'sans-serif'],
                        figtree: ['Figtree', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1e3a8a', // Blue 900
                        secondary: '#2563eb', // Blue 600
                        accent: '#fbbf24', // Amber 400
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    },
                    animation: {
                        blob: 'blob 7s infinite',
                    }
                }
            }
        }
    </script>
    <style>
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        /* Smooth Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.05);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(37, 99, 235, 0.4);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(37, 99, 235, 0.7);
        }
    </style>
</head>

<body class="antialiased bg-slate-50/80 dark:bg-slate-950 font-sans selection:bg-blue-600 selection:text-white text-slate-800 dark:text-slate-100 overflow-x-hidden transition-colors duration-300">

    <!-- Scroll Progress Bar -->
    <div id="scroll-progress-bar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-amber-400 z-50 transition-all duration-150 w-0"></div>

    <!-- Top Sticky Header Wrapper -->
    <div class="fixed top-0 left-0 w-full z-40">
        <!-- Banner Info Live Status Sistem e-Prakerin -->
        <div class="bg-gradient-to-r from-slate-950 via-blue-950 to-indigo-950 text-white text-xs py-2 px-4 text-center font-semibold flex flex-wrap items-center justify-center gap-2 border-b border-blue-500/20 shadow-sm relative z-50">
            <span class="inline-flex items-center gap-1.5 bg-blue-500/20 text-blue-300 px-2.5 py-0.5 rounded-full border border-blue-400/30 text-[11px]">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                System Live Status
            </span>
            
            <span class="hidden sm:inline text-slate-200">Portal e-Prakerin SMK Al Madani Pontianak Berjalan Normal.</span>
            
            <!-- Tombol Simulasi Ber-Border Elegan -->
            <button id="btn-open-calc" class="inline-flex items-center gap-1.5 bg-slate-900/80 hover:bg-amber-400 text-amber-300 hover:text-slate-950 font-extrabold px-3 py-1 rounded-full border-2 border-amber-400/80 hover:border-amber-300 shadow-sm hover:shadow-md hover:shadow-amber-400/20 transition-all duration-300 active:scale-95 cursor-pointer ml-2 text-[11px]">
                <i class="fas fa-calculator text-xs"></i> Simulasi Jam Prakerin
            </button>
        </div>

        <!-- Navigasi Premium -->
        <nav class="bg-white/85 dark:bg-slate-900/85 backdrop-blur-2xl shadow-md shadow-slate-200/50 dark:shadow-slate-950/50 border-b border-slate-200/60 dark:border-slate-800/80 w-full transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    
                    <!-- Logo & Brand -->
                    <a href="#" class="flex items-center gap-3.5 group cursor-pointer shrink-0">
                        <div class="relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl blur-md opacity-0 group-hover:opacity-70 transition duration-500"></div>
                            <div class="relative bg-gradient-to-tr from-blue-50 via-indigo-50 to-white dark:from-slate-800 dark:via-slate-800 dark:to-slate-900 p-2 rounded-2xl border border-blue-100/80 dark:border-slate-700/80 shadow-sm transform group-hover:scale-105 transition duration-300">
                                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-10 w-10 sm:h-11 sm:w-11 object-contain">
                            </div>
                        </div>
                        <div>
                            <h1 class="text-lg sm:text-xl font-black text-primary dark:text-blue-400 tracking-tight leading-none group-hover:text-secondary transition duration-300">e-Prakerin</h1>
                            <p class="text-[9px] sm:text-[10px] text-slate-400 dark:text-slate-500 font-extrabold tracking-widest mt-1">SMK S AL MADANI KOTA PONTIANAK</p>
                        </div>
                    </a>

                    <!-- Desktop Menu Buttons -->
                    <div class="hidden md:flex items-center gap-3.5">
                        <!-- Tombol Pencarian Cepat -->
                        <button id="btn-open-search" class="px-3.5 py-2.5 rounded-xl bg-slate-100/80 dark:bg-slate-800/80 text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-blue-400 hover:bg-slate-200/60 border border-slate-200/80 dark:border-slate-700/80 transition-all duration-300 active:scale-95 flex items-center gap-2 text-xs font-bold shadow-xs">
                            <i class="fas fa-search text-slate-400"></i>
                            <span class="hidden lg:inline text-slate-500 dark:text-slate-400">Cari Info...</span>
                        </button>

                        <!-- Tombol Dark Mode Switcher (Desktop) -->
                        <button id="theme-toggle" type="button" class="p-2.5 rounded-xl bg-slate-100/80 dark:bg-slate-800/80 text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-amber-400 border border-slate-200/80 dark:border-slate-700/80 transition-all duration-300 active:scale-95 shadow-xs" aria-label="Toggle Dark Mode">
                            <i id="theme-toggle-dark-icon" class="fas fa-moon hidden text-base"></i>
                            <i id="theme-toggle-light-icon" class="fas fa-sun hidden text-base text-amber-400"></i>
                        </button>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-bold text-sm text-slate-700 dark:text-slate-200 hover:text-primary dark:hover:text-blue-400 transition-all duration-200 flex items-center gap-2 bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200/80 dark:hover:bg-slate-700/80 px-5 py-2.5 rounded-xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs active:scale-95">
                                    <i class="fas fa-columns text-xs text-slate-400 dark:text-slate-500"></i> Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-blue-400 text-sm font-bold transition-colors duration-200 px-4 py-2.5 rounded-xl hover:bg-slate-100/60 dark:hover:bg-slate-800/60">
                                    Masuk
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-bold rounded-xl group bg-gradient-to-r from-primary via-secondary to-indigo-600 group-hover:from-primary group-hover:to-indigo-600 text-white shadow-md shadow-blue-900/20 hover:shadow-xl hover:shadow-blue-900/30 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0">
                                        <span class="relative px-6 py-2.5 transition-all ease-in duration-75 rounded-xl bg-transparent">
                                            Daftar Siswa
                                        </span>
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <!-- Mobile Menu Toggle Button & Theme Switcher -->
                    <div class="flex items-center gap-2 md:hidden">
                        <button id="btn-open-search-mobile" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-primary border border-slate-200 dark:border-slate-700 transition-all duration-300">
                            <i class="fas fa-search text-base"></i>
                        </button>

                        <!-- Tombol Dark Mode Switcher (Mobile) -->
                        <button id="theme-toggle-mobile" type="button" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-amber-400 border border-slate-200 dark:border-slate-700 transition-all duration-300">
                            <i id="theme-toggle-dark-icon-mobile" class="fas fa-moon hidden text-base"></i>
                            <i id="theme-toggle-light-icon-mobile" class="fas fa-sun hidden text-base text-amber-400"></i>
                        </button>

                        <button id="mobile-menu-btn" type="button" class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-blue-400 focus:outline-none p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                            <i id="hamburger-icon" class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="hidden md:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 animate-fadeIn transition-all duration-300">
                <div class="px-4 pt-3 pb-6 space-y-3 shadow-inner">
                    <button id="btn-open-calc-mobile" class="w-full text-left font-bold text-sm text-blue-600 dark:text-blue-400 py-2.5 px-3 rounded-xl bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-900 flex items-center justify-between">
                        <span><i class="fas fa-calculator mr-2"></i> Simulasi Jam Prakerin</span>
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full font-bold text-sm text-slate-700 dark:text-slate-200 hover:text-primary dark:hover:text-blue-400 transition-colors duration-200 flex items-center justify-center gap-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-3 rounded-xl border border-slate-200/80 dark:border-slate-700">
                                <i class="fas fa-columns text-xs text-slate-400 dark:text-slate-500"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block text-center text-slate-700 dark:text-slate-200 hover:text-primary dark:hover:text-blue-400 text-sm font-bold transition-colors duration-200 py-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 border border-slate-100 dark:border-slate-800">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block text-center bg-gradient-to-r from-primary to-blue-800 text-white text-sm py-3 rounded-xl font-bold shadow-md shadow-blue-900/10">
                                    Daftar Siswa
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </div>

    <!-- Hero Section dengan Efek Dekoratif Modis -->
    <div class="relative bg-gradient-to-b from-white via-blue-50/30 to-slate-100/60 dark:from-slate-950 dark:via-slate-900/50 dark:to-slate-950 pt-44 pb-24 lg:pt-52 lg:pb-36 overflow-hidden border-b border-slate-200/60 dark:border-slate-800/80">
        <!-- Background Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <span class="bg-gradient-to-r from-blue-50 via-indigo-50 to-sky-50 dark:from-blue-950/70 dark:via-indigo-950/70 dark:to-slate-900 text-blue-700 dark:text-blue-300 text-[11px] font-extrabold px-4 py-2 rounded-full uppercase tracking-widest mb-6 inline-flex items-center border border-blue-200/80 dark:border-blue-800/60 shadow-sm backdrop-blur-sm">
                    <span class="relative flex h-2 w-2 mr-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    Tahun Ajaran 2026/2027
                </span>
                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 dark:text-white tracking-tight mb-6 leading-[1.12]">
                    Kelola Kegiatan Magang <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-indigo-600 dark:from-blue-400 dark:via-indigo-400 dark:to-cyan-400">Lebih Mudah & Modern</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-400 mb-10 leading-relaxed max-w-2xl mx-auto font-medium">
                    Platform terintegrasi yang menghubungkan Siswa, Guru Pembimbing, dan Mentor Industri untuk pemantauan kegiatan Prakerin yang efisien, transparan, dan real-time.
                </p>
                <div class="flex flex-col sm:flex-row gap-3.5 justify-center items-center w-full max-w-2xl mx-auto">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary to-blue-800 text-white rounded-2xl font-extrabold shadow-xl shadow-blue-900/20 hover:shadow-2xl hover:shadow-blue-900/30 hover:from-blue-900 hover:to-indigo-900 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2.5 tracking-wide text-sm">
                            <i class="fas fa-tachometer-alt text-xs opacity-80"></i> Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-7 py-3.5 bg-gradient-to-r from-primary to-blue-800 text-white rounded-xl font-bold shadow-xl shadow-blue-900/20 hover:shadow-2xl hover:shadow-blue-900/30 hover:from-blue-900 hover:to-indigo-900 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 text-sm">
                            <i class="fas fa-sign-in-alt text-xs opacity-80"></i> Masuk Sekarang
                        </a>
                        <a href="#fitur" class="w-full sm:w-auto px-7 py-3.5 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 border border-slate-200/80 dark:border-slate-800 rounded-xl font-bold hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white shadow-xs transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                            Pelajari Lebih Lanjut
                        </a>
                        <a href="{{ asset('dokumen/panduan_prakerin.pdf') }}"
                        class="w-full sm:w-auto px-7 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold
                                hover:from-blue-700 hover:to-indigo-700 active:from-blue-800 active:to-indigo-800
                                shadow-md shadow-blue-600/15 hover:shadow-lg hover:shadow-blue-600/25
                                transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 text-sm"
                        target="_blank">
                            <i class="fas fa-file-pdf text-xs opacity-80"></i> Panduan Kerja Praktek
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Efek Blur Latar Belakang Eksklusif -->
        <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full z-0 pointer-events-none opacity-50 dark:opacity-30">
            <div class="absolute top-10 left-10 w-96 h-96 bg-blue-400/30 dark:bg-blue-600/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob"></div>
            <div class="absolute top-20 right-10 w-96 h-96 bg-purple-300/30 dark:bg-purple-600/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-4 left-1/3 w-96 h-96 bg-sky-300/30 dark:bg-cyan-600/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>
    </div>

    <!-- Section Fitur Utama -->
    <div id="fitur" class="py-24 bg-slate-50/70 dark:bg-slate-950 scroll-mt-20 border-b border-slate-200/60 dark:border-slate-800/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 max-w-xl mx-auto">
                <span class="text-xs font-black tracking-widest text-secondary dark:text-blue-400 uppercase bg-blue-50 dark:bg-blue-950/60 px-3.5 py-1.5 rounded-full border border-blue-100 dark:border-blue-900 shadow-xs">Ekosistem Terpadu</span>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight sm:text-4xl mt-3">Solusi Untuk Semua Pihak</h2>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full mx-auto mt-4 mb-3"></div>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Satu aplikasi untuk mengintegrasikan seluruh proses magang.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10">
                <!-- Card Siswa -->
                <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md p-8 rounded-3xl shadow-sm border border-slate-200/80 dark:border-slate-800 hover:shadow-2xl hover:shadow-blue-500/10 hover:border-blue-500/30 transition-all duration-300 transform hover:-translate-y-2 group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-2 h-full bg-blue-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <div>
                        <div class="w-14 h-14 bg-gradient-to-tr from-blue-50 to-indigo-50 dark:from-slate-800 dark:to-slate-800 border border-blue-100 dark:border-slate-700 rounded-2xl flex items-center justify-center text-primary dark:text-blue-400 text-2xl mb-8 group-hover:bg-primary group-hover:text-white dark:group-hover:bg-blue-600 dark:group-hover:text-white transition-all duration-300 shadow-md shadow-blue-900/5 group-hover:scale-110">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3.5 tracking-tight group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">Untuk Siswa</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed font-medium">
                            Isi logbook harian digital, pantau kehadiran, dan lihat transkrip nilai langsung dari dashboard siswa yang responsif.
                        </p>
                    </div>
                </div>

                <!-- Card Guru -->
                <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md p-8 rounded-3xl shadow-sm border border-slate-200/80 dark:border-slate-800 hover:shadow-2xl hover:shadow-green-500/10 hover:border-green-500/30 transition-all duration-300 transform hover:-translate-y-2 group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-2 h-full bg-green-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <div>
                        <div class="w-14 h-14 bg-gradient-to-tr from-green-50 to-emerald-50 dark:from-slate-800 dark:to-slate-800 border border-green-100 dark:border-slate-700 rounded-2xl flex items-center justify-center text-green-600 dark:text-green-400 text-2xl mb-8 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 shadow-md shadow-green-900/5 group-hover:scale-110">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3.5 tracking-tight group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">Untuk Guru</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed font-medium">
                            Monitoring aktivitas siswa bimbingan secara real-time, validasi laporan, dan input nilai akademik dengan mudah.
                        </p>
                    </div>
                </div>

                <!-- Card Industri -->
                <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md p-8 rounded-3xl shadow-sm border border-slate-200/80 dark:border-slate-800 hover:shadow-2xl hover:shadow-purple-500/10 hover:border-purple-500/30 transition-all duration-300 transform hover:-translate-y-2 group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <div>
                        <div class="w-14 h-14 bg-gradient-to-tr from-purple-50 to-fuchsia-50 dark:from-slate-800 dark:to-slate-800 border border-purple-100 dark:border-slate-700 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400 text-2xl mb-8 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 shadow-md shadow-purple-900/5 group-hover:scale-110">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3.5 tracking-tight group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Untuk Industri</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed font-medium">
                            Mentor lapangan dapat memvalidasi logbook, memberikan feedback, dan menilai kinerja teknis & non-teknis siswa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FITUR TAMBAHAN 1: Section Alur Kerja Praktik Industri -->
    <div id="alur" class="py-24 bg-white dark:bg-slate-900 border-b border-slate-200/60 dark:border-slate-800/80 relative scroll-mt-20 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 max-w-xl mx-auto">
                <span class="text-xs font-black tracking-widest text-secondary dark:text-blue-400 uppercase bg-blue-50 dark:bg-blue-950/60 px-3.5 py-1.5 rounded-full border border-blue-100 dark:border-blue-900 shadow-xs">Tahapan Digital</span>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight sm:text-4xl mt-3">Alur Kerja Praktik Industri</h2>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full mx-auto mt-4 mb-3"></div>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Langkah-langkah terstruktur pelaksanaan e-Prakerin</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="bg-slate-50 dark:bg-slate-950/60 p-6 rounded-2xl border border-slate-200/70 dark:border-slate-800 hover:border-blue-300 dark:hover:border-blue-600 transition-all text-center relative group">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-xl font-extrabold flex items-center justify-center mx-auto mb-4 text-lg shadow-lg shadow-blue-600/20 group-hover:scale-110 transition-transform">1</div>
                    <h4 class="font-extrabold text-slate-900 dark:text-white mb-2">Pendaftaran & Ploting</h4>
                    <p class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed">Siswa mendaftar dan ditentukan tempat magang serta guru pembimbingnya.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-slate-50 dark:bg-slate-950/60 p-6 rounded-2xl border border-slate-200/70 dark:border-slate-800 hover:border-blue-300 dark:hover:border-blue-600 transition-all text-center relative group">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-xl font-extrabold flex items-center justify-center mx-auto mb-4 text-lg shadow-lg shadow-blue-600/20 group-hover:scale-110 transition-transform">2</div>
                    <h4 class="font-extrabold text-slate-900 dark:text-white mb-2">Logbook & Presensi</h4>
                    <p class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed">Siswa mengisi kegiatan harian dan absen mandiri melalui sistem.</p>
                </div>
                <!-- Step 3 -->
                <div class="bg-slate-50 dark:bg-slate-950/60 p-6 rounded-2xl border border-slate-200/70 dark:border-slate-800 hover:border-blue-300 dark:hover:border-blue-600 transition-all text-center relative group">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-xl font-extrabold flex items-center justify-center mx-auto mb-4 text-lg shadow-lg shadow-blue-600/20 group-hover:scale-110 transition-transform">3</div>
                    <h4 class="font-extrabold text-slate-900 dark:text-white mb-2">Monitoring & Evaluasi</h4>
                    <p class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed">Guru & Mentor memantau perkembangan dan memberikan respon berkala.</p>
                </div>
                <!-- Step 4 -->
                <div class="bg-slate-50 dark:bg-slate-950/60 p-6 rounded-2xl border border-slate-200/70 dark:border-slate-800 hover:border-blue-300 dark:hover:border-blue-600 transition-all text-center relative group">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-xl font-extrabold flex items-center justify-center mx-auto mb-4 text-lg shadow-lg shadow-blue-600/20 group-hover:scale-110 transition-transform">4</div>
                    <h4 class="font-extrabold text-slate-900 dark:text-white mb-2">Penilaian & Sertifikat</h4>
                    <p class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed">Penilaian akhir dari pihak industri dan diterbitkannya transkrip magang.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Statistik Premium -->
    <div class="py-20 bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-950 text-white relative overflow-hidden shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8 text-center">
                <div class="bg-white/5 border border-white/10 p-7 rounded-3xl backdrop-blur-md shadow-2xl shadow-black/30 transition duration-300 hover:bg-white/10 hover:border-white/20 hover:scale-105 group">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight group-hover:scale-105 transition-transform counter-number" data-target="50" data-suffix="+">0</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-extrabold tracking-wider uppercase">Siswa Magang</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-7 rounded-3xl backdrop-blur-md shadow-2xl shadow-black/30 transition duration-300 hover:bg-white/10 hover:border-white/20 hover:scale-105 group">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight group-hover:scale-105 transition-transform counter-number" data-target="10" data-suffix="+">0</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-extrabold tracking-wider uppercase">Mitra Industri</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-7 rounded-3xl backdrop-blur-md shadow-2xl shadow-black/30 transition duration-300 hover:bg-white/10 hover:border-white/20 hover:scale-105 group">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight group-hover:scale-105 transition-transform counter-number" data-target="100" data-suffix="%">0</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-extrabold tracking-wider uppercase">Digital Logbook</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-7 rounded-3xl backdrop-blur-md shadow-2xl shadow-black/30 transition duration-300 hover:bg-white/10 hover:border-white/20 hover:scale-105 group">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight group-hover:scale-105 transition-transform">24/7</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-extrabold tracking-wider uppercase">Akses Sistem</div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
    </div>

    <!-- FITUR TAMBAHAN 2: FAQ Accordion Section -->
    <div id="faq" class="py-24 bg-slate-50 dark:bg-slate-950 border-b border-slate-200/60 dark:border-slate-800/80 scroll-mt-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs font-black tracking-widest text-secondary dark:text-blue-400 uppercase bg-blue-50 dark:bg-blue-950/60 px-3.5 py-1.5 rounded-full border border-blue-100 dark:border-blue-900">Bantuan</span>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mt-3">Pertanyaan Sering Diajukan</h2>
            </div>

            <div class="space-y-4">
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 overflow-hidden shadow-xs hover:border-blue-300 transition duration-200">
                    <button class="faq-btn w-full p-5 text-left font-bold text-slate-800 dark:text-slate-200 flex justify-between items-center focus:outline-none">
                        <span>Bagaimana cara mengisi jurnal logbook harian?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform duration-200"></i>
                    </button>
                    <div class="faq-answer hidden px-5 pb-5 text-sm text-slate-600 dark:text-slate-400 font-medium leading-relaxed border-t border-slate-100 dark:border-slate-800/50 pt-3">
                        Siswa dapat masuk ke akun masing-masing, memilih menu "Jurnal Harian", lalu menambah catatan aktivitas pekerjaan beserta unggah foto bukti kegiatan magang.
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 overflow-hidden shadow-xs hover:border-blue-300 transition duration-200">
                    <button class="faq-btn w-full p-5 text-left font-bold text-slate-800 dark:text-slate-200 flex justify-between items-center focus:outline-none">
                        <span>Bagaimana jika lupa kata sandi akun?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform duration-200"></i>
                    </button>
                    <div class="faq-answer hidden px-5 pb-5 text-sm text-slate-600 dark:text-slate-400 font-medium leading-relaxed border-t border-slate-100 dark:border-slate-800/50 pt-3">
                        Anda dapat menghubungi tim Admin Kurikulum/Prakerin sekolah atau Guru Pembimbing untuk melakukan reset kata sandi akun Anda.
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 overflow-hidden shadow-xs hover:border-blue-300 transition duration-200">
                    <button class="faq-btn w-full p-5 text-left font-bold text-slate-800 dark:text-slate-200 flex justify-between items-center focus:outline-none">
                        <span>Apakah e-Prakerin bisa diakses melalui smartphone?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform duration-200"></i>
                    </button>
                    <div class="faq-answer hidden px-5 pb-5 text-sm text-slate-600 dark:text-slate-400 font-medium leading-relaxed border-t border-slate-100 dark:border-slate-800/50 pt-3">
                        Ya, tampilan aplikasi e-Prakerin telah dirancang responsif dan nyaman digunakan pada perangkat smartphone, tablet, maupun komputer desktop.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Cantik & Profesional -->
    <footer class="bg-gradient-to-br from-slate-950 via-blue-950 via-slate-900 to-indigo-950 border-t border-blue-500/30 pt-16 pb-12 transition-all duration-300 relative overflow-hidden select-none">
        
        <!-- Ornamen Ambient Glow Neon (Estetika Premium Sisi Kiri & Kanan) -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500/15 rounded-full filter blur-[100px] pointer-events-none animate-pulse"></div>
        <div class="absolute -bottom-20 -left-20 w-[500px] h-[500px] bg-indigo-500/10 rounded-full filter blur-[120px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- BAGIAN 1: GRID UTAMA UTK INFORMASI & KARTU UTAMA -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800/60 items-start">
                
                <!-- Branding Utama (Kolom Kiri - Lebar 5 Grid) -->
                <div class="lg:col-span-5 space-y-5 text-center lg:text-left flex flex-col items-center lg:items-start">
                    <div class="flex items-center gap-4 group">
                        <div class="bg-gradient-to-tr from-white to-blue-50 rounded-2xl p-2.5 shadow-xl shadow-blue-500/10 border border-blue-400/30 transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-300">
                            <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-14 w-14 rounded-xl object-contain">
                        </div>
                        <div class="space-y-0.5 text-left">
                            <p class="text-white font-black text-2xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white via-blue-100 to-blue-300">e-Prakerin</p>
                            <p class="text-blue-400 text-[10px] tracking-widest font-extrabold uppercase">
                                SMK AL MADANI PONTIANAK
                            </p>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed max-w-md font-medium">
                        Platform e-Prakerin memfasilitasi kolaborasi siswa, guru, dan mitra industri dalam pelaksanaan Praktik Kerja Industri yang terarah, terukur, dan profesional.
                    </p>
                </div>

                <!-- Kartu Informasi Alamat & Website (Kolom Kanan - Lebar 7 Grid) -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5 w-full">
                    <!-- Kontak Alamat (Premium Neon Effect) -->
                    <div class="flex items-start gap-4 bg-slate-900/60 backdrop-blur-md p-5 rounded-2xl border border-slate-800/80 shadow-xl shadow-black/20 hover:border-blue-500/40 hover:bg-slate-900/90 transition-all duration-300 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500/20 to-indigo-500/20 text-blue-400 flex items-center justify-center shrink-0 border border-blue-500/20 group-hover:scale-110 transition duration-300">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </div>
                        <div class="space-y-1 text-left">
                            <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase">Alamat Sekolah</p>
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-semibold">
                                Jalan Sungai Raya Dalam Komp. Mitra Utama III No. 16 B
                            </p>
                        </div>
                    </div>

                    <!-- Kontak Website (Interactive Link) -->
                    <a href="https://smkalmadaniptk.sch.id" target="_blank" class="flex items-start gap-4 bg-slate-900/60 backdrop-blur-md p-5 rounded-2xl border border-slate-800/80 shadow-xl shadow-black/20 hover:border-blue-400/50 hover:bg-slate-900/90 transition-all duration-300 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500/20 to-blue-500/20 text-cyan-400 flex items-center justify-center shrink-0 border border-cyan-500/20 group-hover:bg-gradient-to-br group-hover:from-blue-500 group-hover:to-cyan-400 group-hover:text-white transition-all duration-300 shadow-lg shadow-cyan-500/10">
                            <i class="fas fa-globe text-sm"></i>
                        </div>
                        <div class="space-y-1 text-left">
                            <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase">Website Resmi</p>
                            <p class="text-xs sm:text-sm text-slate-300 group-hover:text-cyan-400 font-bold transition duration-200 break-all">
                                smkalmadaniptk.sch.id
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- BAGIAN 2: SOSIAL MEDIA & COPYRIGHT BARIS BAWAH -->
            <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-6">
                
                <!-- Tombol Sosial Media (Desain Pil Mengambang Kontras Tinggi) -->
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 order-2 md:order-1">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/smkalmadaniptk_official" target="_blank"
                    class="flex items-center gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-purple-900/30 hover:to-pink-900/20 py-2.5 pl-2.5 pr-4 rounded-xl border border-slate-800 hover:border-pink-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-amber-500 via-red-500 to-purple-600 shadow-md flex items-center justify-center transform group-hover:rotate-12 transition-all duration-300">
                            <i class="fab fa-instagram text-white text-sm"></i>
                        </div>
                        <span class="text-xs text-slate-300 group-hover:text-pink-400 font-bold tracking-wide transition-colors">
                            @smkalmadaniptk_official
                        </span>
                    </a>

                    <!-- Gmail -->
                    <a href="mailto:smks.almadaniptk@gmail.com" 
                       class="flex items-center gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-red-900/30 hover:to-orange-900/20 py-2.5 pl-2.5 pr-4 rounded-xl border border-slate-800 hover:border-red-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-red-600 to-amber-500 shadow-md flex items-center justify-center transform group-hover:-rotate-12 transition-all duration-300">
                            <i class="fas fa-envelope text-white text-xs"></i>
                        </div>
                        <span class="text-xs text-slate-300 group-hover:text-red-400 font-bold tracking-wide transition-colors">
                            smks.almadaniptk@gmail.com
                        </span>
                    </a>
                </div>

                <!-- Copyright Text -->
                <p class="text-xs text-slate-500 font-semibold text-center md:text-right order-1 md:order-2">
                    &copy; {{ date('Y') }} <span class="text-slate-300 font-bold">SMK Al Madani Pontianak</span>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- FITUR TAMBAHAN JS: Modal Kalkulator Jam PKL (Interactive JS Component) -->
    <div id="calc-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300 p-4">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 w-full max-w-md rounded-3xl p-6 shadow-2xl transform scale-95 transition-transform duration-300 relative">
            <button id="btn-close-calc" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-white p-2">
                <i class="fas fa-times text-lg"></i>
            </button>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                    <i class="fas fa-calculator text-lg"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 dark:text-white">Simulasi Jam Kerja Prakerin</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Hitung estimasi total akumulasi jam magang</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 dark:text-slate-300 mb-1">Durasi Magang (Bulan)</label>
                    <input type="number" id="calc-months" value="3" min="1" max="12" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-3 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 dark:text-slate-300 mb-1">Jam Kerja per Hari</label>
                    <input type="number" id="calc-hours" value="8" min="1" max="12" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-3 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="p-4 bg-blue-50 dark:bg-blue-950/50 rounded-2xl border border-blue-100 dark:border-blue-900 text-center">
                    <span class="text-xs text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider block">Estimasi Total Akumulasi</span>
                    <span id="calc-result" class="text-3xl font-black text-blue-900 dark:text-blue-200">528 Jam</span>
                    <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-1">*Berdasarkan asumsi 22 hari kerja aktif/bulan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FITUR TAMBAHAN JS: Modal Pencarian Cepat (Live Search JS Component) -->
    <div id="search-modal" class="fixed inset-0 z-50 flex items-start justify-center bg-slate-950/70 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300 p-4 pt-20">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 w-full max-w-xl rounded-3xl p-6 shadow-2xl transform -translate-y-4 transition-transform duration-300 relative">
            <div class="flex items-center gap-3 border-b border-slate-200 dark:border-slate-800 pb-3">
                <i class="fas fa-search text-slate-400"></i>
                <input type="text" id="search-input" placeholder="Cari info logbook, alur, FAQ, atau jurusan..." class="w-full bg-transparent text-sm font-bold text-slate-800 dark:text-white focus:outline-none">
                <button id="btn-close-search" class="text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-500 px-2.5 py-1 rounded-lg">ESC</button>
            </div>
            <div id="search-results" class="mt-4 max-h-60 overflow-y-auto space-y-2 text-xs">
                <p class="text-slate-400 text-center py-4">Ketik kata kunci untuk memulai pencarian...</p>
            </div>
        </div>
    </div>

    <!-- FITUR TAMBAHAN 3: Floating Back To Top Button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 z-40 bg-primary/90 dark:bg-blue-600/90 text-white p-3.5 rounded-2xl shadow-xl hover:bg-secondary transition-all duration-300 opacity-0 pointer-events-none transform translate-y-4">
        <i class="fas fa-arrow-up text-sm"></i>
    </button>

    <!-- Script Interaktif untuk Fitur Landing Page & Dark Mode -->
    <script>
        // --- 1. DARK / LIGHT MODE SWITCHING LOGIC ---
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        const themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');
        const themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
        const themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

        function updateIcons() {
            if (document.documentElement.classList.contains('dark')) {
                themeToggleDarkIcon.classList.add('hidden');
                themeToggleLightIcon.classList.remove('hidden');
                if (themeToggleDarkIconMobile) {
                    themeToggleDarkIconMobile.classList.add('hidden');
                    themeToggleLightIconMobile.classList.remove('hidden');
                }
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
                themeToggleLightIcon.classList.add('hidden');
                if (themeToggleDarkIconMobile) {
                    themeToggleDarkIconMobile.classList.remove('hidden');
                    themeToggleLightIconMobile.classList.add('hidden');
                }
            }
        }

        // Jalankan saat pertama kali halaman dimuat
        updateIcons();

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
            updateIcons();
        }

        if (themeToggleBtn) themeToggleBtn.addEventListener('click', toggleTheme);
        if (themeToggleBtnMobile) themeToggleBtnMobile.addEventListener('click', toggleTheme);

        // --- 2. TOGGLE MOBILE MENU ---
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');

        if(mobileBtn) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('fa-bars');
                hamburgerIcon.classList.toggle('fa-xmark');
            });
        }

        // --- 3. FAQ ACCORDION TOGGLE ---
        const faqBtns = document.querySelectorAll('.faq-btn');
        faqBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const answer = btn.nextElementSibling;
                const icon = btn.querySelector('i');
                
                answer.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        // --- 4. FLOATING BACK TO TOP BUTTON & SCROLL PROGRESS BAR ---
        const backToTopBtn = document.getElementById('back-to-top');
        const progressBar = document.getElementById('scroll-progress-bar');

        window.addEventListener('scroll', () => {
            // Back to Top Button Visibility
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                backToTopBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                backToTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                backToTopBtn.classList.remove('opacity-100', 'translate-y-0');
            }

            // Scroll Progress Calculation
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            if (progressBar) progressBar.style.width = scrolled + "%";
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // --- 5. ANIMATED COUNTER UP UNTUK STATISTIK ---
        const counters = document.querySelectorAll('.counter-number');
        let animated = false;

        const animateCounters = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const suffix = counter.getAttribute('data-suffix') || '';
                const speed = 200;
                
                const updateCount = () => {
                    const count = +counter.innerText.replace(/[^0-9]/g, '');
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc) + suffix;
                        setTimeout(updateCount, 15);
                    } else {
                        counter.innerText = target + suffix;
                    }
                };
                updateCount();
            });
        };

        window.addEventListener('scroll', () => {
            const statsSection = document.querySelector('.counter-number');
            if (statsSection && !animated) {
                const pos = statsSection.getBoundingClientRect().top;
                if (pos < window.innerHeight) {
                    animateCounters();
                    animated = true;
                }
            }
        });

        // --- 6. INTERACTIVE PKL HOURS CALCULATOR MODAL ---
        const calcModal = document.getElementById('calc-modal');
        const btnOpenCalc = document.getElementById('btn-open-calc');
        const btnOpenCalcMobile = document.getElementById('btn-open-calc-mobile');
        const btnCloseCalc = document.getElementById('btn-close-calc');
        const calcMonths = document.getElementById('calc-months');
        const calcHours = document.getElementById('calc-hours');
        const calcResult = document.getElementById('calc-result');

        function toggleCalcModal(show) {
            if (show) {
                calcModal.classList.remove('opacity-0', 'pointer-events-none');
                calcModal.firstElementChild.classList.remove('scale-95');
                calcModal.firstElementChild.classList.add('scale-100');
            } else {
                calcModal.classList.add('opacity-0', 'pointer-events-none');
                calcModal.firstElementChild.classList.remove('scale-100');
                calcModal.firstElementChild.classList.add('scale-95');
            }
        }

        function calculatePKLHours() {
            const m = parseInt(calcMonths.value) || 0;
            const h = parseInt(calcHours.value) || 0;
            const total = m * 22 * h; // 22 Hari kerja per bulan
            calcResult.textContent = `${total.toLocaleString('id-ID')} Jam`;
        }

        if (btnOpenCalc) btnOpenCalc.addEventListener('click', () => toggleCalcModal(true));
        if (btnOpenCalcMobile) btnOpenCalcMobile.addEventListener('click', () => toggleCalcModal(true));
        if (btnCloseCalc) btnCloseCalc.addEventListener('click', () => toggleCalcModal(false));
        if (calcMonths && calcHours) {
            calcMonths.addEventListener('input', calculatePKLHours);
            calcHours.addEventListener('input', calculatePKLHours);
        }

        // --- 7. LIVE SEARCH MODAL JS ---
        const searchModal = document.getElementById('search-modal');
        const btnOpenSearch = document.getElementById('btn-open-search');
        const btnOpenSearchMobile = document.getElementById('btn-open-search-mobile');
        const btnCloseSearch = document.getElementById('btn-close-search');
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');

        const searchData = [
            { title: 'Mengisi Logbook Harian', category: 'Siswa', link: '#faq' },
            { title: 'Lupa Kata Sandi Akun', category: 'Bantuan', link: '#faq' },
            { title: 'Alur Pendaftaran & Ploting Prakerin', category: 'Alur Sistem', link: '#alur' },
            { title: 'Sertifikat & Penilaian Industri', category: 'Fitur', link: '#fitur' },
            { title: 'Panduan Kerja Praktek PDF', category: 'Dokumen', link: '{{ asset("dokumen/panduan_prakerin.pdf") }}' },
        ];

        function toggleSearchModal(show) {
            if (show) {
                searchModal.classList.remove('opacity-0', 'pointer-events-none');
                searchModal.firstElementChild.classList.remove('-translate-y-4');
                searchInput.focus();
            } else {
                searchModal.classList.add('opacity-0', 'pointer-events-none');
                searchModal.firstElementChild.classList.add('-translate-y-4');
            }
        }

        if (btnOpenSearch) btnOpenSearch.addEventListener('click', () => toggleSearchModal(true));
        if (btnOpenSearchMobile) btnOpenSearchMobile.addEventListener('click', () => toggleSearchModal(true));
        if (btnCloseSearch) btnCloseSearch.addEventListener('click', () => toggleSearchModal(false));

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();
                if (!query) {
                    searchResults.innerHTML = '<p class="text-slate-400 text-center py-4">Ketik kata kunci untuk memulai pencarian...</p>';
                    return;
                }
                const filtered = searchData.filter(item => item.title.toLowerCase().includes(query) || item.category.toLowerCase().includes(query));
                if (filtered.length === 0) {
                    searchResults.innerHTML = '<p class="text-slate-400 text-center py-4">Hasil tidak ditemukan.</p>';
                } else {
                    searchResults.innerHTML = filtered.map(item => `
                        <a href="${item.link}" class="block p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors flex justify-between items-center" onclick="toggleSearchModal(false)">
                            <span class="font-bold text-slate-700 dark:text-slate-200">${item.title}</span>
                            <span class="text-[10px] bg-blue-100 dark:bg-blue-950 text-blue-600 dark:text-blue-300 font-bold px-2 py-0.5 rounded-md">${item.category}</span>
                        </a>
                    `).join('');
                }
            });
        }

        // Close modal on Escape Key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                toggleCalcModal(false);
                toggleSearchModal(false);
            }
        });
    </script>
</body>
</html>