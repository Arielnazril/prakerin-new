@extends('layouts.siswa_layout')

@section('page_title', 'Transkrip Nilai Magang')

@section('content')

<div class="max-w-5xl mx-auto space-y-8 select-none pb-12 antialiased">

    {{-- KARTU UTAMA TRANSKRIP --}}
    <div class="bg-white rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 overflow-hidden relative transition-all duration-300">
        
        {{-- HEADER DENGAN GRADIENT PREMIUM --}}
        <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 p-6 sm:p-10 text-white relative overflow-hidden group">
            {{-- Light Glow Overlay & Blur Decorative Elements --}}
            <div class="absolute -right-12 -top-12 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl group-hover:bg-blue-400/30 transition-all duration-700 pointer-events-none"></div>
            <div class="absolute right-1/3 -bottom-12 w-56 h-56 bg-indigo-500/20 rounded-full blur-2xl group-hover:bg-indigo-400/30 transition-all duration-700 pointer-events-none"></div>
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative z-10">
                <div class="space-y-2">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[10px] font-black tracking-widest uppercase text-blue-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Official Document
                    </span>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight flex items-center gap-2">
                        TRANSKRIP NILAI PRAKERIN
                    </h1>
                    <p class="text-slate-300 text-xs sm:text-sm font-medium font-mono flex items-center gap-2">
                        <i class="far fa-calendar-alt text-blue-400"></i>
                        Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
                    </p>
                </div>

                {{-- Cumulative Score Pill Badge --}}
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-white/15 flex items-center gap-4 self-stretch sm:self-auto justify-between sm:justify-start shadow-lg">
                    <div class="text-right">
                        <div class="text-3xl sm:text-4xl font-black tracking-tight font-mono text-amber-400 drop-shadow-sm">
                            {{ $placement->nilai_akhir_total ?? '0.00' }}
                        </div>
                        <div class="text-[10px] uppercase font-black tracking-wider text-slate-200 opacity-90 mt-0.5">Nilai Akhir Kumulatif</div>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center text-amber-400 shadow-inner shrink-0">
                        <i class="fas fa-medal text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- Metadata Section --}}
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm border-t border-white/15 pt-6 relative z-10">
                <div class="space-y-1">
                    <p class="text-blue-200/70 text-[10px] uppercase tracking-widest font-black">Nama Lengkap Siswa</p>
                    <p class="font-extrabold text-base sm:text-lg text-white tracking-wide flex items-center gap-2">
                        <i class="fas fa-user-circle text-blue-400"></i>
                        {{ Auth::user()->name }}
                    </p>
                </div>
                <div class="space-y-1">
                    <p class="text-blue-200/70 text-[10px] uppercase tracking-widest font-black">Instansi / Tempat Magang</p>
                    <p class="font-extrabold text-base sm:text-lg text-white tracking-wide flex items-center gap-2">
                        <i class="fas fa-building text-indigo-400"></i>
                        {{ $placement->instansi->nama_perusahaan }}
                    </p>
                </div>
            </div>
        </div>

        {{-- KONTEN RINCIAN PENILAIAN --}}
        <div class="p-6 sm:p-10 space-y-8">
            <h3 class="font-black text-slate-800 text-base sm:text-lg tracking-tight flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="bg-blue-50 p-2.5 rounded-2xl border border-blue-100 text-blue-600 shadow-2xs">
                    <i class="fas fa-list-alt text-base"></i>
                </div>
                Rincian Penilaian Aspek
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- BLOK PENILAIAN INDUSTRI --}}
                <div class="bg-gradient-to-b from-indigo-50/40 via-slate-50/30 to-white p-6 sm:p-7 rounded-3xl border border-indigo-100/80 flex flex-col justify-between shadow-2xs hover:shadow-md transition-all">
                    <div>
                        <h4 class="font-black text-indigo-950 mb-5 flex items-center text-sm tracking-tight bg-indigo-100/70 text-indigo-900 px-3.5 py-2 rounded-xl border border-indigo-200/60 w-max shadow-2xs">
                            <i class="fas fa-building mr-2 text-indigo-600"></i> Penilaian Industri
                        </h4>
                        @if($nilaiMentor)
                            <ul class="space-y-3 text-sm text-slate-700">
                                <li class="flex justify-between items-center bg-white p-3.5 rounded-2xl border border-slate-200/70 shadow-2xs">
                                    <span class="font-semibold text-slate-600 flex items-center gap-2.5 text-xs sm:text-sm">
                                        <i class="fas fa-cog text-xs text-indigo-500"></i> Aspek Teknis (Hard Skill)
                                    </span>
                                    <span class="font-black font-mono text-slate-900 bg-slate-100 px-3 py-1 rounded-xl border border-slate-200/60 text-xs sm:text-sm">{{ $nilaiMentor->aspek_teknis }}</span>
                                </li>
                                <li class="flex justify-between items-center bg-white p-3.5 rounded-2xl border border-slate-200/70 shadow-2xs">
                                    <span class="font-semibold text-slate-600 flex items-center gap-2.5 text-xs sm:text-sm">
                                        <i class="fas fa-users text-xs text-indigo-500"></i> Aspek Non-Teknis (Soft Skill)
                                    </span>
                                    <span class="font-black font-mono text-slate-900 bg-slate-100 px-3 py-1 rounded-xl border border-slate-200/60 text-xs sm:text-sm">{{ $nilaiMentor->aspek_non_teknis }}</span>
                                </li>
                            </ul>
                        @else
                            <div class="bg-rose-50/60 p-4 rounded-2xl border border-rose-100 text-center my-4">
                                <p class="text-rose-600 text-xs italic font-bold flex items-center justify-center gap-2">
                                    <i class="fas fa-exclamation-circle text-sm"></i> Belum dinilai oleh Mentor.
                                </p>
                            </div>
                        @endif
                    </div>
                    
                    @if($nilaiMentor)
                        <div class="mt-6 flex justify-between items-center pt-4 border-t border-indigo-100/80 font-bold text-indigo-950">
                            <span class="text-xs uppercase tracking-wider font-extrabold text-indigo-900/80">Rata-rata Industri</span>
                            <span class="font-black font-mono bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-3.5 py-1.5 rounded-xl shadow-md text-sm">{{ $nilaiMentor->nilai_akhir }}</span>
                        </div>
                    @endif
                </div>

                {{-- BLOK PENILAIAN SEKOLAH --}}
                <div class="bg-gradient-to-b from-blue-50/40 via-slate-50/30 to-white p-6 sm:p-7 rounded-3xl border border-blue-100/80 flex flex-col justify-between shadow-2xs hover:shadow-md transition-all">
                    <div>
                        <h4 class="font-black text-blue-950 mb-5 flex items-center text-sm tracking-tight bg-blue-100/70 text-blue-900 px-3.5 py-2 rounded-xl border border-blue-200/60 w-max shadow-2xs">
                            <i class="fas fa-school mr-2 text-blue-600"></i> Penilaian Sekolah
                        </h4>
                        @if($nilaiGuru)
                            <ul class="space-y-3 text-sm text-slate-700">
                                <li class="flex justify-between items-center bg-white p-3.5 rounded-2xl border border-slate-200/70 shadow-2xs">
                                    <span class="font-semibold text-slate-600 flex items-center gap-2.5 text-xs sm:text-sm">
                                        <i class="fas fa-file-alt text-xs text-blue-500"></i> Laporan Tertulis
                                    </span>
                                    <span class="font-black font-mono text-slate-900 bg-slate-100 px-3 py-1 rounded-xl border border-slate-200/60 text-xs sm:text-sm">{{ $nilaiGuru->aspek_teknis }}</span>
                                </li>
                                <li class="flex justify-between items-center bg-white p-3.5 rounded-2xl border border-slate-200/70 shadow-2xs">
                                    <span class="font-semibold text-slate-600 flex items-center gap-2.5 text-xs sm:text-sm">
                                        <i class="fas fa-chalkboard-teacher text-xs text-blue-500"></i> Presentasi / Sidang
                                    </span>
                                    <span class="font-black font-mono text-slate-900 bg-slate-100 px-3 py-1 rounded-xl border border-slate-200/60 text-xs sm:text-sm">{{ $nilaiGuru->aspek_non_teknis }}</span>
                                </li>
                            </ul>
                        @else
                            <div class="bg-rose-50/60 p-4 rounded-2xl border border-rose-100 text-center my-4">
                                <p class="text-rose-600 text-xs italic font-bold flex items-center justify-center gap-2">
                                    <i class="fas fa-exclamation-circle text-sm"></i> Belum dinilai oleh Guru.
                                </p>
                            </div>
                        @endif
                    </div>

                    @if($nilaiGuru)
                        <div class="mt-6 flex justify-between items-center pt-4 border-t border-blue-100/80 font-bold text-blue-950">
                            <span class="text-xs uppercase tracking-wider font-extrabold text-blue-900/80">Rata-rata Sekolah</span>
                            <span class="font-black font-mono bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-3.5 py-1.5 rounded-xl shadow-md text-sm">{{ $nilaiGuru->nilai_akhir }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- STATUS KELULUSAN --}}
            <div class="mt-8 flex justify-center">
                @if($placement->is_completed)
                    <div class="inline-block bg-emerald-50/80 text-emerald-950 px-8 py-5 rounded-3xl border border-emerald-200 text-center shadow-sm relative overflow-hidden group min-w-[300px]">
                        <div class="absolute -right-4 -bottom-4 text-emerald-200/40 text-7xl font-black select-none pointer-events-none transform rotate-12 transition-transform group-hover:scale-110">✓</div>
                        <p class="text-[10px] uppercase font-black tracking-widest text-emerald-700 mb-1">Status Kelulusan</p>
                        <p class="text-3xl sm:text-4xl font-black tracking-tight text-emerald-600">LULUS</p>
                        <p class="text-xs font-extrabold mt-2 text-emerald-800 bg-white/90 backdrop-blur-xs px-4 py-1.5 rounded-xl border border-emerald-200/60 inline-block shadow-2xs">Predikat: 
                            <span class="font-black text-emerald-600">
                                @if($placement->nilai_akhir_total >= 90) A (Sangat Baik)
                                @elseif($placement->nilai_akhir_total >= 80) B (Baik)
                                @else C (Cukup) @endif
                            </span>
                        </p>
                    </div>
                @else
                    <div class="bg-amber-50/80 text-amber-950 px-6 py-4 rounded-2xl border border-amber-200 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-2xs max-w-lg mx-auto">
                        <i class="fas fa-info-circle text-amber-500 text-xl shrink-0"></i>
                        <span>Nilai Anda saat ini masih dalam proses peninjauan dan belum difinalisasi oleh Administrator Sekolah.</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- FOOTER ACTION --}}
        <div class="bg-slate-50/80 px-6 sm:px-10 py-5 border-t border-slate-100 flex justify-end items-center">
            @if($placement->is_completed)
                <a href="{{ route('siswa.sertifikat.cetak', $placement->id) }}" target="_blank" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-7 py-3.5 rounded-2xl font-black text-xs shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition duration-200 active:scale-95 flex items-center gap-2.5 cursor-pointer tracking-wider uppercase inline-flex">
                    <i class="fas fa-print text-sm"></i> Cetak Sertifikat Resmi
                </a>
            @else
                <button disabled class="bg-slate-200 text-slate-400 px-7 py-3.5 rounded-2xl font-black text-xs cursor-not-allowed flex items-center gap-2.5 border border-slate-300/40 tracking-wider uppercase">
                    <i class="fas fa-lock text-sm opacity-70"></i> Cetak Sertifikat
                </button>
            @endif
        </div>
    </div>

    {{-- KOTAK ULASAN DAN EVALUASI --}}
    @if($placement->is_completed || ($nilaiMentor && $nilaiGuru))
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- CATATAN MENTOR --}}
        <div class="bg-white p-6 sm:p-7 rounded-3xl shadow-sm border border-slate-200/80 border-l-4 border-l-indigo-500 flex flex-col justify-between transition-all duration-300 hover:shadow-md">
            <div>
                <h4 class="font-black text-slate-800 text-sm mb-4 flex items-center tracking-tight">
                    <i class="fas fa-comment-dots text-indigo-500 mr-2.5 text-base"></i> Catatan Mentor
                </h4>
                <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl italic text-slate-600 text-xs sm:text-sm leading-relaxed font-medium border border-slate-200/60 relative">
                    <span class="text-4xl text-slate-200 absolute right-3 bottom-0 font-serif select-none pointer-events-none">”</span>
                    "{{ $nilaiMentor->catatan ?? 'Tidak ada catatan khusus.' }}"
                </div>
            </div>
            <div class="mt-6 flex items-center bg-indigo-50/50 p-3 rounded-2xl border border-indigo-100/60">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-blue-600 flex items-center justify-center text-white font-black text-xs shadow-md shrink-0">
                    {{ substr($placement->mentor->name ?? 'M', 0, 1) }}
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-xs font-black text-slate-900 tracking-wide truncate">{{ $placement->mentor->name ?? 'Mentor' }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pembimbing Lapangan Industri</p>
                </div>
            </div>
        </div>

        {{-- EVALUASI GURU --}}
        <div class="bg-white p-6 sm:p-7 rounded-3xl shadow-sm border border-slate-200/80 border-l-4 border-l-blue-500 flex flex-col justify-between transition-all duration-300 hover:shadow-md">
            <div>
                <h4 class="font-black text-slate-800 text-sm mb-4 flex items-center tracking-tight">
                    <i class="fas fa-quote-left text-blue-500 mr-2.5 text-base"></i> Evaluasi Guru
                </h4>
                <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl italic text-slate-600 text-xs sm:text-sm leading-relaxed font-medium border border-slate-200/60 relative">
                    <span class="text-4xl text-slate-200 absolute right-3 bottom-0 font-serif select-none pointer-events-none">”</span>
                    "{{ $nilaiGuru->catatan ?? 'Tidak ada catatan khusus.' }}"
                </div>
            </div>
            <div class="mt-6 flex items-center bg-blue-50/50 p-3 rounded-2xl border border-blue-100/60">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-black text-xs shadow-md shrink-0">
                    {{ substr($placement->guru->name ?? 'G', 0, 1) }}
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-xs font-black text-slate-900 tracking-wide truncate">{{ $placement->guru->name ?? 'Guru' }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pembimbing Internal Sekolah</p>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection