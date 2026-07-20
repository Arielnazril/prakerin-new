@extends('layouts.siswa_layout')

@section('page_title', 'Edit Logbook')

@section('content')

<div class="max-w-3xl mx-auto space-y-6 select-none pb-12 antialiased">
    
    {{-- BACK BUTTON --}}
    <a href="{{ route('siswa.logbook.history') }}" class="inline-flex items-center text-xs font-bold text-slate-400 hover:text-amber-500 bg-white hover:bg-slate-900 border border-slate-200 hover:border-slate-800 px-4 py-2.5 rounded-xl transition duration-200 shadow-2xs group">
        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i> Batal Edit
    </a>

    {{-- MAIN FORM CARD --}}
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 overflow-hidden">
        
        {{-- HEADER BANNER (DARK SLATE & AMBER ACCENT) --}}
        <div class="bg-slate-900 px-6 py-6 sm:px-8 sm:py-7 relative overflow-hidden group">
            <div class="absolute right-0 top-0 bottom-0 w-1/2 bg-gradient-to-l from-amber-500/10 via-amber-500/5 to-transparent pointer-events-none"></div>
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-amber-600/15 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-[10px] font-extrabold text-amber-400 tracking-wider uppercase mb-1.5">
                        <i class="fas fa-pen-nib text-xs"></i> Mode Perubahan
                    </div>
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight flex items-center gap-2.5">
                        <span class="w-1.5 h-6 bg-amber-500 rounded-full inline-block"></span>
                        Edit Kegiatan
                    </h2>
                </div>
                <div class="hidden sm:flex h-12 w-12 bg-slate-800 border border-slate-700/80 rounded-2xl items-center justify-center text-amber-500 shadow-inner">
                    <i class="fas fa-edit text-xl"></i>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form action="{{ route('siswa.logbook.update', $logbook->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- GRID TANGGAL & JAM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- INPUT TANGGAL --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                        <i class="far fa-calendar-alt mr-2 text-amber-600"></i> Tanggal Kegiatan
                    </label>
                    <input type="date" name="tanggal" value="{{ $logbook->tanggal->format('Y-m-d') }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs" required>
                </div>

                {{-- INPUT JAM MASUK --}}
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                        <i class="far fa-clock mr-2 text-amber-600"></i> Jam Masuk
                    </label>
                    <input type="time" name="jam_masuk" value="{{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-mono font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs" required>
                </div>

                {{-- INPUT JAM KELUAR --}}
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                        <i class="fas fa-history mr-2 text-amber-600"></i> Jam Keluar
                    </label>
                    <input type="time" name="jam_keluar" value="{{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-mono font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs" required>
                </div>
            </div>

            {{-- DESKRIPSI KEGIATAN --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                    <i class="fas fa-align-left mr-2 text-amber-600"></i> Deskripsi Kegiatan
                </label>
                <textarea name="kegiatan" rows="6" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 shadow-2xs leading-relaxed" placeholder="Jelaskan detail pekerjaan Anda hari ini..." required>{{ $logbook->kegiatan }}</textarea>
            </div>

            {{-- UPLOAD & PREVIEW FOTO --}}
            <div class="bg-slate-50 p-5 sm:p-6 rounded-2xl border border-dashed border-slate-300 space-y-4">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700">
                    <i class="fas fa-camera mr-2 text-amber-600"></i> Update Foto 
                    <span class="text-slate-400 font-medium normal-case ml-1">(Biarkan kosong jika tidak diganti)</span>
                </label>

                {{-- PREVIEW FOTO LAMA --}}
                @if($logbook->foto)
                    <div class="p-3 bg-white rounded-2xl border border-slate-200/80 inline-block shadow-2xs">
                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2">Foto Saat Ini:</p>
                        <div class="relative group/preview overflow-hidden rounded-xl border border-slate-200">
                            <img src="{{ asset('storage/' . $logbook->foto) }}" class="h-24 w-auto object-cover rounded-xl group-hover/preview:scale-105 transition duration-300">
                            <div class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover/preview:opacity-100 transition duration-200 flex items-center justify-center pointer-events-none">
                                <i class="fas fa-eye text-white text-sm"></i>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- FILE INPUT STYLING --}}
                <div>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-500/10 file:text-amber-700 hover:file:bg-amber-500/20 file:transition cursor-pointer">
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-bold py-3.5 px-8 rounded-2xl shadow-lg shadow-amber-900/20 hover:shadow-amber-900/30 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center text-sm border border-amber-500/30 cursor-pointer">
                    <i class="fas fa-save mr-2.5 text-base"></i> Update Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection