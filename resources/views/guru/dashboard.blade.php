@extends('layouts.guru_layout')

@section('page_title', 'Dashboard Guru')

@section('content')

{{-- BANNER WELCOME --}}
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-blue-900 p-6 md:p-8 mb-8 text-white shadow-xl shadow-indigo-950/20 border border-slate-800/80 group">
    {{-- Decorative Ornaments --}}
    <div class="absolute -right-12 -top-12 w-56 h-56 bg-blue-500/20 rounded-full blur-3xl group-hover:bg-blue-400/30 transition-all duration-700 pointer-events-none"></div>
    <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-indigo-500/20 rounded-full blur-2xl pointer-events-none"></div>
    
    <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            {{-- AVATAR HURUF PADA GURU --}}
            <div class="hidden sm:flex h-16 w-16 rounded-2xl bg-gradient-to-tr from-blue-500 to-indigo-400 text-white font-black items-center justify-center text-2xl shadow-lg shadow-blue-500/30 border border-white/20 transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-300 shrink-0">
                {{ substr(Auth::user()->name ?? 'G', 0, 1) }}
            </div>
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/10 text-xs font-bold text-blue-200 mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Panel Pembimbing
                </div>
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight flex items-center gap-2">
                    Selamat Datang, {{ Auth::user()->name ?? 'Guru Pembimbing' }}! <span class="animate-bounce inline-block text-2xl">👋</span>
                </h2>
                <p class="text-slate-300 mt-1 text-sm font-medium">Berikut adalah ringkasan aktivitas siswa bimbingan PKL Anda.</p>
            </div>
        </div>
        
        <div class="w-full md:w-auto bg-white/10 backdrop-blur-md px-4 py-3 rounded-2xl border border-white/15 text-white shadow-inner flex items-center justify-between md:justify-end gap-3 shrink-0">
            <div class="flex items-center border-r border-white/20 pr-3 text-xs md:text-sm text-slate-200 font-semibold">
                <i class="far fa-calendar-alt mr-2 text-blue-400 text-base"></i> 
                <span id="realtime-date">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
            </div>
            <div class="flex items-center font-mono tracking-wider bg-blue-600/80 text-white px-3 py-1.5 rounded-xl text-xs shadow-md border border-blue-400/30 font-black">
                <i class="far fa-clock mr-2 text-xs animate-pulse text-blue-200"></i>
                <span id="digital-clock">00:00:00</span>
            </div>
        </div>
    </div>
</div>

