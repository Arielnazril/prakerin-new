<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Guru | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    
    <!-- Integrasi Google Fonts Plus Jakarta Sans untuk Tipografi Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { 
            theme: { 
                extend: { 
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
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
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-8px)' },
                        }
                    }
                } 
            }
        }
    </script>
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 min-h-screen flex items-center justify-center font-sans p-4 relative overflow-hidden selection:bg-blue-600 selection:text-white">
    
    <!-- Background Decoration (Efek Cahaya Modern & Halus Bergerak Lambat) -->
    <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[130px] pointer-events-none animate-pulse-slow"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-indigo-500/10 rounded-full blur-[130px] pointer-events-none animate-pulse-slow [animation-delay:3s]"></div>

    <!-- Card Wrapper Utama -->
    <div class="w-full max-w-md bg-white/[0.97] backdrop-blur-xl rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.4)] p-8 sm:p-10 border border-white/40 relative group overflow-hidden transition-all duration-500 hover:shadow-[0_35px_70px_-10px_rgba(37,99,235,0.15)]">
        
        <!-- Garis Aksen Atas yang Elegan -->
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-secondary-blue via-blue-500 to-cyan-400 transition-all duration-500 group-hover:h-2.5"></div>

        <div class="text-center mb-8 mt-2">
            <!-- Container Logo Sekolah dengan Efek Bayangan & Ring Lembut -->
            <div class="w-24 h-24 mx-auto mb-5 rounded-3xl bg-white shadow-xl shadow-blue-100/40 flex items-center justify-center border border-slate-100 transform group-hover:scale-105 group-hover:rotate-1 transition-all duration-500 ring-4 ring-slate-50/50">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="w-16 h-16 object-contain animate-float">
            </div>
            
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight sm:text-3xl bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">Login Guru Pembimbing</h2>
            
            <div class="flex items-center justify-center gap-3 mt-3">
                <span class="h-[2px] w-5 bg-gradient-to-r from-transparent to-blue-500/50 rounded"></span>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">e-Prakerin SMK</p>
                <span class="h-[2px] w-5 bg-gradient-to-l from-transparent to-blue-500/50 rounded"></span>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-2xl text-sm font-semibold border border-red-200/50 flex items-start gap-3 shadow-sm animate-shake">
                <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <span class="block text-red-950 font-bold mb-0.5">Terjadi Kesalahan:</span>
                    <span class="text-red-700/90 font-medium">{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2.5 ml-1">NIP GURU</label>
                <div class="relative group/input">
                    <!-- Penambahan Ikon SVG Identitas/ID Card -->
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-secondary-blue transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M21 12h-4m4 4h-4"/>
                        </svg>
                    </div>
                    <input type="text" name="username" required autofocus placeholder="Masukkan NIP anda"
                           class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-secondary-blue focus:bg-white outline-none transition-all duration-300 text-slate-800 placeholder:text-slate-400 font-semibold text-sm shadow-inner">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2.5 ml-1">Password</label>
                <div class="relative group/input">
                    <!-- Penambahan Ikon SVG Kunci/Keamanan -->
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-secondary-blue transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                           class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-secondary-blue focus:bg-white outline-none transition-all duration-300 text-slate-800 placeholder:text-slate-400 font-semibold text-sm shadow-inner">
                </div>
            </div>
            
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-4 bg-gradient-to-r from-secondary-blue to-blue-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-primary-blue shadow-lg shadow-blue-600/20 hover:shadow-xl hover:shadow-blue-700/30 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 text-xs tracking-widest uppercase relative overflow-hidden group/btn">
                    <!-- Efek kilatan cahaya halus (shimmer) saat tombol dirender/dilihat -->
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-white/0 via-white/10 to-white/0 -translate-x-full group-hover/btn:animate-[shimmer_1.5s_infinite]"></span>
                    MASUK SEBAGAI GURU
                </button>
            </div>
        </form>

        <div class="mt-8 text-center border-t border-slate-100 pt-6">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs text-slate-400 hover:text-secondary-blue font-bold uppercase tracking-wider transition-colors duration-200 group/link">
                <svg class="w-4 h-4 transform group-hover/link:-translate-x-1.5 transition-transform duration-300 text-slate-400 group-hover/link:text-secondary-blue" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Login Siswa
            </a>
        </div>
    </div>

    <!-- Gaya Animasi Kustom Pembantu Shimmer Tombol -->
    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
</body>
</html>