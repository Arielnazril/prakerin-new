<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Administrator | e-Prakerin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_smk.png') }}">
    <!-- Menambahkan Google Fonts Plus Jakarta Sans agar tipografi terlihat lebih premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <!-- CSS Tailwind CDN Murni -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Style statis bawaan */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }

        /* Animasi Efek JS Tambahan */
        .ripple {
            position: absolute;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.3;
            animation: floatParticle 15s infinite linear;
        }
        @keyframes floatParticle {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.2;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 min-h-screen flex items-center justify-center font-sans px-4 sm:px-6 relative overflow-hidden selection:bg-red-500 selection:text-white py-10">

    <!-- Container Partikel Floating Interaktif JS -->
    <div id="particlesContainer" class="absolute inset-0 pointer-events-none z-0"></div>

    <!-- Dekorasi Background Elegan (Statis Tanpa Efek JS) -->
    <div id="bgGlowRed" class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-red-600/10 rounded-full blur-[130px] pointer-events-none transition-transform duration-700 ease-out"></div>
    <div id="bgGlowBlue" class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[130px] pointer-events-none transition-transform duration-700 ease-out"></div>

    <!-- Container Card Utama Layout 2 Kolom -->
    <div id="mainLoginCard" class="w-full max-w-5xl bg-white/[0.97] backdrop-blur-xl rounded-3xl shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)] border border-white/40 relative group overflow-hidden transition-all duration-500 hover:shadow-[0_35px_70px_-10px_rgba(239,68,68,0.15)] flex flex-col md:flex-row my-auto z-10">
        
        <!-- Garis Aksen Atas yang Diperhalus -->
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-red-500 via-red-600 to-amber-500 transition-all duration-500 group-hover:h-2.5 z-20"></div>

        <!-- SISI KIRI: PANEL INFORMASI ELEGAN (Tema Admin Merah/Dark Slate) -->
        <div class="w-full md:w-5/12 bg-gradient-to-br from-slate-900 via-slate-950 to-red-950 p-8 sm:p-12 text-white flex flex-col justify-between relative overflow-hidden border-b md:border-b-0 md:border-r border-slate-800">
            <!-- Pattern / Mesh Overlay -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ef4444_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10">
                <!-- Branding Header (Logo dengan Background Putih Solid Agar Jelas) -->
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center border border-slate-100 shadow-md transform transition-transform duration-300 hover:scale-110 hover:rotate-6">
                        <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK" class="w-8 h-8 object-contain">
                    </div>
                    <span class="text-xl font-extrabold tracking-wider text-white">e-Prakerin</span>
                </div>

                <!-- Hero Section Sisi Kiri -->
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight mb-4">
                    Portal Utama <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-amber-400">Administrator</span>
                </h1>
                <p class="text-slate-300 text-sm leading-relaxed mb-8 font-normal">
                    Pusat kendali dan manajemen sistem terpadu untuk pengelolaan data siswa, pembimbing, mitra industri, serta verifikasi laporan Prakerin secara terpusat.
                </p>

                <!-- Feature Badges -->
                <div class="space-y-3">
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm flex items-center gap-3 text-xs font-semibold text-slate-200 transition-all duration-300 hover:bg-white/10 hover:translate-x-1 cursor-default">
                        <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                        Kontrol Akses & Hak Pengguna Sistem
                    </div>
                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm flex items-center gap-3 text-xs font-semibold text-slate-200 transition-all duration-300 hover:bg-white/10 hover:translate-x-1 cursor-default">
                        <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                        Manajemen Data Master & Evaluasi
                    </div>
                </div>
            </div>

            <!-- Footer Sisi Kiri -->
            <div class="relative z-10 mt-12 pt-6 border-t border-white/10 text-slate-400 text-xs">
                © 2026 SMK Bisa Hebat. All rights reserved.
            </div>
        </div>

        <!-- SISI KANAN: FORM LOGIN ADMINISTRATOR -->
        <div class="w-full md:w-7/12 p-8 sm:p-12 flex flex-col justify-center bg-white relative">

            <div class="mb-8">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wider uppercase bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">LOGIN ADMINISTRATOR</h2>
                <div class="flex items-center gap-2 mt-2">
                    <span class="h-[3px] w-8 bg-red-500 rounded-full"></span>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Sistem Informasi Manajemen Prakerin</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50/90 border-l-4 border-red-500 text-red-900 p-4 rounded-2xl relative text-sm shadow-sm border border-red-100 animate-shake">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <strong class="font-bold block text-red-950">Akses Ditolak!</strong>
                            <span class="text-red-700 font-medium">{{ $errors->first() }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <form id="adminLoginForm" action="{{ route('login.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2.5">USERNAME ADMIN</label>
                    <div class="relative group/input">
                        <!-- Icon SVG untuk Username -->
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-red-500 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" name="username" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/10 focus:border-red-500 focus:bg-white outline-none transition-all duration-300 text-slate-800 placeholder-slate-400 font-semibold text-sm shadow-inner"
                            placeholder="Masukkan username admin">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2.5">PASSWORD</label>
                    <div class="relative group/input">
                        <!-- Icon SVG untuk Password -->
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-red-500 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" id="inputPassword" name="password" required
                            class="w-full pl-12 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/10 focus:border-red-500 focus:bg-white outline-none transition-all duration-300 text-slate-800 placeholder-slate-400 font-semibold text-sm shadow-inner"
                            placeholder="••••••••">
                        
                        <!-- Tombol Interaktif Toggle Password JS -->
                        <button type="button" id="togglePasswordBtn" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-red-500 transition-colors duration-200 cursor-pointer">
                            <svg id="eyeIconShow" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eyeIconHide" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 013.832-.863c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21f-3-3m-15 0L3 3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" id="btnSubmitLogin"
                        class="w-full py-4 bg-slate-900 text-white font-bold rounded-xl hover:bg-red-600 transition-all duration-300 shadow-xl shadow-slate-900/10 hover:shadow-red-600/20 transform hover:-translate-y-0.5 active:translate-y-0 tracking-widest text-xs uppercase relative overflow-hidden group/btn flex items-center justify-center gap-2">
                        <span id="btnText">MASUK KE PANEL ADMIN</span>
                        <svg id="btnSpinner" class="w-4 h-4 text-white animate-spin hidden" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs text-slate-500 hover:text-red-600 font-bold uppercase tracking-wider transition-colors duration-200 group/link">
                    <span class="transform group-hover/link:-translate-x-1.5 transition-transform duration-300">&larr;</span> Kembali ke Halaman Utama
                </a>
            </div>
        </div>

    </div>

    <!-- SCRIPT JAVASCRIPT ANIMASI TERPADU & INTERAKTIF -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Feature Toggle View Password
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const inputPassword = document.getElementById('inputPassword');
            const eyeIconShow = document.getElementById('eyeIconShow');
            const eyeIconHide = document.getElementById('eyeIconHide');

            if (togglePasswordBtn && inputPassword) {
                togglePasswordBtn.addEventListener('click', () => {
                    const isPassword = inputPassword.getAttribute('type') === 'password';
                    inputPassword.setAttribute('type', isPassword ? 'text' : 'password');
                    eyeIconShow.classList.toggle('hidden', isPassword);
                    eyeIconHide.classList.toggle('hidden', !isPassword);
                });
            }

            // 2. Parallax Effect Hovering on Card & Dynamic Background Glow
            const mainCard = document.getElementById('mainLoginCard');
            const bgGlowRed = document.getElementById('bgGlowRed');
            const bgGlowBlue = document.getElementById('bgGlowBlue');

            document.addEventListener('mousemove', (e) => {
                const { clientX, clientY } = e;
                const windowWidth = window.innerWidth;
                const windowHeight = window.innerHeight;

                const moveX = (clientX - windowWidth / 2) / 45;
                const moveY = (clientY - windowHeight / 2) / 45;

                if (mainCard) {
                    mainCard.style.transform = `translate3d(${moveX}px, ${moveY}px, 0)`;
                }

                if (bgGlowRed && bgGlowBlue) {
                    bgGlowRed.style.transform = `translate(${moveX * 1.5}px, ${moveY * 1.5}px)`;
                    bgGlowBlue.style.transform = `translate(${-moveX * 1.5}px, ${-moveY * 1.5}px)`;
                }
            });

            // 3. Efek Ripple pada Tombol Submit
            const btnSubmit = document.getElementById('btnSubmitLogin');
            if (btnSubmit) {
                btnSubmit.addEventListener('click', function (e) {
                    const rect = this.getBoundingClientRect();
                    const circle = document.createElement('span');
                    const diameter = Math.max(rect.width, rect.height);
                    const radius = diameter / 2;

                    circle.style.width = circle.style.height = `${diameter}px`;
                    circle.style.left = `${e.clientX - rect.left - radius}px`;
                    circle.style.top = `${e.clientY - rect.top - radius}px`;
                    circle.classList.add('ripple');

                    const ripple = this.getElementsByClassName('ripple')[0];
                    if (ripple) {
                        ripple.remove();
                    }

                    this.appendChild(circle);
                });
            }

            // 4. Loading State saat Form Disubmit
            const form = document.getElementById('adminLoginForm');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');

            if (form) {
                form.addEventListener('submit', () => {
                    if (btnSubmit && btnText && btnSpinner) {
                        btnSubmit.disabled = true;
                        btnSubmit.classList.add('opacity-90', 'cursor-wait');
                        btnText.textContent = 'MEMPROSES...';
                        btnSpinner.classList.remove('hidden');
                    }
                });
            }

            // 5. Generator Partikel Melayang Latar Belakang
            const particlesContainer = document.getElementById('particlesContainer');
            if (particlesContainer) {
                const particleColors = ['#ef4444', '#3b82f6', '#f59e0b', '#ffffff'];
                for (let i = 0; i < 20; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    const size = Math.random() * 4 + 2;
                    const color = particleColors[Math.floor(Math.random() * particleColors.length)];
                    
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.backgroundColor = color;
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100 + 100}%`;
                    particle.style.animationDelay = `${Math.random() * 8}s`;
                    particle.style.animationDuration = `${Math.random() * 10 + 10}s`;

                    particlesContainer.appendChild(particle);
                }
            }
        });
    </script>
</body>
</html>