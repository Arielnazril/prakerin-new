<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Siswa - e-Prakerin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 text-gray-800 antialiased min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-100 transition-all duration-300 hover:shadow-blue-900/5">

        <!-- Sidebar Kiri (Informasi Visual) -->
        <div class="hidden md:flex md:w-5/12 bg-gradient-to-b from-blue-950 via-blue-900 to-indigo-950 text-white flex-col justify-between p-10 relative overflow-hidden border-r border-blue-900/20">
            <!-- Background Ornamen Estetik -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-56 h-56 rounded-full bg-blue-600/20 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-indigo-500/20 blur-3xl"></div>
            <div class="absolute top-1/2 left-1/4 w-32 h-32 rounded-full bg-sky-400/10 blur-xl"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-10 group">
                    <div class="bg-white/10 backdrop-blur-md p-2.5 rounded-xl border border-white/20 shadow-inner shadow-white/10 transition-transform duration-300 group-hover:scale-105">
                        <i class="fas fa-graduation-cap text-sky-400 text-2xl"></i>
                    </div>
                    <span class="text-2xl font-black tracking-wider bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">e-Prakerin</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-extrabold mb-5 leading-tight tracking-tight">Mulai Perjalanan Karirmu Disini.</h2>
                <p class="text-blue-200/80 text-sm leading-relaxed font-light">Daftarkan dirimu untuk mengakses informasi magang, logbook digital, dan penilaian secara real-time.</p>
            </div>

            <!-- Fitur Tambahan Mini -->
            <div class="relative z-10 my-8 space-y-4 hidden lg:block bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-sm">
                <div class="flex items-center space-x-3 text-xs text-blue-100">
                    <i class="fas fa-check-circle text-sky-400"></i>
                    <span>Proses Administrasi Lebih Cepat</span>
                </div>
                <div class="flex items-center space-x-3 text-xs text-blue-100">
                    <i class="fas fa-check-circle text-sky-400"></i>
                    <span>Logbook Digital Terintegrasi</span>
                </div>
            </div>

            <div class="relative z-10 text-xs text-blue-300/70 font-medium tracking-wide">
                &copy; {{ date('Y') }} SMK Bisa Hebat. All rights reserved.
            </div>
        </div>

        <!-- Form Konten Kanan -->
        <div class="w-full md:w-7/12 p-8 sm:p-10 lg:p-12 relative bg-white">

            <div class="mb-8">
                <h3 class="text-3xl font-black text-gray-950 tracking-tight">Buat Akun Siswa</h3>
                <p class="text-gray-500 text-sm mt-1.5 font-medium">Lengkapi data di bawah ini dengan benar untuk memulai.</p>
            </div>

            <!-- Error Validation Alert -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-xl shadow-sm text-sm ring-1 ring-red-500/10">
                    <p class="font-bold mb-2 flex items-center text-red-700">
                        <i class="fas fa-exclamation-triangle mr-2 text-base"></i> Perhatikan beberapa hal berikut:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-red-600 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Section 1: Informasi Akun -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-blue-700 uppercase tracking-widest mb-3 border-b border-gray-100 pb-2 flex items-center">
                        <span class="bg-blue-100 text-blue-700 w-5 h-5 rounded-full flex items-center justify-center text-[10px] mr-2">1</span>
                        Informasi Akun
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm placeholder-gray-400 font-medium shadow-sm" placeholder="Nama sesuai ijazah">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="username" value="{{ old('username') }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm placeholder-gray-400 font-medium shadow-sm" placeholder="NIS Anda">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                            <div class="relative rounded-xl shadow-sm">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none">
                                    <i class="fas fa-envelope text-sm"></i>
                                </span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm placeholder-gray-400 font-medium" placeholder="email@sekolah.sch.id">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Data Sekolah -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-blue-700 uppercase tracking-widest mb-3 border-b border-gray-100 pb-2 flex items-center mt-2">
                        <span class="bg-blue-100 text-blue-700 w-5 h-5 rounded-full flex items-center justify-center text-[10px] mr-2">2</span>
                        Data Sekolah
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm placeholder-gray-400 font-medium shadow-sm" placeholder="Contoh: 20241055">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Kelas</label>
                            <input type="text" name="kelas" value="{{ old('kelas') }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm placeholder-gray-400 font-medium shadow-sm" placeholder="Contoh: XII RPL 1">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Jurusan Kompetensi</label>
                            <div class="relative rounded-xl shadow-sm">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none">
                                    <i class="fas fa-book text-sm"></i>
                                </span>
                                <select name="jurusan_id" required class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm font-medium appearance-none cursor-pointer text-gray-700">
                                    <option value="" disabled selected>-- Pilih Jurusan --</option>
                                    @foreach($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                            {{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan ?? 'KJ' }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-gray-400">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Kontak -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-blue-700 uppercase tracking-widest mb-3 border-b border-gray-100 pb-2 flex items-center mt-2">
                        <span class="bg-blue-100 text-blue-700 w-5 h-5 rounded-full flex items-center justify-center text-[10px] mr-2">3</span>
                        Kontak & Alamat
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">No. WhatsApp</label>
                            <div class="relative rounded-xl shadow-sm">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-emerald-600 pointer-events-none">
                                    <i class="fab fa-whatsapp text-base"></i>
                                </span>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm placeholder-gray-400 font-medium" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 bg-gray-50/50 focus:bg-white text-sm placeholder-gray-400 font-medium shadow-sm resize-none" placeholder="Nama Jalan, Kelurahan, Kecamatan...">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section Keamanan -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50/50 p-5 rounded-2xl border border-blue-100/70 shadow-inner">
                    <h4 class="text-xs font-bold text-blue-800 uppercase tracking-wider mb-3 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-sm text-blue-600"></i> Keamanan Akun
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white text-sm placeholder-gray-400 font-medium shadow-sm" placeholder="********">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Ulangi Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white text-sm placeholder-gray-400 font-medium shadow-sm" placeholder="********">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-700 to-indigo-700 text-white font-bold py-3 px-4 rounded-xl hover:from-blue-800 hover:to-indigo-800 focus:ring-4 focus:ring-blue-300/50 transition duration-300 shadow-md shadow-blue-700/20 transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide text-sm cursor-pointer">
                        Daftar Sekarang <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </button>
                </div>

                <!-- Footer Link -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500 font-medium">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:text-blue-800 hover:underline transition ml-0.5">Login disini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>