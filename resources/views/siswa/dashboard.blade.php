@extends('layouts.siswa_layout') {{-- Pake layout baru --}}

@section('page_title', 'Dashboard Siswa')

@section('content')

<div class="space-y-8 select-none pb-12 antialiased font-sans">
    
    {{-- KARTU UCAPAN SELAMAT DATANG (ELEGAN & INTERAKTIF) --}}
    <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950 p-7 sm:p-10 text-white shadow-2xl shadow-emerald-950/20 border border-slate-800/80 transition-all duration-500 hover:shadow-emerald-900/30 hover:-translate-y-0.5 group">
        {{-- Light Glow Overlay & Decorative Blur --}}
        <div class="absolute -right-16 -top-16 w-80 h-80 bg-emerald-500/15 rounded-full blur-3xl group-hover:bg-emerald-400/25 transition-all duration-700 pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-72 h-72 bg-teal-500/15 rounded-full blur-3xl group-hover:bg-teal-400/25 transition-all duration-700 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#opacity-10_1px,transparent_1px)] [background-size:16px_16px] opacity-20 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 text-[11px] font-black text-emerald-300 tracking-wider uppercase shadow-inner">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                    </span>
                    Student Portal
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight flex flex-wrap items-center gap-3 leading-tight">
                    Halo, 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-green-300 font-black tracking-wide drop-shadow-sm">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="inline-block animate-bounce text-2xl sm:text-3xl">👋</span>
                </h2>
                <p class="text-slate-300/90 text-sm sm:text-base font-medium leading-relaxed">
                    Selamat datang di panel monitoring kegiatan magang Anda secara real-time.
                </p>
            </div>

            {{-- Date & Time Pill Badge --}}
            <div class="relative z-10 bg-slate-900/60 backdrop-blur-xl p-2 rounded-2xl border border-white/10 text-white text-sm font-bold shadow-2xl flex flex-col sm:flex-row items-stretch sm:items-center shrink-0 gap-2 w-full sm:w-auto">
                <div class="flex items-center px-4 py-2 text-slate-200 gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500/10 border border-emerald-400/20 flex items-center justify-center text-emerald-400 shrink-0">
                        <i class="far fa-calendar-alt text-sm animate-pulse"></i> 
                    </div>
                    {{-- Format Tanggal dan Hari Bahasa Indonesia + Timezone Asia/Jakarta --}}
                    <span class="font-bold text-xs sm:text-sm text-slate-100 tracking-wide">
                        {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </span>
                </div>
                <div class="flex items-center justify-center gap-2.5 font-mono tracking-wider bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 text-white px-4 py-2.5 rounded-xl text-xs font-black shadow-md shadow-emerald-600/30 border border-emerald-400/30 group-hover:scale-[1.02] transition-transform">
                    <i class="far fa-clock text-xs animate-spin" style="animation-duration: 8s;"></i>
                    <span id="digital-clock" class="text-sm tracking-widest font-bold">00:00:00</span>
                </div>
            </div>
        </div>
    </div>

    @if($placement)
        @php
            // Status Logbook
            $hasLoggedToday = $hasLoggedToday ?? false; 
        @endphp

        {{-- FITUR BANNER TARGET LOGBOOK HARI INI & HIMBAUAN PEMBIMBING --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Status Target Logbook Hari Ini --}}
            <div class="lg:col-span-2 relative overflow-hidden bg-white p-6 sm:p-7 rounded-[2rem] shadow-sm hover:shadow-md border border-slate-200/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 transition-all duration-300">
                
                {{-- Decorative Background Glow --}}
                <div class="absolute -right-10 -bottom-10 w-36 h-36 {{ $hasLoggedToday ? 'bg-emerald-500/5' : 'bg-amber-500/5' }} rounded-full blur-2xl pointer-events-none"></div>

                {{-- Left Section: Icon & Info --}}
                <div class="flex items-start sm:items-center gap-4 min-w-0 flex-1">
                    {{-- Icon Box --}}
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl {{ $hasLoggedToday ? 'bg-emerald-50 text-emerald-600 border border-emerald-200/60 shadow-sm shadow-emerald-500/10' : 'bg-amber-50 text-amber-500 border border-amber-200/60 shadow-sm shadow-amber-500/10' }} flex items-center justify-center text-xl sm:text-2xl shrink-0">
                        <i class="fas {{ $hasLoggedToday ? 'fa-check-circle' : 'fa-exclamation-triangle' }}"></i>
                    </div>

                    {{-- Text Information --}}
                    <div class="space-y-1.5 min-w-0 flex-1">
                        <h4 class="font-black text-slate-800 text-base sm:text-lg tracking-tight leading-none">
                            Target Logbook Hari Ini
                        </h4>
                        
                        <div class="text-xs sm:text-sm font-semibold text-slate-500 leading-relaxed flex flex-wrap items-center gap-2 pt-0.5">
                            @if($hasLoggedToday)
                                <span class="inline-flex items-center text-emerald-700 font-extrabold bg-emerald-50 px-2.5 py-0.5 rounded-lg border border-emerald-200/60 text-xs shrink-0">
                                    Lengkap!
                                </span>
                                <span>Anda sudah mengisi aktivitas logbook untuk hari ini.</span>
                            @else
                                <span class="inline-flex items-center text-amber-700 font-extrabold bg-amber-50 px-2.5 py-0.5 rounded-lg border border-amber-200/60 text-xs shrink-0">
                                    Belum Diisi!
                                </span>
                                <span>Jangan lupa untuk mencatat aktivitas harian Anda hari ini.</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Right Section: Action Button / Status --}}
                <div class="w-full sm:w-auto shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                    @if(!$hasLoggedToday)
                        <a href="{{ \Illuminate\Support\Facades\Route::has('logbook.create') ? route('logbook.create') : (\Illuminate\Support\Facades\Route::has('siswa.logbook.create') ? route('siswa.logbook.create') : '#') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs shadow-lg shadow-emerald-600/25 active:scale-95 transition-all">
                            <i class="fas fa-plus text-xs"></i> 
                            <span>Isi Logbook Sekarang</span>
                        </a>
                    @else
                        <span class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl bg-emerald-50/80 border border-emerald-200/80 text-emerald-700 font-bold text-xs shadow-xs">
                            <i class="fas fa-shield-alt text-emerald-600"></i> 
                            <span>Terverifikasi Sistem</span>
                        </span>
                    @endif
                </div>

            </div>

            {{-- Card Himbauan Pembimbing --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-700 p-6 rounded-[2rem] shadow-xl shadow-emerald-600/15 text-white border border-emerald-500/40 flex items-center gap-4 transition-all duration-300 hover:shadow-emerald-600/25">
                {{-- Decorative Background Glow --}}
                <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                {{-- Icon Wrapper --}}
                <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-md border border-white/20 text-white flex items-center justify-center shrink-0 shadow-inner">
                    <i class="fas fa-user-check text-lg"></i>
                </div>

                {{-- Content Text Wrapper --}}
                <div class="space-y-1 min-w-0 flex-1">
                    <h5 class="font-black text-[10px] uppercase tracking-widest text-emerald-200 opacity-90">Pesan Pembimbing</h5>
                    <p class="text-xs sm:text-sm font-bold leading-relaxed text-white drop-shadow-xs">
                        "Setiap harinya melakukan monitoring, jangan lupa upload logbook!"
                    </p>
                </div>
            </div>
        </div>

        {{-- STATS CARDS GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">

            {{-- Card Total Logbook --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-emerald-500 group flex flex-col justify-between h-48">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-2">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Total Logbook</p>
                        <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono">{{ $logbookSummary['total'] }}</h3>
                    </div>
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-emerald-600 group-hover:to-teal-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-500/30 group-hover:rotate-6 shrink-0">
                        <i class="fas fa-book-open text-xl"></i>
                    </div>
                </div>
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                    <span>Aktivitas Harian</span>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-emerald-500"></i>
                </div>
            </div>

            {{-- Card Disetujui --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-emerald-500 group flex flex-col justify-between h-48">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-2">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Disetujui</p>
                        <h3 class="text-3xl sm:text-4xl font-black text-emerald-600 tracking-tight font-mono">{{ $logbookSummary['disetujui'] }}</h3>
                    </div>
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-emerald-600 group-hover:to-teal-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-500/30 group-hover:rotate-6 shrink-0">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                </div>
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                    <span>Verifikasi Pembimbing</span>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-emerald-500"></i>
                </div>
            </div>

            {{-- Card Menunggu --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] shadow-sm hover:shadow-xl hover:shadow-amber-500/10 border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-amber-500 group flex flex-col justify-between h-48">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-amber-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-2">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-amber-600 transition-colors">Menunggu</p>
                        <h3 class="text-3xl sm:text-4xl font-black text-amber-500 tracking-tight font-mono">{{ $logbookSummary['pending'] }}</h3>
                    </div>
                    <div class="p-4 bg-amber-50 text-amber-600 rounded-2xl border border-amber-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:to-amber-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-amber-500/30 group-hover:rotate-6 shrink-0">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                    <span>Perlu Tinjauan</span>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-amber-500"></i>
                </div>
            </div>

            {{-- Card Status Magang --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] shadow-sm hover:shadow-xl hover:shadow-purple-500/10 border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-purple-500 group flex flex-col justify-between h-48">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-purple-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-2">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-purple-600 transition-colors">Status Magang</p>
                        <div class="mt-2">
                            <span class="text-xs font-black text-purple-700 uppercase bg-purple-50 border border-purple-200/80 px-3.5 py-1.5 rounded-xl inline-block shadow-2xs tracking-wider">
                                {{ $placement->status }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4 bg-purple-50 text-purple-600 rounded-2xl border border-purple-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-purple-600 group-hover:to-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-purple-500/30 group-hover:rotate-6 shrink-0">
                        <i class="fas fa-business-time text-xl"></i>
                    </div>
                </div>
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                    <span>Kondisi Aktif</span>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-purple-500"></i>
                </div>
            </div>

        </div>

        {{-- DETAIL PLACEMENT GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Lokasi Magang --}}
            <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/80 via-white to-slate-50/80 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 text-base sm:text-lg flex items-center tracking-tight">
                        <div class="bg-emerald-50 p-2.5 rounded-2xl mr-3 border border-emerald-100 text-emerald-600 shadow-2xs shrink-0">
                            <i class="fas fa-building text-base"></i>
                        </div>
                        Lokasi Penempatan Magang
                    </h3>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row items-start gap-6">
                        <div class="h-18 w-18 bg-gradient-to-tr from-emerald-600 via-teal-600 to-emerald-700 text-white rounded-2xl flex items-center justify-center font-black text-2xl shadow-xl shadow-emerald-500/20 shrink-0 border border-emerald-400/20">
                            <i class="far fa-building"></i>
                        </div>
                        <div class="space-y-4 flex-1">
                            <div>
                                <h2 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight leading-snug">{{ $placement->instansi->nama_perusahaan }}</h2>
                                <p class="text-slate-500 mt-2 text-xs sm:text-sm font-medium flex items-start sm:items-center gap-2.5 leading-relaxed">
                                    <i class="fas fa-map-marker-alt text-rose-500 text-sm shrink-0 mt-0.5 sm:mt-0"></i> 
                                    <span>{{ $placement->instansi->alamat }}</span>
                                </p>
                            </div>
                            
                            <div class="pt-2 flex flex-wrap gap-3 text-xs">
                                <span class="bg-slate-50 text-slate-700 px-4 py-2.5 rounded-2xl border border-slate-200/80 font-semibold shadow-2xs flex items-center gap-2.5">
                                    <i class="fas fa-calendar-alt text-emerald-500 text-sm"></i> 
                                    <span>Mulai: <strong class="font-black text-slate-800">{{ $placement->tanggal_mulai->locale('id')->translatedFormat('d M Y') }}</strong></span>
                                </span>
                                <span class="bg-slate-50 text-slate-700 px-4 py-2.5 rounded-2xl border border-slate-200/80 font-semibold shadow-2xs flex items-center gap-2.5">
                                    <i class="fas fa-flag-checkered text-teal-500 text-sm"></i> 
                                    <span>Selesai: <strong class="font-black text-slate-800">{{ $placement->tanggal_selesai->locale('id')->translatedFormat('d M Y') }}</strong></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pembimbing --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/80 via-white to-slate-50/80">
                    <h3 class="font-black text-slate-800 text-base sm:text-lg flex items-center tracking-tight">
                        <div class="bg-emerald-50 p-2.5 rounded-2xl mr-3 border border-emerald-100 text-emerald-600 shadow-2xs shrink-0">
                            <i class="fas fa-users text-base"></i>
                        </div>
                        Pembimbing Magang
                    </h3>
                </div>
                <div class="p-6 sm:p-8 space-y-4">

                    {{-- Guru Sekolah --}}
                    <div class="flex items-center p-4 bg-slate-50/80 rounded-2xl border border-slate-200/60 hover:bg-white hover:border-emerald-200 hover:shadow-md transition-all duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center font-bold mr-4 shrink-0 shadow-2xs">
                            <i class="fas fa-chalkboard-teacher text-lg"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">Guru Pembimbing Sekolah</p>
                            <p class="font-extrabold text-slate-800 text-sm truncate mt-0.5">{{ $placement->guru->name }}</p>
                        </div>
                    </div>

                    {{-- Mentor Industri --}}
                    <div class="flex items-center p-4 bg-slate-50/80 rounded-2xl border border-slate-200/60 hover:bg-white hover:border-purple-200 hover:shadow-md transition-all duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center font-bold mr-4 shrink-0 shadow-2xs">
                            <i class="fas fa-user-tie text-lg"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">Mentor Industri</p>
                            @if($placement->mentor_id)
                                <p class="font-extrabold text-slate-800 text-sm truncate mt-0.5">{{ $placement->mentor->name }}</p>
                            @else
                                <p class="text-rose-500 text-xs font-bold mt-0.5 italic flex items-center gap-1">
                                    Belum ditentukan
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>

    @else
        {{-- EMPTY STATE: Menunggu Penempatan (Diperindah Tampilan dan Layout-nya) --}}
        <div class="relative overflow-hidden bg-white rounded-[2.5rem] shadow-xl hover:shadow-2xl p-8 sm:p-12 text-center border border-slate-200/80 max-w-xl mx-auto my-6 transition-all duration-500 group">
            {{-- Decorative Top Bar --}}
            <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-amber-500"></div>
            <div class="absolute -right-16 -bottom-16 w-48 h-48 bg-amber-500/5 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 space-y-5">
                {{-- Icon Badge --}}
                <div class="w-20 h-20 bg-amber-50 text-amber-500 rounded-3xl flex items-center justify-center border-2 border-amber-200/80 mx-auto shadow-lg shadow-amber-500/10 transform group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-exclamation-triangle text-3xl animate-pulse"></i>
                </div>

                {{-- Text Content --}}
                <div class="space-y-2">
                    <span class="inline-block px-3.5 py-1 rounded-full bg-amber-100/80 text-amber-800 text-[10px] font-black uppercase tracking-widest border border-amber-200/60">
                        Status Sesi
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">Menunggu Penempatan</h3>
                </div>

                <p class="text-slate-500 text-xs sm:text-sm font-medium leading-relaxed max-w-md mx-auto">
                    Akun kamu sudah aktif, tetapi Admin sekolah belum menentukan tempat magang kamu.
                    Silakan tunggu atau hubungi Guru Pembimbing.
                </p>

                {{-- Decorative Helper Badge --}}
                <div class="pt-4 flex items-center justify-center gap-2 text-xs text-slate-400 font-bold border-t border-slate-100">
                    <i class="fas fa-info-circle text-amber-500"></i>
                    <span>Informasi penempatan akan diperbarui secara otomatis di halaman ini.</span>
                </div>
            </div>
        </div>
    @endif

</div>

{{-- SCRIPT JAM DIGITAL BERGERAK REAL-TIME DENGAN TIMEZONE WIB --}}
<script>
    function updateClock() {
        const options = {
            timeZone: 'Asia/Jakarta',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };
        
        const now = new Date();
        const timeString = new Intl.DateTimeFormat('id-ID', options).format(now).replace(/\./g, ':');
        
        const clockElement = document.getElementById('digital-clock');
        if (clockElement) {
            clockElement.textContent = timeString;
        }
    }

    // Jalankan langsung saat pertama kali dimuat
    updateClock();
    // Perbarui setiap 1 detik
    setInterval(updateClock, 1000);
</script>
@endsection