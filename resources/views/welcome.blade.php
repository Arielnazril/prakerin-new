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
                        primary: '#1e462d',   // Deep Forest Green
                        secondary: '#89C74A', // Vibrant Leaf Green
                        accent: '#fbbf24',    // Amber 400
                        greenLight: '#89C74A', // Custom Color Hijau Muda
                        greenDark: '#234F35',  // Custom Color Hijau Tua
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
        
        /* Custom Scrollbar Organik */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.05);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(137, 199, 74, 0.4);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(35, 79, 53, 0.8);
        }

        /* Ambient Glass Card Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
        }
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="antialiased bg-slate-50 dark:bg-slate-950 font-sans selection:bg-greenDark selection:text-white text-slate-800 dark:text-slate-100 overflow-x-hidden transition-colors duration-300 min-h-screen flex flex-col">

    <!-- Scroll Progress Bar -->
    <div id="scroll-progress-bar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-greenDark via-greenLight to-amber-400 z-50 transition-all duration-150 w-0"></div>

    <!-- Top Sticky Header Wrapper -->
    <div class="fixed top-0 left-0 w-full z-40">
        <!-- Banner Info Live Status Sistem e-Prakerin -->
        <div class="bg-slate-950 text-white text-xs py-2 px-3 sm:px-4 text-center font-semibold flex flex-wrap items-center justify-center gap-1.5 sm:gap-2 border-b border-slate-800/80 shadow-xs relative z-50">
            <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 px-2.5 py-0.5 rounded-full border border-emerald-500/20 text-[10px] sm:text-[11px] font-medium">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                System Live Status
            </span>
            
            <span class="hidden sm:inline text-slate-300 font-normal">Portal e-Prakerin SMK Al Madani Pontianak Berjalan Normal.</span>
            
            <!-- Tombol Simulasi Ber-Border Elegan -->
            <button id="btn-open-calc" class="inline-flex items-center gap-1.5 bg-slate-900 hover:bg-amber-400 text-amber-300 hover:text-slate-950 font-bold px-3 py-1 rounded-lg border border-amber-400/40 transition-all duration-200 active:scale-95 cursor-pointer sm:ml-2 text-[10px] sm:text-[11px] shadow-xs">
                <i class="fas fa-calculator text-[10px] sm:text-xs"></i> Simulasi Jam Prakerin
            </button>
        </div>

        <!-- Navigasi Premium -->
        <nav class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-xs border-b border-slate-200/80 dark:border-slate-800/80 w-full transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 sm:h-20 items-center">
                    
                    <!-- Logo & Brand -->
                    <a href="#" class="flex items-center gap-3 sm:gap-3.5 group cursor-pointer shrink-0">
                        <div class="relative">
                            <div class="bg-slate-50 dark:bg-slate-800/80 p-2 rounded-xl border border-slate-200/80 dark:border-slate-700/80 shadow-2xs group-hover:border-greenLight/50 transition duration-300">
                                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-9 w-9 sm:h-11 sm:w-11 object-contain transition-transform duration-300 group-hover:scale-105">
                            </div>
                        </div>
                        <div>
                            <h1 class="text-base sm:text-xl font-extrabold text-primary dark:text-greenLight tracking-tight leading-none group-hover:text-secondary transition duration-200">e-Prakerin</h1>
                            <p class="text-[8px] sm:text-[10px] text-slate-500 dark:text-slate-400 font-bold tracking-wider mt-0.5 sm:mt-1">SMK S AL MADANI KOTA PONTIANAK</p>
                        </div>
                    </a>

                    <!-- Desktop Menu Buttons -->
                    <div class="hidden md:flex items-center gap-3">
                        <!-- Tombol Pencarian Cepat -->
                        <button id="btn-open-search" class="px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-800/70 text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-greenLight hover:bg-slate-200/60 dark:hover:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 transition-all duration-200 active:scale-95 flex items-center gap-2.5 text-xs font-semibold shadow-2xs">
                            <i class="fas fa-search text-slate-400"></i>
                            <span class="hidden lg:inline text-slate-500 dark:text-slate-400">Cari Info...</span>
                            <span class="hidden lg:inline text-[10px] font-mono bg-slate-200/60 dark:bg-slate-700/60 px-1.5 py-0.5 rounded text-slate-400">Ctrl K</span>
                        </button>

                        <!-- Tombol Dark Mode Switcher (Desktop) -->
                        <button id="theme-toggle" type="button" class="p-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-800/70 text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-amber-400 border border-slate-200/80 dark:border-slate-700/80 transition-all duration-200 active:scale-95 shadow-2xs" aria-label="Toggle Dark Mode">
                            <i id="theme-toggle-dark-icon" class="fas fa-moon hidden text-base"></i>
                            <i id="theme-toggle-light-icon" class="fas fa-sun hidden text-base text-amber-400"></i>
                        </button>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-bold text-sm text-slate-700 dark:text-slate-200 hover:text-primary dark:hover:text-greenLight transition-all duration-200 flex items-center gap-2 bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200/80 dark:hover:bg-slate-700/80 px-5 py-2.5 rounded-xl border border-slate-200/80 dark:border-slate-700/80 shadow-2xs active:scale-95">
                                    <i class="fas fa-columns text-xs text-slate-400 dark:text-slate-500"></i> Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-greenLight text-sm font-semibold transition-colors duration-200 px-4 py-2.5 rounded-xl hover:bg-slate-100/60 dark:hover:bg-slate-800/60">
                                    Masuk
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold rounded-xl bg-primary hover:bg-emerald-900 text-white shadow-sm hover:shadow-md hover:shadow-emerald-900/20 transition-all duration-200 active:scale-95">
                                        Daftar Siswa
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <!-- Mobile Menu Toggle Button & Theme Switcher -->
                    <div class="flex items-center gap-1.5 sm:gap-2 md:hidden">
                        <button id="btn-open-search-mobile" class="p-2 sm:p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-primary border border-slate-200 dark:border-slate-700 transition-all duration-200">
                            <i class="fas fa-search text-sm sm:text-base"></i>
                        </button>

                        <!-- Tombol Dark Mode Switcher (Mobile) -->
                        <button id="theme-toggle-mobile" type="button" class="p-2 sm:p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-amber-400 border border-slate-200 dark:border-slate-700 transition-all duration-200">
                            <i id="theme-toggle-dark-icon-mobile" class="fas fa-moon hidden text-sm sm:text-base"></i>
                            <i id="theme-toggle-light-icon-mobile" class="fas fa-sun hidden text-sm sm:text-base text-amber-400"></i>
                        </button>

                        <button id="mobile-menu-btn" type="button" class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-greenLight focus:outline-none p-2 sm:p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                            <i id="hamburger-icon" class="fas fa-bars text-lg sm:text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="hidden md:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-all duration-300 max-h-[calc(100vh-5rem)] overflow-y-auto">
                <div class="px-4 pt-3 pb-6 space-y-3">
                    <button id="btn-open-calc-mobile" class="w-full text-left font-bold text-sm text-greenDark dark:text-greenLight py-2.5 px-3.5 rounded-xl bg-emerald-50/80 dark:bg-emerald-950/60 border border-emerald-200/80 dark:border-emerald-900/80 flex items-center justify-between">
                        <span><i class="fas fa-calculator mr-2"></i> Simulasi Jam Prakerin</span>
                        <i class="fas fa-chevron-right text-xs opacity-60"></i>
                    </button>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full font-bold text-sm text-slate-700 dark:text-slate-200 hover:text-primary dark:hover:text-greenLight transition-colors duration-200 flex items-center justify-center gap-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-3 rounded-xl border border-slate-200/80 dark:border-slate-700">
                                <i class="fas fa-columns text-xs text-slate-400 dark:text-slate-500"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block text-center text-slate-700 dark:text-slate-200 hover:text-primary dark:hover:text-greenLight text-sm font-semibold transition-colors duration-200 py-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 border border-slate-200/60 dark:border-slate-800">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block text-center bg-primary text-white text-sm py-3 rounded-xl font-bold shadow-xs">
                                    Daftar Siswa
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </div>

    <!-- Hero Section -->
    <div class="relative bg-white dark:bg-slate-950 pt-32 sm:pt-44 pb-16 sm:pb-20 lg:pt-48 lg:pb-28 overflow-hidden border-b border-slate-200/80 dark:border-slate-800">
        <!-- Grid Dynamic Background -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:2.5rem_2.5rem] sm:bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <span class="bg-emerald-50 dark:bg-emerald-950/70 text-greenDark dark:text-greenLight text-[10px] sm:text-[11px] font-extrabold px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full uppercase tracking-wider mb-4 sm:mb-6 inline-flex items-center border border-emerald-200/80 dark:border-emerald-800/80 shadow-2xs">
                    <span class="relative flex h-2 w-2 mr-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-greenLight opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-greenLight"></span>
                    </span>
                    Tahun Ajaran 2026/2027
                </span>
                <h1 class="text-2xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4 sm:mb-6 leading-tight">
                    Kelola Kegiatan Magang <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-greenDark to-greenLight dark:from-greenLight dark:via-emerald-300 dark:to-lime-400">Lebih Mudah & Modern</span>
                </h1>
                <p class="text-xs sm:text-lg text-slate-600 dark:text-slate-400 mb-6 sm:mb-8 leading-relaxed max-w-2xl mx-auto font-normal">
                    Platform terintegrasi yang menghubungkan Siswa, Guru Pembimbing, dan Mentor Industri untuk pemantauan kegiatan Prakerin yang efisien, transparan, dan real-time.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-3.5 justify-center items-center w-full max-w-2xl mx-auto">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-6 py-3.5 bg-primary hover:bg-emerald-900 text-white rounded-xl font-bold shadow-md hover:shadow-lg shadow-emerald-950/10 transition-all duration-200 flex items-center justify-center gap-2 text-sm active:scale-95">
                            <i class="fas fa-tachometer-alt text-xs opacity-80"></i> Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-6 py-3.5 bg-primary hover:bg-emerald-900 text-white rounded-xl font-bold shadow-md hover:shadow-lg shadow-emerald-950/10 transition-all duration-200 flex items-center justify-center gap-2 text-sm active:scale-95">
                            <i class="fas fa-sign-in-alt text-xs opacity-80"></i> Masuk Sekarang
                        </a>
                        <a href="#fitur" class="w-full sm:w-auto px-6 py-3.5 bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-slate-200 border border-slate-200/80 dark:border-slate-800 rounded-xl font-semibold hover:bg-slate-200/70 dark:hover:bg-slate-800 transition-all duration-200 flex items-center justify-center gap-2 text-sm active:scale-95">
                            Pelajari Lebih Lanjut
                        </a>
                        <a href="{{ asset('dokumen/panduan_prakerin.pdf') }}"
                        class="w-full sm:w-auto px-6 py-3.5 bg-greenDark hover:bg-emerald-900 text-white rounded-xl font-semibold shadow-xs hover:shadow border border-greenDark/80 transition-all duration-200 flex items-center justify-center gap-2 text-sm active:scale-95"
                        target="_blank">
                            <i class="fas fa-file-pdf text-xs opacity-80"></i> Panduan Kerja Praktek
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Efek Glow Latar Belakang -->
        <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full z-0 pointer-events-none opacity-25 dark:opacity-15">
            <div class="absolute top-10 left-1/4 w-48 sm:w-80 h-48 sm:h-80 bg-greenLight/40 rounded-full filter blur-[60px] sm:blur-[90px] animate-blob"></div>
            <div class="absolute top-20 right-1/4 w-48 sm:w-80 h-48 sm:h-80 bg-emerald-400/30 rounded-full filter blur-[60px] sm:blur-[90px] animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-4 left-1/3 w-48 sm:w-80 h-48 sm:h-80 bg-lime-300/30 rounded-full filter blur-[60px] sm:blur-[90px] animate-blob animation-delay-4000"></div>
        </div>
    </div>

    <!-- Section Fitur Utama -->
    <div id="fitur" class="py-16 sm:py-24 bg-slate-50 dark:bg-slate-950 scroll-mt-20 border-b border-slate-200/80 dark:border-slate-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 sm:mb-16 max-w-xl mx-auto">
                <span class="text-[10px] sm:text-xs font-extrabold tracking-wider text-greenDark dark:text-greenLight uppercase bg-emerald-100/60 dark:bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-900 shadow-2xs">Ekosistem Terpadu</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-3">Solusi Untuk Semua Pihak</h2>
                <div class="w-12 h-1 bg-gradient-to-r from-greenDark to-greenLight rounded-full mx-auto mt-3 mb-2"></div>
                <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm font-normal">Satu aplikasi untuk mengintegrasikan seluruh proses magang.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <!-- Card Siswa -->
                <div class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-2xl shadow-sm hover:shadow-xl border border-slate-200/90 dark:border-slate-800 transition-all duration-300 hover:border-greenLight dark:hover:border-slate-700 hover:-translate-y-1 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-emerald-50 dark:bg-slate-800 border border-emerald-100 dark:border-slate-700 rounded-2xl flex items-center justify-center text-primary dark:text-greenLight text-xl mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-xs">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2.5">Untuk Siswa</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm leading-relaxed">
                            Isi logbook harian digital, pantau kehadiran, dan lihat transkrip nilai langsung dari dashboard siswa yang responsif.
                        </p>
                    </div>
                </div>

                <!-- Card Guru -->
                <div class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-2xl shadow-sm hover:shadow-xl border border-slate-200/90 dark:border-slate-800 transition-all duration-300 hover:border-greenLight dark:hover:border-slate-700 hover:-translate-y-1 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-emerald-50 dark:bg-slate-800 border border-emerald-100 dark:border-slate-700 rounded-2xl flex items-center justify-center text-greenDark dark:text-greenLight text-xl mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-xs">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2.5">Untuk Guru</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm leading-relaxed">
                            Monitoring aktivitas siswa bimbingan secara real-time, validasi laporan, dan input nilai akademik dengan mudah.
                        </p>
                    </div>
                </div>

                <!-- Card Industri -->
                <div class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-2xl shadow-sm hover:shadow-xl border border-slate-200/90 dark:border-slate-800 transition-all duration-300 hover:border-greenLight dark:hover:border-slate-700 hover:-translate-y-1 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-emerald-50 dark:bg-slate-800 border border-emerald-100 dark:border-slate-700 rounded-2xl flex items-center justify-center text-greenDark dark:text-lime-400 text-xl mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-xs">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2.5">Untuk Industri</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm leading-relaxed">
                            Mentor lapangan dapat memvalidasi logbook, memberikan feedback, dan menilai kinerja teknis & non-teknis siswa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FITUR TAMBAHAN 1: Section Alur Kerja Praktik Industri -->
    <div id="alur" class="py-16 sm:py-24 bg-white dark:bg-slate-900 border-b border-slate-200/80 dark:border-slate-800 relative scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 max-w-xl mx-auto">
                <span class="text-[10px] sm:text-xs font-extrabold tracking-wider text-greenDark dark:text-greenLight uppercase bg-emerald-100/60 dark:bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-900 shadow-2xs">Tahapan Digital</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-3">Alur Kerja Praktik Industri</h2>
                <div class="w-12 h-1 bg-gradient-to-r from-greenDark to-greenLight rounded-full mx-auto mt-3 mb-2"></div>
                <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm font-normal">Langkah-langkah terstruktur pelaksanaan e-Prakerin</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="bg-slate-50 dark:bg-slate-950 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800 transition-all duration-300 hover:border-greenLight/50 dark:hover:border-slate-700 hover:shadow-md text-center group">
                    <div class="w-11 h-11 bg-primary text-white rounded-2xl font-extrabold flex items-center justify-center mx-auto mb-4 text-sm shadow-md group-hover:scale-110 group-hover:bg-greenDark transition-all">1</div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-base mb-2">Pendaftaran & Ploting</h4>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Siswa mendaftar dan ditentukan tempat magang serta guru pembimbingnya.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-slate-50 dark:bg-slate-950 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800 transition-all duration-300 hover:border-greenLight/50 dark:hover:border-slate-700 hover:shadow-md text-center group">
                    <div class="w-11 h-11 bg-primary text-white rounded-2xl font-extrabold flex items-center justify-center mx-auto mb-4 text-sm shadow-md group-hover:scale-110 group-hover:bg-greenDark transition-all">2</div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-base mb-2">Logbook & Presensi</h4>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Siswa mengisi kegiatan harian dan absen mandiri melalui sistem.</p>
                </div>
                <!-- Step 3 -->
                <div class="bg-slate-50 dark:bg-slate-950 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800 transition-all duration-300 hover:border-greenLight/50 dark:hover:border-slate-700 hover:shadow-md text-center group">
                    <div class="w-11 h-11 bg-primary text-white rounded-2xl font-extrabold flex items-center justify-center mx-auto mb-4 text-sm shadow-md group-hover:scale-110 group-hover:bg-greenDark transition-all">3</div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-base mb-2">Monitoring & Evaluasi</h4>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Guru & Mentor memantau perkembangan dan memberikan respon berkala.</p>
                </div>
                <!-- Step 4 -->
                <div class="bg-slate-50 dark:bg-slate-950 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800 transition-all duration-300 hover:border-greenLight/50 dark:hover:border-slate-700 hover:shadow-md text-center group">
                    <div class="w-11 h-11 bg-primary text-white rounded-2xl font-extrabold flex items-center justify-center mx-auto mb-4 text-sm shadow-md group-hover:scale-110 group-hover:bg-greenDark transition-all">4</div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-base mb-2">Penilaian & Sertifikat</h4>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Penilaian akhir dari pihak industri dan diterbitkannya transkrip magang.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Statistik -->
    <div class="py-14 sm:py-20 bg-slate-950 text-white relative border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
                <div class="p-5 sm:p-6 rounded-2xl border border-slate-800/80 bg-slate-900/40 backdrop-blur-xs hover:border-greenLight/30 transition-all">
                    <div class="text-3xl sm:text-5xl font-extrabold mb-1.5 text-greenLight counter-number" data-target="50" data-suffix="+">0</div>
                    <div class="text-slate-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider">Siswa Magang</div>
                </div>
                <div class="p-5 sm:p-6 rounded-2xl border border-slate-800/80 bg-slate-900/40 backdrop-blur-xs hover:border-greenLight/30 transition-all">
                    <div class="text-3xl sm:text-5xl font-extrabold mb-1.5 text-greenLight counter-number" data-target="10" data-suffix="+">0</div>
                    <div class="text-slate-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider">Mitra Industri</div>
                </div>
                <div class="p-5 sm:p-6 rounded-2xl border border-slate-800/80 bg-slate-900/40 backdrop-blur-xs hover:border-greenLight/30 transition-all">
                    <div class="text-3xl sm:text-5xl font-extrabold mb-1.5 text-greenLight counter-number" data-target="100" data-suffix="%">0</div>
                    <div class="text-slate-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider">Digital Logbook</div>
                </div>
                <div class="p-5 sm:p-6 rounded-2xl border border-slate-800/80 bg-slate-900/40 backdrop-blur-xs hover:border-greenLight/30 transition-all">
                    <div class="text-3xl sm:text-5xl font-extrabold mb-1.5 text-greenLight">24/7</div>
                    <div class="text-slate-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider">Akses Sistem</div>
                </div>
            </div>
        </div>
    </div>

    <!-- FITUR TAMBAHAN 2: FAQ Accordion Section (MODERN REDESIGN) -->
    <div id="faq" class="py-16 sm:py-24 bg-slate-50 dark:bg-slate-950 border-b border-slate-200/80 dark:border-slate-800 scroll-mt-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 sm:mb-14">
                <span class="text-[10px] sm:text-xs font-extrabold tracking-wider text-greenDark dark:text-greenLight uppercase bg-emerald-100/60 dark:bg-emerald-950/80 px-3.5 py-1.5 rounded-full border border-emerald-200 dark:border-emerald-900 shadow-2xs">Bantuan</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-3">Pertanyaan Sering Diajukan</h2>
                <div class="w-12 h-1 bg-gradient-to-r from-greenDark to-greenLight rounded-full mx-auto mt-3"></div>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/90 dark:border-slate-800/90 overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 hover:border-emerald-500/40">
                    <button class="faq-btn w-full p-5 sm:p-6 text-left font-bold text-slate-800 dark:text-slate-100 flex justify-between items-center focus:outline-none text-sm sm:text-base cursor-pointer hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors group">
                        <span class="flex items-center gap-3 pr-4 group-hover:text-primary dark:group-hover:text-greenLight transition-colors">
                            <span class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-slate-800 text-greenDark dark:text-greenLight flex items-center justify-center text-xs shrink-0 border border-emerald-100 dark:border-slate-700">
                                <i class="fas fa-question text-xs"></i>
                            </span>
                            Bagaimana cara mengisi jurnal logbook harian?
                        </span>
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-950 transition-colors">
                            <i class="fas fa-chevron-down text-slate-400 group-hover:text-greenDark dark:group-hover:text-greenLight text-xs transition-transform duration-300"></i>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300 font-normal leading-relaxed border-t border-slate-100 dark:border-slate-800/80 pt-4 bg-slate-50/40 dark:bg-slate-900/40">
                        Siswa dapat masuk ke akun masing-masing, memilih menu "Jurnal Harian", lalu menambah catatan aktivitas pekerjaan beserta unggah foto bukti kegiatan magang.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/90 dark:border-slate-800/90 overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 hover:border-emerald-500/40">
                    <button class="faq-btn w-full p-5 sm:p-6 text-left font-bold text-slate-800 dark:text-slate-100 flex justify-between items-center focus:outline-none text-sm sm:text-base cursor-pointer hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors group">
                        <span class="flex items-center gap-3 pr-4 group-hover:text-primary dark:group-hover:text-greenLight transition-colors">
                            <span class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-slate-800 text-greenDark dark:text-greenLight flex items-center justify-center text-xs shrink-0 border border-emerald-100 dark:border-slate-700">
                                <i class="fas fa-key text-xs"></i>
                            </span>
                            Bagaimana jika lupa kata sandi akun?
                        </span>
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-950 transition-colors">
                            <i class="fas fa-chevron-down text-slate-400 group-hover:text-greenDark dark:group-hover:text-greenLight text-xs transition-transform duration-300"></i>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300 font-normal leading-relaxed border-t border-slate-100 dark:border-slate-800/80 pt-4 bg-slate-50/40 dark:bg-slate-900/40">
                        Anda dapat menghubungi tim Admin Kurikulum/Prakerin sekolah atau Guru Pembimbing untuk melakukan reset kata sandi akun Anda.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/90 dark:border-slate-800/90 overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 hover:border-emerald-500/40">
                    <button class="faq-btn w-full p-5 sm:p-6 text-left font-bold text-slate-800 dark:text-slate-100 flex justify-between items-center focus:outline-none text-sm sm:text-base cursor-pointer hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors group">
                        <span class="flex items-center gap-3 pr-4 group-hover:text-primary dark:group-hover:text-greenLight transition-colors">
                            <span class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-slate-800 text-greenDark dark:text-greenLight flex items-center justify-center text-xs shrink-0 border border-emerald-100 dark:border-slate-700">
                                <i class="fas fa-mobile-alt text-xs"></i>
                            </span>
                            Apakah e-Prakerin bisa diakses melalui smartphone?
                        </span>
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-950 transition-colors">
                            <i class="fas fa-chevron-down text-slate-400 group-hover:text-greenDark dark:group-hover:text-greenLight text-xs transition-transform duration-300"></i>
                        </div>
                    </button>
                    <div class="faq-answer hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300 font-normal leading-relaxed border-t border-slate-100 dark:border-slate-800/80 pt-4 bg-slate-50/40 dark:bg-slate-900/40">
                        Ya, tampilan aplikasi e-Prakerin telah dirancang responsif dan nyaman digunakan pada perangkat smartphone, tablet, maupun komputer desktop.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Cantik & Profesional -->
    <footer class="bg-gradient-to-br from-slate-950 via-emerald-950 via-slate-900 to-slate-950 border-t border-greenLight/30 pt-12 sm:pt-16 pb-8 sm:pb-12 transition-all duration-300 relative overflow-hidden select-none z-10 mt-auto">
        
        <!-- Ornamen Ambient Glow Neon (Estetika Premium Sisi Kiri & Kanan) -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-greenLight/15 rounded-full filter blur-[100px] pointer-events-none animate-pulse"></div>
        <div class="absolute -bottom-20 -left-20 w-[500px] h-[500px] bg-greenDark/20 rounded-full filter blur-[120px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- BAGIAN 1: GRID UTAMA UTK INFORMASI & KARTU UTAMA -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 pb-8 sm:pb-12 border-b border-slate-800/60 items-start">
                
                <!-- Branding Utama (Kolom Kiri - Lebar 5 Grid) -->
                <div class="lg:col-span-5 space-y-4 sm:space-y-5 text-center lg:text-left flex flex-col items-center lg:items-start">
                    <div class="flex items-center gap-3 sm:gap-4 group">
                        <div class="bg-gradient-to-tr from-white to-emerald-50 rounded-2xl p-2 sm:p-2.5 shadow-xl shadow-greenLight/10 border border-greenLight/30 transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-300">
                            <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-10 w-10 sm:h-14 sm:w-14 rounded-xl object-contain">
                        </div>
                        <div class="space-y-0.5 text-left">
                            <p class="text-white font-black text-xl sm:text-2xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white via-emerald-100 to-greenLight">e-Prakerin</p>
                            <p class="text-greenLight text-[9px] sm:text-[10px] tracking-widest font-extrabold uppercase">
                                SMK AL MADANI PONTIANAK
                            </p>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed max-w-md font-medium">
                        Platform e-Prakerin memfasilitasi kolaborasi siswa, guru, dan mitra industri dalam pelaksanaan Praktik Kerja Industri yang terarah, terukur, dan profesional.
                    </p>
                </div>

                <!-- Kartu Informasi Alamat & Website (Kolom Kanan - Lebar 7 Grid) -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 w-full">
                    <!-- Kontak Alamat (Premium Neon Effect) -->
                    <div class="flex items-start gap-3.5 sm:gap-4 bg-slate-900/60 backdrop-blur-md p-4 sm:p-5 rounded-2xl border border-slate-800/80 shadow-xl shadow-black/20 hover:border-greenLight/40 hover:bg-slate-900/90 transition-all duration-300 group">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-br from-emerald-500/20 to-greenDark/30 text-greenLight flex items-center justify-center shrink-0 border border-greenLight/20 group-hover:scale-110 transition duration-300">
                            <i class="fas fa-map-marker-alt text-xs sm:text-sm"></i>
                        </div>
                        <div class="space-y-1 text-left">
                            <p class="text-[9px] sm:text-[10px] font-bold tracking-wider text-slate-500 uppercase">Alamat Sekolah</p>
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-semibold">
                                Jalan Sungai Raya Dalam Komp. Mitra Utama III No. 16 B
                            </p>
                        </div>
                    </div>

                    <!-- Kontak Website (Interactive Link) -->
                    <a href="https://smkalmadaniptk.sch.id" target="_blank" class="flex items-start gap-3.5 sm:gap-4 bg-slate-900/60 backdrop-blur-md p-4 sm:p-5 rounded-2xl border border-slate-800/80 shadow-xl shadow-black/20 hover:border-greenLight/50 hover:bg-slate-900/90 transition-all duration-300 group">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-br from-lime-500/20 to-emerald-500/20 text-lime-400 flex items-center justify-center shrink-0 border border-lime-500/20 group-hover:bg-gradient-to-br group-hover:from-greenDark group-hover:to-greenLight group-hover:text-white transition-all duration-300 shadow-lg shadow-lime-500/10">
                            <i class="fas fa-globe text-xs sm:text-sm"></i>
                        </div>
                        <div class="space-y-1 text-left">
                            <p class="text-[9px] sm:text-[10px] font-bold tracking-wider text-slate-500 uppercase">Website Resmi</p>
                            <p class="text-xs sm:text-sm text-slate-300 group-hover:text-greenLight font-bold transition duration-200 break-all">
                                smkalmadaniptk.sch.id
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- BAGIAN 2: SOSIAL MEDIA & COPYRIGHT BARRIS BAWAH -->
            <div class="mt-6 sm:mt-8 flex flex-col md:flex-row items-center justify-between gap-5 sm:gap-6">
                
                <!-- Tombol Sosial Media (Desain Pil Mengambang Kontras Tinggi) -->
                <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 order-2 md:order-1 w-full md:w-auto">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/smkalmadaniptk_official" target="_blank"
                    class="flex items-center gap-2 sm:gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-purple-900/30 hover:to-pink-900/20 py-2 sm:py-2.5 pl-2 sm:pl-2.5 pr-3 sm:pr-4 rounded-xl border border-slate-800 hover:border-pink-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-gradient-to-tr from-amber-500 via-red-500 to-purple-600 shadow-md flex items-center justify-center transform group-hover:rotate-12 transition-all duration-300">
                            <i class="fab fa-instagram text-white text-xs sm:text-sm"></i>
                        </div>
                        <span class="text-[11px] sm:text-xs text-slate-300 group-hover:text-pink-400 font-bold tracking-wide transition-colors">
                            @smkalmadaniptk_official
                        </span>
                    </a>

                    <!-- Gmail -->
                    <a href="mailto:smks.almadaniptk@gmail.com" 
                       class="flex items-center gap-2 sm:gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-red-900/30 hover:to-orange-900/20 py-2 sm:py-2.5 pl-2 sm:pl-2.5 pr-3 sm:pr-4 rounded-xl border border-slate-800 hover:border-red-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-gradient-to-tr from-red-500 via-red-600 to-orange-500 flex items-center justify-center transform group-hover:scale-105 transition-all duration-300 shadow-md shadow-red-500/10">
                            <i class="fas fa-envelope text-white text-[10px] sm:text-[11px]"></i>
                        </div>
                        <span class="text-[11px] sm:text-xs text-slate-300 group-hover:text-red-400 font-bold tracking-wide transition-colors">
                           smks.almadaniptk@gmail.com
                        </span>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/6285652104414" target="_blank"
                    class="flex items-center gap-2 sm:gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-green-900/30 hover:to-emerald-900/20 py-2 sm:py-2.5 pl-2 sm:pl-2.5 pr-3 sm:pr-4 rounded-xl border border-slate-800 hover:border-green-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 shadow-md shadow-emerald-500/20 flex items-center justify-center transform group-hover:rotate-6 transition-all duration-300">
                            <i class="fab fa-whatsapp text-white text-xs sm:text-sm"></i>
                        </div>
                        <span class="text-[11px] sm:text-xs text-slate-300 group-hover:text-emerald-400 font-bold tracking-wide transition-colors">
                            +62 856-5210-4414
                        </span>
                    </a>
                </div>

                <!-- Hak Cipta -->
                <p class="text-slate-500 text-[11px] sm:text-xs text-center md:text-right font-semibold tracking-wide order-1 md:order-2">
                    &copy; {{ date('Y') }} <span class="text-greenLight font-bold hover:text-lime-300 transition-colors">SMK Al Madani Pontianak</span>. <br class="sm:hidden"> All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- FITUR TAMBAHAN JS: Modal Kalkulator Jam PKL -->
    <div id="calc-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-200 p-4">
        <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 w-full max-w-md rounded-2xl p-5 sm:p-6 shadow-2xl transform scale-95 transition-all duration-200 relative">
            <button id="btn-close-calc" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-white p-2 rounded-lg cursor-pointer">
                <i class="fas fa-times text-base"></i>
            </button>
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-greenDark dark:text-greenLight flex items-center justify-center border border-emerald-100 dark:border-emerald-900 shrink-0">
                    <i class="fas fa-calculator text-base"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-sm sm:text-base">Simulasi Jam Kerja Prakerin</h3>
                    <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400">Hitung estimasi total akumulasi jam magang</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-extrabold text-slate-600 dark:text-slate-300 mb-1.5">Durasi Magang (Bulan)</label>
                    <input type="number" id="calc-months" value="3" min="1" max="12" class="w-full bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 rounded-xl p-3 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-greenLight">
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-600 dark:text-slate-300 mb-1.5">Jam Kerja per Hari</label>
                    <input type="number" id="calc-hours" value="8" min="1" max="12" class="w-full bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 rounded-xl p-3 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-greenLight">
                </div>
                <div class="p-4 bg-emerald-50/80 dark:bg-emerald-950/50 rounded-xl border border-emerald-100 dark:border-emerald-900 text-center">
                    <span class="text-xs text-greenDark dark:text-greenLight font-bold uppercase tracking-wider block">Estimasi Total Akumulasi</span>
                    <span id="calc-result" class="text-xl sm:text-2xl font-extrabold text-greenDark dark:text-greenLight mt-0.5 block">528 Jam</span>
                    <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-1">*Berdasarkan asumsi 22 hari kerja aktif/bulan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FITUR TAMBAHAN JS: Modal Pencarian Cepat -->
    <div id="search-modal" class="fixed inset-0 z-50 flex items-start justify-center bg-slate-950/70 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-200 p-3 sm:p-4 pt-16 sm:pt-20">
        <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 w-full max-w-xl rounded-2xl p-4 sm:p-5 shadow-2xl transform -translate-y-4 transition-all duration-200 relative">
            <div class="flex items-center gap-2.5 sm:gap-3 border-b border-slate-200 dark:border-slate-800 pb-3">
                <i class="fas fa-search text-slate-400 text-sm sm:text-base"></i>
                <input type="text" id="search-input" placeholder="Cari info logbook, alur, FAQ, atau jurusan..." class="w-full bg-transparent text-xs sm:text-sm font-medium text-slate-800 dark:text-white focus:outline-none">
                <button id="btn-close-search" class="text-[10px] sm:text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-500 px-2 py-1 rounded-md cursor-pointer shrink-0">ESC</button>
            </div>
            <div id="search-results" class="mt-4 max-h-60 overflow-y-auto space-y-2 text-xs">
                <p class="text-slate-400 text-center py-4">Ketik kata kunci untuk memulai pencarian...</p>
            </div>
        </div>
    </div>

    <!-- FITUR TAMBAHAN 3: Floating Back To Top Button -->
    <button id="back-to-top" aria-label="Kembali ke Atas" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-40 bg-primary text-white p-3 sm:p-3.5 rounded-xl shadow-md hover:bg-emerald-900 transition-all duration-200 opacity-0 pointer-events-none transform translate-y-4 cursor-pointer">
        <i class="fas fa-arrow-up text-xs"></i>
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
                const icon = btn.querySelector('.fa-chevron-down');
                
                answer.classList.toggle('hidden');
                if (icon) {
                    icon.classList.toggle('rotate-180');
                }
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
                        <a href="${item.link}" class="block p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition-colors flex justify-between items-center" onclick="toggleSearchModal(false)">
                            <span class="font-bold text-slate-700 dark:text-slate-200">${item.title}</span>
                            <span class="text-[10px] bg-emerald-100 dark:bg-emerald-950 text-greenDark dark:text-greenLight font-bold px-2 py-0.5 rounded-md">${item.category}</span>
                        </a>
                    `).join('');
                }
            });
        }

        // Close modal on Escape Key & Shortcut Ctrl+K
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                toggleCalcModal(false);
                toggleSearchModal(false);
            }
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                toggleSearchModal(true);
            }
        });
    </script>
</body>
</html>