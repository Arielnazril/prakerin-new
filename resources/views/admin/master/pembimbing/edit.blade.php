@extends('layouts.admin_layout')

@section('page_title', 'Edit Mentor Industri')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-0 font-sans selection:bg-amber-500 selection:text-white antialiased">
    {{-- Tombol Kembali & Judul Halaman yang Dipercantik --}}
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.pembimbing.index') }}" class="group flex items-center justify-center w-11 h-11 bg-white hover:bg-slate-50 text-slate-500 hover:text-amber-600 rounded-2xl shadow-xs hover:shadow-md border border-slate-200/80 hover:border-amber-200 transition-all duration-300 transform hover:-translate-x-1 cursor-pointer" title="Kembali ke Daftar Mentor">
                <i class="fas fa-arrow-left text-base transition-transform group-hover:scale-110"></i>
            </a>
            <div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Edit Mentor</h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Perbarui informasi profil pembimbing lapangan industri.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
            <i class="fas fa-pen-nib text-xs text-amber-600"></i> Mode Edit
        </span>
    </div>

    {{-- Kartu Form Utama Modern --}}
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100/80 overflow-hidden relative backdrop-blur-xl">
        {{-- Aksen Dekorasi Atas Kartu --}}
        <div class="h-2 bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-500"></div>
        
        <form action="{{ route('admin.pembimbing.update', $mentor->id) }}" method="POST" class="space-y-7 p-6 sm:p-10">
            @csrf
            @method('PUT')

            {{-- Input: Asal Perusahaan dengan Ikon --}}
            <div class="space-y-2">
                <label class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-700">Asal Perusahaan</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                        <i class="fas fa-building text-sm"></i>
                    </div>
                    <select name="instansi_id" class="w-full pl-11 pr-10 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs cursor-pointer appearance-none" required>
                        @foreach($instansis as $instansi)
                            <option value="{{ $instansi->id }}" {{ $mentor->instansi_id == $instansi->id ? 'selected' : '' }}>
                                {{ $instansi->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Input: Nama Mentor dengan Ikon --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-700">Nama Mentor</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <input type="text" name="name" value="{{ $mentor->name }}" class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs" required placeholder="Masukkan nama lengkap mentor">
                    </div>
                </div>

                {{-- Input: Username dengan Ikon --}}
                <div class="space-y-2">
                    <label class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-700">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                            <i class="fas fa-id-badge text-sm"></i>
                        </div>
                        <input type="text" name="username" value="{{ $mentor->username }}" class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-bold font-mono text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs" required placeholder="Username untuk login">
                    </div>
                </div>

                {{-- Input: Nomor HP dengan Ikon --}}
                <div class="space-y-2">
                    <label class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-700">Nomor HP</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors duration-300">
                            <i class="fas fa-phone text-sm"></i>
                        </div>
                        <input type="text" name="no_hp" value="{{ $mentor->no_hp }}" class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs" placeholder="Contoh: 081234567xxx">
                    </div>
                </div>

                {{-- Input: Password Baru dengan Ikon & Hint Informasi --}}
                <div class="col-span-1 md:col-span-2 bg-gradient-to-br from-amber-50/60 via-amber-50/20 to-yellow-50/30 border border-amber-200/70 p-5 sm:p-6 rounded-3xl space-y-4">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 bg-gradient-to-tr from-amber-500 to-amber-400 text-white rounded-2xl flex items-center justify-center text-sm shadow-md shadow-amber-500/20 shrink-0">
                            <i class="fas fa-key"></i>
                        </div>
                        <div>
                            <label class="block text-sm font-extrabold text-slate-800 tracking-tight">Password Baru (Opsional)</label>
                            <p class="text-xs text-slate-500 leading-relaxed font-medium mt-0.5">
                                <i class="fas fa-info-circle mr-1 text-amber-500"></i>Biarkan kolom ini kosong jika Anda tidak berniat mengganti password login mentor.
                            </p>
                        </div>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-600 transition-colors duration-300">
                            <i class="fas fa-lock text-sm"></i>
                        </div>
                        <input type="password" name="password" class="w-full pl-11 pr-4 py-3.5 bg-white border border-amber-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs" placeholder="Kosongkan jika tidak ubah password">
                    </div>
                </div>
            </div>

            {{-- Bagian Tombol Aksi Akhir --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.pembimbing.index') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl border border-slate-200 text-slate-600 font-extrabold text-xs uppercase tracking-wider hover:bg-slate-100 hover:text-slate-800 transition duration-200 text-center flex items-center justify-center cursor-pointer">
                    <i class="fas fa-times mr-2 text-sm opacity-70"></i> Batal
                </a>
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-amber-500 via-amber-600 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-extrabold py-3.5 px-8 rounded-2xl text-xs uppercase tracking-wider shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/35 active:scale-[0.98] transition-all duration-200 flex items-center justify-center space-x-2 cursor-pointer">
                    <i class="fas fa-save text-sm"></i>
                    <span>Update Data</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection