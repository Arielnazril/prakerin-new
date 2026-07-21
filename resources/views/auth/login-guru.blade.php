<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Guru | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    
    <!-- Integrasi Google Fonts Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk Ikon Tech Modern -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { 
            theme: { 
                extend: { 
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    },
                    colors: { 
                        'primary-blue': '#1e3a8a', 
                        'secondary-blue': '#2563eb' 
                    },
                    animation: {
                        'pulse-slow': 'pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-10px) rotate(1deg)' },
                        }
                    }
                } 
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-800 antialiased min-h-screen flex items-center justify-center p-3 sm:p-6 md:p-8 relative overflow-x-hidden selection:bg-blue-600 selection:text-white">
    
    <!-- Glowing Background Atmosphere (Ambient Glow Tech Modern) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-blue-600/20 rounded-full blur-[120px] animate-pulse-slow"></div>
        <div class="absolute -bottom-40 -right-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-indigo-600/20 rounded-full blur-[120px] animate-pulse-slow [animation-delay:3s]"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 sm:w-[600px] h-80 sm:h-[600px] bg-sky-500/10 rounded-full blur-[150px]"></div>
    </div>

    <!-- Main Card Container (Dibuat Seragam dengan Halaman Registrasi) -->
    <div class="relative z-10 w-full max-w-5xl bg-white/95 backdrop-blur-2xl rounded-2xl sm:rounded-3xl shadow-2xl shadow-blue-950/40 overflow-hidden flex flex-col md:flex-row border border-white/20 transition-all duration-300 hover:shadow-blue-900/20 my-auto">
        
        <!-- Sidebar Kiri (Informasi Visual & Teknologi Guru Pembimbing) -->
        <div class="hidden md:flex md:w-5/12 bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-950 text-white flex-col justify-between p-8 lg:p-10 relative overflow-hidden border-r border-slate-800/80">
            
            <!-- Background Ornaments (Glassmorphic Light Grid & Glow) -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-56 h-56 rounded-full bg-blue-500/20 blur-2xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/4 w-32 h-32 rounded-full bg-sky-400/10 blur-xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:1.5rem_1.5rem] pointer-events-none"></div>

            <!-- Top Section Header -->
            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-8 lg:mb-10 group">
                    <div class="w-12 h-12 rounded-2xl bg-white shadow-lg shadow-blue-500/30 flex items-center justify-center border border-white/20 transition-all duration-300 group-hover:scale-110 group-hover:rotate-3 ring-4 ring-white/10">
                        <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK" class="w-8 h-8 object-contain">
                    </div>
                    <span class="text-2xl font-black tracking-wider bg-gradient-to-r from-white via-blue-100 to-sky-200 bg-clip-text text-transparent">e-Prakerin</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-black mb-4 leading-[1.15] tracking-tight text-white">
                    Portal Guru Pembimbing
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed font-normal opacity-90">
                    Kelola monitoring siswa, verifikasi logbook harian, serta evaluasi penilaian Prakerin berbasis digital dengan aman dan responsif.
                </p>
            </div>

            <!-- Dashboard Mini Feature Card -->
            <div class="relative z-10 my-6 space-y-3 hidden lg:block bg-white/5 p-4 sm:p-5 rounded-2xl border border-white/10 backdrop-blur-md shadow-inner animate-float">
                <div class="flex items-center space-x-3 text-xs text-blue-100 font-semibold">
                    <div class="w-6 h-6 rounded-lg bg-sky-500/20 flex items-center justify-center border border-sky-400/30 shrink-0">
                        <i class="fas fa-chart-line text-sky-400 text-[10px]"></i>
                    </div>
                    <span>Monitoring Progress Real-time</span>
                </div>
                <div class="flex items-center space-x-3 text-xs text-blue-100 font-semibold">
                    <div class="w-6 h-6 rounded-lg bg-sky-500/20 flex items-center justify-center border border-sky-400/30 shrink-0">
                        <i class="fas fa-file-signature text-sky-400 text-[10px]"></i>
                    </div>
                    <span>Persetujuan Logbook & Laporan</span>
                </div>
            </div>

            <!-- Footer Sidebar -->
            <div class="relative z-10 text-[11px] text-slate-400 font-semibold tracking-wide">
                &copy; {{ date('Y') }} SMK Bisa Hebat. All rights reserved.
            </div>
        </div>

        <!-- Form Konten Kanan -->
        <div class="w-full md:w-7/12 p-6 sm:p-10 lg:p-12 relative bg-white/90 backdrop-blur-xl flex flex-col justify-center">

            <!-- Mobile Branding Bar (Khusus Tampilan Smartphone) -->
            <div class="flex md:hidden items-center justify-between mb-6 pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-white shadow-md border border-slate-100 flex items-center justify-center">
                        <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="w-7 h-7 object-contain">
                    </div>
                    <span class="text-xl font-black text-slate-900 tracking-tight">e-Prakerin</span>
                </div>
                <span class="text-[10px] font-extrabold uppercase bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full border border-blue-200/60">Akses Guru</span>
            </div>

            <div class="mb-6 sm:mb-8">
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Login Guru Pembimbing</h3>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="h-[2px] w-5 bg-gradient-to-r from-blue-600 to-sky-400 rounded"></span>
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">e-Prakerin SMK</p>
                </div>
            </div>

            <!-- Error Validation Alert -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-2xl text-sm font-semibold border border-red-200/50 flex items-start gap-3 shadow-sm animate-shake">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <span class="block text-red-950 font-bold mb-0.5">Terjadi Kesalahan:</span>
                        <span class="text-red-700/90 font-medium text-xs sm:text-sm">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" class="space-y-5 sm:space-y-6">
                @csrf
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-2">NIP GURU</label>
                    <div class="relative group/input">
                        <!-- Ikon SVG Identitas/ID Card -->
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-secondary-blue transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M21 12h-4m4 4h-4"/>
                            </svg>
                        </div>
                        <input type="text" name="username" required autofocus placeholder="Masukkan NIP anda"
                               class="w-full pl-12 pr-5 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-secondary-blue focus:bg-white outline-none transition-all duration-200 text-slate-800 placeholder:text-slate-400 font-semibold text-xs sm:text-sm shadow-xs hover:border-slate-300">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-2">Password</label>
                    <div class="relative group/input">
                        <!-- Ikon Gembok Font Awesome -->
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within/input:text-secondary-blue transition-colors duration-200">
                            <i class="fas fa-lock text-base"></i>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full pl-12 pr-5 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-secondary-blue focus:bg-white outline-none transition-all duration-200 text-slate-800 placeholder:text-slate-400 font-semibold text-xs sm:text-sm shadow-xs hover:border-slate-300">
                    </div>
                </div>
                
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3.5 bg-gradient-to-r from-secondary-blue via-blue-700 to-indigo-800 hover:from-blue-700 hover:to-indigo-900 text-white font-extrabold rounded-xl shadow-lg shadow-blue-800/25 hover:shadow-xl hover:shadow-blue-900/30 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 text-xs sm:text-sm tracking-widest uppercase relative overflow-hidden group/btn cursor-pointer">
                        <!-- Efek kilatan cahaya (shimmer) -->
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover/btn:animate-[shimmer_1.5s_infinite]"></span>
                        MASUK SEBAGAI GURU
                    </button>
                </div>
            </form>

            <!-- Card Callout "Kembali ke Login Siswa" Modern -->
            <div class="mt-8 pt-4 border-t border-slate-100">
                <div class="bg-slate-50/80 hover:bg-blue-50/50 border border-slate-200/80 hover:border-blue-200/80 rounded-2xl p-3.5 text-center transition-all duration-300 group">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 text-xs sm:text-sm text-slate-600 font-bold hover:text-secondary-blue transition-colors duration-200 group-hover:translate-x-0.5">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-300 text-slate-400 group-hover:text-secondary-blue" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Login Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>