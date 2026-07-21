@php
    $user = Auth::user();
    $layout = 'layouts.app';

    // 1. Tentukan Layout
    if($user->role == 'admin') {
        $layout = 'layouts.admin_layout';
    } elseif($user->role == 'siswa') {
        $layout = 'layouts.siswa_layout';
    } elseif($user->role == 'industri') {
        $layout = 'layouts.industri_layout';
    } elseif($user->role == 'guru') {
        $layout = 'layouts.guru_layout';
    }

    // 2. Tentukan Label Identitas (Supaya Dinamis)
    $labelIdentitas = 'Nomor Identitas';
    $placeholderIdentitas = 'Nomor ID';

    if($user->role == 'siswa') {
        $labelIdentitas = 'NIS (Nomor Induk Siswa)';
    } elseif($user->role == 'guru') {
        $labelIdentitas = 'NIP / NUPTK';
    } elseif($user->role == 'industri') {
        $labelIdentitas = 'NIK / ID Karyawan';
    }
@endphp

@extends($layout)

@section('page_title', 'Pengaturan Profil')

@section('content')

<div class="max-w-4xl mx-auto space-y-6 sm:space-y-8 px-3 sm:px-6 lg:px-0 py-4 sm:py-6">

    {{-- HEADER PROFILE DENGAN AVATAR INISIAL --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-4 sm:p-6 rounded-2xl shadow-xs border border-gray-100 transition-all duration-300 hover:shadow-md relative overflow-hidden group/header">
        {{-- Decorative background gradient blur effect --}}
        <div class="absolute -right-16 -top-16 w-36 h-36 bg-blue-500/5 rounded-full blur-2xl transition-all duration-500 group-hover/header:scale-150"></div>
        
        <div class="flex items-center space-x-3.5 sm:space-x-4 z-10 w-full sm:w-auto">
            <div class="h-14 w-14 sm:h-16 sm:w-16 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white flex items-center justify-center font-black text-xl sm:text-2xl shadow-lg shadow-blue-500/20 transform hover:scale-105 hover:rotate-3 transition-all duration-300 select-none shrink-0">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="min-w-0 flex-1">
                <h2 class="text-xl sm:text-2xl font-black text-gray-800 tracking-tight flex items-center gap-2 truncate">
                    Profil Saya
                </h2>
                <p class="text-gray-400 text-xs sm:text-sm font-medium mt-0.5 sm:mt-1 leading-snug">Kelola informasi akun dan data diri Anda secara real-time.</p>
            </div>
        </div>
        
        <div class="px-3.5 py-1.5 sm:px-4 sm:py-2 bg-gradient-to-r from-blue-50 to-indigo-50/60 text-blue-700 rounded-xl text-[10px] sm:text-xs font-black uppercase tracking-widest border border-blue-100 shadow-3xs flex items-center gap-2 select-none z-10 self-start sm:self-center shrink-0">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
            </span>
            Role: {{ $user->role }}
        </div>
    </div>

    {{-- INFORMASI PRIBADI --}}
    <div class="bg-white p-4 sm:p-6 md:p-8 rounded-2xl shadow-xs border border-gray-100/90 transition-all duration-300 hover:shadow-md group/card">
        <div class="border-b border-gray-100 pb-4 sm:pb-5 mb-5 sm:mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1.5 sm:gap-2">
            <h3 class="text-base sm:text-lg font-black text-gray-800 flex items-center tracking-tight transition-colors duration-200 group-focus-within/card:text-blue-600">
                <span class="p-2 sm:p-2.5 bg-blue-50 text-blue-600 rounded-xl mr-2.5 sm:mr-3 border border-blue-100/50 shadow-3xs transition-transform duration-300 group-focus-within/card:scale-105 shrink-0">
                    <i class="fas fa-id-card text-sm sm:text-base"></i>
                </span> 
                Informasi Pribadi
            </h3>
            <span class="text-[10px] sm:text-[11px] text-gray-400 font-medium">Pastikan data yang dimasukkan sudah valid</span>
        </div>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-5 sm:space-y-6">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">

                {{-- Nama Lengkap --}}
                <div class="group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2 transition-colors duration-200 group-focus-within/section:text-blue-600">Nama Lengkap</label>
                    <div class="relative shadow-3xs rounded-xl">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within/section:text-blue-500 transition-colors duration-200">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full pl-11 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-hidden transition-all duration-200 text-gray-800 text-sm font-semibold bg-white placeholder:text-gray-300" required>
                    </div>
                    @error('name') <span class="text-red-500 text-xs mt-2 block font-bold tracking-wide flex items-center gap-1.5 animate-fadeIn"><i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}</span> @enderror
                </div>

                {{-- Username --}}
                <div class="group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2 transition-colors duration-200 group-focus-within/section:text-blue-600">Username</label>
                    <div class="relative shadow-3xs rounded-xl">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within/section:text-blue-500 transition-colors duration-200">
                            <i class="fas fa-at text-sm"></i>
                        </span>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full pl-11 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-hidden transition-all duration-200 text-gray-800 text-sm font-semibold bg-white placeholder:text-gray-300" required>
                    </div>
                    @error('username') <span class="text-red-500 text-xs mt-2 block font-bold tracking-wide flex items-center gap-1.5 animate-fadeIn"><i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}</span> @enderror
                </div>

                {{-- Nomor Identitas (Read-only) --}}
                <div class="group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">{{ $labelIdentitas }}</label>
                    <div class="relative shadow-3xs rounded-xl bg-gray-50/80 border border-gray-200/60 transition-colors duration-200">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fas fa-fingerprint text-sm"></i>
                        </span>
                        <input type="text" value="{{ $user->nomor_identitas }}" class="w-full pl-11 pr-10 py-2.5 sm:py-3 rounded-xl text-gray-400 cursor-not-allowed text-sm font-mono font-bold select-none focus:outline-hidden bg-transparent" readonly>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 text-xs opacity-60"></i>
                        </div>
                    </div>
                    <p class="text-[10px] sm:text-[11px] text-gray-400 mt-2 flex items-start gap-1.5 font-medium leading-relaxed">
                        <i class="fas fa-info-circle text-[11px] text-blue-500/80 mt-0.5 shrink-0"></i> 
                        <span>Hubungi pihak kurikulum/admin jika ingin mengubah nomor identitas sistem Anda.</span>
                    </p>
                </div>

                {{-- Alamat Email --}}
                <div class="group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2 transition-colors duration-200 group-focus-within/section:text-blue-600">Alamat Email</label>
                    <div class="relative shadow-3xs rounded-xl">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within/section:text-blue-500 transition-colors duration-200">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full pl-11 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-hidden transition-all duration-200 text-gray-800 text-sm font-semibold bg-white placeholder:text-gray-300" required>
                    </div>
                    @error('email') <span class="text-red-500 text-xs mt-2 block font-bold tracking-wide flex items-center gap-1.5 animate-fadeIn"><i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}</span> @enderror
                </div>

                {{-- Nomor HP / WhatsApp --}}
                <div class="col-span-1 md:col-span-2 group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2 transition-colors duration-200 group-focus-within/section:text-emerald-600">Nomor HP / WhatsApp</label>
                    <div class="relative shadow-3xs rounded-xl">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within/section:text-emerald-500 group-focus-within/section:scale-105 transition-all duration-200">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="w-full pl-11 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-hidden transition-all duration-200 text-gray-800 text-sm font-semibold bg-white placeholder:text-gray-300" placeholder="08xxxxxxxxxx">
                    </div>
                    @error('no_hp') <span class="text-red-500 text-xs mt-2 block font-bold tracking-wide flex items-center gap-1.5 animate-fadeIn"><i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}</span> @enderror
                </div>

                {{-- Kondisional Khusus Siswa --}}
                @if($user->role == 'siswa')
                <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-5 sm:pt-6 mt-1 sm:mt-2 bg-gray-50/50 -mx-4 px-4 sm:-mx-6 sm:px-6 md:-mx-8 md:px-8 pb-4 rounded-b-2xl">
                    <p class="text-xs font-black text-blue-600 uppercase tracking-widest mb-3.5 sm:mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2.5 text-sm bg-blue-100/80 p-1.5 rounded-lg shadow-3xs"></i> Data Akademik Internal
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 sm:gap-4">
                        <div>
                            <label class="block text-[10px] sm:text-[11px] font-black uppercase tracking-wider text-gray-400 mb-1.5">Kelas</label>
                            <input type="text" value="{{ $user->kelas }}" class="w-full px-4 py-2 sm:py-2.5 border border-gray-200 bg-white shadow-3xs rounded-xl text-xs sm:text-sm text-gray-600 font-bold outline-hidden cursor-not-allowed select-none border-dashed" readonly>
                        </div>
                        <div>
                            <label class="block text-[10px] sm:text-[11px] font-black uppercase tracking-wider text-gray-400 mb-1.5">Jurusan</label>
                            <input type="text" value="{{ $user->jurusan->nama_jurusan ?? '-' }}" class="w-full px-4 py-2 sm:py-2.5 border border-gray-200 bg-white shadow-3xs rounded-xl text-xs sm:text-sm text-gray-600 font-bold outline-hidden cursor-not-allowed select-none border-dashed" readonly>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Kondisional Khusus Industri --}}
                @if($user->role == 'industri')
                <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-5 sm:pt-6 mt-1 sm:mt-2 bg-gray-50/50 -mx-4 px-4 sm:-mx-6 sm:px-6 md:-mx-8 md:px-8 pb-5 rounded-b-2xl">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Instansi / Perusahaan Tempat Tugas</label>
                    <div class="relative shadow-3xs rounded-xl bg-white border border-gray-200 border-dashed">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fas fa-building text-sm"></i>
                        </span>
                        <input type="text" value="{{ $user->instansi->nama_perusahaan ?? '-' }}" class="w-full pl-11 pr-4 py-2.5 sm:py-3 rounded-xl text-gray-600 text-xs sm:text-sm font-bold cursor-not-allowed select-none focus:outline-hidden bg-transparent" readonly>
                    </div>
                </div>
                @endif

            </div>

            {{-- Tombol Aksi & Notifikasi --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-4 border-t border-gray-50">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black py-3 px-6 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 shadow-md shadow-blue-500/10 active:scale-[0.99] flex items-center justify-center tracking-wide text-sm cursor-pointer select-none">
                    <i class="fas fa-save mr-2 text-xs opacity-90"></i> Simpan Profil
                </button>

                @if (session('status') === 'profile-updated')
                    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" x-init="setTimeout(() => show = false, 4000)" class="text-[11px] sm:text-xs text-emerald-700 font-black tracking-wide flex items-center justify-center sm:justify-start bg-emerald-50/80 px-4 py-2.5 sm:py-3 rounded-xl border border-emerald-200 shadow-3xs uppercase">
                        <i class="fas fa-check-circle mr-2 text-sm sm:text-base text-emerald-600"></i> Data profil berhasil diperbarui.
                    </div>
                @endif
            </div>
        </form>
    </div>

    {{-- GANTI PASSWORD --}}
    <div class="bg-white p-4 sm:p-6 md:p-8 rounded-2xl shadow-xs border border-gray-100/90 transition-all duration-300 hover:shadow-md group/card-pw">
        <div class="border-b border-gray-100 pb-4 sm:pb-5 mb-5 sm:mb-6">
            <h3 class="text-base sm:text-lg font-black text-gray-800 flex items-center tracking-tight transition-colors duration-200 group-focus-within/card-pw:text-amber-500">
                <span class="p-2 sm:p-2.5 bg-amber-50 text-amber-500 rounded-xl mr-2.5 sm:mr-3 border border-amber-100/50 shadow-3xs transition-transform duration-300 group-focus-within/card-pw:scale-105 shrink-0">
                    <i class="fas fa-key text-sm sm:text-base"></i>
                </span>
                Ganti Password Akun
            </h3>
            <p class="text-xs text-gray-400 mt-1.5 sm:mt-2 ml-0.5 sm:ml-1 font-medium leading-relaxed">Gunakan kombinasi password unik yang aman demi perlindungan enkripsi data akun Anda.</p>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="space-y-5 sm:space-y-6">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                
                {{-- Password Saat Ini --}}
                <div class="group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2 transition-colors duration-200 group-focus-within/section:text-amber-500">Password Saat Ini</label>
                    <div class="relative shadow-3xs rounded-xl">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within/section:text-amber-500 transition-colors duration-200">
                            <i class="fas fa-unlock-alt text-sm"></i>
                        </span>
                        <input type="password" name="current_password" class="w-full pl-11 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 focus:outline-hidden transition-all duration-200 text-gray-800 text-sm font-bold bg-white" autocomplete="current-password">
                    </div>
                    @error('current_password') <span class="text-red-500 text-xs mt-2 block font-bold tracking-wide flex items-center gap-1.5 animate-fadeIn"><i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}</span> @enderror
                </div>

                {{-- Password Baru --}}
                <div class="group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2 transition-colors duration-200 group-focus-within/section:text-amber-500">Password Baru</label>
                    <div class="relative shadow-3xs rounded-xl">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within/section:text-amber-500 transition-colors duration-200">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" class="w-full pl-11 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 focus:outline-hidden transition-all duration-200 text-gray-800 text-sm font-bold bg-white" autocomplete="new-password">
                    </div>
                    @error('password') <span class="text-red-500 text-xs mt-2 block font-bold tracking-wide flex items-center gap-1.5 animate-fadeIn"><i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}</span> @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="group/section">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2 transition-colors duration-200 group-focus-within/section:text-amber-500">Konfirmasi Password Baru</label>
                    <div class="relative shadow-3xs rounded-xl">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within/section:text-amber-500 transition-colors duration-200">
                            <i class="fas fa-shield-alt text-sm"></i>
                        </span>
                        <input type="password" name="password_confirmation" class="w-full pl-11 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 focus:outline-hidden transition-all duration-200 text-gray-800 text-sm font-bold bg-white" autocomplete="new-password">
                    </div>
                    @error('password_confirmation') <span class="text-red-500 text-xs mt-2 block font-bold tracking-wide flex items-center gap-1.5 animate-fadeIn"><i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Tombol Aksi & Notifikasi Password --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-4 border-t border-gray-50">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-amber-500 to-orange-500 text-white font-black py-3 px-6 rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 shadow-md shadow-amber-500/10 active:scale-[0.99] flex items-center justify-center tracking-wide text-sm cursor-pointer select-none">
                    <i class="fas fa-sync-alt mr-2 text-xs opacity-90 animate-spin-hover"></i> Update Password Akun
                </button>

                @if (session('status') === 'password-updated')
                    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" x-init="setTimeout(() => show = false, 4000)" class="text-[11px] sm:text-xs text-emerald-700 font-black tracking-wide flex items-center justify-center sm:justify-start bg-emerald-50/80 px-4 py-2.5 sm:py-3 rounded-xl border border-emerald-200 shadow-3xs uppercase">
                        <i class="fas fa-check-circle mr-2 text-sm sm:text-base text-emerald-600"></i> Kredensial password berhasil diubah.
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Tambahan Animasi CSS Ringan opsional untuk memperhalus error alert --}}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.25s ease-out forwards;
    }
</style>

@endsection