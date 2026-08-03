@extends('layouts.admin_layout')

@section('page_title', 'Edit Data Guru')

@section('content')
<div class="max-w-3xl mx-auto selection:bg-amber-500 selection:text-white px-3 sm:px-0 font-sans antialiased">
    {{-- Header Page & Navigation --}}
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.guru.index') }}" 
               class="w-11 h-11 bg-white hover:bg-slate-50 text-slate-600 hover:text-amber-600 rounded-2xl flex items-center justify-center border border-slate-200/80 shadow-xs hover:shadow-md hover:border-amber-200 transition-all duration-200 group cursor-pointer"
               title="Kembali ke Daftar Guru">
                <i class="fas fa-arrow-left text-base group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Edit Guru</h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Perbarui informasi profil guru pembimbing sekolah.</p>
            </div>
        </div>

        {{-- Badge Status Ringkas --}}
        <div class="hidden sm:inline-flex items-center gap-2 bg-amber-50 border border-amber-200/80 px-3.5 py-1.5 rounded-full">
            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
            <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">Guru Pembimbing</span>
        </div>
    </div>

    {{-- Main Form Card (Premium Design) --}}
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
        {{-- Header Dekoratif Tipis (Aksen Gradient Amber/Gold) --}}
        <div class="h-2 w-full bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-500"></div>

        <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="p-6 sm:p-10 space-y-7">
            @csrf
            @method('PUT')

            {{-- Section 1: Profil Utama Guru --}}
            <div class="space-y-5">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <i class="fas fa-chalkboard-teacher text-amber-500 text-sm"></i>
                    <h3 class="text-xs font-extrabold uppercase tracking-widest text-slate-400">Informasi Profil</h3>
                </div>

                {{-- Nama Lengkap Guru --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nama Lengkap Guru</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ $guru->name }}" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 focus:bg-white border border-slate-200/90 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-2xl text-sm font-semibold text-slate-800 placeholder:text-slate-400 outline-none transition-all shadow-2xs" 
                            placeholder="Masukkan nama lengkap beserta gelar..." required>
                    </div>
                </div>

                {{-- Grid NIP & Nomor HP --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- NIP --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">NIP</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors">
                                <i class="fas fa-id-card text-sm"></i>
                            </span>
                            <input type="text" name="nip" value="{{ $guru->nomor_identitas }}" 
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 focus:bg-white border border-slate-200/90 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-2xl text-sm font-bold font-mono text-slate-800 outline-none transition-all shadow-2xs" 
                                placeholder="Nomor Induk Pegawai..." required>
                        </div>
                    </div>

                    {{-- Nomor HP --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nomor HP</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                                <i class="fas fa-phone text-sm"></i>
                            </span>
                            <input type="text" name="no_hp" value="{{ $guru->no_hp }}" 
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 focus:bg-white border border-slate-200/90 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-2xl text-sm font-semibold text-slate-800 outline-none transition-all shadow-2xs"
                                placeholder="Contoh: 08123456xxx">
                        </div>
                    </div>
                </div>

                {{-- Password Baru (Kombinasi Kartu Terpisah - Modern Amber Card) --}}
                <div class="bg-gradient-to-br from-amber-50/60 via-amber-50/20 to-yellow-50/30 p-5 sm:p-6 rounded-3xl border border-amber-200/70 space-y-4 mt-2">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 bg-gradient-to-tr from-amber-500 to-amber-400 text-white rounded-2xl flex items-center justify-center text-sm shadow-md shadow-amber-500/20 shrink-0">
                            <i class="fas fa-key"></i>
                        </div>
                        <div>
                            <label class="block text-sm font-extrabold text-slate-800 tracking-tight">Password Baru (Opsional)</label>
                            <p class="text-xs text-slate-500 leading-relaxed font-medium mt-0.5">Biarkan kosong jika akun guru tetap menggunakan password lama.</p>
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-600 transition-colors">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" 
                            class="w-full pl-11 pr-4 py-3.5 bg-white border border-amber-200/90 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/15 rounded-2xl text-sm font-semibold text-slate-800 placeholder:text-slate-400 outline-none transition-all shadow-2xs" 
                            placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                </div>
            </div>

            {{-- Bagian Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.guru.index') }}" class="w-full sm:w-auto text-center px-6 py-3.5 text-xs font-bold text-slate-500 hover:text-slate-800 bg-slate-100 hover:bg-slate-200/80 rounded-2xl transition-all uppercase tracking-wider cursor-pointer">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-amber-500 via-amber-600 to-yellow-500 text-white font-extrabold py-3.5 px-8 rounded-2xl hover:opacity-95 shadow-lg shadow-amber-500/25 transform hover:-translate-y-0.5 active:translate-y-0 transition-all uppercase tracking-wider text-xs cursor-pointer">
                    <i class="fas fa-save text-xs"></i> Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection