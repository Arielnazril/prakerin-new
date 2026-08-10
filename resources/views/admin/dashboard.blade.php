@extends('layouts.admin_layout')

@section('page_title', 'Dashboard Administrator')

@section('content')
<div class="space-y-8 select-none pb-12">

    {{-- KARTU UCAPAN SELAMAT DATANG (ELEGAN & INTERAKTIF) --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-emerald-950 to-slate-950 p-6 sm:p-8 text-white shadow-xl shadow-slate-950/20 border border-slate-800 transition-all duration-500 hover:-translate-y-0.5 group">
        {{-- Light Glow Overlay & Decorative Blur --}}
        <div class="absolute -right-12 -top-12 w-64 h-64 bg-emerald-600/20 rounded-full blur-3xl group-hover:bg-emerald-500/30 transition-all duration-700 pointer-events-none"></div>
        <div class="absolute -left-12 -bottom-12 w-56 h-56 bg-lime-500/20 rounded-full blur-2xl group-hover:bg-lime-400/30 transition-all duration-700 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-extrabold text-lime-300 tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-lime-400 animate-pulse"></span> Control Center
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight flex flex-wrap items-center gap-2.5">
                    Selamat Datang, 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-emerald-100 to-[#89C74A] font-black tracking-wide">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </span>
                    <span class="inline-block animate-bounce text-2xl sm:text-3xl">👋</span>
                </h2>
                <p class="text-slate-300 text-sm sm:text-base font-medium leading-relaxed">Panel kontrol pusat untuk memantau kegiatan Prakerin dan Verifikasi Pendaftaran secara real-time.</p>
            </div>

            <div class="relative z-10 bg-white/10 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/15 text-white text-sm font-bold shadow-lg flex items-center shrink-0 gap-4 w-full sm:w-auto justify-between sm:justify-start">
                <div class="flex items-center border-r border-white/20 pr-4 text-slate-200">
                    <i class="far fa-calendar-alt mr-2.5 text-[#89C74A] text-base animate-pulse"></i> 
                    <span id="digital-date" class="font-bold text-xs sm:text-sm text-slate-100">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <div class="flex items-center pl-1 font-mono tracking-wider bg-gradient-to-r from-[#234F35] to-emerald-900 text-white px-3.5 py-1.5 rounded-xl text-xs font-black shadow-md border border-[#89C74A]/30 group-hover:scale-105 transition-transform">
                    <i class="far fa-clock mr-2 text-xs animate-spin" style="animation-duration: 8s;"></i>
                    <span id="digital-clock">00:00:00</span>
                </div>
            </div>
        </div>
    </div>

    {{-- QUICK ACTIONS BAR --}}
    <div class="flex flex-wrap items-center gap-3">
        <a href="{{ route('admin.siswa.index') }}" class="px-4 py-2.5 rounded-2xl bg-white border border-slate-200/80 hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-2xs flex items-center gap-2 transition-all transform hover:-translate-y-0.5 hover:shadow-md">
            <i class="fas fa-user-plus text-[#234F35]"></i> Kelola Siswa
        </a>
        <a href="{{ route('admin.guru.index') }}" class="px-4 py-2.5 rounded-2xl bg-white border border-slate-200/80 hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-2xs flex items-center gap-2 transition-all transform hover:-translate-y-0.5 hover:shadow-md">
            <i class="fas fa-chalkboard-teacher text-emerald-600"></i> Data Guru
        </a>
        <a href="{{ route('admin.instansi.index') }}" class="px-4 py-2.5 rounded-2xl bg-white border border-slate-200/80 hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-2xs flex items-center gap-2 transition-all transform hover:-translate-y-0.5 hover:shadow-md">
            <i class="fas fa-building text-teal-600"></i> Mitra Industri
        </a>
    </div>

    {{-- GRID KARTU STATISTIK (TERANG & CERAH) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-5 sm:gap-6">

        {{-- Total Siswa (Hanya Siswa Aktif / Terverifikasi) --}}
        @php
            $countSiswaAktif = isset($siswaAktif) ? $siswaAktif->count() : ($totalSiswa ?? 0);
            $countSiswaPending = isset($siswaPending) ? $siswaPending->count() : 0;
        @endphp
        <div class="stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-[#234F35] group cursor-pointer flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-emerald-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-[#234F35] transition-colors">Total Siswa Aktif</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $countSiswaAktif }}">0</h3>
                </div>
                <div class="p-3.5 bg-emerald-50 text-[#234F35] rounded-2xl border border-emerald-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-[#234F35] group-hover:to-emerald-800 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-900/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span class="flex items-center gap-1">
                    @if($countSiswaPending > 0)
                        <span class="bg-amber-100 text-amber-800 text-[10px] px-2 py-0.5 rounded-full font-extrabold">+{{ $countSiswaPending }} Pending</span>
                    @else
                        <span>Terdaftar Sistem</span>
                    @endif
                </span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-[#234F35]"></i>
            </div>
        </div>

        {{-- Guru Pembimbing --}}
        <a href="{{ route('admin.guru.index') }}" class="block stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 hover:z-20 border-t-4 border-t-emerald-600 group cursor-pointer no-underline flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-emerald-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Guru Pembimbing</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $totalGuru }}">0</h3>
                </div>
                <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-emerald-600 group-hover:to-teal-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Tenaga Pendidik</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-emerald-500"></i>
            </div>
        </a>

        {{-- Mitra Industri --}}
        <a href="{{ route('admin.instansi.index') }}" class="block stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 hover:z-20 border-t-4 border-t-teal-600 group cursor-pointer no-underline flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-teal-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-teal-600 transition-colors">Mitra Industri</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $totalIndustri }}">0</h3>
                </div>
                <div class="p-3.5 bg-teal-50 text-teal-600 rounded-2xl border border-teal-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-teal-600 group-hover:to-emerald-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-teal-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-building text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Perusahaan Partner</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-teal-500"></i>
            </div>
        </a>

        {{-- Mentor Industri --}}
        <div class="stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-lime-600 group cursor-pointer flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-lime-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-lime-600 transition-colors">Mentor Industri</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $totalMentor }}">0</h3>
                </div>
                <div class="p-3.5 bg-lime-50 text-lime-700 rounded-2xl border border-lime-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-lime-600 group-hover:to-emerald-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-lime-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-user-tie text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Pembimbing Lapangan</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-lime-600"></i>
            </div>
        </div>

        {{-- Sedang Magang --}}
        <a href="{{ route('admin.siswa.index') }}" class="block stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 hover:z-20 border-t-4 border-t-amber-500 group cursor-pointer no-underline flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-amber-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-amber-600 transition-colors">Sedang Magang</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $siswaMagang }}">0</h3>
                </div>
                <div class="p-3.5 bg-amber-50 text-amber-600 rounded-2xl border border-amber-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:to-amber-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-amber-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Siswa Aktif Prakerin</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-amber-500"></i>
            </div>
        </a>

        {{-- INFO TERKINI: Ringkasan Sisa Kuota Industri --}}
        <a href="{{ route('admin.instansi.index') }}" class="block stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 hover:z-20 border-t-4 border-t-emerald-700 group cursor-pointer no-underline flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-emerald-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-800 transition-colors">Sisa Kuota Mitra</p>
                    @php
                        $dataInstansis = $instansis ?? collect();
                        $totalKuota = $dataInstansis->sum('kuota');
                        $terpakai = $dataInstansis->sum('terpakai_count');
                        $sisaKuota = max(0, $totalKuota - $terpakai);
                    @endphp
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $sisaKuota }}">0</h3>
                </div>
                <div class="p-3.5 bg-emerald-50 text-emerald-800 rounded-2xl border border-emerald-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-[#234F35] group-hover:to-emerald-700 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-900/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-users-slash text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Dari Total {{ $totalKuota }} Kuota</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-emerald-800"></i>
            </div>
        </a>

    </div>

    {{-- SECTION SEKSI DONUT CHART --}}
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-lg shadow-slate-200/50 transition-all duration-300 hover:shadow-xl relative overflow-hidden">
        {{-- Accent Background Glow --}}
        <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-50/50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-4 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-2">
                    <span class="p-2 bg-emerald-50 text-[#234F35] rounded-xl border border-emerald-100">
                        <i class="fas fa-chart-pie text-base"></i>
                    </span>
                    <h3 class="font-black text-slate-800 text-lg tracking-tight">Distribusi & Rasio Data</h3>
                </div>
                <p class="text-xs sm:text-sm text-slate-400 font-medium mt-1">Visualisasi persentase dan komparasi data statistik sistem Prakerin</p>
            </div>
            <span class="px-3.5 py-1.5 rounded-2xl bg-emerald-50/80 text-[#234F35] border border-emerald-200/60 text-xs font-black uppercase tracking-wider flex items-center gap-1.5 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-[#89C74A] animate-ping"></span> Real-Time Data
            </span>
        </div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            {{-- Canvas Donut Chart --}}
            <div class="lg:col-span-7 flex justify-center items-center relative min-h-[300px]">
                <div class="w-full max-w-[320px] sm:max-w-[360px] relative">
                    <canvas id="statistikDonutChart"></canvas>
                </div>
            </div>

            {{-- Custom Chart Legend Summary --}}
            <div class="lg:col-span-5 space-y-3">
                <div class="p-4 rounded-2xl bg-slate-50/80 hover:bg-slate-100/80 border border-slate-100 transition-all duration-200 flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full bg-[#234F35] ring-4 ring-emerald-100 shrink-0 group-hover:scale-110 transition-transform"></span>
                        <span class="text-xs font-extrabold text-slate-700 group-hover:text-[#234F35] transition-colors">Total Siswa Aktif</span>
                    </div>
                    <span class="text-xs font-black text-slate-800 font-mono bg-white px-3 py-1 rounded-xl border border-slate-200/80 shadow-2xs">{{ $countSiswaAktif }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50/80 hover:bg-slate-100/80 border border-slate-100 transition-all duration-200 flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full bg-emerald-500 ring-4 ring-emerald-100 shrink-0 group-hover:scale-110 transition-transform"></span>
                        <span class="text-xs font-extrabold text-slate-700 group-hover:text-emerald-600 transition-colors">Guru Pembimbing</span>
                    </div>
                    <span class="text-xs font-black text-slate-800 font-mono bg-white px-3 py-1 rounded-xl border border-slate-200/80 shadow-2xs">{{ $totalGuru }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50/80 hover:bg-slate-100/80 border border-slate-100 transition-all duration-200 flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full bg-teal-500 ring-4 ring-teal-100 shrink-0 group-hover:scale-110 transition-transform"></span>
                        <span class="text-xs font-extrabold text-slate-700 group-hover:text-teal-600 transition-colors">Mitra Industri</span>
                    </div>
                    <span class="text-xs font-black text-slate-800 font-mono bg-white px-3 py-1 rounded-xl border border-slate-200/80 shadow-2xs">{{ $totalIndustri }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50/80 hover:bg-slate-100/80 border border-slate-100 transition-all duration-200 flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full bg-[#89C74A] ring-4 ring-lime-100 shrink-0 group-hover:scale-110 transition-transform"></span>
                        <span class="text-xs font-extrabold text-slate-700 group-hover:text-lime-700 transition-colors">Mentor Industri</span>
                    </div>
                    <span class="text-xs font-black text-slate-800 font-mono bg-white px-3 py-1 rounded-xl border border-slate-200/80 shadow-2xs">{{ $totalMentor }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50/80 hover:bg-slate-100/80 border border-slate-100 transition-all duration-200 flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full bg-amber-500 ring-4 ring-amber-100 shrink-0 group-hover:scale-110 transition-transform"></span>
                        <span class="text-xs font-extrabold text-slate-700 group-hover:text-amber-600 transition-colors">Sedang Magang</span>
                    </div>
                    <span class="text-xs font-black text-slate-800 font-mono bg-white px-3 py-1 rounded-xl border border-slate-200/80 shadow-2xs">{{ $siswaMagang }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- INFORMASI TERKINI: MANAJEMEN KUOTA INDUSTRI --}}
    <div class="bg-white rounded-3xl shadow-md border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-xl relative z-10">
        {{-- Header Seksi Kuota --}}
        <div class="px-6 sm:px-8 py-6 border-b border-slate-200/80 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 bg-gradient-to-r from-emerald-50/80 via-white to-slate-50">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-tr from-[#234F35] to-emerald-800 p-3.5 rounded-2xl text-white shadow-md shadow-emerald-900/20 shrink-0">
                    <i class="fas fa-warehouse text-xl"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-900 text-lg sm:text-xl tracking-tight">Status Kuota Mitra Industri</h3>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5 font-medium">Informasi kapasitas penerimaan siswa Prakerin per Mitra Industri</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto justify-between lg:justify-end">
                <div class="relative w-full sm:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="kuotaSearchInput" placeholder="Cari nama mitra..." 
                        class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500/20 focus:border-[#234F35] outline-none transition-all shadow-xs">
                </div>
                <a href="{{ route('admin.instansi.index') }}" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#234F35] to-emerald-800 hover:from-emerald-900 hover:to-slate-900 text-white text-xs font-black shadow-md shadow-emerald-900/20 transition-all shrink-0 flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                    <i class="fas fa-cog text-xs"></i> Kelola Kuota
                </a>
            </div>
        </div>

        {{-- Tabel Kuota Industri --}}
        <div class="overflow-x-auto p-4 sm:p-6">
            <table class="w-full text-left border-collapse border border-slate-200/80 rounded-2xl overflow-hidden">
                <thead class="bg-slate-100/90 text-slate-700 uppercase text-[11px] font-black tracking-wider border-b border-slate-200/80 divide-x divide-slate-200/80">
                    <tr>
                        <th class="px-6 py-4">Nama Mitra Industri</th>
                        <th class="px-6 py-4 text-center">Total Kuota</th>
                        <th class="px-6 py-4 text-center">Terisi</th>
                        <th class="px-6 py-4 text-center">Sisa</th>
                        <th class="px-6 py-4 min-w-[200px]">Penggunaan Kuota</th>
                        <th class="px-6 py-4 text-center">Status Kapasitas</th>
                    </tr>
                </thead>
                <tbody id="kuotaTableBody" class="divide-y divide-slate-200/80 text-sm bg-white">
                    @forelse($instansis ?? [] as $instansi)
                    @php
                        // PENANGANAN PENAMPILLAN NAMA DENGAN DYNAMIC FALLBACK
                        $namaIndustri = $instansi->nama_instansi ?? $instansi->nama ?? $instansi->nama_perusahaan ?? $instansi->name ?? 'Mitra Industri #' . $instansi->id;
                        
                        $kuotaTotal = $instansi->kuota ?? 0;
                        $kuotaTerpakai = $instansi->terpakai_count ?? 0;
                        $sisa = max(0, $kuotaTotal - $kuotaTerpakai);
                        $persen = $kuotaTotal > 0 ? min(100, round(($kuotaTerpakai / $kuotaTotal) * 100)) : 0;
                    @endphp
                    <tr class="kuota-row hover:bg-slate-50/90 transition-all duration-200 group divide-x divide-slate-200/80">
                        <td class="px-6 py-4 font-black text-slate-800 tracking-wide search-target-kuota">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 text-[#234F35] font-bold text-sm flex items-center justify-center shrink-0 group-hover:bg-[#234F35] group-hover:text-white transition-all shadow-2xs">
                                    <i class="fas fa-building"></i>
                                </div>
                                <span class="text-sm font-black text-slate-800 group-hover:text-[#234F35] transition-colors leading-snug">
                                    {{ $namaIndustri }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-mono text-sm font-black text-slate-700">
                            {{ $kuotaTotal }}
                        </td>
                        <td class="px-6 py-4 text-center font-mono text-sm font-black text-amber-600">
                            {{ $kuotaTerpakai }}
                        </td>
                        <td class="px-6 py-4 text-center font-mono text-sm font-black text-emerald-600">
                            {{ $sisa }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1.5">
                                <div class="flex justify-between text-[11px] font-black">
                                    <span class="text-slate-500 font-mono">{{ $persen }}%</span>
                                    <span class="text-slate-400 font-mono">{{ $kuotaTerpakai }}/{{ $kuotaTotal }}</span>
                                </div>
                                <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden border border-slate-200/60 flex shadow-inner">
                                    <div class="h-full transition-all duration-500 rounded-full {{ $persen >= 100 ? 'bg-rose-500' : ($persen >= 80 ? 'bg-amber-500' : 'bg-gradient-to-r from-[#234F35] to-[#89C74A]') }}" style="width: {{ $persen }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($sisa <= 0)
                                <span class="bg-rose-50 text-rose-700 border border-rose-200/80 px-3.5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-xs">
                                    <i class="fas fa-times-circle"></i> Penuh
                                </span>
                            @elseif($persen >= 80)
                                <span class="bg-amber-50 text-amber-700 border border-amber-200/80 px-3.5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-xs">
                                    <i class="fas fa-exclamation-triangle"></i> Hampir Penuh
                                </span>
                            @else
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/80 px-3.5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-xs">
                                    <i class="fas fa-check-circle"></i> Tersedia
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400 bg-slate-50/30">
                            <p class="text-xs font-semibold">Belum ada data mitra industri yang terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse

                    <tr id="noKuotaResult" class="hidden">
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400 bg-slate-50/50 italic text-xs font-medium">
                            <i class="fas fa-search-minus mr-2 text-slate-400"></i>
                            Mitra Industri yang dicari tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- TABEL VERIFIKASI PENDAFTARAN (PUTIH TERANG & CLEAN DENGAN GARIS RAPI) --}}
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-slate-200/80 transition-all duration-300 hover:shadow-md">
        <div class="px-6 sm:px-8 py-5 border-b border-slate-200/80 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 bg-gradient-to-r from-slate-50/90 via-white to-slate-50/90">
            <div class="flex items-center">
                <div class="bg-emerald-50 p-3 rounded-2xl mr-4 border border-emerald-100 text-[#234F35] shadow-2xs group-hover:scale-105 transition-transform shrink-0">
                    <i class="fas fa-user-plus text-lg animate-pulse"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base sm:text-lg tracking-tight">Verifikasi Pendaftaran Siswa</h3>
                    <p class="text-xs sm:text-sm text-slate-400 mt-0.5 font-medium">Daftar siswa baru yang menunggu persetujuan verifikasi akun</p>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full lg:w-auto justify-between lg:justify-end">
                {{-- Live Search Input untuk Tabel Verifikasi --}}
                @if($siswaPending->count() > 0)
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="verifySearchInput" placeholder="Cari nama, NIS, jurusan..." 
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200/80 rounded-xl text-xs font-semibold text-slate-700 focus:ring-2 focus:ring-emerald-500/20 focus:border-[#234F35] focus:bg-white outline-none transition-all shadow-2xs">
                </div>
                @endif

                @if($siswaPending->count() > 0)
                    <span class="bg-gradient-to-r from-[#234F35] to-emerald-800 text-white py-1.5 px-4 rounded-xl text-[11px] font-black uppercase tracking-wider shadow-sm shadow-emerald-900/20 animate-pulse whitespace-nowrap border border-emerald-900/10 shrink-0">
                        {{ $siswaPending->count() }} Perlu Tindakan
                    </span>
                @else
                    <span class="bg-emerald-50 text-emerald-700 py-1.5 px-4 rounded-xl text-[11px] font-black uppercase tracking-wider border border-emerald-200/80 shadow-2xs whitespace-nowrap shrink-0 flex items-center gap-1.5">
                        <i class="fas fa-check-circle text-emerald-500"></i> Semua Beres
                    </span>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto p-4 sm:p-6">
            <table class="w-full text-left border-collapse border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs">
                <thead class="bg-slate-100/80 text-slate-600 uppercase text-[10px] font-black tracking-widest border-b border-slate-200/80 divide-x divide-slate-200/80">
                    <tr>
                        <th class="px-6 sm:px-8 py-4">Nama Siswa</th>
                        <th class="px-6 py-4">NIS</th>
                        <th class="px-6 py-4">Jurusan</th>
                        <th class="px-6 py-4">Tanggal Daftar</th>
                        <th class="px-6 sm:px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="verifyTableBody" class="divide-y divide-slate-200/80 text-sm bg-white">
                    @forelse($siswaPending as $siswa)
                    <tr class="pending-row hover:bg-slate-50/90 transition-all duration-200 group divide-x divide-slate-200/80">
                        <td class="px-6 sm:px-8 py-4 font-extrabold text-slate-800 tracking-wide search-target">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#234F35] to-emerald-800 text-white font-black text-xs flex items-center justify-center shadow-md shadow-emerald-900/10 group-hover:scale-105 transition-transform shrink-0">
                                    {{ substr($siswa->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-bold text-slate-800 group-hover:text-[#234F35] transition-colors">{{ $siswa->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-mono text-xs font-semibold tracking-wider search-target">
                            <span class="bg-slate-100/80 group-hover:bg-white px-3 py-1.5 rounded-lg border border-slate-200/80 text-slate-700 shadow-2xs inline-block">{{ $siswa->nomor_identitas }}</span>
                        </td>
                        <td class="px-6 py-4 search-target">
                            <span class="bg-emerald-50 text-[#234F35] group-hover:bg-emerald-100 px-3 py-1 rounded-full text-[10px] font-black border border-emerald-200/70 uppercase tracking-wider shadow-2xs transition-colors inline-block">
                                {{ $siswa->jurusan->kode_jurusan ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs font-semibold">
                            <div class="flex items-center bg-slate-50/80 group-hover:bg-white w-max px-3 py-1.5 rounded-xl border border-slate-200/80 transition-colors shadow-2xs">
                                <i class="far fa-calendar-alt mr-2 text-[#234F35] text-xs"></i>
                                {{ $siswa->created_at->locale('id')->isoFormat('D MMMM Y') }}
                            </div>
                        </td>
                        <td class="px-6 sm:px-8 py-4">
                            <div class="flex justify-center items-center gap-2">
                                {{-- Form Terima dengan Konfirmasi Kustom --}}
                                <form action="{{ route('admin.siswa.verify', $siswa->id) }}" method="POST" class="form-verify-approve">
                                    @csrf
                                    <button type="button" data-name="{{ $siswa->name }}" class="btn-approve bg-emerald-600 text-white px-3.5 py-1.5 rounded-xl text-xs font-black hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 hover:shadow-md hover:shadow-emerald-600/30 transition-all flex items-center transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                                        <i class="fas fa-check mr-1.5 text-[10px]"></i> Terima
                                    </button>
                                </form>

                                {{-- Form Tolak dengan Konfirmasi Kustom --}}
                                <form action="{{ route('admin.siswa.reject', $siswa->id) }}" method="POST" class="form-verify-reject">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" data-name="{{ $siswa->name }}" class="btn-reject bg-rose-500 text-white px-3.5 py-1.5 rounded-xl text-xs font-black hover:bg-rose-600 shadow-sm shadow-rose-500/20 hover:shadow-md hover:shadow-rose-500/30 transition-all flex items-center transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                                        <i class="fas fa-trash mr-1.5 text-[10px]"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-slate-400 bg-slate-50/30">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="h-16 w-16 bg-white text-slate-300 rounded-3xl flex items-center justify-center mb-4 border border-dashed border-slate-200 shadow-sm group hover:rotate-12 transition-transform duration-300">
                                    <i class="fas fa-clipboard-check text-2xl text-slate-300"></i>
                                </div>
                                <p class="text-sm font-black text-slate-700 tracking-tight">Tidak ada pendaftaran baru</p>
                                <p class="text-xs text-slate-400 mt-1 font-medium leading-relaxed">Semua akun pendaftaran siswa saat ini telah selesai diverifikasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Baris Pesan Live Search Tidak Ditemukan --}}
                    <tr id="noVerifyResult" class="hidden">
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 bg-slate-50/50 italic text-xs font-medium">
                            <i class="fas fa-search-minus mr-2 text-slate-400"></i>
                            Siswa yang dicari tidak ditemukan dalam daftar verifikasi pending.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- MODAL POP-UP KONFIRMASI ELEGAN & MODERN --}}
<div id="actionModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    {{-- Backdrop dengan Efek Blur Ringan & Fade --}}
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-md transition-opacity duration-300 ease-out opacity-0" id="modalBackdrop"></div>
    
    {{-- Card Content (Elegan Glassmorphism) --}}
    <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl max-w-md w-full mx-4 p-7 sm:p-8 transform transition-all duration-300 ease-out border border-white/80 overflow-hidden scale-90 opacity-0" id="modalCard">
        
        {{-- Glow Accent Belakang Modal --}}
        <div id="modalGlow" class="absolute -top-20 -right-20 w-44 h-44 rounded-full blur-3xl opacity-30 pointer-events-none transition-colors duration-500"></div>

        {{-- Tombol Close di Pojok Atas --}}
        <button type="button" onclick="closeModal()" class="absolute top-5 right-5 w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:text-slate-600 hover:bg-slate-200 flex items-center justify-center transition-all duration-200 text-xs font-bold cursor-pointer">
            <i class="fas fa-times"></i>
        </button>

        <div class="flex flex-col items-center text-center relative z-10">
            {{-- Dynamic Icon Container dengan Pulse Glow --}}
            <div id="modalIconBg" class="relative h-20 w-20 rounded-3xl flex items-center justify-center text-3xl mb-5 shadow-lg transition-all duration-300">
                <i id="modalIcon" class="fas"></i>
            </div>
            
            <h3 id="modalTitle" class="text-xl sm:text-2xl font-black text-slate-900 mb-2 tracking-tight">Konfirmasi Action</h3>
            <p id="modalDescription" class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-7 font-medium px-2">
                Apakah Anda yakin ingin melakukan tindakan ini pada <span id="modalTargetName" class="font-extrabold text-slate-800"></span>?
            </p>
            
            {{-- Action Buttons --}}
            <div class="flex w-full gap-3">
                <button type="button" id="btnCancelModal" class="flex-1 bg-slate-100 hover:bg-slate-200 active:bg-slate-300 text-slate-600 font-extrabold py-3.5 px-4 rounded-2xl transition-all duration-200 text-xs outline-none cursor-pointer tracking-wide">
                    Batal
                </button>
                <button type="button" id="btnConfirmModal" class="flex-1 text-white font-extrabold py-3.5 px-4 rounded-2xl shadow-lg transition-all duration-200 text-xs outline-none cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- LIBRARY CHART.JS VIA CDN UNTUK DONUT CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- SCRIPT JAVASCRIPT LENGKAP & INTERAKTIF --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // 0. INISIALISASI DONUT CHART (STATISTIK DATA)
        const donutCtx = document.getElementById('statistikDonutChart');
        if (donutCtx) {
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Total Siswa Aktif', 'Guru Pembimbing', 'Mitra Industri', 'Mentor Industri', 'Sedang Magang'],
                    datasets: [{
                        data: [
                            {{ $countSiswaAktif }}, 
                            {{ $totalGuru ?? 0 }}, 
                            {{ $totalIndustri ?? 0 }}, 
                            {{ $totalMentor ?? 0 }}, 
                            {{ $siswaMagang ?? 0 }}
                        ],
                        backgroundColor: [
                            '#234F35', // Green Dark
                            '#10b981', // Emerald-500
                            '#14b8a6', // Teal-500
                            '#89C74A', // Green Light
                            '#f59e0b'  // Amber-500
                        ],
                        borderWidth: 4,
                        borderColor: '#ffffff',
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 12,
                            titleFont: { size: 12, weight: 'bold' },
                            bodyFont: { size: 12 },
                            cornerRadius: 12,
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    return ` ${label}: ${value}`;
                                }
                            }
                        }
                    },
                    cutout: '72%'
                }
            });
        }

        // 1. JAM & TANGGAL DIGITAL REAL-TIME
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

        // 2. COUNTER ANIMATION UNTUK KARTU STATISTIK
        const counters = document.querySelectorAll('.counter-val');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            if (target === 0) {
                counter.innerText = '0';
                return;
            }
            
            let count = 0;
            const speed = 200; // Semakin kecil semakin cepat
            const inc = target / (speed / 10);

            const updateCount = () => {
                count += inc;
                if (count < target) {
                    counter.innerText = Math.ceil(count);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });

        // 3. LIVE SEARCH TABEL VERIFIKASI
        const searchInput = document.getElementById('verifySearchInput');
        const verifyTableBody = document.getElementById('verifyTableBody');
        
        if (searchInput && verifyTableBody) {
            const rows = verifyTableBody.getElementsByClassName('pending-row');
            const noResultRow = document.getElementById('noVerifyResult');

            searchInput.addEventListener('input', function () {
                const query = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const targets = row.getElementsByClassName('search-target');
                    let textContent = '';
                    
                    for (let j = 0; j < targets.length; j++) {
                        textContent += ' ' + targets[j].textContent.toLowerCase();
                    }

                    if (textContent.indexOf(query) > -1) {
                        row.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        row.classList.add('hidden');
                    }
                }

                if (noResultRow) {
                    if (visibleCount === 0 && query !== '') {
                        noResultRow.classList.remove('hidden');
                    } else {
                        noResultRow.classList.add('hidden');
                    }
                }
            });
        }

        // 3.1 LIVE SEARCH TABEL KUOTA INDUSTRI
        const kuotaSearchInput = document.getElementById('kuotaSearchInput');
        const kuotaTableBody = document.getElementById('kuotaTableBody');

        function filterKuotaTable() {
            if (!kuotaTableBody) return;

            const query = kuotaSearchInput ? kuotaSearchInput.value.toLowerCase().trim() : '';
            const kuotaRows = kuotaTableBody.getElementsByClassName('kuota-row');
            const noKuotaResult = document.getElementById('noKuotaResult');
            let visibleCount = 0;

            for (let i = 0; i < kuotaRows.length; i++) {
                const row = kuotaRows[i];
                const targets = row.getElementsByClassName('search-target-kuota');
                let textContent = '';

                for (let j = 0; j < targets.length; j++) {
                    textContent += ' ' + targets[j].textContent.toLowerCase();
                }

                if (textContent.indexOf(query) > -1) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            }

            if (noKuotaResult) {
                if (visibleCount === 0) {
                    noKuotaResult.classList.remove('hidden');
                } else {
                    noKuotaResult.classList.add('hidden');
                }
            }
        }

        if (kuotaSearchInput) {
            kuotaSearchInput.addEventListener('input', filterKuotaTable);
        }

        // 4. CUSTOM MODAL CONFIRMATION ELEGAN (TERIMA / TOLAK SISWA)
        const actionModal = document.getElementById('actionModal');
        const modalCard = document.getElementById('modalCard');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalIconBg = document.getElementById('modalIconBg');
        const modalIcon = document.getElementById('modalIcon');
        const modalGlow = document.getElementById('modalGlow');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        const modalTargetName = document.getElementById('modalTargetName');
        const btnCancelModal = document.getElementById('btnCancelModal');
        const btnConfirmModal = document.getElementById('btnConfirmModal');

        let targetFormToSubmit = null;

        function openModal(type, targetName, form) {
            targetFormToSubmit = form;
            modalTargetName.textContent = targetName;

            if (type === 'approve') {
                modalGlow.className = 'absolute -top-20 -right-20 w-44 h-44 rounded-full blur-3xl opacity-30 pointer-events-none bg-emerald-500 transition-colors duration-500';
                modalIconBg.className = 'relative h-20 w-20 rounded-3xl flex items-center justify-center text-3xl mb-5 bg-gradient-to-tr from-[#234F35] to-emerald-600 text-white shadow-xl shadow-emerald-900/30 transform hover:scale-105 transition-all';
                modalIcon.className = 'fas fa-user-check';
                modalTitle.textContent = 'Terima Pendaftaran';
                modalDescription.innerHTML = `Apakah Anda yakin ingin menyetujui pendaftaran siswa <span class="font-extrabold text-[#234F35] bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100">${targetName}</span>? Akun siswa akan diaktifkan secara otomatis.`;
                btnConfirmModal.className = 'flex-1 bg-gradient-to-r from-[#234F35] to-emerald-700 hover:from-emerald-800 hover:to-slate-900 text-white font-extrabold py-3.5 px-4 rounded-2xl shadow-lg shadow-emerald-900/25 transition-all duration-200 text-xs outline-none cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide';
            } else {
                modalGlow.className = 'absolute -top-20 -right-20 w-44 h-44 rounded-full blur-3xl opacity-30 pointer-events-none bg-rose-500 transition-colors duration-500';
                modalIconBg.className = 'relative h-20 w-20 rounded-3xl flex items-center justify-center text-3xl mb-5 bg-gradient-to-tr from-rose-500 to-red-500 text-white shadow-xl shadow-rose-500/30 transform hover:scale-105 transition-all';
                modalIcon.className = 'fas fa-user-times';
                modalTitle.textContent = 'Tolak Pendaftaran';
                modalDescription.innerHTML = `Apakah Anda yakin ingin menolak dan menghapus pendaftaran siswa <span class="font-extrabold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-100">${targetName}</span>? Tindakan ini permanen.`;
                btnConfirmModal.className = 'flex-1 bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-extrabold py-3.5 px-4 rounded-2xl shadow-lg shadow-rose-500/25 transition-all duration-200 text-xs outline-none cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0 tracking-wide';
            }

            actionModal.classList.remove('hidden');
            setTimeout(() => {
                modalBackdrop.classList.remove('opacity-0');
                modalBackdrop.classList.add('opacity-100');

                modalCard.classList.remove('scale-90', 'opacity-0');
                modalCard.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        window.closeModal = function() {
            modalBackdrop.classList.remove('opacity-100');
            modalBackdrop.classList.add('opacity-0');

            modalCard.classList.remove('scale-100', 'opacity-100');
            modalCard.classList.add('scale-90', 'opacity-0');
            
            setTimeout(() => {
                actionModal.classList.add('hidden');
                targetFormToSubmit = null;
            }, 300);
        };

        // Event Listener Tombol Terima
        document.querySelectorAll('.btn-approve').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const form = this.closest('.form-verify-approve');
                openModal('approve', name, form);
            });
        });

        // Event Listener Tombol Tolak
        document.querySelectorAll('.btn-reject').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const form = this.closest('.form-verify-reject');
                openModal('reject', name, form);
            });
        });

        if (btnCancelModal) btnCancelModal.addEventListener('click', closeModal);
        if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);

        // 5. SUBMIT FORM DENGAN LOADING STATE
        if (btnConfirmModal) {
            btnConfirmModal.addEventListener('click', function () {
                if (targetFormToSubmit) {
                    this.disabled = true;
                    this.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...`;
                    this.classList.add('opacity-75', 'cursor-not-allowed');
                    
                    targetFormToSubmit.submit();
                }
            });
        }
    });
</script>
@endsection