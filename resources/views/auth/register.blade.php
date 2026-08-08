<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Siswa - e-Prakerin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary-blue': '#234F35',
                        'secondary-blue': '#89C74A',
                        'greenDark': '#234F35',
                        'greenLight': '#89C74A',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }
        
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
        }
        .animate-float {
            animation: float-slow 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-800 antialiased min-h-screen flex flex-col font-sans relative overflow-x-hidden selection:bg-greenDark selection:text-white">

    <!-- Glowing Background Atmosphere (Ambient Glow Modern) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-emerald-700/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-40 -right-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-greenDark/20 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 sm:w-[600px] h-80 sm:h-[600px] bg-greenLight/10 rounded-full blur-[150px]"></div>
    </div>

    <!-- WRAPPER UTAMA UNTUK FORM REGISTRASI -->
    <div class="flex-1 flex items-center justify-center py-6 sm:py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Main Card Container -->
        <div class="w-full max-w-5xl bg-white/95 backdrop-blur-2xl rounded-3xl sm:rounded-3xl shadow-2xl shadow-slate-950/40 overflow-hidden flex flex-col md:flex-row border border-white/20 transition-all duration-300 hover:shadow-emerald-950/20 my-auto">

            <!-- Sidebar Kiri (Informasi Visual) -->
            <div class="hidden md:flex md:w-5/12 bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-950 text-white flex-col justify-between p-8 lg:p-10 relative overflow-hidden border-r border-slate-800/80">
                
                <!-- Background Ornamen Estetik (Glassmorphism Light Grid) -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-56 h-56 rounded-full bg-greenLight/20 blur-2xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-greenDark/30 blur-3xl pointer-events-none"></div>
                <div class="absolute top-1/2 left-1/4 w-32 h-32 rounded-full bg-lime-400/10 blur-xl pointer-events-none"></div>
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:1.5rem_1.5rem] pointer-events-none"></div>

                <!-- Top Header Section Sidebar -->
                <div class="relative z-10">
                    <div class="flex items-center space-x-3 mb-8 lg:mb-10 group">
                        <div class="bg-gradient-to-tr from-greenDark to-greenLight p-2.5 rounded-2xl border border-white/20 shadow-lg shadow-greenDark/30 transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
                        </div>
                        <span class="text-2xl font-black tracking-wider bg-gradient-to-r from-white via-emerald-100 to-greenLight bg-clip-text text-transparent">e-Prakerin</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-black mb-4 leading-[1.15] tracking-tight text-white">
                        Mulai Perjalanan Karirmu Disini.
                    </h2>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed font-normal opacity-90">
                        Daftarkan dirimu untuk mengakses informasi magang, logbook digital, dan penilaian secara real-time.
                    </p>
                </div>

                <!-- Fitur Tambahan Mini -->
                <div class="relative z-10 my-6 space-y-3 hidden lg:block bg-white/5 p-4 sm:p-5 rounded-2xl border border-white/10 backdrop-blur-md shadow-inner animate-float">
                    <div class="flex items-center space-x-3 text-xs text-emerald-100 font-semibold">
                        <div class="w-6 h-6 rounded-lg bg-greenLight/20 flex items-center justify-center border border-greenLight/30 shrink-0">
                            <i class="fas fa-check text-greenLight text-[10px]"></i>
                        </div>
                        <span>Proses Administrasi Lebih Cepat</span>
                    </div>
                    <div class="flex items-center space-x-3 text-xs text-emerald-100 font-semibold">
                        <div class="w-6 h-6 rounded-lg bg-greenLight/20 flex items-center justify-center border border-greenLight/30 shrink-0">
                            <i class="fas fa-check text-greenLight text-[10px]"></i>
                        </div>
                        <span>Logbook Digital Terintegrasi</span>
                    </div>
                </div>

                <!-- Footer Sidebar -->
                <div class="relative z-10 text-[11px] text-slate-400 font-semibold tracking-wide">
                    &copy; {{ date('Y') }} SMK Bisa Hebat. All rights reserved.
                </div>
            </div>

            <!-- Form Konten Kanan -->
            <div class="w-full md:w-7/12 p-5 sm:p-8 lg:p-10 relative bg-white/90 backdrop-blur-xl">

                <!-- Mobile Branding Bar (Tampil Khusus Layar Kecil) -->
                <div class="flex md:hidden items-center justify-between mb-5 pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2.5">
                        <div class="bg-gradient-to-tr from-greenDark to-greenLight p-2 rounded-xl text-white shadow-md shadow-greenDark/20">
                            <i class="fas fa-graduation-cap text-base sm:text-lg"></i>
                        </div>
                        <span class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">e-Prakerin</span>
                    </div>
                    <span class="text-[9px] sm:text-[10px] font-extrabold uppercase bg-emerald-50 text-greenDark px-2.5 py-1 rounded-full border border-emerald-200/60">Registrasi</span>
                </div>

                <div class="mb-5 sm:mb-8">
                    <h3 class="text-xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">Buat Akun Siswa</h3>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">Lengkapi data di bawah ini dengan benar untuk memulai.</p>
                </div>

                <!-- Error Validation Alert -->
                @if ($errors->any())
                    <div class="mb-5 bg-rose-50/90 border-l-4 border-rose-500 text-rose-800 p-3.5 sm:p-4 rounded-2xl shadow-sm text-xs sm:text-sm ring-1 ring-rose-500/10 backdrop-blur-sm animate-fadeIn">
                        <p class="font-extrabold mb-1.5 flex items-center text-rose-700">
                            <i class="fas fa-exclamation-triangle mr-2 text-sm sm:text-base shrink-0"></i> Perhatikan beberapa hal berikut:
                        </p>
                        <ul class="list-disc list-inside space-y-1 text-rose-600 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-6">
                    @csrf

                    <!-- Section 1: Informasi Akun -->
                    <div class="space-y-3 sm:space-y-4">
                        <h4 class="text-[11px] sm:text-xs font-black text-greenDark uppercase tracking-widest mb-2.5 sm:mb-3 border-b border-slate-100 pb-2 flex items-center">
                            <span class="bg-greenDark text-white w-5 h-5 rounded-lg flex items-center justify-center text-[10px] font-black mr-2 shadow-sm shadow-greenDark/30">1</span>
                            Informasi Akun
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                            <div class="col-span-1">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="Nama sesuai ijazah">
                            </div>
                            <div class="col-span-1">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Induk Siswa (NIS)</label>
                                <input type="text" name="username" value="{{ old('username') }}" required
                                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="NIS Anda">
                            </div>
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                                <div class="relative rounded-xl shadow-xs">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                        <i class="fas fa-envelope text-xs sm:text-sm"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium hover:border-slate-300" placeholder="email@sekolah.sch.id">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Data Sekolah -->
                    <div class="space-y-3 sm:space-y-4">
                        <h4 class="text-[11px] sm:text-xs font-black text-greenDark uppercase tracking-widest mb-2.5 sm:mb-3 border-b border-slate-100 pb-2 flex items-center mt-2">
                            <span class="bg-greenDark text-white w-5 h-5 rounded-lg flex items-center justify-center text-[10px] font-black mr-2 shadow-sm shadow-greenDark/30">2</span>
                            Data Sekolah
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div class="col-span-1">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Induk Siswa (NIS)</label>
                                <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required
                                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="Contoh: 20241055">
                            </div>
                            <div class="col-span-1">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Kelas</label>
                                <input type="text" name="kelas" value="{{ old('kelas') }}" required
                                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="Contoh: XII RPL 1">
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Jurusan Kompetensi</label>
                                <div class="relative rounded-xl shadow-xs">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                        <i class="fas fa-book text-xs sm:text-sm"></i>
                                    </span>
                                    <select name="jurusan_id" required class="w-full pl-10 pr-10 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm font-medium appearance-none cursor-pointer text-slate-700 hover:border-slate-300">
                                        <option value="" disabled selected>-- Pilih Jurusan --</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                {{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan ?? 'KJ' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Kontak & Alamat -->
                    <div class="space-y-3 sm:space-y-4">
                        <h4 class="text-[11px] sm:text-xs font-black text-greenDark uppercase tracking-widest mb-2.5 sm:mb-3 border-b border-slate-100 pb-2 flex items-center mt-2">
                            <span class="bg-greenDark text-white w-5 h-5 rounded-lg flex items-center justify-center text-[10px] font-black mr-2 shadow-sm shadow-greenDark/30">3</span>
                            Kontak & Alamat
                        </h4>
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">No. WhatsApp</label>
                                <div class="relative rounded-xl shadow-xs">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-emerald-600 pointer-events-none">
                                        <i class="fab fa-whatsapp text-xs sm:text-sm"></i>
                                    </span>
                                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium hover:border-slate-300" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" required
                                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs resize-none hover:border-slate-300" placeholder="Nama Jalan, Kelurahan, Kecamatan...">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Section Keamanan -->
                    <div class="bg-gradient-to-br from-slate-50 via-emerald-50/40 to-lime-50/30 p-3.5 sm:p-5 rounded-2xl border border-emerald-100/80 shadow-xs">
                        <h4 class="text-[11px] sm:text-xs font-black text-greenDark uppercase tracking-wider mb-2.5 sm:mb-3 flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-xs sm:text-sm text-greenDark"></i> Keamanan Akun
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div class="col-span-1">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Password</label>
                                <input type="password" name="password" required
                                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="********">
                            </div>
                            <div class="col-span-1">
                                <label class="block text-[10px] sm:text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Ulangi Password</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-greenLight/30 focus:border-greenDark outline-none bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="********">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-1 sm:pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-greenDark via-emerald-900 to-greenDark hover:from-emerald-900 hover:to-slate-900 text-white font-extrabold py-3 sm:py-3.5 px-6 rounded-xl focus:ring-4 focus:ring-greenLight/40 transition duration-300 shadow-md sm:shadow-lg shadow-greenDark/25 transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide text-xs sm:text-sm cursor-pointer flex items-center justify-center group">
                            <span>Daftar Sekarang</span>
                            <i class="fas fa-arrow-right ml-2 text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
                        </button>
                    </div>

                    <!-- Footer Link -->
                    <div class="mt-5 sm:mt-6 pt-3.5 sm:pt-4 border-t border-slate-100">
                        <div class="bg-slate-50/80 hover:bg-emerald-50/50 border border-slate-200/80 hover:border-emerald-200/80 rounded-2xl p-3 sm:p-3.5 text-center transition-all duration-300 group">
                            <p class="text-xs sm:text-sm text-slate-600 font-medium flex items-center justify-center space-x-1.5">
                                <span>Sudah punya akun?</span>
                                <a href="{{ route('login') }}" class="inline-flex items-center text-greenDark font-extrabold hover:text-emerald-900 transition-colors duration-200 group-hover:translate-x-0.5">
                                    <span>Login disini</span>
                                    <i class="fas fa-right-to-bracket ml-1.5 text-xs text-greenDark transition-transform duration-200 group-hover:scale-110"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Cantik & Profesional (Disisipkan dengan Rapi & Responsif Mobile) -->
    <footer class="bg-gradient-to-br from-slate-950 via-emerald-950 via-slate-900 to-slate-950 border-t border-greenLight/30 pt-10 sm:pt-16 pb-8 sm:pb-12 transition-all duration-300 relative overflow-hidden select-none z-10 mt-auto">
        
        <!-- Ornamen Ambient Glow Neon (Estetika Premium Sisi Kiri & Kanan) -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-greenLight/15 rounded-full filter blur-[100px] pointer-events-none animate-pulse"></div>
        <div class="absolute -bottom-20 -left-20 w-[500px] h-[500px] bg-greenDark/20 rounded-full filter blur-[120px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- BAGIAN 1: GRID UTAMA UTK INFORMASI & KARTU UTAMA -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-10 pb-8 sm:pb-12 border-b border-slate-800/60 items-start">
                
                <!-- Branding Utama (Kolom Kiri - Lebar 5 Grid) -->
                <div class="lg:col-span-5 space-y-3 sm:space-y-5 text-center lg:text-left flex flex-col items-center lg:items-start">
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
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-5 w-full">
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

</body>
</html>