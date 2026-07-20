<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Siswa | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    <!-- Font Inter untuk tampilan tipografi yang lebih modern dan premium -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome untuk ikon interaktif jika diperlukan -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
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
        /* Smooth custom focus shadow */
        .focus-glow:focus {
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }
    </style>
</head>

<body class="bg-[radial-gradient(135deg,_#f8fafc_0%,_#f1f5f9_100%)] min-h-screen flex flex-col font-sans antialiased selection:bg-secondary-blue selection:text-white">

    {{-- WRAPPER UTAMA UNTUK LOGIN --}}
    <div class="flex-1 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-5xl animate-fade-in-up">

            <div class="flex flex-col lg:flex-row w-full bg-white rounded-[32px] shadow-[0_25px_60px_-15px_rgba(30,58,138,0.12)] border border-gray-100/80 overflow-hidden backdrop-blur-sm">

                <!-- KIRI: BRANDING HERO SIDE -->
                <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-blue via-[#1e40af] to-blue-900 items-center justify-center relative p-16 overflow-hidden">
                    
                    <!-- Decorative background glow spheres -->
                    <div class="absolute -top-24 -left-24 w-72 h-72 bg-blue-600 rounded-full opacity-20 blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-sky-500 rounded-full opacity-20 blur-3xl pointer-events-none"></div>

                    <div class="relative z-10 text-center text-white flex flex-col items-center">
                        <!-- KARTU PUTIH UNTUK LOGO -->
                        <div class="w-36 h-36 mx-auto mb-8 rounded-[28px] bg-white/95 shadow-[0_20px_40px_rgba(0,0,0,0.15)] flex items-center justify-center backdrop-blur-md border border-white transform hover:rotate-3 transition-transform duration-300 group cursor-default">
                            <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK"
                                class="w-26 h-26 object-contain p-2 transform group-hover:scale-105 transition-transform duration-300">
                        </div>

                        <h2 class="text-4xl font-black mb-3 tracking-tight bg-clip-text text-transparent bg-gradient-to-b from-white to-blue-100">e-Prakerin</h2>
                        <p class="text-blue-100/90 text-lg font-normal max-w-xs leading-relaxed">
                            Sistem Informasi Manajemen Praktik Kerja Industri
                        </p>
                    </div>

                    <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none"
                        style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
                </div>

                <!-- KANAN: FORM INTERACTIVE SIDE -->
                <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-16 bg-white relative">
                    <div class="w-full max-w-md">
                        <div class="text-center mb-9">
                            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2.5">Selamat Datang!</h2>
                            <p class="text-gray-500 font-medium text-sm sm:text-base">Silakan masuk menggunakan akun Siswa</p>
                        </div>

                        @if (session('status_pending'))
                            <div class="mb-6 bg-amber-50/80 border-l-4 border-amber-500 p-4 rounded-2xl shadow-sm border border-amber-100/50 backdrop-blur-sm transition-all">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="h-5 w-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3.5">
                                        <h3 class="text-sm font-bold text-amber-900 tracking-wide">Menunggu Verifikasi</h3>
                                        <div class="mt-1 text-sm text-amber-800 font-medium leading-relaxed">
                                            {{ session('status_pending') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session('status'))
                            <div class="mb-6 bg-emerald-50/80 border-l-4 border-emerald-500 p-4 rounded-2xl shadow-sm border border-emerald-100/50">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3.5">
                                        <p class="text-sm font-semibold text-emerald-900">{{ session('status') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-6 bg-rose-50/80 border-l-4 border-rose-500 p-4 rounded-2xl shadow-sm border border-rose-100/50">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="h-5 w-5 text-rose-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3.5">
                                        <h3 class="text-sm font-bold text-rose-900 tracking-wide">Login Gagal</h3>
                                        <p class="text-sm text-rose-800 font-medium mt-0.5">{{ $errors->first() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('login.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2 tracking-wide">NIS (Nomor Induk Siswa)</label>
                                <div class="relative group">
                                    <input type="text" name="username" required autofocus
                                        placeholder="Contoh: 102030"
                                        class="w-full pl-4 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary-blue focus:border-secondary-blue text-gray-800 placeholder-gray-400 font-medium bg-gray-50/50 hover:bg-gray-50 focus:bg-white focus-glow transition-all duration-300 outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2 tracking-wide">Kata Sandi</label>
                                <div class="relative group">
                                    <input type="password" name="password" required placeholder="••••••••"
                                        class="w-full pl-4 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary-blue focus:border-secondary-blue text-gray-800 placeholder-gray-400 font-medium bg-gray-50/50 hover:bg-gray-50 focus:bg-white focus-glow transition-all duration-300 outline-none">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-3.5 px-4 bg-secondary-blue hover:bg-primary-blue text-white font-bold rounded-xl shadow-[0_10px_20px_-5px_rgba(37,99,235,0.3)] hover:shadow-[0_15px_25px_-5px_rgba(30,58,138,0.4)] transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide">
                                MASUK SEKARANG
                            </button>
                        </form>

                        <div class="relative flex py-7 items-center">
                            <div class="flex-grow border-t border-gray-100"></div>
                            <span class="flex-shrink mx-4 text-gray-400 text-xs font-bold tracking-widest uppercase">Masuk Sebagai</span>
                            <div class="flex-grow border-t border-gray-100"></div>
                        </div>

                        <div class="space-y-3.5">
                            <a href="{{ route('login.guru') }}"
                                class="w-full block py-3.5 px-4 border-2 border-secondary-blue rounded-xl font-bold text-secondary-blue hover:text-white hover:bg-secondary-blue text-center shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide">
                                LOGIN GURU
                            </a>
                            <a href="{{ route('login.industri') }}"
                                class="w-full block py-3.5 px-4 border-2 border-gray-300 rounded-xl font-bold text-gray-600 hover:text-white hover:bg-gray-700 hover:border-gray-700 text-center shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide">
                                LOGIN INDUSTRI
                            </a>
                        </div>

                        <div class="mt-9 text-center pt-5 border-t border-gray-100/80">
                            <p class="text-sm text-gray-500 font-medium">Belum punya akun?</p>
                            <a href="{{ route('register') }}"
                                class="font-bold text-secondary-blue hover:text-primary-blue hover:underline transition-colors mt-1 inline-block tracking-wide">Daftar Akun Siswa</a>
                        </div>
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

        <!-- BAGIAN 2: SOSIAL MEDIA & COPYRIGHT BARRIS BAWAH -->
        <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-6">
            
            <!-- Tombol Sosial Media (Desain Pil Mengambang Kontras Tinggi) -->
            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 order-2 md:order-1">
                <!-- Instagram (Diperbarui dengan Ikon Font Awesome) -->
                <a href="https://www.instagram.com/smkalmadaniptk_official" target="_blank"
                class="flex items-center gap-2.5 group bg-slate-900/80 hover:bg-gradient-to-r hover:from-purple-900/30 hover:to-pink-900/20 py-2.5 pl-2.5 pr-4 rounded-xl border border-slate-800 hover:border-pink-500/40 shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-amber-500 via-red-500 to-purple-600 shadow-md flex items-center justify-center transform group-hover:rotate-12 transition-all duration-300">
                        <!-- Menggunakan ikon brand Font Awesome asli untuk Instagram -->
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
                        <!-- Menggunakan ikon brand Font Awesome asli untuk WhatsApp -->
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

</body>
</html>