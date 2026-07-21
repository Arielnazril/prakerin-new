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
<body class="bg-slate-950 text-slate-800 antialiased min-h-screen flex items-center justify-center p-3 sm:p-6 md:p-8 relative overflow-x-hidden selection:bg-blue-600 selection:text-white">

    <!-- Glowing Background Atmosphere (Ambient Glow Modern) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-blue-600/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-40 -right-40 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-indigo-600/20 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 sm:w-[600px] h-80 sm:h-[600px] bg-sky-500/10 rounded-full blur-[150px]"></div>
    </div>

    <!-- Main Card Container -->
    <div class="relative z-10 w-full max-w-5xl bg-white/95 backdrop-blur-2xl rounded-2xl sm:rounded-3xl shadow-2xl shadow-blue-950/40 overflow-hidden flex flex-col md:flex-row border border-white/20 transition-all duration-300 hover:shadow-blue-900/20 my-auto">

        <!-- Sidebar Kiri (Informasi Visual) -->
        <div class="hidden md:flex md:w-5/12 bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-950 text-white flex-col justify-between p-8 lg:p-10 relative overflow-hidden border-r border-slate-800/80">
            
            <!-- Background Ornamen Estetik (Glassmorphism Light Grid) -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-56 h-56 rounded-full bg-blue-500/20 blur-2xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/4 w-32 h-32 rounded-full bg-sky-400/10 blur-xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:1.5rem_1.5rem] pointer-events-none"></div>

            <!-- Top Header Section Sidebar -->
            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-8 lg:mb-10 group">
                    <div class="bg-gradient-to-tr from-blue-600 to-sky-400 p-2.5 rounded-2xl border border-white/20 shadow-lg shadow-blue-500/30 transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <span class="text-2xl font-black tracking-wider bg-gradient-to-r from-white via-blue-100 to-sky-200 bg-clip-text text-transparent">e-Prakerin</span>
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
                <div class="flex items-center space-x-3 text-xs text-blue-100 font-semibold">
                    <div class="w-6 h-6 rounded-lg bg-sky-500/20 flex items-center justify-center border border-sky-400/30 shrink-0">
                        <i class="fas fa-check text-sky-400 text-[10px]"></i>
                    </div>
                    <span>Proses Administrasi Lebih Cepat</span>
                </div>
                <div class="flex items-center space-x-3 text-xs text-blue-100 font-semibold">
                    <div class="w-6 h-6 rounded-lg bg-sky-500/20 flex items-center justify-center border border-sky-400/30 shrink-0">
                        <i class="fas fa-check text-sky-400 text-[10px]"></i>
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
            <div class="flex md:hidden items-center justify-between mb-6 pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-2.5">
                    <div class="bg-gradient-to-tr from-blue-600 to-indigo-600 p-2 rounded-xl text-white shadow-md shadow-blue-500/20">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <span class="text-xl font-black text-slate-900 tracking-tight">e-Prakerin</span>
                </div>
                <span class="text-[10px] font-extrabold uppercase bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full border border-blue-200/60">Registrasi</span>
            </div>

            <div class="mb-6 sm:mb-8">
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Buat Akun Siswa</h3>
                <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">Lengkapi data di bawah ini dengan benar untuk memulai.</p>
            </div>

            <!-- Error Validation Alert -->
            @if ($errors->any())
                <div class="mb-6 bg-rose-50/90 border-l-4 border-rose-500 text-rose-800 p-4 rounded-2xl shadow-sm text-xs sm:text-sm ring-1 ring-rose-500/10 backdrop-blur-sm animate-fadeIn">
                    <p class="font-extrabold mb-2 flex items-center text-rose-700">
                        <i class="fas fa-exclamation-triangle mr-2 text-base shrink-0"></i> Perhatikan beberapa hal berikut:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-rose-600 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5 sm:space-y-6">
                @csrf

                <!-- Section 1: Informasi Akun -->
                <div class="space-y-3.5 sm:space-y-4">
                    <h4 class="text-xs font-black text-blue-700 uppercase tracking-widest mb-3 border-b border-slate-100 pb-2 flex items-center">
                        <span class="bg-blue-600 text-white w-5 h-5 rounded-lg flex items-center justify-center text-[10px] font-black mr-2 shadow-sm shadow-blue-500/30">1</span>
                        Informasi Akun
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 sm:gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="Nama sesuai ijazah">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="username" value="{{ old('username') }}" required
                                class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="NIS Anda">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                            <div class="relative rounded-xl shadow-xs">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                    <i class="fas fa-envelope text-xs sm:text-sm"></i>
                                </span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium hover:border-slate-300" placeholder="email@sekolah.sch.id">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Data Sekolah -->
                <div class="space-y-3.5 sm:space-y-4">
                    <h4 class="text-xs font-black text-blue-700 uppercase tracking-widest mb-3 border-b border-slate-100 pb-2 flex items-center mt-2">
                        <span class="bg-blue-600 text-white w-5 h-5 rounded-lg flex items-center justify-center text-[10px] font-black mr-2 shadow-sm shadow-blue-500/30">2</span>
                        Data Sekolah
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 sm:gap-4">
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required
                                class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="Contoh: 20241055">
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Kelas</label>
                            <input type="text" name="kelas" value="{{ old('kelas') }}" required
                                class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="Contoh: XII RPL 1">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Jurusan Kompetensi</label>
                            <div class="relative rounded-xl shadow-xs">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                    <i class="fas fa-book text-xs sm:text-sm"></i>
                                </span>
                                <select name="jurusan_id" required class="w-full pl-10 pr-10 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm font-medium appearance-none cursor-pointer text-slate-700 hover:border-slate-300">
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

                <!-- Section 3: Kontak -->
                <div class="space-y-3.5 sm:space-y-4">
                    <h4 class="text-xs font-black text-blue-700 uppercase tracking-widest mb-3 border-b border-slate-100 pb-2 flex items-center mt-2">
                        <span class="bg-blue-600 text-white w-5 h-5 rounded-lg flex items-center justify-center text-[10px] font-black mr-2 shadow-sm shadow-blue-500/30">3</span>
                        Kontak & Alamat
                    </h4>
                    <div class="space-y-3.5 sm:space-y-4">
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">No. WhatsApp</label>
                            <div class="relative rounded-xl shadow-xs">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-emerald-600 pointer-events-none">
                                    <i class="fab fa-whatsapp text-sm sm:text-base"></i>
                                </span>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                    class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium hover:border-slate-300" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" required
                                class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition duration-200 bg-slate-50/50 focus:bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs resize-none hover:border-slate-300" placeholder="Nama Jalan, Kelurahan, Kecamatan...">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section Keamanan -->
                <div class="bg-gradient-to-br from-slate-50 via-blue-50/40 to-indigo-50/30 p-4 sm:p-5 rounded-2xl border border-blue-100/80 shadow-xs">
                    <h4 class="text-xs font-black text-blue-900 uppercase tracking-wider mb-3 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-sm text-blue-600"></i> Keamanan Akun
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 sm:gap-4">
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="********">
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Ulangi Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none bg-white text-xs sm:text-sm placeholder-slate-400 font-medium shadow-xs hover:border-slate-300" placeholder="********">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 text-white font-extrabold py-3.5 px-6 rounded-xl focus:ring-4 focus:ring-blue-300/50 transition duration-300 shadow-lg shadow-blue-800/25 transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide text-xs sm:text-sm cursor-pointer flex items-center justify-center group">
                        <span>Daftar Sekarang</span>
                        <i class="fas fa-arrow-right ml-2 text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
                    </button>
                </div>

                <!-- Footer Link (Bagian Diperbarui) -->
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <div class="bg-slate-50/80 hover:bg-blue-50/50 border border-slate-200/80 hover:border-blue-200/80 rounded-2xl p-3.5 text-center transition-all duration-300 group">
                        <p class="text-xs sm:text-sm text-slate-600 font-medium flex items-center justify-center space-x-1.5">
                            <span>Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="inline-flex items-center text-blue-700 font-extrabold hover:text-blue-900 transition-colors duration-200 group-hover:translate-x-0.5">
                                <span>Login disini</span>
                                <i class="fas fa-right-to-bracket ml-1.5 text-xs text-blue-600 transition-transform duration-200 group-hover:scale-110"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>