{{-- STATISTIC CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- CARD BARU: GURU BIMBINGAN (MODIFIED PREMIUM) --}}
    <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 border border-slate-200/80 group relative overflow-hidden flex flex-col justify-between h-full">
        {{-- ORNAMEN BACKGROUND DINAMIS --}}
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50/80 rounded-full blur-xl group-hover:bg-blue-100 group-hover:scale-125 transition-all duration-500 pointer-events-none"></div>
        <div class="absolute left-0 top-0 w-1.5 h-full bg-blue-500 rounded-l-3xl"></div>

        <div class="flex items-start justify-between relative z-10 gap-3">
            <div class="space-y-1.5 min-w-0 flex-1">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100">
                    Pembimbing PKL
                </span>
                <h3 class="text-base font-extrabold text-slate-800 tracking-tight group-hover:text-blue-600 transition-colors duration-300 truncate mt-1" title="{{ Auth::user()->name ?? 'Guru Bimbingan' }}">
                    {{ Auth::user()->name ?? 'Guru Bimbingan' }}
                </h3>
            </div>
            <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl border border-blue-100/60 group-hover:bg-gradient-to-tr group-hover:from-blue-600 group-hover:to-indigo-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-blue-500/30 group-hover:rotate-6 transition-all duration-300 shrink-0">
                <i class="fas fa-chalkboard-teacher text-xl"></i>
            </div>
        </div>

        <div class="mt-6 pt-3.5 border-t border-slate-100 flex items-center justify-between relative z-10">
            <div class="flex items-center gap-1.5 text-[10px] text-slate-400 font-bold tracking-wider uppercase">
                <i class="fas fa-shield-alt text-blue-500 text-xs animate-pulse"></i> Hak Akses Guru
            </div>
            <span class="flex h-2.5 w-2.5 relative" title="Sistem Aktif">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
        </div>
    </div>

    {{-- CARD 1: TOTAL SISWA --}}
    <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 border border-slate-200/80 group relative overflow-hidden flex flex-col justify-between">
        <div class="absolute right-0 top-0 h-20 w-20 bg-indigo-50/50 rounded-bl-full pointer-events-none transition-all duration-500 group-hover:scale-125"></div>
        <div class="absolute left-0 top-0 w-1.5 h-full bg-indigo-600 rounded-l-3xl"></div>

        <div class="flex items-center justify-between relative z-10">
            <div class="space-y-1">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa Bimbingan</p>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight font-mono group-hover:text-indigo-600 transition-colors duration-300">{{ $totalSiswa }}</h3>
            </div>
            <div class="p-3.5 bg-indigo-50 text-indigo-600 rounded-2xl border border-indigo-100/60 group-hover:bg-gradient-to-tr group-hover:from-indigo-600 group-hover:to-indigo-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-indigo-500/30 transition-all duration-300">
                <i class="fas fa-user-graduate text-2xl"></i>
            </div>
        </div>
        <div class="mt-6 pt-3.5 border-t border-slate-100 flex items-center gap-1.5 text-[11px] text-slate-400 font-medium">
            <i class="fas fa-info-circle text-indigo-500"></i> Terdaftar aktif sistem
        </div>
    </div>

    {{-- CARD 2: BELUM DINILAI --}}
    <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 border border-slate-200/80 group relative overflow-hidden flex flex-col justify-between">
        <div class="absolute right-0 top-0 h-20 w-20 bg-amber-50/50 rounded-bl-full pointer-events-none transition-all duration-500 group-hover:scale-125"></div>
        <div class="absolute left-0 top-0 w-1.5 h-full bg-amber-500 rounded-l-3xl"></div>

        <div class="flex items-center justify-between relative z-10">
            <div class="space-y-1">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum Dinilai</p>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight font-mono group-hover:text-amber-600 transition-colors duration-300">{{ $belumDinilai }}</h3>
            </div>
            <div class="p-3.5 bg-amber-50 text-amber-600 rounded-2xl border border-amber-100/60 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:to-amber-400 group-hover:text-white group-hover:shadow-lg group-hover:shadow-amber-500/30 transition-all duration-300">
                <i class="fas fa-exclamation-circle text-2xl animate-pulse"></i>
            </div>
        </div>
        <div class="mt-6 pt-3.5 border-t border-slate-100 flex items-center justify-between">
            <a href="{{ route('guru.penilaian.index') }}" class="text-[11px] text-amber-600 font-extrabold hover:text-amber-700 tracking-wider uppercase inline-flex items-center group/btn bg-amber-50 hover:bg-amber-100/80 px-3 py-1.5 rounded-xl border border-amber-200/60 transition-all">
                Input Nilai <i class="fas fa-arrow-right ml-1.5 text-[10px] transform group-hover/btn:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

    {{-- CARD 3: SELESAI DINILAI --}}
    <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 border border-slate-200/80 group relative overflow-hidden flex flex-col justify-between">
        <div class="absolute right-0 top-0 h-20 w-20 bg-emerald-50/50 rounded-bl-full pointer-events-none transition-all duration-500 group-hover:scale-125"></div>
        <div class="absolute left-0 top-0 w-1.5 h-full bg-emerald-500 rounded-l-3xl"></div>

        <div class="flex items-center justify-between relative z-10">
            <div class="space-y-1">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Selesai Dinilai</p>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight font-mono group-hover:text-emerald-600 transition-colors duration-300">{{ $sudahDinilai }}</h3>
            </div>
            <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100/60 group-hover:bg-gradient-to-tr group-hover:from-emerald-600 group-hover:to-teal-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-500/30 transition-all duration-300">
                <i class="fas fa-check-double text-2xl"></i>
            </div>
        </div>
        <div class="mt-6 pt-3.5 border-t border-slate-100 flex items-center gap-1.5 text-[11px] text-slate-400 font-medium">
            <i class="fas fa-check-circle text-emerald-500"></i> Evaluasi tersimpan
        </div>
    </div>
</div>

