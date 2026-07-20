@extends('layouts.siswa_layout') {{-- Pake layout baru --}}

@section('page_title', 'Dashboard Siswa')

@section('content')

<div class="space-y-8 select-none pb-12 antialiased">
    
    {{-- KARTU UCAPAN SELAMAT DATANG (ELEGAN & INTERAKTIF) --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950 p-6 sm:p-8 text-white shadow-xl shadow-slate-900/10 border border-slate-700/60 transition-all duration-500 hover:-translate-y-0.5 group">
        {{-- Light Glow Overlay & Decorative Blur --}}
        <div class="absolute -right-12 -top-12 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl group-hover:bg-blue-400/30 transition-all duration-700 pointer-events-none"></div>
        <div class="absolute -left-12 -bottom-12 w-56 h-56 bg-indigo-500/20 rounded-full blur-2xl group-hover:bg-indigo-400/30 transition-all duration-700 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-extrabold text-blue-300 tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Student Portal
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight flex flex-wrap items-center gap-2.5">
                    Halo, 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-sky-300 font-black tracking-wide">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="inline-block animate-bounce text-2xl sm:text-3xl">👋</span>
                </h2>
                <p class="text-slate-300 text-sm sm:text-base font-medium leading-relaxed">
                    Selamat datang di panel monitoring kegiatan magang Anda secara real-time.
                </p>
            </div>

            {{-- Date & Time Pill Badge --}}
            <div class="relative z-10 bg-white/10 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/15 text-white text-sm font-bold shadow-lg flex items-center shrink-0 gap-4 w-full sm:w-auto justify-between sm:justify-start">
                <div class="flex items-center border-r border-white/20 pr-4 text-slate-200">
                    <i class="far fa-calendar-alt mr-2.5 text-blue-400 text-base animate-pulse"></i> 
                    <span class="font-bold text-xs sm:text-sm text-slate-100">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <div class="flex items-center pl-1 font-mono tracking-wider bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-3.5 py-1.5 rounded-xl text-xs font-black shadow-md border border-blue-400/30 group-hover:scale-105 transition-transform">
                    <i class="far fa-clock mr-2 text-xs animate-spin" style="animation-duration: 8s;"></i>
                    <span id="digital-clock">00:00:00</span>
                </div>
            </div>
        </div>
    </div>

    @if($placement)
        {{-- STATS CARDS GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">

            {{-- Card Total Logbook --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-blue-500 group flex flex-col justify-between h-44">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-blue-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-1.5">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-blue-600 transition-colors">Total Logbook</p>
                        <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono">{{ $logbookSummary['total'] }}</h3>
                    </div>
                    <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl border border-blue-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-blue-600 group-hover:to-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-blue-500/30 group-hover:rotate-6 shrink-0">
                        <i class="fas fa-book-open text-xl"></i>
                    </div>
                </div>
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                    <span>Aktivitas Harian</span>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-blue-500"></i>
                </div>
            </div>

            {{-- Card Disetujui --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-emerald-500 group flex flex-col justify-between h-44">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-emerald-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-1.5">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Disetujui</p>
                        <h3 class="text-3xl sm:text-4xl font-black text-emerald-600 tracking-tight font-mono">{{ $logbookSummary['disetujui'] }}</h3>
                    </div>
                    <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-emerald-600 group-hover:to-teal-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-500/30 group-hover:rotate-6 shrink-0">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                </div>
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                    <span>Verifikasi Pembimbing</span>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-emerald-500"></i>
                </div>
            </div>

            {{-- Card Menunggu --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-amber-500 group flex flex-col justify-between h-44">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-amber-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-1.5">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-amber-600 transition-colors">Menunggu</p>
                        <h3 class="text-3xl sm:text-4xl font-black text-amber-500 tracking-tight font-mono">{{ $logbookSummary['pending'] }}</h3>
                    </div>
                    <div class="p-3.5 bg-amber-50 text-amber-600 rounded-2xl border border-amber-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:to-amber-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-amber-500/30 group-hover:rotate-6 shrink-0">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                    <span>Perlu Tinjauan</span>
                    <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-amber-500"></i>
                </div>
            </div>

            {{-- Card Status Magang --}}
            <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-purple-500 group flex flex-col justify-between h-44">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-purple-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="space-y-1.5">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-purple-600 transition-colors">Status Magang</p>
                        <div class="mt-2">
                            <span class="text-xs font-black text-purple-700 uppercase bg-purple-50 border border-purple-200/80 px-3 py-1.5 rounded-xl inline-block shadow-2xs tracking-wider">
                                {{ $placement->status }}
                            </span>
                        </div>
                    </div>
                    <div class="p-3.5 bg-purple-50 text-purple-600 rounded-2xl border border-purple-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-purple-600 group-hover:to-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-purple-500/30 group-hover:rotate-6 shrink-0">
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
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/90 via-white to-slate-50/90 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 text-base sm:text-lg flex items-center tracking-tight">
                        <div class="bg-blue-50 p-2.5 rounded-2xl mr-3 border border-blue-100 text-blue-600 shadow-2xs shrink-0">
                            <i class="fas fa-building text-base"></i>
                        </div>
                        Lokasi Penempatan Magang
                    </h3>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row items-start gap-5">
                        <div class="h-16 w-16 bg-gradient-to-tr from-blue-600 via-indigo-600 to-indigo-700 text-white rounded-2xl flex items-center justify-center font-black text-2xl shadow-lg shadow-blue-500/20 shrink-0">
                            <i class="far fa-building"></i>
                        </div>
                        <div class="space-y-3 flex-1">
                            <div>
                                <h2 class="text-xl font-black text-slate-800 tracking-tight">{{ $placement->instansi->nama_perusahaan }}</h2>
                                <p class="text-slate-500 mt-1.5 text-xs sm:text-sm font-medium flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-rose-500 text-sm shrink-0"></i> 
                                    {{ $placement->instansi->alamat }}
                                </p>
                            </div>
                            
                            <div class="pt-3 flex flex-wrap gap-3 text-xs">
                                <span class="bg-slate-50 text-slate-700 px-4 py-2 rounded-xl border border-slate-200/80 font-semibold shadow-2xs flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-blue-500"></i> 
                                    <span>Mulai: <strong class="font-black text-slate-800">{{ $placement->tanggal_mulai->format('d M Y') }}</strong></span>
                                </span>
                                <span class="bg-slate-50 text-slate-700 px-4 py-2 rounded-xl border border-slate-200/80 font-semibold shadow-2xs flex items-center gap-2">
                                    <i class="fas fa-flag-checkered text-indigo-500"></i> 
                                    <span>Selesai: <strong class="font-black text-slate-800">{{ $placement->tanggal_selesai->format('d M Y') }}</strong></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pembimbing --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/90 via-white to-slate-50/90">
                    <h3 class="font-black text-slate-800 text-base sm:text-lg flex items-center tracking-tight">
                        <div class="bg-emerald-50 p-2.5 rounded-2xl mr-3 border border-emerald-100 text-emerald-600 shadow-2xs shrink-0">
                            <i class="fas fa-users text-base"></i>
                        </div>
                        Pembimbing Magang
                    </h3>
                </div>
                <div class="p-6 sm:p-8 space-y-4">

                    {{-- Guru Sekolah --}}
                    <div class="flex items-center p-4 bg-slate-50/80 rounded-2xl border border-slate-200/60 hover:bg-white hover:shadow-sm transition-all duration-200">
                        <div class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold mr-4 shrink-0 shadow-2xs">
                            <i class="fas fa-chalkboard-teacher text-base"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">Guru Pembimbing Sekolah</p>
                            <p class="font-extrabold text-slate-800 text-sm truncate mt-0.5">{{ $placement->guru->name }}</p>
                        </div>
                    </div>

                    {{-- Mentor Industri --}}
                    <div class="flex items-center p-4 bg-slate-50/80 rounded-2xl border border-slate-200/60 hover:bg-white hover:shadow-sm transition-all duration-200">
                        <div class="w-11 h-11 rounded-xl bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center font-bold mr-4 shrink-0 shadow-2xs">
                            <i class="fas fa-user-tie text-base"></i>
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
        {{-- EMPTY STATE: Menunggu Penempatan --}}
        <div class="bg-white rounded-3xl shadow-sm p-8 sm:p-12 text-center border-t-4 border-t-amber-400 border border-slate-200/80 max-w-2xl mx-auto my-8">
            <div class="h-20 w-20 bg-amber-50 text-amber-500 rounded-3xl flex items-center justify-center border border-amber-200/80 mx-auto mb-5 shadow-2xs">
                <i class="fas fa-exclamation-circle text-4xl animate-pulse"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-800 tracking-tight">Menunggu Penempatan</h3>
            <p class="text-slate-500 text-xs sm:text-sm font-medium mt-2 leading-relaxed max-w-md mx-auto">
                Akun kamu sudah aktif, tetapi Admin sekolah belum menentukan tempat magang kamu.
                Silakan tunggu atau hubungi Guru Pembimbing.
            </p>
        </div>
    @endif

</div>

{{-- SCRIPT JAM DIGITAL BERGERAK REAL-TIME --}}
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
    }

    // Jalankan langsung saat pertama kali dimuat
    updateClock();
    // Perbarui setiap 1 detik
    setInterval(updateClock, 1000);
</script>
@endsection