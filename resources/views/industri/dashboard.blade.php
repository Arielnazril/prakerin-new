@extends('layouts.industri_layout')

@section('page_title', 'Dashboard Mentor')

@section('content')

{{-- BANNER WELCOME --}}
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 p-6 sm:p-8 text-white shadow-2xl shadow-indigo-950/20 border border-slate-700/50 transition-all duration-500 hover:shadow-indigo-900/30 group mb-8">
    {{-- Light Glow Overlay & Decorative Blur --}}
    <div class="absolute -right-12 -top-12 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl group-hover:bg-blue-400/30 transition-all duration-700 pointer-events-none"></div>
    <div class="absolute -left-12 -bottom-12 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl group-hover:bg-indigo-400/30 transition-all duration-700 pointer-events-none"></div>
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none"></div>

    <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        {{-- Sisi Kiri: Profil & Teks Ucapan --}}
        <div class="flex items-center gap-5 w-full lg:w-auto">
            {{-- Avatar Inisial Mentor --}}
            <div class="hidden sm:flex shrink-0 h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-sky-400 text-white text-2xl font-black shadow-lg shadow-blue-500/25 border border-white/20 transition-all duration-300 transform group-hover:scale-105 group-hover:rotate-2">
                {{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}
            </div>

            <div class="space-y-2 max-w-2xl">
                {{-- Status Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-extrabold text-blue-300 tracking-wider uppercase shadow-inner">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shadow-sm shadow-emerald-400"></span> Mentor Aktif
                </div>

                {{-- Judul Menyapa --}}
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight flex flex-wrap items-center gap-2.5">
                    Selamat Datang, 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-sky-300 font-black tracking-wide">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="inline-block animate-bounce text-2xl sm:text-3xl">👋</span>
                </h2>

                {{-- Detail Instansi Mentor --}}
                <p class="text-slate-300 text-sm sm:text-base font-medium leading-relaxed flex flex-wrap items-center gap-2">
                    <span>Anda bertindak sebagai Pembimbing Lapangan dari</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-xl bg-white/10 backdrop-blur-md border border-white/15 text-xs font-bold text-sky-200 shadow-sm transition-colors duration-300 group-hover:border-blue-400/50">
                        <i class="fas fa-building mr-1.5 text-blue-400 text-xs"></i>
                        {{ Auth::user()->instansi->nama_perusahaan ?? 'Instansi' }}
                    </span>
                </p>
            </div>
        </div>

        {{-- Sisi Kanan: Widget Waktu (Jam & Tanggal) --}}
        <div class="relative z-10 bg-slate-800/60 backdrop-blur-xl px-5 py-3.5 rounded-2xl border border-white/15 text-white text-sm font-bold shadow-xl flex items-center shrink-0 gap-4 w-full sm:w-auto justify-between sm:justify-start">
            {{-- Tanggal --}}
            <div class="flex items-center border-r border-white/20 pr-4 text-slate-200">
                <i class="far fa-calendar-alt mr-2.5 text-blue-400 text-base animate-pulse"></i> 
                <span id="digital-date" class="font-bold text-xs sm:text-sm text-slate-100">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
            </div>

            {{-- Jam Real-Time --}}
            <div class="flex items-center pl-1 font-mono tracking-wider bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-3.5 py-1.5 rounded-xl text-xs font-black shadow-md border border-blue-400/30 group-hover:scale-105 transition-transform">
                <i class="far fa-clock mr-2 text-xs animate-spin" style="animation-duration: 8s;"></i>
                <span id="digital-clock">00:00:00</span>
            </div>
        </div>
    </div>
</div>

{{-- STATISTIC CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- CARD 1: TOTAL SISWA (Gradient Biru Ultra Modern) --}}
    <div class="bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 text-white p-6 rounded-3xl shadow-xl shadow-blue-500/10 hover:shadow-2xl hover:shadow-blue-500/25 hover:-translate-y-1.5 transition-all duration-300 group relative overflow-hidden border border-blue-400/30 flex flex-col justify-between">
        {{-- Decorative Blur & Grid Pattern --}}
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all duration-500 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:16px_16px] pointer-events-none"></div>

        {{-- Main Content --}}
        <div class="flex items-start justify-between relative z-10">
            <div class="space-y-1">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-md text-[11px] font-black tracking-widest uppercase text-blue-100 border border-white/10 shadow-xs">
                    Siswa Bimbingan
                </span>
                <h3 class="text-4xl sm:text-5xl font-black text-white tracking-tight pt-2 drop-shadow-md">
                    {{ number_format($totalSiswa ?? 0) }}
                </h3>
            </div>
            <div class="p-3.5 bg-white/15 backdrop-blur-md text-white rounded-2xl border border-white/25 shadow-lg flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                <i class="fas fa-users text-2xl text-blue-100"></i>
            </div>
        </div>

        {{-- Subtext/Footer Note --}}
        <div class="mt-6 pt-3 border-t border-white/15 relative z-10 flex items-center justify-between text-[11px] font-extrabold text-blue-100/90 tracking-wide">
            <span class="flex items-center gap-1.5">
                <i class="fas fa-user-check text-blue-300"></i> Siswa Terdaftar
            </span>
            <span class="text-white/80 font-mono text-[10px]">AKTIF</span>
        </div>
    </div>

    {{-- CARD 2: BUTUH VALIDASI (Gradient Orange / Warm Alert) --}}
    <div class="bg-gradient-to-br from-amber-500 via-orange-500 to-rose-600 text-white p-6 rounded-3xl shadow-xl shadow-orange-500/10 hover:shadow-2xl hover:shadow-orange-500/25 hover:-translate-y-1.5 transition-all duration-300 group relative overflow-hidden border border-amber-300/30 flex flex-col justify-between">
        {{-- Decorative Blur & Grid Pattern --}}
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all duration-500 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:16px_16px] pointer-events-none"></div>

        {{-- Main Content --}}
        <div class="flex items-start justify-between relative z-10">
            <div class="space-y-1">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-md text-[11px] font-black tracking-widest uppercase text-amber-100 border border-white/10 shadow-xs">
                    Butuh Validasi
                </span>
                <h3 class="text-4xl sm:text-5xl font-black text-white tracking-tight pt-2 drop-shadow-md">
                    {{ number_format($logbookPending ?? 0) }}
                </h3>
            </div>
            <div class="p-3.5 bg-white/15 backdrop-blur-md text-white rounded-2xl border border-white/25 shadow-lg flex items-center justify-center relative group-hover:scale-110 transition-all duration-300">
                <span class="absolute -top-1 -right-1 flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                </span>
                <i class="fas fa-bell text-2xl text-amber-100 animate-bounce" style="animation-duration: 2s;"></i>
            </div>
        </div>

        {{-- Button Action --}}
        <div class="mt-6 pt-3 border-t border-white/15 relative z-10">
            <a href="{{ route('industri.validasi.index') }}" class="w-full text-xs text-amber-50 font-black tracking-wider uppercase inline-flex items-center justify-between group/btn hover:text-white transition-colors duration-200">
                <span class="flex items-center gap-1.5">
                    <i class="fas fa-clock text-amber-200"></i> Periksa Logbook
                </span>
                <span class="inline-flex items-center px-2 py-0.5 rounded-lg bg-white/20 group-hover/btn:bg-white/30 transition-colors">
                    <i class="fas fa-arrow-right text-[10px] transform group-hover/btn:translate-x-1 transition-transform"></i>
                </span>
            </a>
        </div>
    </div>

    {{-- CARD 3: TOTAL AKTIVITAS (Gradient Emerald / Fresh Success) --}}
    <div class="bg-gradient-to-br from-emerald-600 via-teal-600 to-emerald-800 text-white p-6 rounded-3xl shadow-xl shadow-emerald-500/10 hover:shadow-2xl hover:shadow-emerald-500/25 hover:-translate-y-1.5 transition-all duration-300 group relative overflow-hidden border border-emerald-400/30 flex flex-col justify-between">
        {{-- Decorative Blur & Grid Pattern --}}
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all duration-500 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:16px_16px] pointer-events-none"></div>

        {{-- Main Content --}}
        <div class="flex items-start justify-between relative z-10">
            <div class="space-y-1">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-md text-[11px] font-black tracking-widest uppercase text-emerald-100 border border-white/10 shadow-xs">
                    Total Aktivitas
                </span>
                <h3 class="text-4xl sm:text-5xl font-black text-white tracking-tight pt-2 drop-shadow-md">
                    {{ number_format($totalLogbook ?? 0) }}
                </h3>
            </div>
            <div class="p-3.5 bg-white/15 backdrop-blur-md text-white rounded-2xl border border-white/25 shadow-lg flex items-center justify-center group-hover:scale-110 group-hover:-rotate-3 transition-all duration-300">
                <i class="fas fa-file-alt text-2xl text-emerald-100"></i>
            </div>
        </div>

        {{-- Subtext/Footer Note --}}
        <div class="mt-6 pt-3 border-t border-white/15 relative z-10 flex items-center justify-between text-[11px] font-extrabold text-emerald-100/90 tracking-wide">
            <span class="flex items-center gap-1.5">
                <i class="fas fa-check-circle text-emerald-300"></i> Jurnal Masuk
            </span>
            <span class="text-white/80 font-mono text-[10px]">AKUMULASI</span>
        </div>
    </div>

