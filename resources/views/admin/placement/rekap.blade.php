@extends('layouts.admin_layout')

@section('page_title', 'Finalisasi Nilai')

@section('content')

<div class="space-y-6 animate-fade-in">
    <!-- HEADER SECTION -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950 p-6 sm:p-8 rounded-3xl shadow-xl text-white relative overflow-hidden">
        <!-- Accent Glow Effects -->
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <span class="bg-emerald-500/20 text-emerald-300 text-xs font-bold px-3 py-1 rounded-full border border-emerald-400/20 uppercase tracking-widest">
                        Rekapitulasi PKL
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white">Finalisasi & Rekap Nilai</h2>
                <p class="text-xs sm:text-sm text-slate-300 font-medium mt-1 max-w-xl leading-relaxed">
                    Evaluasi gabungan nilai dari Mentor Industri dan Guru Pembimbing serta penerbitan nilai akhir siswa PKL.
                </p>
            </div>

            <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/10 text-xs text-slate-200 font-medium">
                <i class="fas fa-info-circle text-amber-400 text-sm flex-shrink-0"></i>
                <span>Klik <strong class="text-white">"Kunci Nilai"</strong> untuk menerbitkan nilai final.</span>
            </div>
        </div>
    </div>

    {{-- STATISTIK RINGKASAN DATA SISWA & NILAI --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- Total Siswa Keseluruhan --}}
        <div class="bg-white hover:bg-slate-50/80 transition-all p-5 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center justify-between group">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center font-bold text-lg shadow-inner group-hover:scale-105 transition-transform">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Siswa</p>
                    <p class="text-xs font-semibold text-slate-600">Keseluruhan</p>
                </div>
            </div>
            <span class="text-sm font-black bg-blue-50 text-blue-700 px-3.5 py-1.5 rounded-2xl border border-blue-200/60 shadow-2xs whitespace-nowrap">
                {{ $placements->count() }} Siswa
            </span>
        </div>

        {{-- Total Siswa Sudah Dinilai --}}
        <div class="bg-white hover:bg-slate-50/80 transition-all p-5 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center justify-between group">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center font-bold text-lg shadow-inner group-hover:scale-105 transition-transform">
                    <i class="fas fa-user-check"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Sudah Dinilai</p>
                    <p class="text-xs font-semibold text-slate-600">Mentor & Guru</p>
                </div>
            </div>
            <span class="text-sm font-black bg-emerald-50 text-emerald-700 px-3.5 py-1.5 rounded-2xl border border-emerald-200/60 shadow-2xs whitespace-nowrap">
                {{ $placements->filter(function($p) {
                    return $p->penilaians->where('penilai.role', 'industri')->first() && $p->penilaians->where('penilai.role', 'guru')->first();
                })->count() }} Siswa
            </span>
        </div>

        {{-- Total Siswa Belum Dinilai --}}
        <div class="bg-white hover:bg-slate-50/80 transition-all p-5 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center justify-between group sm:col-span-2 lg:col-span-1">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center font-bold text-lg shadow-inner group-hover:scale-105 transition-transform">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Belum Dinilai</p>
                    <p class="text-xs font-semibold text-slate-600">Proses Penilaian</p>
                </div>
            </div>
            <span class="text-sm font-black bg-amber-50 text-amber-700 px-3.5 py-1.5 rounded-2xl border border-amber-200/60 shadow-2xs whitespace-nowrap">
                {{ $placements->filter(function($p) {
                    return !$p->penilaians->where('penilai.role', 'industri')->first() || !$p->penilaians->where('penilai.role', 'guru')->first();
                })->count() }} Siswa
            </span>
        </div>
    </div>

    {{-- KOTAK PENCARIAN & TABLE CONTAINER --}}
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
        
        <!-- Header Tabel & Input Pencarian -->
        <div class="p-5 sm:p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-800">Master Data Nilai Akhir</h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Daftar rekap nilai evaluasi siswa dari pihak sekolah dan industri.</p>
            </div>

            <div class="relative w-full sm:w-80 flex-shrink-0 group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                    <i class="fas fa-search text-sm"></i>
                </span>
                <input type="text" id="nilaiSearchInput" placeholder="Cari nama siswa..." 
                    class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-2xl text-xs sm:text-sm font-semibold text-slate-700 placeholder-slate-400 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 shadow-2xs">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 uppercase text-[11px] font-black tracking-wider border-b border-slate-100">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Mentor (Industri)</th>
                        <th class="px-6 py-4">Guru (Sekolah)</th>
                        <th class="px-6 py-4">Total Akhir</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody id="nilaiTableBody" class="divide-y divide-slate-100 text-sm">
                    @php 
                        $hasData = false; 
                        $rowNumber = 1;
                    @endphp
                    @foreach($placements as $p)
                    @php $hasData = true; @endphp
                    {{-- Helper logic sederhana untuk view --}}
                    @php
                        $nMentor = $p->penilaians->where('penilai.role', 'industri')->first();
                        $nGuru   = $p->penilaians->where('penilai.role', 'guru')->first();
                    @endphp

                    <tr class="nilai-row hover:bg-slate-50/80 transition-colors duration-150">
                        <td class="px-6 py-5 text-slate-400 font-extrabold text-center text-xs index-cell">{{ $rowNumber++ }}</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3.5">
                                <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white flex items-center justify-center font-black text-sm flex-shrink-0 shadow-md shadow-indigo-500/20">
                                    {{ substr($p->siswa->name, 0, 1) }}
                                </div>
                                <div class="font-bold text-slate-800 name-cell leading-snug">{{ $p->siswa->name }}</div>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            @if($nMentor)
                                <span class="inline-flex items-center font-black text-emerald-700 bg-emerald-50 px-3 py-1 rounded-xl border border-emerald-200/60 text-xs shadow-2xs">
                                    <i class="fas fa-check-circle mr-1.5 text-emerald-500"></i> {{ $nMentor->nilai_akhir }}
                                </span>
                            @else
                                <span class="inline-flex items-center text-rose-500 bg-rose-50 px-3 py-1 rounded-xl border border-rose-100 text-xs font-semibold italic">
                                    <i class="fas fa-hourglass-half mr-1.5 text-xs text-rose-400"></i> Belum Input
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-5">
                            @if($nGuru)
                                <span class="inline-flex items-center font-black text-emerald-700 bg-emerald-50 px-3 py-1 rounded-xl border border-emerald-200/60 text-xs shadow-2xs">
                                    <i class="fas fa-check-circle mr-1.5 text-emerald-500"></i> {{ $nGuru->nilai_akhir }}
                                </span>
                            @else
                                <span class="inline-flex items-center text-rose-500 bg-rose-50 px-3 py-1 rounded-xl border border-rose-100 text-xs font-semibold italic">
                                    <i class="fas fa-hourglass-half mr-1.5 text-xs text-rose-400"></i> Belum Input
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-5">
                            <span class="font-mono font-black text-slate-800 text-sm bg-slate-100 px-3 py-1 rounded-xl border border-slate-200/80 shadow-2xs">
                                {{ $p->nilai_akhir_total ?? '-' }}
                            </span>
                        </td>

                        <td class="px-6 py-5 text-center">
                            @if($p->is_completed)
                                <span class="inline-flex items-center justify-center bg-slate-900 text-slate-100 px-4 py-2 rounded-xl text-xs font-extrabold border border-slate-800 shadow-md whitespace-nowrap">
                                    <i class="fas fa-lock mr-2 text-amber-400"></i> TERKUNCI
                                </span>
                            @else
                                @if($nMentor && $nGuru)
                                    <form action="{{ route('admin.rekap.finalize', $p->id) }}" method="POST" onsubmit="return confirm('Kunci nilai ini? Data tidak bisa diubah lagi.')">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-500 text-white font-black px-4 py-2 rounded-xl text-xs uppercase tracking-wider shadow-lg shadow-emerald-600/30 hover:shadow-xl hover:shadow-emerald-500/40 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 animate-pulse cursor-pointer">
                                            <i class="fas fa-key mr-2 text-xs"></i> KUNCI NILAI
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center text-slate-400 bg-slate-100 px-3 py-1.5 rounded-xl text-xs font-bold border border-slate-200/60 cursor-not-allowed">
                                        <i class="fas fa-clock mr-1.5 text-slate-400"></i> Menunggu Data
                                    </span>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @if(!$hasData)
                    <tr id="emptyPlaceholderRow">
                        <td colspan="6" class="px-6 py-16 text-center text-slate-400 bg-slate-50/50">
                            <div class="max-w-xs mx-auto flex flex-col items-center">
                                <div class="w-16 h-16 rounded-3xl bg-slate-100 border border-slate-200/80 flex items-center justify-center text-slate-400 text-2xl mb-4 shadow-inner">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <p class="font-bold text-slate-700 text-base">Belum Ada Data Nilai</p>
                                <p class="text-xs text-slate-400 mt-1">Belum ada data nilai akhir siswa yang siap diproses.</p>
                            </div>
                        </td>
                    </tr>
                    @endif

                    {{-- Baris cadangan jika hasil pencarian kosong --}}
                    <tr id="noResultRow" class="hidden">
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 bg-slate-50/50 italic text-xs font-medium">
                            <i class="fas fa-search-minus mr-2 text-slate-300 text-base"></i>
                            Tidak ditemukan data nilai siswa yang cocok dengan kata kunci pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ANIMATION CSS --}}
<style>
    .animate-fade-in {
        animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

{{-- SCRIPT PENCARIAN JS CLIENT-SIDE --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('nilaiSearchInput');
        const tableBody = document.getElementById('nilaiTableBody');
        
        if (searchInput && tableBody) {
            const rows = tableBody.getElementsByClassName('nilai-row');
            const noResultRow = document.getElementById('noResultRow');
            const emptyPlaceholderRow = document.getElementById('emptyPlaceholderRow');

            searchInput.addEventListener('input', function () {
                const filter = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                // Jika tabel dari database memang kosong sejak awal, lewati fungsi pencarian
                if (emptyPlaceholderRow) return;

                for (let i = 0; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByClassName('name-cell')[0];
                    
                    if (nameCell) {
                        const nameText = nameCell.textContent || nameCell.innerText;

                        // Mencocokkan teks nama siswa dengan input filter pencarian
                        if (nameText.toLowerCase().indexOf(filter) > -1) {
                            rows[i].classList.remove('hidden');
                            visibleCount++;
                            
                            // Mengatur ulang penomoran dinamis agar list tetap berurutan saat difilter
                            const indexCell = rows[i].getElementsByClassName('index-cell')[0];
                            if (indexCell) {
                                indexCell.textContent = visibleCount;
                            }
                        } else {
                            rows[i].classList.add('hidden');
                        }
                    }
                }

                // Menampilkan notifikasi "Tidak ditemukan" jika hasil filter kosong
                if (visibleCount === 0 && filter !== '') {
                    noResultRow.classList.remove('hidden');
                } else {
                    noResultRow.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection