@extends('layouts.industri_layout')

@section('page_title', 'Validasi Logbook')

@section('content')

<div class="space-y-6">
    {{-- HEADER SECTION --}}
{{-- HEADER SECTION WITH MATCHING DARK BACKGROUND --}}
<div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 shadow-xl shadow-slate-900/10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-slate-800 text-slate-100 rounded-2xl shadow-md border border-slate-700/60">
                <i class="fas fa-clipboard-check text-xl text-blue-400"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">Daftar Logbook Siswa</h2>
                <p class="text-xs sm:text-sm text-slate-400 font-medium mt-0.5">Periksa dan validasi kegiatan harian siswa bimbingan Anda.</p>
            </div>
        </div>
    </div>

    {{-- QUICK SUMMARY BADGES --}}
    @php
        $totalCount = count($logbooks);
        $pendingCount = $logbooks->where('status', 'pending')->count();
        $approvedCount = $logbooks->where('status', 'disetujui')->count();
    @endphp
    <div class="flex items-center gap-2.5 self-start sm:self-auto flex-wrap">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-amber-500/10 text-amber-400 text-xs font-bold border border-amber-500/30 shadow-2xs">
            <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
            <span>{{ $pendingCount }} Menunggu</span>
        </span>
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/30 shadow-2xs">
            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
            <span>{{ $approvedCount }} Disetujui</span>
        </span>
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-800 text-slate-200 text-xs font-bold border border-slate-700 shadow-2xs">
            <span class="text-slate-400">Total:</span> {{ $totalCount }}
        </span>
    </div>
</div>

    {{-- MAIN TABLE CARD --}}
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-200/80 transition-all">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full min-w-[1000px] text-left border-collapse">
                <thead class="bg-slate-900">
                    <tr class="text-slate-200 uppercase text-[10px] font-black tracking-widest border-b border-slate-800">
                        <th class="px-6 py-5 min-w-[170px]">Tanggal & Waktu</th>
                        <th class="px-6 py-5 min-w-[240px]">Nama Siswa</th>
                        <th class="px-6 py-5 min-w-[300px]">Kegiatan</th>
                        <th class="px-6 py-5 min-w-[160px]">Foto Dokumen</th>
                        <th class="px-6 py-5 min-w-[160px] text-center">Status</th>
                        <th class="px-6 py-5 min-w-[130px] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm align-middle">
                    @forelse($logbooks as $logbook)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150 group {{ $logbook->status == 'pending' ? 'bg-amber-50/30' : '' }}">
                        {{-- TANGGAL --}}
                        <td class="px-6 py-6 text-slate-700 whitespace-nowrap font-medium">
                            <div class="font-bold text-slate-800 flex items-center gap-1.5">
                                <i class="far fa-calendar-alt text-xs text-blue-500"></i>
                                {{ $logbook->tanggal->format('d M Y') }}
                            </div>
                            <div class="text-[11px] text-slate-400 font-mono mt-1.5 inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-slate-100 border border-slate-200/60">
                                <i class="far fa-clock text-[10px] text-slate-400"></i>
                                {{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}
                            </div>
                        </td>

                        {{-- SISWA --}}
                        <td class="px-6 py-6 font-bold text-slate-800 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 shrink-0 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white font-black flex items-center justify-center text-xs shadow-md shadow-blue-500/20 uppercase border border-white/20 transform group-hover:scale-105 transition-transform">
                                    {{ substr($logbook->siswa->name, 0, 1) }}
                                </div>
                                <div>
                                    <span class="block text-slate-800 group-hover:text-blue-600 transition-colors">{{ $logbook->siswa->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-semibold tracking-wide uppercase mt-0.5 block">Siswa Magang</span>
                                </div>
                            </div>
                        </td>

                        {{-- KEGIATAN --}}
                        <td class="px-6 py-6 text-slate-600 font-medium">
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/50 group-hover:bg-white group-hover:border-slate-300/80 transition-colors shadow-2xs">
                                <span class="text-xs text-slate-700 leading-relaxed block truncate" title="{{ $logbook->kegiatan }}">
                                    {{ Str::limit($logbook->kegiatan, 50) }}
                                </span>
                            </div>
                        </td>

                        {{-- FOTO --}}
                        <td class="px-6 py-6 whitespace-nowrap">
                            @if($logbook->foto)
                                <a href="{{ asset('storage/' . $logbook->foto) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs font-bold inline-flex items-center gap-1.5 bg-blue-50/80 hover:bg-blue-100/80 px-3.5 py-2 rounded-xl border border-blue-200/80 transition-all shadow-2xs hover:shadow-xs group/img">
                                    <i class="fas fa-image text-blue-500 group-hover/img:scale-110 transition-transform"></i> 
                                    <span>Lihat Foto</span>
                                </a>
                            @else
                                <span class="text-slate-300 text-xs font-bold px-3 py-1 rounded-lg bg-slate-50 border border-slate-100 inline-block">-</span>
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-6 text-center whitespace-nowrap">
                            @if($logbook->status == 'pending')
                                <span class="bg-amber-50 text-amber-700 px-3.5 py-2 rounded-xl text-xs font-extrabold border border-amber-300/70 inline-flex items-center gap-1.5 shadow-2xs">
                                    <span class="h-2 w-2 rounded-full bg-amber-500 animate-ping"></span>
                                    <span>Butuh Validasi</span>
                                </span>
                            @elseif($logbook->status == 'disetujui')
                                <span class="bg-emerald-50 text-emerald-700 px-3.5 py-2 rounded-xl text-xs font-extrabold border border-emerald-300/70 inline-flex items-center gap-1.5 shadow-2xs">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    <span>Disetujui</span>
                                </span>
                            @else
                                <span class="bg-rose-50 text-rose-700 px-3.5 py-2 rounded-xl text-xs font-extrabold border border-rose-300/70 inline-flex items-center gap-1.5 shadow-2xs">
                                    <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                                    <span>Ditolak</span>
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-6 text-center whitespace-nowrap">
                            <a href="{{ route('industri.validasi.show', $logbook->id) }}" class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:from-blue-700 hover:to-indigo-700 px-4 py-2 rounded-xl text-xs font-extrabold shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all active:scale-95 group/btn">
                                <i class="fas fa-search mr-1.5 text-[10px] group-hover/btn:scale-110 transition-transform"></i> 
                                <span>Periksa</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-slate-400 font-medium bg-slate-50/50">
                            <div class="flex flex-col items-center justify-center gap-3 max-w-sm mx-auto">
                                <div class="h-16 w-16 rounded-3xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-center text-slate-300">
                                    <i class="fas fa-clipboard-check text-3xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-slate-700">Belum Ada Logbook</h4>
                                    <p class="text-xs text-slate-400 mt-1">Tidak ada data logbook dari siswa bimbingan Anda yang tersedia saat ini.</p>
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

@endsection