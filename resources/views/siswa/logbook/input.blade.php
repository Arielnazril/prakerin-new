@extends('layouts.siswa_layout')

@section('page_title', 'Isi Logbook Baru')

@section('content')

<div class="max-w-3xl mx-auto space-y-6 select-none pb-12 antialiased">
    
    {{-- BACK BUTTON --}}
    <div>
        <a href="{{ route('siswa.logbook.history') }}" class="inline-flex items-center text-xs font-bold text-slate-400 hover:text-amber-500 bg-white hover:bg-slate-900 border border-slate-200 hover:border-slate-800 px-4 py-2.5 rounded-xl transition duration-200 shadow-2xs group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i> Kembali ke Riwayat
        </a>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 overflow-hidden">
        
        {{-- HEADER BANNER (DARK SLATE & AMBER ACCENT) --}}
        <div class="bg-slate-900 px-6 py-6 sm:px-8 sm:py-7 relative overflow-hidden group">
            {{-- Accent Elements --}}
            <div class="absolute right-0 top-0 bottom-0 w-1/2 bg-gradient-to-l from-amber-500/10 via-amber-500/5 to-transparent pointer-events-none"></div>
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-amber-600/15 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-[10px] font-extrabold text-amber-400 tracking-wider uppercase mb-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Form Input
                    </div>
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight flex items-center gap-2.5">
                        <span class="w-1.5 h-6 bg-amber-500 rounded-full inline-block"></span>
                        Form Kegiatan Harian
                    </h2>
                    <p class="text-xs text-slate-300 font-medium pl-4 mt-1">Isi kegiatan magangmu dengan jujur dan lengkap.</p>
                </div>
                <div class="hidden sm:flex h-12 w-12 bg-slate-800 border border-slate-700/80 rounded-2xl items-center justify-center text-amber-500 shadow-inner">
                    <i class="fas fa-pen-fancy text-xl"></i>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form action="{{ route('siswa.logbook.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
            @csrf

            {{-- TANGGAL KEGIATAN --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                    Tanggal Kegiatan
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-amber-600 text-sm"></i>
                    </div>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full pl-10 px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs" required>
                </div>
            </div>

            {{-- JAM MASUK & JAM KELUAR --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                        Jam Masuk
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-sign-in-alt text-amber-600 text-sm"></i>
                        </div>
                        <input type="time" name="jam_masuk" class="w-full pl-10 px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-mono font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                        Jam Keluar
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-sign-out-alt text-amber-600 text-sm"></i>
                        </div>
                        <input type="time" name="jam_keluar" class="w-full pl-10 px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-mono font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs" required>
                    </div>
                </div>
            </div>

            {{-- DESKRIPSI KEGIATAN --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                    Deskripsi Kegiatan
                </label>
                <textarea name="kegiatan" rows="6" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs leading-relaxed" placeholder="Contoh: Memperbaiki bug pada fitur login, Melakukan instalasi kabel jaringan..." required></textarea>
                <p class="text-xs text-slate-400 mt-2 flex justify-between font-medium">
                    <span class="flex items-center gap-1.5"><i class="fas fa-info-circle text-amber-600"></i> Jelaskan secara detail.</span>
                    <span>Min. 10 karakter</span>
                </p>
            </div>

            {{-- UPLOAD FOTO --}}
            <div class="bg-slate-50/70 p-5 rounded-2xl border-2 border-dashed border-slate-300 hover:border-amber-500/60 transition duration-200 space-y-3">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700">
                    Foto Dokumentasi <span class="text-slate-400 font-normal lowercase">(opsional)</span>
                </label>
                <div class="flex items-center gap-2">
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-wide file:bg-amber-500/10 file:text-amber-700 hover:file:bg-amber-500/20 file:transition duration-200 cursor-pointer">
                </div>
                <p class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5 pt-1">
                    <i class="fas fa-image text-amber-600"></i> Format: JPG, PNG. Maksimal ukuran 2MB.
                </p>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-bold py-3.5 px-8 rounded-2xl shadow-lg shadow-amber-900/20 hover:shadow-amber-900/30 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 text-sm border border-amber-500/30 cursor-pointer">
                    <i class="fas fa-save text-base"></i> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection