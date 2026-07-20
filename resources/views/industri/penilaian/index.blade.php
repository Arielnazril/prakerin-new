@extends('layouts.industri_layout')

@section('page_title', 'Penilaian Kinerja')

@section('content')

<div x-data="{ activeTab: 'aktif' }" class="max-w-7xl mx-auto space-y-6">

    {{-- HEADER SECTION WITH MATCHING DARK CARD BACKGROUND --}}
    <div class="bg-slate-900 p-6 sm:p-7 rounded-3xl border border-slate-800 shadow-xl shadow-slate-900/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
        <div class="flex items-center gap-3.5">
            <div class="p-3 bg-slate-800 text-slate-100 rounded-2xl shadow-md border border-slate-700/60">
                <i class="fas fa-user-graduate text-2xl text-blue-400"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">Daftar Siswa Bimbingan</h2>
                <p class="text-xs sm:text-sm text-slate-400 font-medium mt-0.5">Kelola nilai siswa magang dan lihat riwayat alumni.</p>
            </div>
        </div>

        {{-- TAB SWITCHER BUTTONS --}}
        <div class="flex bg-slate-800/80 p-1.5 rounded-2xl border border-slate-700/80 w-full md:w-auto shadow-inner">
            <button @click="activeTab = 'aktif'"
                :class="{ 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-extrabold': activeTab === 'aktif', 'text-slate-400 hover:text-white hover:bg-slate-700/50 font-bold': activeTab !== 'aktif' }"
                class="flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 flex items-center justify-center gap-2">
                <i class="fas fa-user-clock text-xs"></i> 
                <span>Sedang Magang</span>
            </button>
            <button @click="activeTab = 'riwayat'"
                :class="{ 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 font-extrabold': activeTab === 'riwayat', 'text-slate-400 hover:text-white hover:bg-slate-700/50 font-bold': activeTab !== 'riwayat' }"
                class="flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 flex items-center justify-center gap-2 ml-1">
                <i class="fas fa-history text-xs"></i> 
                <span>Riwayat Alumni</span>
            </button>
        </div>
    </div>

    {{-- TAB CONTENT: SEDANG MAGANG --}}
    <div x-show="activeTab === 'aktif'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-200/80 transition-all duration-300">
            
            {{-- STATUS BANNER --}}
            <div class="px-7 py-4 border-b border-blue-100 bg-gradient-to-r from-blue-50/80 via-slate-50 to-white text-blue-900 text-xs font-black uppercase tracking-wider flex items-center">
                <span class="relative flex h-2.5 w-2.5 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                Status: Aktif Magang
            </div>

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[900px]">
                    <thead class="bg-slate-900 text-slate-300 uppercase text-[11px] font-black tracking-widest border-b border-slate-800">
                        <tr>
                            <th class="px-7 py-5">Nama Siswa</th>
                            <th class="px-7 py-5">Periode Magang</th>
                            <th class="px-7 py-5 text-center">Status Nilai</th>
                            <th class="px-7 py-5 text-center">Nilai Anda</th>
                            <th class="px-7 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm align-middle">
                        @forelse($placements as $placement)
                            @php
                                $nilai = \App\Models\Penilaian::where('placement_id', $placement->id)
                                    ->where('penilai_id', Auth::id())
                                    ->first();
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition duration-150 group">
                                {{-- NAMA SISWA --}}
                                <td class="px-7 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-3.5">
                                        <div class="h-10 w-10 shrink-0 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white font-black flex items-center justify-center text-xs shadow-md shadow-blue-500/20 uppercase border border-white/20 transform group-hover:scale-105 transition-transform">
                                            {{ substr($placement->siswa->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-900 block leading-tight text-base group-hover:text-blue-600 transition-colors">{{ $placement->siswa->name }}</span>
                                            <span class="text-xs text-slate-400 font-mono mt-1 block tracking-tight font-medium">{{ $placement->siswa->nomor_identitas }}</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- PERIODE --}}
                                <td class="px-7 py-5 text-slate-600 font-semibold whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2 text-xs bg-slate-50 border border-slate-200/80 px-3.5 py-2 rounded-xl font-mono text-slate-700 shadow-2xs">
                                        <i class="far fa-calendar-alt text-blue-500"></i>
                                        <span>{{ $placement->tanggal_mulai->format('d M y') }}</span>
                                        <span class="text-slate-300 font-bold mx-0.5">•</span>
                                        <span>{{ $placement->tanggal_selesai->format('d M y') }}</span>
                                    </div>
                                </td>

                                {{-- STATUS NILAI --}}
                                <td class="px-7 py-5 text-center whitespace-nowrap">
                                    @if($nilai)
                                        <span class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-xs font-extrabold border border-emerald-200/80 inline-flex items-center gap-2 shadow-2xs">
                                            <i class="fas fa-check-circle text-emerald-500 text-xs"></i> Sudah Dinilai
                                        </span>
                                    @else
                                        <span class="bg-rose-50 text-rose-700 px-4 py-2 rounded-xl text-xs font-extrabold border border-rose-200/80 inline-flex items-center gap-2 shadow-2xs">
                                            <span class="h-2 w-2 rounded-full bg-rose-500 animate-ping"></span> Belum Dinilai
                                        </span>
                                    @endif
                                </td>

                                {{-- NILAI ANDA --}}
                                <td class="px-7 py-5 text-center whitespace-nowrap">
                                    @if($nilai)
                                        <span class="inline-block bg-slate-900 text-white border border-slate-800 px-4 py-1.5 rounded-xl font-mono text-sm font-black shadow-md shadow-slate-900/10">
                                            {{ $nilai->nilai_akhir }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 font-mono font-bold text-base">-</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="px-7 py-5 text-center whitespace-nowrap">
                                    @if(!$nilai)
                                        <a href="{{ route('industri.penilaian.create', $placement->id) }}" class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-xs px-4 py-2.5 rounded-xl transition-all duration-200 active:scale-95 shadow-md shadow-blue-500/20 gap-2">
                                            <i class="fas fa-plus text-[10px]"></i> 
                                            <span>Input Nilai</span>
                                        </a>
                                    @else
                                        <a href="{{ route('industri.penilaian.edit', $nilai->id) }}" class="inline-flex items-center justify-center text-amber-700 hover:text-white font-extrabold text-xs border border-amber-300 hover:bg-amber-500 px-4 py-2.5 rounded-xl transition-all duration-200 active:scale-95 shadow-2xs gap-2">
                                            <i class="fas fa-edit text-[10px]"></i> 
                                            <span>Edit Nilai</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-16 text-center text-slate-400 font-medium bg-slate-50/50">
                                    <div class="flex flex-col items-center justify-center space-y-3 max-w-sm mx-auto">
                                        <div class="h-16 w-16 rounded-3xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-center text-slate-300">
                                            <i class="fas fa-users-slash text-2xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-extrabold text-slate-700">Tidak Ada Siswa Aktif</h4>
                                            <p class="text-xs text-slate-400 mt-1">Tidak ada siswa yang sedang menjalani masa magang saat ini.</p>
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

    {{-- TAB CONTENT: RIWAYAT ALUMNI --}}
    <div x-show="activeTab === 'riwayat'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-200/80 transition-all duration-300">
            
            {{-- ARCHIVE BANNER --}}
            <div class="px-7 py-4 border-b border-slate-200/80 bg-slate-50 text-slate-600 text-xs font-black uppercase tracking-wider flex items-center">
                <i class="fas fa-archive text-slate-400 mr-2.5 text-sm"></i> Arsip Alumni
            </div>

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead class="bg-slate-900 text-slate-300 uppercase text-[11px] font-black tracking-widest border-b border-slate-800">
                        <tr>
                            <th class="px-7 py-5">Nama Siswa</th>
                            <th class="px-7 py-5">Selesai Magang</th>
                            <th class="px-7 py-5 text-center">Nilai Akhir Anda</th>
                            <th class="px-7 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm align-middle">
                        @forelse($placementsHistory as $history)
                            @php
                                $nilaiFinal = \App\Models\Penilaian::where('placement_id', $history->id)
                                    ->where('penilai_id', Auth::id())
                                    ->first();
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition duration-150 group">
                                {{-- NAMA SISWA --}}
                                <td class="px-7 py-5 font-bold text-slate-800 whitespace-nowrap">
                                    <div class="flex items-center gap-3.5">
                                        <div class="h-10 w-10 shrink-0 rounded-2xl bg-slate-100 text-slate-500 font-black flex items-center justify-center text-xs border border-slate-200 uppercase shadow-2xs">
                                            {{ substr($history->siswa->name, 0, 1) }}
                                        </div>
                                        <span class="text-slate-900 font-bold text-base group-hover:text-blue-600 transition-colors">{{ $history->siswa->name }}</span>
                                    </div>
                                </td>

                                {{-- SELESAI MAGANG --}}
                                <td class="px-7 py-5 text-slate-500 font-medium whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2 text-xs bg-slate-50 border border-slate-200/80 px-3.5 py-2 rounded-xl font-mono text-slate-700 shadow-2xs">
                                        <i class="far fa-calendar-check text-emerald-500"></i>
                                        <span>{{ $history->tanggal_selesai->format('d F Y') }}</span>
                                    </div>
                                </td>

                                {{-- NILAI AKHIR --}}
                                <td class="px-7 py-5 text-center whitespace-nowrap">
                                    <span class="inline-block bg-blue-50 border border-blue-200/80 text-blue-700 px-4 py-1.5 rounded-xl font-mono text-sm font-black shadow-2xs">
                                        {{ $nilaiFinal ? $nilaiFinal->nilai_akhir : '0' }}
                                    </span>
                                </td>

                                {{-- AKSI --}}
                                <td class="px-7 py-5 text-center whitespace-nowrap">
                                    @if($nilaiFinal)
                                        <span class="inline-flex items-center justify-center gap-2 bg-slate-100 px-4 py-2 rounded-xl text-xs font-extrabold border border-slate-200/80 text-slate-400 select-none shadow-2xs">
                                            <i class="fas fa-lock text-[10px]"></i> 
                                            <span>Terkunci</span>
                                        </span>
                                    @else
                                        <span class="text-xs text-rose-600 font-extrabold bg-rose-50 px-4 py-2 rounded-xl border border-rose-200/80 shadow-2xs inline-block">Data Kosong</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-16 text-center text-slate-400 font-medium bg-slate-50/50">
                                    <div class="flex flex-col items-center justify-center space-y-3 max-w-sm mx-auto">
                                        <div class="h-16 w-16 rounded-3xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-center text-slate-300">
                                            <i class="fas fa-folder-open text-2xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-extrabold text-slate-700">Belum Ada Riwayat</h4>
                                            <p class="text-xs text-slate-400 mt-1">Arsip riwayat alumni magang masih kosong saat ini.</p>
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

</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script src="//unpkg.com/alpinejs" defer></script>

@endsection