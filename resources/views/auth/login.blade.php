<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Siswa | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    
    <!-- Font Plus Jakarta Sans & Inter untuk tipografi ultra-modern -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome untuk ikon interaktif -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary-blue': '#1e3a8a',
                        'secondary-blue': '#2563eb',
                    },
                    animation: {
                        'bounce-slow': 'bounce 3s infinite',
                        'fade-in-up': 'fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }
        
        /* Smooth custom focus shadow */
        .focus-glow:focus {
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
        }
        .animate-float {
            animation: float-slow 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-800 antialiased min-h-screen flex flex-col font-sans selection:bg-blue-600 selection:text-white relative overflow-x-hidden">

    <!-- Glowing Background Atmosphere (Ambient Glow Modern) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-blue-600/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-40 -right-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-indigo-600/20 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 sm:w-[600px] h-80 sm:h-[600px] bg-sky-500/10 rounded-full blur-[150px]"></div>
    </div>

    {{-- WRAPPER UTAMA UNTUK LOGIN --}}
    <div class="flex-1 flex items-center justify-center py-10 sm:py-16 px-3 sm:px-6 lg:px-8 relative z-10">
        <div class="w-full max-w-5xl animate-fade-in-up">

            <div class="flex flex-col lg:flex-row w-full bg-white/95 backdrop-blur-2xl rounded-2xl sm:rounded-3xl shadow-2xl shadow-blue-950/40 border border-white/20 overflow-hidden transition-all duration-300 hover:shadow-blue-900/20 my-auto">

                <!-- KIRI: BRANDING HERO SIDE (Informasi Visual Style Gelap Premium) -->
                <div class="hidden lg:flex lg:w-5/12 bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-950 text-white flex-col justify-between p-8 lg:p-10 relative overflow-hidden border-r border-slate-800/80">
                    
                    <!-- Background Ornaments (Glassmorphism & Light Grid) -->
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-56 h-56 rounded-full bg-blue-500/20 blur-2xl pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
                    <div class="absolute top-1/2 left-1/4 w-32 h-32 rounded-full bg-sky-400/10 blur-xl pointer-events-none"></div>
                    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:1.5rem_1.5rem] pointer-events-none"></div>

                    <!-- Top Branding Section -->
                    <div class="relative z-10">
                        <div class="flex items-center space-x-3 mb-8 lg:mb-10 group">
                            <div class="bg-gradient-to-tr from-blue-600 to-sky-400 p-2.5 rounded-2xl border border-white/20 shadow-lg shadow-blue-500/30 transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                                <i class="fas fa-graduation-cap text-white text-2xl"></i>
                            </div>
                            <span class="text-2xl font-black tracking-wider bg-gradient-to-r from-white via-blue-100 to-sky-200 bg-clip-text text-transparent">e-Prakerin</span>
                        </div>

                        <!-- Kartu Putih Untuk Logo Sekolah -->
                        <div class="w-32 h-32 mx-auto my-6 rounded-[24px] bg-white/95 shadow-2xl shadow-black/40 flex items-center justify-center backdrop-blur-md border border-white/80 transform hover:rotate-3 transition-transform duration-300 group cursor-default">
                            <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK"
                                class="w-24 h-24 object-contain p-1 transform group-hover:scale-105 transition-transform duration-300">
                        </div>

                        <h2 class="text-2xl lg:text-3xl font-black text-center mb-3 leading-snug tracking-tight bg-clip-text text-transparent bg-gradient-to-b from-white via-blue-50 to-sky-200">
                            Portal Login
                        </h2>
                        <p class="text-slate-300 text-xs sm:text-sm text-center leading-relaxed font-medium opacity-90">
                            Sistem Informasi Manajemen Praktik Kerja Industri Terintegrasi
                        </p>
                    </div>

                    <!-- Fitur Tambahan Floating Badge -->
                    <div class="relative z-10 my-4 space-y-2.5 bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-md shadow-inner animate-float">
                        <div class="flex items-center space-x-3 text-xs text-blue-100 font-semibold">
                            <div class="w-5 h-5 rounded-lg bg-sky-500/20 flex items-center justify-center border border-sky-400/30 shrink-0">
                                <i class="fas fa-shield-alt text-sky-400 text-[9px]"></i>
                            </div>
                            <span>Akses Aman & Terenkripsi</span>
                        </div>
                        <div class="flex items-center space-x-3 text-xs text-blue-100 font-semibold">
                            <div class="w-5 h-5 rounded-lg bg-sky-500/20 flex items-center justify-center border border-sky-400/30 shrink-0">
                                <i class="fas fa-bolt text-sky-400 text-[9px]"></i>
                            </div>
                            <span>Monitoring Presensi Real-Time</span>
                        </div>
                    </div>

                    <!-- Footer Sidebar -->
                    <div class="relative z-10 text-[11px] text-center text-slate-400 font-semibold tracking-wide">
                        &copy; {{ date('Y') }} SMK Al Madani Pontianak.
                    </div>
                </div>

                <!-- KANAN: FORM INTERACTIVE SIDE -->
                <div class="w-full lg:w-7/12 p-6 sm:p-10 lg:p-12 relative bg-white/90 backdrop-blur-xl flex flex-col justify-center">

                    <!-- Mobile Branding Bar (Tampil Khusus Layar Kecil) -->
                    <div class="flex lg:hidden items-center justify-between mb-6 pb-4 border-b border-slate-100">
                        <div class="flex items-center space-x-2.5">
                            <div class="bg-gradient-to-tr from-blue-600 to-indigo-600 p-2 rounded-xl text-white shadow-md shadow-blue-500/20">
                                <i class="fas fa-graduation-cap text-lg"></i>
                            </div>
                            <span class="text-xl font-black text-slate-900 tracking-tight">e-Prakerin</span>
                        </div>
                        <span class="text-[10px] font-extrabold uppercase bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full border border-blue-200/60">Masuk Siswa</span>
                    </div>

                    <div class="w-full max-w-md mx-auto">
                        <div class="text-left mb-6 sm:mb-8">
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Selamat Datang!</h2>
                            <p class="text-slate-500 font-medium text-xs sm:text-sm mt-1">Silakan masuk menggunakan akun Siswa Anda.</p>
                        </div>

                        <!-- Alert Status Pending -->
                        @if (session('status_pending'))
                            <div class="mb-5 bg-amber-50/90 border-l-4 border-amber-500 p-4 rounded-2xl shadow-sm border border-amber-200/60 backdrop-blur-sm animate-fadeIn">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="h-5 w-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3.5">
                                        <h3 class="text-xs font-extrabold text-amber-900 uppercase tracking-wide">Menunggu Verifikasi</h3>
                                        <div class="mt-1 text-xs text-amber-800 font-medium leading-relaxed">
                                            {{ session('status_pending') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Alert Status Success -->
                        @if (session('status'))
                            <div class="mb-5 bg-emerald-50/90 border-l-4 border-emerald-500 p-4 rounded-2xl shadow-sm border border-emerald-200/60 backdrop-blur-sm animate-fadeIn">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3.5">
                                        <p class="text-xs sm:text-sm font-semibold text-emerald-900">{{ session('status') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Alert Error Validation -->
                        @if ($errors->any())
                            <div class="mb-5 bg-rose-50/90 border-l-4 border-rose-500 p-4 rounded-2xl shadow-sm border border-rose-200/60 backdrop-blur-sm animate-fadeIn">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="h-5 w-5 text-rose-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3.5">
                                        <h3 class="text-xs font-extrabold text-rose-900 uppercase tracking-wide">Login Gagal</h3>
                                        <p class="text-xs sm:text-sm text-rose-800 font-medium mt-0.5">{{ $errors->first() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Form Main -->
                        <form action="{{ route('login.store') }}" method="POST" class="space-y-4 sm:space-y-5">
                            @csrf

                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">NIS (Nomor Induk Siswa)</label>
                                <div class="relative rounded-xl shadow-xs">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                        <i class="fas fa-id-card text-xs sm:text-sm"></i>
                                    </span>
                                    <input type="text" name="username" required autofocus
                                        placeholder="Contoh: 102030"
                                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                                <div class="relative rounded-xl shadow-xs">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                        <i class="fas fa-lock text-xs sm:text-sm"></i>
                                    </span>
                                    <input type="password" name="password" required placeholder="••••••••"
                                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 text-white font-extrabold py-3.5 px-6 rounded-xl focus:ring-4 focus:ring-blue-300/50 transition duration-300 shadow-lg shadow-blue-800/25 transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide text-xs sm:text-sm cursor-pointer flex items-center justify-center group">
                                <span>MASUK SEKARANG</span>
                                <i class="fas fa-arrow-right ml-2 text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
                            </button>
                        </form>

                        <!-- Divider Line -->
                        <div class="relative flex py-5 items-center">
                            <div class="flex-grow border-t border-slate-200"></div>
                            <span class="flex-shrink mx-3 text-slate-400 text-[10px] sm:text-xs font-extrabold tracking-widest uppercase">Masuk Sebagai</span>
                            <div class="flex-grow border-t border-slate-200"></div>
                        </div>

                        <!-- Role Login Buttons -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="{{ route('login.guru') }}"
                                class="w-full py-2.5 sm:py-3 px-4 border-2 border-blue-600 rounded-xl font-bold text-blue-700 hover:text-white hover:bg-blue-600 text-center shadow-xs transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 text-xs tracking-wide flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher mr-2"></i> LOGIN GURU
                            </a>
                            <a href="{{ route('login.industri') }}"
                                class="w-full py-2.5 sm:py-3 px-4 border-2 border-blue-600 rounded-xl font-bold text-slate-700 hover:text-white hover:bg-slate-800 hover:border-slate-800 text-center shadow-xs transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 text-xs tracking-wide flex items-center justify-center">
                                <i class="fas fa-building mr-2"></i> LOGIN INDUSTRI
                            </a>
                        </div>

                        <!-- Register Link Footer (MODIFIED: Style Card Modern & Eye-Catching) -->
                        <div class="mt-6 sm:mt-8 pt-5 border-t border-slate-200/80">
                            <div class="bg-gradient-to-r from-blue-50/80 via-sky-50/50 to-indigo-50/80 p-4 sm:p-5 rounded-2xl border border-blue-100/80 text-center shadow-xs">
                                <p class="text-xs sm:text-sm text-slate-600 font-semibold mb-2.5">
                                    Belum punya akun e-Prakerin?
                                </p>
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 bg-white hover:bg-blue-600 text-blue-700 hover:text-white font-extrabold text-xs sm:text-sm rounded-xl border border-blue-200/80 hover:border-blue-600 shadow-sm transition-all duration-300 transform hover:-translate-y-0.5 group">
                                    <i class="fas fa-user-plus text-xs text-blue-600 group-hover:text-white transition-colors duration-300"></i>
                                    <span>Daftar Akun Siswa</span>
                                    <i class="fas fa-arrow-right text-[10px] opacity-70 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer Cantik & Profesional -->
    <footer class="bg-gradient-to-br from-slate-950 via-blue-950 via-slate-900 to-indigo-950 border-t border-blue-500/30 pt-16 pb-12 transition-all duration-300 relative overflow-hidden select-none z-10 mt-auto">
        
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

            <!-- BAGIAN 2: SOSIAL MEDIA & COPYRIGHT BARRIS BAWAH -->
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
                    <a href="mailto:akhdannafish@gmail.com" 
                       class="flex items-center gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-red-900/30 hover:to-orange-900/20 py-2.5 pl-2.5 pr-4 rounded-xl border border-slate-800 hover:border-red-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-red-500 via-red-600 to-orange-500 flex items-center justify-center transform group-hover:scale-105 transition-all duration-300 shadow-md shadow-red-500/10">
                            <i class="fas fa-envelope text-white text-[11px]"></i>
                        </div>
                        <span class="text-xs text-slate-300 group-hover:text-red-400 font-bold tracking-wide transition-colors">
                            akhdannafish@gmail.com
                        </span>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/6285652104414" target="_blank"
                    class="flex items-center gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-green-900/30 hover:to-emerald-900/20 py-2.5 pl-2.5 pr-4 rounded-xl border border-slate-800 hover:border-green-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 shadow-md shadow-emerald-500/20 flex items-center justify-center transform group-hover:rotate-6 transition-all duration-300">
                            <i class="fab fa-whatsapp text-white text-sm"></i>
                        </div>
                        <span class="text-xs text-slate-300 group-hover:text-emerald-400 font-bold tracking-wide transition-colors">
                            +62 856-5210-4414
                        </span>
                    </a>
                </div>

                <!-- Hak Cipta -->
                <p class="text-slate-500 text-xs text-center md:text-right font-semibold tracking-wide order-1 md:order-2">
                    &copy; {{ date('Y') }} <span class="text-blue-400 font-bold hover:text-blue-300 transition-colors">SMK Al Madani Pontianak</span>. <br class="sm:hidden"> All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>