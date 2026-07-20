<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Prakerin | Sistem Informasi Praktik Kerja Industri</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a', // Blue 900
                        secondary: '#2563eb', // Blue 600
                        accent: '#fbbf24', // Amber 400
                    }
                }
            }
        }
    </script>
</head>

<body class="antialiased bg-slate-50/50 font-figtree selection:bg-blue-600 selection:text-white">

    <!-- Navigasi Premium -->
    <nav class="bg-white/90 backdrop-blur-md shadow-sm border-b border-gray-100 fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3 group cursor-pointer shrink-0">
                    <div class="bg-gradient-to-tr from-blue-50 to-indigo-50 p-2 rounded-xl border border-blue-100/50 transform group-hover:scale-105 transition duration-300 shadow-sm">
                        <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-10 w-10 sm:h-11 sm:w-11 object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg sm:text-xl font-extrabold text-primary tracking-tight leading-none group-hover:text-secondary transition duration-300">e-Prakerin</h1>
                        <p class="text-[9px] sm:text-[10px] text-gray-400 font-bold tracking-widest mt-1">SMK BISA HEBAT</p>
                    </div>
                </div>

                <!-- Desktop Menu Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-sm text-gray-700 hover:text-primary transition-all duration-200 flex items-center gap-2 bg-gray-50 hover:bg-gray-100 px-5 py-2.5 rounded-xl border border-gray-200/60 shadow-sm">
                                <i class="fas fa-columns text-xs text-gray-400"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary text-sm font-bold transition-colors duration-200 px-3 py-2">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary to-blue-800 hover:from-blue-900 hover:to-indigo-900 text-white text-sm px-6 py-2.5 rounded-xl font-bold shadow-md shadow-blue-900/10 hover:shadow-lg hover:shadow-blue-900/20 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0">
                                    Daftar Siswa
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Toggle Button (Hamburger) -->
                <div class="flex md:hidden">
                    <button id="mobile-menu-btn" type="button" class="text-gray-500 hover:text-primary focus:outline-none p-2 rounded-xl hover:bg-slate-100 transition-colors">
                        <i id="hamburger-icon" class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-gray-100 animate-fadeIn">
            <div class="px-4 pt-2 pb-6 space-y-3 shadow-inner">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full font-bold text-sm text-gray-700 hover:text-primary transition-colors duration-200 flex items-center justify-center gap-2 bg-gray-50 hover:bg-gray-100 px-4 py-3 rounded-xl border border-gray-200/60">
                            <i class="fas fa-columns text-xs text-gray-400"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block text-center text-gray-600 hover:text-primary text-sm font-bold transition-colors duration-200 py-2.5 rounded-xl hover:bg-slate-50">
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

    <!-- Hero Section dengan Efek Dekoratif Modis -->
    <div class="relative bg-white pt-36 pb-24 lg:pt-48 lg:pb-36 overflow-hidden border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <span class="bg-blue-50 text-blue-700 text-[11px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6 inline-flex items-center border border-blue-100 shadow-inner">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                    Tahun Ajaran 2026/2027
                </span>
                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight mb-6 leading-[1.15]">
                    Kelola Kegiatan Magang <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-indigo-600">Lebih Mudah & Modern</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 mb-10 leading-relaxed max-w-2xl mx-auto font-medium">
                    Platform terintegrasi yang menghubungkan Siswa, Guru Pembimbing, dan Mentor Industri untuk pemantauan kegiatan PKL yang efisien, transparan, dan real-time.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center w-full max-w-xl mx-auto sm:max-w-none">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary to-blue-800 text-white rounded-xl font-bold shadow-xl shadow-blue-900/10 hover:shadow-2xl hover:shadow-blue-900/20 hover:from-blue-900 hover:to-indigo-900 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tracking-wide text-sm">
                            <i class="fas fa-tachometer-alt text-xs opacity-80"></i> Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary to-blue-800 text-white rounded-xl font-bold shadow-xl shadow-blue-900/10 hover:shadow-2xl hover:shadow-blue-900/20 hover:from-blue-900 hover:to-indigo-900 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tracking-wide text-sm">
                            <i class="fas fa-sign-in-alt text-xs opacity-80"></i> Masuk Sekarang
                        </a>
                        <a href="#fitur" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-xl font-bold hover:bg-slate-50 hover:text-slate-900 hover:border-slate-300 shadow-sm transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                            Pelajari Lebih Lanjut
                        </a>
                        <a href="{{ asset('dokumen/panduan_prakerin.pdf') }}"
                        class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold
                                hover:from-blue-700 hover:to-indigo-700 active:from-blue-800 active:to-indigo-800
                                shadow-md shadow-blue-600/10 hover:shadow-lg hover:shadow-blue-600/20
                                transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2 text-sm"
                        target="_blank">
                            <i class="fas fa-file-pdf text-xs opacity-80"></i> Panduan Kerja Praktek
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Efek Blur Latar Belakang Eksklusif -->
        <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full z-0 pointer-events-none opacity-40">
            <div class="absolute top-10 left-10 w-80 h-80 bg-blue-300/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-20 right-10 w-80 h-80 bg-purple-300/30 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-4 left-1/3 w-96 h-96 bg-sky-200/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>
    </div>

    <!-- Section Fitur Utama -->
    <div id="fitur" class="py-24 bg-slate-50/60 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 max-w-xl mx-auto">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl">Solusi Untuk Semua Pihak</h2>
                <div class="w-12 h-1 bg-blue-600 rounded-full mx-auto mt-4 mb-3"></div>
                <p class="text-slate-500 font-medium">Satu aplikasi untuk mengintegrasikan seluruh proses magang.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10">
                <!-- Card Siswa -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:border-blue-500/20 transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-2 h-full bg-blue-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <div>
                        <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-primary text-2xl mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-sm shadow-blue-900/5">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3.5 tracking-tight group-hover:text-primary transition-colors">Untuk Siswa</h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">
                            Isi logbook harian digital, pantau kehadiran, dan lihat transkrip nilai langsung dari dashboard siswa yang responsif.
                        </p>
                    </div>
                </div>

                <!-- Card Guru -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:border-green-500/20 transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-2 h-full bg-green-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <div>
                        <div class="w-14 h-14 bg-green-50 border border-green-100 rounded-2xl flex items-center justify-center text-green-600 text-2xl mb-8 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 shadow-sm shadow-green-900/5">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3.5 tracking-tight group-hover:text-green-600 transition-colors">Untuk Guru</h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">
                            Monitoring aktivitas siswa bimbingan secara real-time, validasi laporan, dan input nilai akademik dengan mudah.
                        </p>
                    </div>
                </div>

                <!-- Card Industri -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:border-purple-500/20 transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <div>
                        <div class="w-14 h-14 bg-purple-50 border border-purple-100 rounded-2xl flex items-center justify-center text-purple-600 text-2xl mb-8 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 shadow-sm shadow-purple-900/5">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3.5 tracking-tight group-hover:text-purple-600 transition-colors">Untuk Industri</h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">
                            Mentor lapangan dapat memvalidasi logbook, memberikan feedback, dan menilai kinerja teknis & non-teknis siswa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Statistik Premium -->
    <div class="py-20 bg-gradient-to-br from-blue-950 via-blue-900 to-indigo-950 text-white relative overflow-hidden shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12 text-center">
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm shadow-xl shadow-black/10 transition duration-300 hover:bg-white/10">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight">50+</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-bold tracking-wider uppercase">Siswa Magang</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm shadow-xl shadow-black/10 transition duration-300 hover:bg-white/10">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight">10+</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-bold tracking-wider uppercase">Mitra Industri</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm shadow-xl shadow-black/10 transition duration-300 hover:bg-white/10">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight">100%</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-bold tracking-wider uppercase">Digital Logbook</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm shadow-xl shadow-black/10 transition duration-300 hover:bg-white/10">
                    <div class="text-4xl lg:text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-100 to-sky-300 bg-clip-text text-transparent tracking-tight">24/7</div>
                    <div class="text-blue-200 text-xs lg:text-sm font-bold tracking-wider uppercase">Akses Sistem</div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
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

            <!-- BAGIAN 2: SOSIAL MEDIA & COPYRIGHT BARRIS BAWAH -->
            <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-6">
                
                <!-- Tombol Sosial Media (Desain Pil Mengambang Kontras Tinggi) -->
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 order-2 md:order-1">
                    <!-- Instagram (Diperbarui dengan Ikon Font Awesome) -->
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

                    <!-- WhatsApp (Diperbarui dengan Ikon Font Awesome) -->
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

                <!-- Hak Cipta (Order 1 di mobile agar rapi) -->
                <p class="text-slate-500 text-xs text-center md:text-right font-semibold tracking-wide order-1 md:order-2">
                    &copy; {{ date('Y') }} <span class="text-blue-400 font-bold hover:text-blue-300 transition-colors">SMK Al Madani Pontianak</span>. <br class="sm:hidden"> All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Style Animasi Blob Tambahan & JavaScript Menu -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 8s infinite ease-in-out;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>

    <script>
        // Logika Interaktif Hamburgers Menu untuk Mobile Responsiveness
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const icon = document.getElementById('hamburger-icon');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if (mobileMenu.classList.contains('hidden')) {
                icon.classList.replace('fa-times', 'fa-bars');
            } else {
                icon.classList.replace('fa-bars', 'fa-times');
            }
        });
    </script>
</body>
</html>