{{-- DATA TABLE LOGBOOK --}}
<div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden mb-8 transition-all duration-300 hover:shadow-md">
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-gradient-to-r from-slate-50/80 via-white to-slate-50/30">
        <h3 class="font-black text-slate-800 text-base tracking-tight flex items-center">
            <span class="p-2 rounded-xl bg-blue-50 text-blue-600 mr-3 border border-blue-100">
                <i class="fas fa-history text-sm"></i>
            </span>
            Logbook Siswa Terbaru
        </h3>
        <span class="text-[10px] font-black uppercase text-slate-500 bg-slate-100/80 border border-slate-200/80 px-3 py-1.5 rounded-xl tracking-wider shadow-2xs">
            5 Aktivitas Terakhir
        </span>
    </div>

    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/70 text-slate-400 uppercase text-[10px] font-black tracking-widest border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Siswa</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Kegiatan</th>
                    <th class="px-6 py-4">Status Mentor</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($recentLogbooks as $log)
                <tr class="hover:bg-slate-50/80 transition duration-150 group">
                    <td class="px-6 py-4 font-extrabold text-slate-800 whitespace-nowrap tracking-wide">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-black flex items-center justify-center text-sm shadow-md shadow-blue-500/10 border border-blue-400/20 transform group-hover:scale-105 transition-transform duration-200 shrink-0">
                                {{ substr($log->siswa->name, 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="group-hover:text-blue-600 transition-colors duration-150 text-sm font-bold text-slate-800">{{ $log->siswa->name }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-mono text-xs font-semibold tracking-wider whitespace-nowrap">
                        <div class="bg-slate-50 group-hover:bg-white w-max px-3 py-1.5 rounded-xl border border-slate-200/60 shadow-2xs transition-colors duration-150">
                            <i class="far fa-calendar text-slate-400 mr-1.5"></i>{{ $log->tanggal->format('d M Y') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-600 max-w-[340px] font-medium text-xs tracking-wide">
                        <div class="bg-slate-50/60 group-hover:bg-blue-50/40 p-2.5 rounded-xl border border-slate-200/50 group-hover:border-blue-100 transition-all duration-150 line-clamp-2">
                            {{ Str::limit($log->kegiatan, 50) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($log->status == 'pending')
                            <span class="bg-amber-50 text-amber-700 border border-amber-200/70 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-2xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu mentor
                            </span>
                        @elseif($log->status == 'disetujui')
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/70 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-2xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Disetujui Mentor
                            </span>
                        @else
                            <span class="bg-rose-50 text-rose-700 border border-rose-200/70 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-2xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Ditolak
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center text-slate-400 font-medium bg-slate-50/30">
                        <div class="flex flex-col items-center justify-center gap-3 max-w-sm mx-auto">
                            <div class="h-16 w-16 bg-white text-slate-300 rounded-3xl flex items-center justify-center border border-dashed border-slate-200 shadow-sm">
                                <i class="fas fa-inbox text-2xl text-slate-300"></i>
                            </div>
                            <span class="text-sm font-black text-slate-700 tracking-tight">Belum ada aktivitas terbaru</span>
                            <span class="text-xs text-slate-400 mt-0.5 font-medium leading-relaxed">Belum ada catatan aktivitas harian terbaru yang masuk dari semua siswa bimbingan.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- SCRIPT JAM DIGITAL BERGERAK & HARI REAL-TIME --}}
<script>
    function updateClock() {
        const now = new Date();
        
        // 1. Format Jam Digital
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        const clockElement = document.getElementById('digital-clock');
        if (clockElement) {
            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
        }

        // 2. Perbaikan Nama Hari & Tanggal Dinamis (Bahasa Indonesia)
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        const currentDayName = days[now.getDay()];
        const currentDate = now.getDate();
        const currentMonthName = months[now.getMonth()];
        const currentYear = now.getFullYear();
        
        const dateElement = document.getElementById('realtime-date');
        if (dateElement) {
            dateElement.textContent = `${currentDayName}, ${currentDate} ${currentMonthName} ${currentYear}`;
        }
    }

    // Jalankan langsung saat pertama kali dimuat
    updateClock();
    // Perbarui setiap 1 detik
    setInterval(updateClock, 1000);
</script>
@endsection