</div>

{{-- SECTION INFORMASI DAN DAFTAR SISWA --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    
    {{-- CARD UTAMA LOKASI MAGANG (Background Dark Navy Slate) --}}
    <div class="relative overflow-hidden rounded-2xl border border-slate-700 bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 text-white shadow-xl transition-all duration-300 hover:shadow-2xl lg:col-span-3 group">
        <div class="absolute -right-6 -top-6 w-32 h-32 rounded-full bg-blue-500/10 blur-2xl opacity-0 transition-opacity duration-500 group-hover:opacity-100 pointer-events-none"></div>

        {{-- Header Card --}}
        <div class="flex justify-between items-center px-6 py-4 border-b border-slate-700/60 bg-black/20">
            <h3 class="flex items-center font-bold tracking-tight text-sm sm:text-base text-slate-100">
                <i class="fas fa-building mr-2.5 text-blue-400 text-lg"></i> 
                Lokasi Magang Perusahaan
            </h3>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-500/20 border border-blue-400/30 text-[11px] font-extrabold text-blue-300 uppercase tracking-wider">
                <i class="fas fa-check-circle mr-1 text-xs"></i> Terverifikasi
            </span>
        </div>
        
        {{-- Konten Utama --}}
        <div class="p-6">
            <div class="flex flex-col sm:flex-row items-start gap-5">
                {{-- Box Ikon Besar --}}
                <div class="flex shrink-0 h-20 w-20 items-center justify-center rounded-2xl border border-white/15 bg-white/10 backdrop-blur-md text-sky-400 shadow-inner transition-all duration-300 group-hover:scale-105">
                    <i class="far fa-building text-3xl"></i>
                </div>
                
                {{-- Detail Informasi Perusahaan --}}
                <div class="flex-1 space-y-3 min-w-0">
                    <div>
                        <h2 class="text-xl font-black tracking-tight text-white transition-colors duration-200 group-hover:text-sky-300">
                            {{ Auth::user()->instansi->nama_perusahaan ?? 'Nama Instansi Magang' }}
                        </h2>
                        <p class="flex items-start mt-2 text-slate-300 text-xs sm:text-sm font-medium leading-relaxed">
                            <i class="fas fa-map-marker-alt shrink-0 mr-2 mt-0.5 text-base text-rose-400"></i> 
                            <span class="break-words">{{ Auth::user()->instansi->alamat ?? 'Alamat Belum Diatur.' }}</span>
                        </p>
                    </div>
                    
                    <div class="w-full h-[1px] bg-slate-700/60"></div>
                    
                    <div class="flex flex-wrap items-center gap-2.5 pt-1 text-xs font-bold text-slate-200">
                        <div class="flex items-center px-3.5 py-1.5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm hover:border-blue-400/50">
                            <i class="fas fa-envelope mr-2.5 w-4 text-center text-blue-400 text-xs"></i> 
                            <span class="truncate">{{ Auth::user()->instansi->email_perusahaan ?? '-' }}</span>
                        </div>
                        <div class="flex items-center px-3.5 py-1.5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm hover:border-emerald-400/50">
                            <i class="fas fa-phone mr-2.5 w-4 text-center text-emerald-400 text-xs"></i> 
                            <span class="truncate">{{ Auth::user()->instansi->telepon ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- GRID DUA CARD BARU (QUICK ACTIONS & STATISTIK LOGBOOK) --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

    {{-- CARD BARU 1: AKSES CEPAT MENTOR (Background Dark Violet/Purple) --}}
    <div class="relative overflow-hidden rounded-2xl border border-violet-800/50 bg-gradient-to-br from-purple-900 via-slate-900 to-indigo-950 text-white shadow-xl transition-all duration-300 hover:shadow-2xl group">
        <div class="px-6 py-4 border-b border-purple-700/40 bg-black/20 flex items-center justify-between">
            <h3 class="flex items-center font-bold tracking-tight text-sm sm:text-base text-purple-200">
                <i class="fas fa-bolt mr-2.5 text-amber-400 text-lg"></i> 
                Aksi Cepat Mentor
            </h3>
            <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-md bg-amber-400/20 text-amber-300 border border-amber-400/30">Pintas</span>
        </div>
        <div class="p-6">
            <p class="text-xs text-purple-200/80 font-medium mb-4">Akses langsung ke menu bimbingan dan evaluasi siswa magang secara efisien.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <a href="{{ route('industri.validasi.index') }}" class="flex items-center p-3 rounded-xl border border-amber-400/30 bg-amber-500/10 backdrop-blur-md hover:bg-amber-500/20 hover:border-amber-400/60 transition-all duration-200 group/btn">
                    <div class="h-10 w-10 rounded-xl bg-amber-400 text-slate-950 font-black flex items-center justify-center shrink-0 mr-3 group-hover/btn:scale-105 transition-transform">
                        <i class="fas fa-check-double text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-black text-amber-200 truncate">Validasi Logbook</p>
                        <p class="text-[10px] text-purple-200/70 truncate">Periksa & setujui jurnal</p>
                    </div>
                </a>

                <a href="{{ route('industri.penilaian.index') }}" class="flex items-center p-3 rounded-xl border border-indigo-400/30 bg-indigo-500/10 backdrop-blur-md hover:bg-indigo-500/20 hover:border-indigo-400/60 transition-all duration-200 group/btn">
                    <div class="h-10 w-10 rounded-xl bg-indigo-400 text-slate-950 font-black flex items-center justify-center shrink-0 mr-3 group-hover/btn:scale-105 transition-transform">
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-black text-indigo-200 truncate">Input Penilaian</p>
                        <p class="text-[10px] text-purple-200/70 truncate">Evaluasi kinerja siswa</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- CARD BARU 2: RINGKASAN PROGRESS & STATUS BIMBINGAN (Background Soft Blue) --}}
    <div class="relative overflow-hidden rounded-2xl border border-blue-200 bg-gradient-to-br from-blue-50 via-sky-50 to-indigo-50 shadow-md transition-all duration-300 hover:shadow-xl group">
        <div class="px-6 py-4 border-b border-blue-100 bg-white/60 backdrop-blur-md flex items-center justify-between">
            <h3 class="flex items-center text-blue-900 font-bold tracking-tight text-sm sm:text-base">
                <i class="fas fa-chart-line mr-2.5 text-blue-600 text-lg"></i> 
                Ringkasan Penuntasan Jurnal
            </h3>
            <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-md bg-blue-600 text-white shadow-xs">Statistik</span>
        </div>
        <div class="p-6">
            @php
                $totalSiswaCount = $totalSiswa ?? 0;
                $validatedCount = ($totalLogbook ?? 0) - ($logbookPending ?? 0);
                $percentage = $totalLogbook > 0 ? round(($validatedCount / $totalLogbook) * 100) : 0;
            @endphp
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-blue-950">Persentase Logbook Tervalidasi</p>
                        <p class="text-[11px] text-blue-700 font-medium">{{ $validatedCount }} dari {{ $totalLogbook ?? 0 }} total aktivitas telah disetujui</p>
                    </div>
                    <span class="text-xl font-black text-blue-700 font-mono">{{ $percentage }}%</span>
                </div>
                
                {{-- Progress Bar Visual --}}
                <div class="w-full h-3.5 bg-blue-200/70 rounded-full overflow-hidden p-0.5 border border-blue-300/50">
                    <div class="h-full bg-gradient-to-r from-blue-600 via-indigo-600 to-emerald-500 rounded-full transition-all duration-1000 shadow-sm" style="width: {{ $percentage }}%"></div>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1 text-center">
                    <div class="p-2.5 rounded-xl bg-white/80 border border-blue-100 shadow-xs">
                        <span class="block text-[10px] font-black text-slate-400 uppercase">Perlu Tindakan</span>
                        <span class="text-sm font-black text-amber-600">{{ $logbookPending ?? 0 }} Logbook</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-white/80 border border-blue-100 shadow-xs">
                        <span class="block text-[10px] font-black text-slate-400 uppercase">Siswa Terdaftar</span>
                        <span class="text-sm font-black text-blue-700">{{ $totalSiswaCount }} Orang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- GRID KOLOM DAFTAR STATIK SISWA --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    
    {{-- CARD DAFTAR SISWA LOGBOOK (Background Emerald Mint) --}}
    <div class="relative overflow-hidden rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50/90 via-teal-50/50 to-emerald-100/40 shadow-md transition-shadow duration-300 hover:shadow-lg">
        <div class="px-6 py-4 border-b border-emerald-200/60 bg-white/70 backdrop-blur-md">
            <h3 class="flex items-center text-emerald-950 font-black tracking-tight text-sm sm:text-base">
                <i class="fas fa-clipboard-list mr-2.5 text-emerald-600 text-lg"></i> 
                AKTIVITAS LOGBOOK
            </h3>
        </div>
        
        <div class="p-6 space-y-4">
            <div class="space-y-3">
                <p class="mb-1 text-[10px] font-black tracking-wider text-emerald-700 uppercase">
                    Siswa Sudah Mengunggah Logbook
                </p>
                
                @forelse(collect($recentLogbooks ?? [])->pluck('siswa')->unique('id')->filter() as $siswa)
                    @php
                        $namaSiswa = $siswa->nama ?? $siswa->name ?? 'Nama Siswa';
                        $initialSiswa = strtoupper(substr($namaSiswa, 0, 1));
                    @endphp
                    <div class="flex items-center p-3 rounded-xl border border-emerald-200/80 bg-white/90 backdrop-blur-sm transition-all duration-200 hover:border-emerald-400 hover:shadow-xs">
                        <div class="flex shrink-0 h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-black text-sm shadow-sm">
                            {{ $initialSiswa }}
                        </div>
                        <div class="min-w-0 flex-1 pl-3">
                            <p class="font-bold text-sm text-slate-800 truncate">
                                {{ $namaSiswa }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center rounded-xl border border-dashed border-emerald-200 bg-white/50">
                        <div class="text-emerald-300 mb-2">
                            <i class="fas fa-file-signature text-3xl"></i>
                        </div>
                        <p class="text-xs font-bold text-emerald-800/60">
                            Belum ada siswa yang mengunggah logbook
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- KARTU: DAFTAR SISWA SUDAH DINILAI (Background Indigo Rose Soft Gradient) --}}
    <div class="relative overflow-hidden rounded-2xl border border-indigo-200 bg-gradient-to-br from-indigo-50/90 via-slate-50 to-purple-50/50 shadow-md transition-all duration-300 hover:shadow-lg group">
        <div class="flex justify-between items-center px-6 py-4 border-b border-indigo-200/60 bg-white/70 backdrop-blur-md">
            <h3 class="flex items-center text-indigo-950 font-black tracking-tight text-sm sm:text-base">
                <i class="fas fa-star mr-2.5 text-indigo-600 text-lg"></i> 
                STATUS PENILAIAN
            </h3>
            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-indigo-600 text-[10px] font-bold text-white uppercase tracking-wider">
                Evaluasi
            </span>
        </div>
        
        {{-- Konten Utama --}}
        <div class="p-6">
            <p class="mb-4 text-[10px] font-black tracking-widest text-indigo-700 uppercase">
                Siswa Bimbingan Sudah Dinilai
            </p>
            
            <div class="space-y-3 max-h-[320px] overflow-y-auto pr-1 custom-scrollbar">
                @php $hasEvaluated = false; @endphp

                @if(isset($placements) && count($placements) > 0)
                    @foreach($placements as $placement)
                        @php
                            $nilaiEvaluasi = \App\Models\Penilaian::where('placement_id', $placement->id)
                                ->where('penilai_id', Auth::id())
                                ->first();
                        @endphp
                        
                        @if($nilaiEvaluasi)
                            @php 
                                $hasEvaluated = true; 
                                $namaEvaluasiSiswa = $placement->siswa->name ?? $placement->siswa->nama ?? 'Siswa';
                                $initialEvaluasi = strtoupper(substr($namaEvaluasiSiswa, 0, 1));
                            @endphp
                            <div class="flex items-center justify-between p-3.5 rounded-xl border border-indigo-100 bg-white/90 backdrop-blur-sm transition-all duration-300 hover:border-indigo-300 hover:shadow-xs group/item">
                                <div class="flex items-center min-w-0 flex-1">
                                    {{-- Profil Huruf Inisial Siswa --}}
                                    <div class="flex shrink-0 h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-black text-sm shadow-sm transition-all duration-300 group-hover/item:scale-105">
                                        {{ $initialEvaluasi }}
                                    </div>
                                    
                                    {{-- Nama & Identitas Siswa --}}
                                    <div class="min-w-0 flex-1 pl-3.5">
                                        <p class="font-bold text-sm text-slate-800 group-hover/item:text-indigo-900 transition-colors duration-200 truncate">
                                            {{ $namaEvaluasiSiswa }}
                                        </p>
                                        <p class="text-[11px] font-bold text-slate-400 flex items-center mt-0.5">
                                            <i class="fas fa-graduation-cap mr-1 text-[10px]"></i>
                                            Siswa Magang Aktif
                                        </p>
                                    </div>
                                </div>
                                {{-- Badge Nilai Akhir --}}
                                <div class="ml-4 shrink-0">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-xl font-mono text-xs font-black bg-indigo-600 text-white shadow-xs group-hover/item:bg-purple-700 transition-all duration-300">
                                        <small class="font-sans font-bold text-[10px] uppercase tracking-wider mr-1.5 opacity-80">Score:</small>
                                        {{ $nilaiEvaluasi->nilai_akhir }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                {{-- State Ketika Belum Ada Data --}}
                @if(!$hasEvaluated)
                    <div class="flex flex-col items-center justify-center py-10 px-4 text-center rounded-2xl border border-dashed border-indigo-200 bg-white/50 relative overflow-hidden">
                        <div class="h-14 w-14 rounded-2xl bg-white border border-indigo-100 shadow-xs flex items-center justify-center text-indigo-400 mb-3.5">
                            <i class="fas fa-graduation-cap text-2xl text-indigo-300 animate-pulse"></i>
                        </div>
                        <h4 class="text-xs font-extrabold text-indigo-900 tracking-tight">Belum Ada Evaluasi</h4>
                        <p class="text-[11px] font-medium text-indigo-700/60 mt-1 max-w-[200px] mx-auto leading-normal">
                            Belum ada siswa bimbingan yang dinilai
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- Variabel bawaan --}}
<div class="hidden">
    @forelse($recentLogbooks ?? [] as $log)
        <span>{{ $log->id }}</span>
    @empty
    @endforelse
</div>

{{-- SCRIPT JAM & TANGGAL DIGITAL BERGERAK REAL-TIME --}}
<script>
    function updateClock() {
        const now = new Date();
        
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        const clockElement = document.getElementById('digital-clock');
        if (clockElement) {
            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
        }

        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        const dayName = days[now.getDay()];
        const dayOfMonth = now.getDate();
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        const dateElement = document.getElementById('digital-date');
        if (dateElement) {
            dateElement.textContent = `${dayName}, ${dayOfMonth} ${monthName} ${year}`;
        }
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection