@extends('layouts.admin_layout')

@section('page_title', 'Edit Data Siswa')

@section('content')
<div class="max-w-3xl mx-auto selection:bg-blue-600 selection:text-white px-3 sm:px-0 font-sans antialiased">
    <!-- Header Page & Navigation -->
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.siswa.index') }}" 
               class="w-11 h-11 bg-white hover:bg-slate-50 text-slate-600 hover:text-blue-600 rounded-2xl flex items-center justify-center border border-slate-200/80 shadow-xs hover:shadow-md hover:border-blue-200 transition-all duration-200 group cursor-pointer"
               title="Kembali ke Daftar Siswa">
                <i class="fas fa-arrow-left text-base group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Edit Siswa</h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Perbarui informasi profil dan kredensial akun siswa aktif.</p>
            </div>
        </div>

        <!-- Badge Status Ringkas -->
        <div class="hidden sm:inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200/80 px-3.5 py-1.5 rounded-full">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Siswa Aktif</span>
        </div>
    </div>

    <!-- Main Form Card (Premium Design) -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
        <!-- Accent Top Bar -->
        <div class="h-2 w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600"></div>

        <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="p-6 sm:p-10 space-y-7">
            @csrf
            @method('PUT')

            <!-- Section 1: Profil Utama Siswa -->
            <div class="space-y-5">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <i class="fas fa-id-badge text-blue-600 text-sm"></i>
                    <h3 class="text-xs font-extrabold uppercase tracking-widest text-slate-400">Informasi Profil</h3>
                </div>

                <!-- Input Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Lengkap</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name', $siswa->name) }}" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 focus:bg-white border @error('name') border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 @else border-slate-200/90 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 @enderror rounded-2xl text-sm font-semibold text-slate-800 placeholder:text-slate-400 outline-none transition-all shadow-2xs" 
                            placeholder="Masukkan nama lengkap siswa" required>
                    </div>
                    @error('name')
                        <span class="text-xs text-rose-500 mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fas fa-exclamation-circle text-xs"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Grid NIS & Jurusan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- NIS -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">NIS (Nomor Induk Siswa)</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="fas fa-id-card text-sm"></i>
                            </span>
                            <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas', $siswa->nomor_identitas) }}" 
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 focus:bg-white border font-mono @error('nomor_identitas') border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 @else border-slate-200/90 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 @enderror rounded-2xl text-sm font-bold text-slate-800 outline-none transition-all shadow-2xs" 
                                placeholder="Nomor NIS" required>
                        </div>
                        @error('nomor_identitas')
                            <span class="text-xs text-rose-500 mt-1.5 flex items-center gap-1 font-medium">
                                <i class="fas fa-exclamation-circle text-xs"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Jurusan</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors z-10">
                                <i class="fas fa-graduation-cap text-sm"></i>
                            </span>
                            <select name="jurusan_id" class="w-full pl-11 pr-10 py-3.5 bg-slate-50/50 focus:bg-white border @error('jurusan_id') border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 @else border-slate-200/90 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 @enderror rounded-2xl text-sm font-semibold text-slate-800 outline-none transition-all cursor-pointer appearance-none shadow-2xs" required>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $siswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan }})
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </span>
                        </div>
                        @error('jurusan_id')
                            <span class="text-xs text-rose-500 mt-1.5 flex items-center gap-1 font-medium">
                                <i class="fas fa-exclamation-circle text-xs"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Nomor HP / WA -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nomor HP / WA</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                            <i class="fab fa-whatsapp text-base font-bold"></i>
                        </span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 focus:bg-white border @error('no_hp') border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 @else border-slate-200/90 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 @enderror rounded-2xl text-sm font-semibold text-slate-800 outline-none transition-all shadow-2xs" 
                            placeholder="Contoh: 081234567890">
                    </div>
                    @error('no_hp')
                        <span class="text-xs text-rose-500 mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fas fa-exclamation-circle text-xs"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Section 2: Keamanan / Reset Password -->
            <div class="bg-gradient-to-br from-amber-50/60 via-amber-50/20 to-orange-50/30 p-5 sm:p-6 rounded-3xl border border-amber-200/70 space-y-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 bg-gradient-to-tr from-amber-500 to-amber-400 text-white rounded-2xl flex items-center justify-center text-sm shadow-md shadow-amber-500/20 shrink-0">
                        <i class="fas fa-key"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-800 text-sm tracking-tight">Reset Password Siswa</h3>
                        <p class="text-xs text-slate-500 leading-relaxed font-medium mt-0.5">
                            Isi kolom di bawah <strong class="text-amber-800">HANYA</strong> jika ingin mengganti password login siswa ini. Jika tidak berencana mengubahnya, silakan biarkan kosong.
                        </p>
                    </div>
                </div>

                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-600 transition-colors">
                        <i class="fas fa-lock text-sm"></i>
                    </span>
                    <input type="password" name="password" 
                        class="w-full pl-11 pr-4 py-3.5 bg-white border @error('password') border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 @else border-amber-200/90 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/15 @enderror rounded-2xl text-sm font-semibold text-slate-800 placeholder:text-slate-400 outline-none transition-all shadow-2xs" 
                        placeholder="Masukkan password baru jika ingin diganti...">
                </div>
                @error('password')
                    <span class="text-xs text-rose-500 flex items-center gap-1 font-medium">
                        <i class="fas fa-exclamation-circle text-xs"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Tombol Aksi Simpan -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.siswa.index') }}" class="w-full sm:w-auto text-center px-6 py-3.5 text-xs font-bold text-slate-500 hover:text-slate-800 bg-slate-100 hover:bg-slate-200/80 rounded-2xl transition-all uppercase tracking-wider cursor-pointer">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 text-white font-extrabold py-3.5 px-8 rounded-2xl hover:opacity-95 shadow-lg shadow-indigo-500/25 transform hover:-translate-y-0.5 active:translate-y-0 transition-all uppercase tracking-wider text-xs cursor-pointer flex items-center justify-center gap-2">
                    <i class="fas fa-save text-xs"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection