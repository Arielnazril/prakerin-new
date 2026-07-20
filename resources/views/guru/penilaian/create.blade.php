@extends('layouts.guru_layout')

@section('page_title', 'Input Nilai Guru')

@section('content')

<div class="max-w-3xl mx-auto space-y-6 antialiased">
    {{-- Tombol Kembali --}}
    <div>
        <a href="{{ route('guru.penilaian.index') }}" class="group inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-blue-600 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform duration-200 text-xs"></i> Kembali
        </a>
    </div>

    {{-- Kotak Utama Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-md">
        
        {{-- Header Form --}}
        <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 px-8 py-7 shadow-xs relative overflow-hidden">
            {{-- Accent Light Pattern --}}
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="relative z-10">
                <h2 class="text-white font-black text-xl flex items-center tracking-tight gap-3">
                    <span class="bg-white/15 p-2.5 rounded-xl border border-white/20 shadow-xs flex items-center justify-center shrink-0">
                        <i class="fas fa-book-reader text-white text-lg"></i>
                    </span>
                    Penilaian Laporan
                </h2>
                <div class="text-blue-100 text-xs font-medium mt-3 flex items-center gap-2 bg-black/10 w-max px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-xs">
                    <i class="fas fa-user text-[10px] text-blue-200"></i> Siswa: 
                    <span class="font-bold text-white tracking-wide underline underline-offset-4 decoration-blue-400/80">{{ $placement->siswa->name }}</span>
                </div>
            </div>
        </div>

        {{-- Isi Form --}}
        <form action="{{ route('guru.penilaian.store', $placement->id) }}" method="POST" class="p-8 space-y-8">
            @csrf

            <input type="hidden" name="nama_siswa" value="{{ $placement->siswa->name }}">

            {{-- Langkah 1: Skor Laporan --}}
            <div class="group/section">
                <h3 class="font-extrabold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center text-base tracking-tight transition-colors group-focus-within/section:text-blue-600">
                    <span class="bg-blue-50 text-blue-600 w-8 h-8 rounded-xl flex items-center justify-center mr-3 text-xs font-black border border-blue-100/80 shadow-2xs group-focus-within/section:bg-blue-600 group-focus-within/section:text-white transition-all duration-200">1</span>
                    Nilai Laporan Tertulis
                </h3>
                <div class="bg-slate-50/60 p-5 rounded-2xl border border-slate-200/80 transition-all duration-200 group-focus-within/section:bg-white group-focus-within/section:border-blue-300 group-focus-within/section:shadow-sm">
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-600 mb-2">Skor Laporan (0-100)</label>
                    <div class="relative rounded-xl shadow-2xs">
                        <input type="number" name="aspek_teknis" min="0" max="100" class="w-full px-4 py-3.5 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-none text-lg font-mono font-black text-blue-700 bg-white transition-all duration-200 placeholder:text-slate-300" placeholder="0" required>
                    </div>
                    <p class="text-xs text-slate-400 mt-3 flex items-start gap-1.5 leading-relaxed font-medium">
                        <i class="fas fa-info-circle text-[11px] text-slate-400 mt-0.5 shrink-0"></i>
                        <span>Dinilai berdasarkan: Kelengkapan bab, format penulisan, kerapian, dan isi laporan.</span>
                    </p>
                </div>
            </div>

            {{-- Langkah 2: Skor Presentasi --}}
            <div class="group/section">
                <h3 class="font-extrabold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center text-base tracking-tight transition-colors group-focus-within/section:text-blue-600">
                    <span class="bg-blue-50 text-blue-600 w-8 h-8 rounded-xl flex items-center justify-center mr-3 text-xs font-black border border-blue-100/80 shadow-2xs group-focus-within/section:bg-blue-600 group-focus-within/section:text-white transition-all duration-200">2</span>
                    Nilai Presentasi / Sidang
                </h3>
                <div class="bg-slate-50/60 p-5 rounded-2xl border border-slate-200/80 transition-all duration-200 group-focus-within/section:bg-white group-focus-within/section:border-blue-300 group-focus-within/section:shadow-sm">
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-600 mb-2">Skor Presentasi (0-100)</label>
                    <div class="relative rounded-xl shadow-2xs">
                        <input type="number" name="aspek_non_teknis" min="0" max="100" class="w-full px-4 py-3.5 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-none text-lg font-mono font-black text-blue-700 bg-white transition-all duration-200 placeholder:text-slate-300" placeholder="0" required>
                    </div>
                    <p class="text-xs text-slate-400 mt-3 flex items-start gap-1.5 leading-relaxed font-medium">
                        <i class="fas fa-info-circle text-[11px] text-slate-400 mt-0.5 shrink-0"></i>
                        <span>Dinilai berdasarkan: Penguasaan materi, cara penyampaian, dan kemampuan menjawab pertanyaan.</span>
                    </p>
                </div>
            </div>

            {{-- Langkah 3: Catatan Revisi --}}
            <div class="group/section">
                <h3 class="font-extrabold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center text-base tracking-tight transition-colors group-focus-within/section:text-blue-600">
                    <span class="bg-blue-50 text-blue-600 w-8 h-8 rounded-xl flex items-center justify-center mr-3 text-xs font-black border border-blue-100/80 shadow-2xs group-focus-within/section:bg-blue-600 group-focus-within/section:text-white transition-all duration-200">3</span>
                    Catatan Revisi <span class="text-slate-400 font-normal ml-1 text-xs lowercase italic">(opsional)</span>
                </h3>
                <div class="shadow-2xs rounded-2xl overflow-hidden">
                    <textarea name="catatan" rows="4" class="w-full px-4 py-3.5 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-none text-sm text-slate-700 placeholder:text-slate-400 bg-slate-50/40 transition-all duration-200 focus:bg-white" placeholder="Tuliskan catatan revisi, masukan, atau saran perbaikan jika diperlukan..."></textarea>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black py-3.5 px-8 rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-md shadow-blue-500/20 active:scale-[0.98] transition-all duration-200 transform hover:-translate-y-0.5 flex items-center gap-2.5 text-xs uppercase tracking-wider cursor-pointer select-none" onclick="return confirm('Simpan nilai laporan & sidang? Data tidak bisa diubah.')">
                    <i class="fas fa-save text-sm opacity-90"></i> Simpan Nilai Guru
                </button>
            </div>
        </form>
    </div>
</div>

@endsection