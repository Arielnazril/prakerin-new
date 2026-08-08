@extends('layouts.guru_layout')

@section('page_title', 'Integrasi Nilai')

@section('content')

{{-- AlpineJS untuk Tabs --}}
<div x-data="{ activeTab: 'aktif' }" class="space-y-6 antialiased">

    {{-- HEADER CARD & TAB TOGGLE --}}
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm gap-4 transition-all duration-300 hover:shadow-md">
        <div class="space-y-1">
            <h2 class="text-2xl font-black text-slate-800 tracking-tight flex items-center gap-2.5">
                <span class="p-2.5 bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-xl shadow-md shadow-emerald-500/20">
                    <i class="fas fa-star-half-alt text-lg"></i>
                </span>
                Rekapitulasi Nilai Bimbingan
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 font-medium pl-1">Pantau nilai dari Industri dan input nilai Sekolah secara terintegrasi.</p>
        </div>

        <div class="flex bg-slate-100/80 p-1.5 rounded-2xl border border-slate-200/60 w-full lg:w-auto shadow-inner shrink-0">
            <button @click="activeTab = 'aktif'"
                :class="{ 'bg-white text-emerald-600 shadow-sm border border-slate-200/60 font-black': activeTab === 'aktif', 'text-slate-500 hover:text-slate-800 font-bold': activeTab !== 'aktif' }"
                class="flex-1 lg:flex-none px-5 py-2.5 rounded-xl text-xs uppercase tracking-wider transition-all duration-200 flex items-center justify-center cursor-pointer">
                <i class="fas fa-chalkboard-teacher mr-2 text-xs"></i> Sedang Magang
            </button>
            <button @click="activeTab = 'riwayat'"
                :class="{ 'bg-white text-emerald-600 shadow-sm border border-slate-200/60 font-black': activeTab === 'riwayat', 'text-slate-500 hover:text-slate-800 font-bold': activeTab !== 'riwayat' }"
                class="flex-1 lg:flex-none px-5 py-2.5 rounded-xl text-xs uppercase tracking-wider transition-all duration-200 flex items-center justify-center ml-1 cursor-pointer">
                <i class="fas fa-history mr-2 text-xs"></i> Riwayat Penilaian
            </button>
        </div>
    </div>

    {{-- TAB 1: SEDANG MAGANG --}}
    <div x-show="activeTab === 'aktif'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-200/80 transition-all duration-300 hover:shadow-md">
        
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 text-slate-700 text-xs font-black uppercase tracking-widest flex items-center justify-between">
            <div class="flex items-center">
                <span class="relative flex h-2.5 w-2.5 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                Status: Aktif Membimbing
            </div>
            <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full font-extrabold normal-case text-[11px] border border-emerald-200/60 shadow-2xs">
                Total: {{ count($placements) }} Siswa
            </span>
        </div>

        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/80 text-slate-400 uppercase text-[10px] font-black tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Instansi</th>
                        <th class="px-6 py-4">Nilai Industri (50%)</th>
                        <th class="px-6 py-4">Nilai Sekolah (50%)</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($placements as $placement)
                    @php
                        // 1. Ambil nilai akhir yang diinput oleh Industri / Mentor (Bukan Guru yang sedang login)
                        $nilaiIndustri = \DB::table('penilaians')
                            ->where('placement_id', $placement->id)
                            ->where('penilai_id', '!=', Auth::id())
                            ->value('nilai_akhir');

                        // 2. Ambil nilai akhir yang diinput oleh Guru yang sedang login
                        $nilaiSekolah = \DB::table('penilaians')
                            ->where('placement_id', $placement->id)
                            ->where('penilai_id', Auth::id())
                            ->value('nilai_akhir');
                    @endphp
                    <tr class="hover:bg-slate-50/80 transition duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center font-black text-white text-xs shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform duration-200 select-none">
                                    {{ strtoupper(substr($placement->siswa->name, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="block font-bold text-slate-800 group-hover:text-emerald-600 transition-colors duration-150 tracking-tight">{{ $placement->siswa->name }}</span>
                                    <span class="text-xs font-mono font-medium text-slate-400 tracking-wider block mt-0.5">{{ $placement->siswa->nomor_identitas }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-xs font-semibold text-slate-600 tracking-wide">
                            <div class="bg-slate-100/70 group-hover:bg-white w-max px-3 py-1.5 rounded-xl border border-slate-200/60 max-w-[220px] truncate transition-all duration-200">
                                <i class="fas fa-building text-slate-400 group-hover:text-emerald-500 mr-2 text-[10px]"></i>{{ $placement->instansi->nama_perusahaan }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(!is_null($nilaiIndustri))
                                <div class="flex items-center bg-purple-50 border border-purple-200/60 w-max px-3.5 py-1.5 rounded-xl shadow-2xs">
                                    <span class="text-sm font-black text-purple-700 font-mono">{{ $nilaiIndustri }}</span>
                                    <i class="fas fa-check-circle text-purple-500 ml-2 text-xs" title="Sudah dinilai Mentor"></i>
                                </div>
                            @else
                                <span class="bg-amber-50 text-amber-700 border border-amber-200/60 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-2xs">
                                    <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span> Menunggu Mentor
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(!is_null($nilaiSekolah))
                                <div class="flex items-center bg-emerald-50 border border-emerald-200/60 w-max px-3.5 py-1.5 rounded-xl shadow-2xs">
                                    <span class="text-sm font-black text-emerald-700 font-mono">{{ $nilaiSekolah }}</span>
                                </div>
                            @else
                                <span class="text-xs text-slate-400 font-semibold italic bg-slate-50 border border-slate-200/60 px-3 py-1.5 rounded-xl inline-flex items-center gap-1.5">
                                    <i class="fas fa-pen text-[9px] text-slate-400"></i>Belum Input
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($placement->is_completed)
                                <span class="bg-slate-100 text-slate-500 border border-slate-200/80 px-4 py-2 rounded-xl text-xs font-black tracking-wider inline-flex items-center gap-2 shadow-2xs select-none uppercase text-[10px]">
                                    <i class="fas fa-lock text-[10px] text-slate-400"></i> Final
                                </span>
                            @else
                                <a href="{{ route('guru.penilaian.create', $placement->id) }}" class="inline-flex items-center justify-center bg-white text-emerald-600 border border-emerald-200 hover:bg-emerald-600 hover:text-white px-4 py-2 rounded-xl text-xs font-extrabold tracking-wide shadow-2xs hover:shadow-md hover:shadow-emerald-600/10 transition-all duration-200 transform hover:-translate-y-0.5 cursor-pointer">
                                    <i class="{{ !is_null($nilaiSekolah) ? 'fas fa-edit' : 'fas fa-plus-circle' }} mr-1.5 text-[11px]"></i>
                                    {{ !is_null($nilaiSekolah) ? 'Edit Nilai' : 'Input Nilai' }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-slate-400 bg-slate-50/30">
                            <div class="flex flex-col items-center justify-center gap-3 max-w-sm mx-auto">
                                <div class="h-16 w-16 bg-white text-slate-300 rounded-2xl flex items-center justify-center border border-dashed border-slate-200 shadow-sm">
                                    <i class="fas fa-user-friends text-2xl text-slate-300"></i>
                                </div>
                                <div class="space-y-1">
                                    <span class="block text-sm font-bold text-slate-700 tracking-tight">Tidak ada siswa aktif</span>
                                    <span class="block text-xs text-slate-400 font-medium leading-relaxed">Saat ini tidak ada data siswa bimbingan magang Anda yang aktif dalam sistem.</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- TAB 2: RIWAYAT PENILAIAN --}}
    <div x-show="activeTab === 'riwayat'" 
         style="display: none;" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-200/80 transition-all duration-300 hover:shadow-md">
        
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 text-slate-700 text-xs font-black uppercase tracking-widest flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-archive text-slate-400 mr-2.5 text-sm p-1.5 bg-white rounded-lg border border-slate-200/60 shadow-2xs"></i> 
                Arsip Alumni Bimbingan
            </div>
            <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full font-bold normal-case text-[11px] border border-slate-200/60">
                Total Arsip: {{ count($placementsHistory) }} Alumni
            </span>
        </div>

        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/80 text-slate-400 uppercase text-[10px] font-black tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Instansi</th>
                        <th class="px-6 py-4">Nilai Industri</th>
                        <th class="px-6 py-4">Nilai Sekolah</th>
                        <th class="px-6 py-4">Nilai Akhir (NA)</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($placementsHistory as $history)
                    @php
                        // 1. Nilai Industri pada Riwayat
                        $nilaiIndustriH = \DB::table('penilaians')
                            ->where('placement_id', $history->id)
                            ->where('penilai_id', '!=', Auth::id())
                            ->value('nilai_akhir');

                        // 2. Nilai Sekolah pada Riwayat
                        $nilaiSekolahH = \DB::table('penilaians')
                            ->where('placement_id', $history->id)
                            ->where('penilai_id', Auth::id())
                            ->value('nilai_akhir');
                    @endphp
                    <tr class="hover:bg-slate-50/80 transition duration-150 group">
                        <td class="px-6 py-4 font-bold text-slate-700 whitespace-nowrap tracking-tight group-hover:text-emerald-600 transition-colors duration-150">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 bg-slate-100 rounded-xl flex items-center justify-center font-black text-slate-500 text-xs shadow-2xs select-none">
                                    {{ strtoupper(substr($history->siswa->name, 0, 2)) }}
                                </div>
                                <span>{{ $history->siswa->name }}</span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 text-xs font-semibold text-slate-500 tracking-wide">
                            <div class="bg-slate-100/70 w-max px-3 py-1 rounded-xl border border-slate-200/60 max-w-[220px] truncate">
                                {{ $history->instansi->nama_perusahaan }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap font-mono font-black text-purple-600">
                            <span class="bg-purple-50/80 border border-purple-100 px-2.5 py-1 rounded-lg">
                                {{ !is_null($nilaiIndustriH) ? $nilaiIndustriH : '-' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap font-mono font-black text-emerald-600">
                            <span class="bg-emerald-50/80 border border-emerald-100 px-2.5 py-1 rounded-lg">
                                {{ !is_null($nilaiSekolahH) ? $nilaiSekolahH : '-' }}
                            </span>
                        </td>

                        {{-- Nilai Akhir Total (Ambil dari DB atau Hitung Manual 50:50) --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="bg-emerald-50 border border-emerald-200/60 w-max px-3.5 py-1.5 rounded-xl shadow-2xs group-hover:scale-105 transition-transform duration-200">
                                <span class="text-sm font-black text-emerald-700 font-mono">
                                    @if(isset($history->nilai_akhir_total) && !is_null($history->nilai_akhir_total))
                                        {{ $history->nilai_akhir_total }}
                                    @elseif(!is_null($nilaiIndustriH) && !is_null($nilaiSekolahH))
                                        {{ ($nilaiIndustriH * 0.5) + ($nilaiSekolahH * 0.5) }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1.5 shadow-2xs">
                                <i class="fas fa-check-double text-[9px] text-emerald-500"></i> Selesai
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-slate-400 bg-slate-50/30">
                            <div class="flex flex-col items-center justify-center gap-3 max-w-sm mx-auto">
                                <div class="h-16 w-16 bg-white text-slate-300 rounded-2xl flex items-center justify-center border border-dashed border-slate-200 shadow-sm">
                                    <i class="fas fa-history text-2xl text-slate-300"></i>
                                </div>
                                <div class="space-y-1">
                                    <span class="text-sm font-bold text-slate-700 tracking-tight">Belum ada riwayat</span>
                                    <span class="block text-xs text-slate-400 font-medium leading-relaxed">Belum ditemukan arsip riwayat penilaian bimbingan dari periode sebelumnya.</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection