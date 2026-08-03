@extends('layouts.siswa_layout')

@section('page_title', 'Isi Logbook Baru')

@section('content')

<div class="max-w-3xl mx-auto space-y-6 select-none pb-12 antialiased">
    
    {{-- BACK BUTTON --}}
    <div>
        <a href="{{ route('siswa.logbook.history') }}" class="inline-flex items-center text-xs font-bold text-slate-500 hover:text-amber-600 bg-white hover:bg-slate-900 hover:text-white border border-slate-200/80 hover:border-slate-900 px-4 py-2.5 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300 text-amber-500"></i> Kembali ke Riwayat
        </a>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden transition-all duration-300">
        
        {{-- HEADER BANNER (DARK SLATE & AMBER ACCENT) --}}
        <div class="bg-slate-950 px-6 py-7 sm:px-10 sm:py-9 relative overflow-hidden group">
            {{-- Ambient Decorative Glow --}}
            <div class="absolute -right-12 -top-12 w-64 h-64 bg-amber-500/15 rounded-full blur-3xl group-hover:bg-amber-500/20 transition-all duration-700 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-1/2 bg-gradient-to-l from-amber-500/10 via-amber-500/5 to-transparent pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#opacity-10_1px,transparent_1px)] [background-size:16px_16px] opacity-10 pointer-events-none"></div>

            <div class="relative z-10 flex items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-[10px] font-black text-amber-400 tracking-wider uppercase shadow-inner">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span> Form Input
                    </div>
                    <h2 class="text-xl sm:text-3xl font-black text-white tracking-tight flex items-center gap-3 pt-1">
                        <span class="w-1.5 h-7 bg-gradient-to-b from-amber-400 to-amber-600 rounded-full inline-block shrink-0 shadow-sm shadow-amber-500/50"></span>
                        Form Kegiatan Harian
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-300/90 font-medium pl-4 pt-0.5">Isi kegiatan magangmu dengan jujur dan lengkap.</p>
                </div>
                <div class="hidden sm:flex h-14 w-14 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl items-center justify-center text-amber-400 shadow-2xl shrink-0 group-hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-pen-fancy text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form action="{{ route('siswa.logbook.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-7">
            @csrf

            {{-- TANGGAL KEGIATAN --}}
            <div class="space-y-2">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-2">
                    <i class="fas fa-calendar-day text-amber-500"></i> Tanggal Kegiatan
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors">
                        <i class="fas fa-calendar text-sm"></i>
                    </div>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full pl-11 pr-4 py-3.5 bg-slate-50/80 border border-slate-200/90 rounded-2xl font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 shadow-2xs text-sm" required>
                </div>
            </div>

            {{-- JAM MASUK & JAM KELUAR --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-2">
                        <i class="fas fa-clock text-amber-500"></i> Jam Masuk
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors">
                            <i class="fas fa-sign-in-alt text-sm"></i>
                        </div>
                        <input type="time" name="jam_masuk" class="w-full pl-11 pr-4 py-3.5 bg-slate-50/80 border border-slate-200/90 rounded-2xl font-mono font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 shadow-2xs text-sm" required>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-2">
                        <i class="fas fa-clock text-amber-500"></i> Jam Keluar
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </div>
                        <input type="time" name="jam_keluar" class="w-full pl-11 pr-4 py-3.5 bg-slate-50/80 border border-slate-200/90 rounded-2xl font-mono font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 shadow-2xs text-sm" required>
                    </div>
                </div>
            </div>

            {{-- DESKRIPSI KEGIATAN --}}
            <div class="space-y-2">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-2">
                    <i class="fas fa-align-left text-amber-500"></i> Deskripsi Kegiatan
                </label>
                <div class="relative">
                    <textarea name="kegiatan" rows="6" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200/90 rounded-2xl font-medium text-slate-800 placeholder-slate-400/80 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 shadow-2xs leading-relaxed text-sm resize-none" placeholder="Contoh: Memperbaiki bug pada fitur login, Melakukan instalasi kabel jaringan..." required></textarea>
                </div>
                <p class="text-xs text-slate-400 flex justify-between font-medium pt-1">
                    <span class="flex items-center gap-1.5"><i class="fas fa-info-circle text-amber-500"></i> Jelaskan secara detail.</span>
                    <span>Min. 10 karakter</span>
                </p>
            </div>

            {{-- UPLOAD FOTO --}}
            <div class="space-y-2">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-2">
                    <i class="fas fa-camera text-amber-500"></i> Foto Dokumentasi <span class="text-slate-400 font-normal lowercase">(opsional)</span>
                </label>
                <div class="bg-slate-50/70 p-5 sm:p-6 rounded-2xl border-2 border-dashed border-slate-300/80 hover:border-amber-500/80 hover:bg-amber-500/5 transition-all duration-300 space-y-3 group">
                    <div class="flex items-center gap-3">
                        <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-wider file:bg-amber-500/10 file:text-amber-700 hover:file:bg-amber-500 hover:file:text-white file:transition-all file:duration-300 cursor-pointer">
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5 pt-1 border-t border-slate-200/60">
                        <i class="fas fa-image text-amber-500"></i> Format: JPG, PNG. Maksimal ukuran 2MB.
                    </p>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:from-amber-600 hover:to-amber-800 text-white font-extrabold py-3.5 px-9 rounded-2xl shadow-xl shadow-amber-600/20 hover:shadow-amber-600/35 transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2.5 text-sm border border-amber-400/30 cursor-pointer">
                    <i class="fas fa-save text-base"></i> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection