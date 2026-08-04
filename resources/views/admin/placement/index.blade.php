@extends('layouts.admin_layout')

@section('page_title', 'Data Penempatan Magang')

@section('content')
<div class="space-y-8 animate-fade-in">

    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950 p-6 sm:p-8 rounded-3xl shadow-xl text-white relative overflow-hidden">
        <!-- Accent Glow Effects -->
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <div class="flex items-center space-x-3 mb-2">
                <span class="bg-blue-500/20 text-blue-300 text-xs font-bold px-3 py-1 rounded-full border border-blue-400/20 uppercase tracking-widest">
                    Manajemen PKL
                </span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white">Plotting Siswa PKL</h2>
            <p class="text-xs sm:text-sm text-slate-300 font-medium mt-1 max-w-xl leading-relaxed">
                Kelola penempatan siswa, alokasi guru pembimbing, dan pendaftaran mentor industri secara terpusat.
            </p>
        </div>

        <div class="relative z-10 flex-shrink-0">
            <a href="{{ route('admin.placement.calculate') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-2xl shadow-lg shadow-blue-600/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 text-xs sm:text-sm uppercase tracking-wider group cursor-pointer whitespace-nowrap">
                <i class="fas fa-plus-circle mr-2 text-base transition-transform group-hover:rotate-90 duration-300"></i> Plotting Baru
            </a>
        </div>
    </div>

    {{-- KOTAK PENCARIAN & STATISTIK RINGKASAN --}}
<div class="bg-white/90 backdrop-blur-md p-5 sm:p-6 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100/80 flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-6">
    
    <!-- Grid Ringkasan Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full lg:w-auto flex-1">
        
        {{-- Statistik Total Semua Siswa --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100/60 hover:from-slate-100 hover:to-slate-200/50 transition-all duration-300 p-4 rounded-2xl border border-slate-200/70 flex items-center justify-between group shadow-xs hover:shadow-md hover:-translate-y-0.5">
            <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-slate-400/10 rounded-full blur-xl group-hover:bg-slate-500/15 transition-all"></div>
            
            <div class="flex items-center space-x-3.5 relative z-10">
                <div class="w-11 h-11 rounded-xl bg-white text-slate-700 flex items-center justify-center font-bold shadow-sm border border-slate-200/60 group-hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-users text-sm text-slate-600"></i>
                </div>
                <div>
                    <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">Total Siswa</p>
                    <p class="text-xs font-bold text-slate-700 mt-0.5">Terdaftar</p>
                </div>
            </div>
            
            <span class="relative z-10 text-xs sm:text-sm font-black bg-white text-slate-800 px-3.5 py-1.5 rounded-xl border border-slate-200 shadow-xs whitespace-nowrap">
                {{ $placements->count() }} Siswa
            </span>
        </div>

        {{-- Statistik Siswa Aktif --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-50/80 to-teal-50/40 hover:from-emerald-100/70 hover:to-teal-100/50 transition-all duration-300 p-4 rounded-2xl border border-emerald-200/60 flex items-center justify-between group shadow-xs hover:shadow-md hover:-translate-y-0.5">
            <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-emerald-500/10 rounded-full blur-xl group-hover:bg-emerald-500/20 transition-all"></div>
            
            <div class="flex items-center space-x-3.5 relative z-10">
                <div class="w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center font-bold shadow-xs border border-emerald-200/50 group-hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-running text-sm text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-600/80">Aktif Magang</p>
                    <p class="text-xs font-bold text-emerald-900 mt-0.5">Sedang Jalan</p>
                </div>
            </div>
            
            <span class="relative z-10 text-xs sm:text-sm font-black bg-white text-emerald-700 px-3.5 py-1.5 rounded-xl border border-emerald-200/80 shadow-xs whitespace-nowrap">
                {{ $placements->where('status', 'aktif')->count() }} Siswa
            </span>
        </div>

        {{-- Statistik Siswa Selesai --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-50/80 to-blue-50/40 hover:from-indigo-100/70 hover:to-blue-100/50 transition-all duration-300 p-4 rounded-2xl border border-indigo-200/60 flex items-center justify-between group shadow-xs hover:shadow-md hover:-translate-y-0.5">
            <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-indigo-500/10 rounded-full blur-xl group-hover:bg-indigo-500/20 transition-all"></div>
            
            <div class="flex items-center space-x-3.5 relative z-10">
                <div class="w-11 h-11 rounded-xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center font-bold shadow-xs border border-indigo-200/50 group-hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-check-circle text-sm text-indigo-600"></i>
                </div>
                <div>
                    <p class="text-[10px] font-extrabold uppercase tracking-widest text-indigo-600/80">Lulus / Selesai</p>
                    <p class="text-xs font-bold text-indigo-900 mt-0.5">Selesai PKL</p>
                </div>
            </div>
            
            <span class="relative z-10 text-xs sm:text-sm font-black bg-white text-indigo-700 px-3.5 py-1.5 rounded-xl border border-indigo-200/80 shadow-xs whitespace-nowrap">
                {{ $placements->where('status', 'selesai')->count() }} Siswa
            </span>
        </div>

    </div>
    
    <!-- Input Pencarian -->
    <div class="relative w-full lg:w-80 group flex-shrink-0">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-200">
            <i class="fas fa-search text-sm"></i>
        </span>
        <input type="text" id="placementSearchInput" placeholder="Cari siswa, instansi, atau guru..." 
            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/80 hover:bg-slate-100/50 focus:bg-white border border-slate-200/80 rounded-2xl text-xs sm:text-sm font-semibold text-slate-700 placeholder-slate-400 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 shadow-xs hover:shadow-sm">
    </div>
</div>

    <!-- MAIN TABLE SECTION -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
        
        <!-- HEADER TABEL & TOMBOL AKSI -->
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-base font-bold text-slate-800">Daftar Penempatan</h3>
                <p class="text-xs text-slate-400 font-medium">Seluruh data plotting siswa beserta pembimbing terkait.</p>
            </div>
            <div class="flex items-center gap-2.5 flex-wrap sm:flex-nowrap">
                {{-- TOMBOL EKSPOR PDF --}}
                <button type="button" onclick="triggerExportPdf()" @if($placements->isEmpty()) disabled @endif 
                    class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-500 text-white border border-emerald-600/80 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 shadow-xs hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer whitespace-nowrap">
                    <i class="fas fa-file-pdf mr-2 text-xs text-emerald-100"></i> Cetak PDF / Laporan
                </button>

                <form action="{{ route('admin.placement.destroyAll') }}" method="POST" id="deleteAllPlacementForm">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="btnTriggerDeleteAll" @if($placements->isEmpty()) disabled @endif 
                        class="inline-flex items-center justify-center bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/80 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 shadow-xs hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer whitespace-nowrap">
                        <i class="fas fa-trash-alt mr-2 text-xs text-rose-500"></i> Hapus Semua Data
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 uppercase text-[11px] font-black tracking-wider border-b border-slate-100">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Lokasi Magang (Instansi)</th>
                        <th class="px-6 py-4">Guru Pembimbing</th>
                        <th class="px-6 py-4">Mentor Industri</th>
                        <th class="px-6 py-4">Periode Magang</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="placementTableBody" class="divide-y divide-slate-100 text-sm">
                    @php $rowNumber = 1; @endphp
                    @forelse($placements as $placement)
                    <tr class="placement-row hover:bg-slate-50/80 transition-colors duration-150">
                        <td class="px-6 py-5 text-slate-400 font-extrabold text-center text-xs index-cell">{{ $rowNumber++ }}</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3.5">
                                <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-black text-sm flex-shrink-0 shadow-md shadow-blue-500/20">
                                    {{ substr($placement->siswa->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 name-cell leading-snug">{{ $placement->siswa->name }}</div>
                                    <div class="flex items-center gap-1.5 mt-0.5 group/copy">
                                        <span class="text-[11px] text-slate-400 font-semibold tracking-wide">{{ $placement->siswa->nomor_identitas }}</span>
                                        <button type="button" onclick="copyToClipboard('{{ $placement->siswa->nomor_identitas }}', this)" 
                                            class="inline-flex items-center justify-center w-5 h-5 rounded-md text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 cursor-pointer" 
                                            title="Salin NISN / ID">
                                            <i class="far fa-copy text-[10px]"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="font-bold text-slate-800 instansi-cell leading-snug">{{ $placement->instansi->nama_perusahaan }}</div>
                            <div class="text-xs text-slate-400 font-medium mt-0.5 line-clamp-1" title="{{ $placement->instansi->alamat }}">{{ $placement->instansi->alamat }}</div>
                        </td>

                        {{-- Kolom Guru Pembimbing --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center text-slate-700 text-xs font-semibold" title="Guru Sekolah">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-2.5 flex-shrink-0 border border-blue-100">
                                    <i class="fas fa-chalkboard-teacher text-xs"></i>
                                </span>
                                <span class="leading-snug guru-cell text-slate-800 font-bold">{{ $placement->guru->name }}</span>
                            </div>
                        </td>

                        {{-- Kolom Mentor Industri --}}
                        <td class="px-6 py-5">
                            @if($placement->mentor_id)
                                <div class="flex items-center text-slate-700 text-xs font-semibold" title="Mentor Industri">
                                    <span class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center mr-2.5 flex-shrink-0 border border-purple-100">
                                        <i class="fas fa-user-tie text-xs"></i>
                                    </span>
                                    <span class="leading-snug text-slate-800 font-bold">{{ $placement->mentor->name }}</span>
                                </div>
                            @else
                                <span class="inline-flex items-center text-amber-700 bg-amber-50 border border-amber-200/60 px-2.5 py-1 rounded-xl text-[11px] font-extrabold w-fit animate-pulse">
                                    <i class="fas fa-exclamation-triangle mr-1.5 text-xs text-amber-500"></i> Belum Ada Mentor
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-5">
                            <div class="inline-flex flex-col bg-slate-50 border border-slate-200/60 p-2 rounded-xl text-center min-w-[120px]">
                                <span class="font-bold text-slate-700 text-xs whitespace-nowrap">{{ $placement->tanggal_mulai->format('d M Y') }}</span>
                                <span class="text-slate-400 text-[9px] uppercase font-black my-0.5 tracking-wider">s/d</span>
                                <span class="font-bold text-slate-700 text-xs whitespace-nowrap">{{ $placement->tanggal_selesai->format('d M Y') }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            @if($placement->status == 'aktif')
                                <span class="inline-flex items-center justify-center bg-emerald-50 text-emerald-700 px-3.5 py-1.5 rounded-full text-xs font-bold border border-emerald-200/80 whitespace-nowrap shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-ping"></span>
                                    Sedang Magang
                                </span>
                            @elseif($placement->status == 'selesai')
                                <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 px-3.5 py-1.5 rounded-full text-xs font-bold border border-blue-200/80 whitespace-nowrap shadow-2xs">
                                    <i class="fas fa-check text-[10px] mr-1.5"></i> Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center bg-rose-50 text-rose-700 px-3.5 py-1.5 rounded-full text-xs font-bold border border-rose-200/80 whitespace-nowrap shadow-2xs">
                                    Batal
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-5 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.placement.edit', $placement->id) }}" class="text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200/60 w-9 h-9 rounded-xl flex items-center justify-center transition-all shadow-2xs hover:shadow-md" title="Update Guru/Mentor">
                                    <i class="fas fa-user-edit text-xs"></i>
                                </a>

                                <form action="{{ route('admin.placement.destroy', $placement->id) }}" method="POST" class="delete-placement-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-trigger-delete text-rose-500 hover:text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200/60 w-9 h-9 rounded-xl flex items-center justify-center transition-all shadow-2xs hover:shadow-md cursor-pointer" title="Batalkan Plotting">
                                        <i class="fas fa-times-circle text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyPlaceholderRow">
                        <td colspan="8" class="px-6 py-16 text-center text-slate-400 bg-slate-50/50">
                            <div class="max-w-xs mx-auto flex flex-col items-center">
                                <div class="w-16 h-16 rounded-3xl bg-slate-100 border border-slate-200/80 flex items-center justify-center text-slate-400 text-2xl mb-4 shadow-inner">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <p class="font-bold text-slate-700 text-base">Belum Ada Plotting</p>
                                <p class="text-xs text-slate-400 mt-1 mb-4">Belum ada data siswa yang ditempatkan ke instansi magang.</p>
                                <a href="{{ route('admin.placement.create') }}" class="inline-flex items-center text-xs font-black text-blue-600 bg-blue-50 border border-blue-200/80 px-4 py-2.5 rounded-xl hover:bg-blue-100 transition shadow-2xs">
                                    <i class="fas fa-plus mr-2"></i> Mulai Plotting Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Baris notifikasi jika hasil pencarian kosong --}}
                    <tr id="noResultRow" class="hidden">
                        <td colspan="8" class="px-6 py-10 text-center text-slate-400 bg-slate-50/50 italic text-xs font-medium">
                            <i class="fas fa-search-minus mr-2 text-slate-300 text-base"></i>
                            Tidak ditemukan data penempatan magang yang cocok dengan kata kunci pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL POP-UP KONFIRMASI HAPUS PER BARIS --}}
<div id="deleteConfirmationModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md transition-opacity"></div>
    
    {{-- Card Content --}}
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full mx-4 p-8 transform transition-all border border-slate-100 overflow-hidden text-center z-10">
        <div class="flex flex-col items-center">
            {{-- Icon Warning --}}
            <div class="h-16 w-16 bg-rose-50 text-rose-500 rounded-2xl border border-rose-100 flex items-center justify-center text-2xl mb-4 shadow-lg shadow-rose-500/10">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <h3 class="text-xl font-black text-slate-800 mb-2">Konfirmasi Pembatalan</h3>
            <p class="text-xs sm:text-sm text-slate-500 font-medium leading-relaxed mb-6">
                Apakah Anda yakin ingin membatalkan penempatan ini? Tindakan ini akan mengembalikan status siswa menjadi <span class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">belum magang</span>.
            </p>
            
            {{-- Action Buttons --}}
            <div class="flex w-full gap-3">
                <button type="button" id="btnCancelDelete" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 px-4 rounded-xl transition text-xs uppercase tracking-wider outline-none cursor-pointer">
                    Kembali
                </button>
                <button type="button" id="btnConfirmDelete" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-rose-600/30 hover:shadow-xl transition text-xs uppercase tracking-wider outline-none cursor-pointer">
                    Ya, Batalkan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL POP-UP KONFIRMASI HAPUS SEMUA DATA --}}
<div id="deleteAllConfirmationModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md transition-opacity"></div>
    
    {{-- Card Content --}}
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full mx-4 p-8 transform transition-all border border-slate-100 overflow-hidden text-center z-10">
        <div class="flex flex-col items-center">
            {{-- Icon Warning --}}
            <div class="h-16 w-16 bg-rose-100 text-rose-600 rounded-2xl border border-rose-200 flex items-center justify-center text-2xl mb-4 shadow-lg shadow-rose-600/20">
                <i class="fas fa-dumpster text-2xl"></i>
            </div>
            
            <h3 class="text-xl font-black text-slate-800 mb-2">Hapus SEMUA Data?</h3>
            <p class="text-xs sm:text-sm text-slate-500 font-medium leading-relaxed mb-6">
                Tindakan ini akan menghapus semua data plotting magang secara berurutan. Semua status siswa akan kembali menjadi <span class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">belum magang</span>.
            </p>
            
            {{-- Action Buttons --}}
            <div class="flex w-full gap-3">
                <button type="button" id="btnCancelDeleteAll" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 px-4 rounded-xl transition text-xs uppercase tracking-wider outline-none cursor-pointer">
                    Batal
                </button>
                <button type="button" id="btnConfirmDeleteAll" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-rose-600/30 hover:shadow-xl transition text-xs uppercase tracking-wider outline-none cursor-pointer">
                    Ya, Hapus Semua
                </button>
            </div>
        </div>
    </div>
</div>

{{-- TEMPLATE LAYOUT CETAK PDF RESMI - SMKS AL MADANI PONTIANAK --}}
<div id="pdfPrintArea" class="hidden print:block w-full text-slate-900 font-sans">
    <!-- KOP SURAT SEKOLAH -->
    <div class="flex items-center justify-between border-b-4 border-double border-slate-900 pb-3 mb-4 w-full">
        <div class="flex items-center gap-4">
            <!-- LOGO SEKOLAH -->
            <div class="w-[18mm] h-[18mm] flex items-center justify-center flex-shrink-0">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMKS Al Madani Pontianak" class="max-w-full max-h-full object-contain">
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-base font-black uppercase tracking-wide text-slate-900 leading-tight">SMKS AL MADANI PONTIANAK</h1>
                <p class="text-[10px] font-bold text-slate-800 mt-0.5">SISTEM INFORMASI MANAJEMEN PRAKTEK KERJA LAPANGAN (PKL)</p>
                <p class="text-[8.5px] text-slate-600 mt-0.5 leading-snug">
                    Jl. Sungai Raya Dalam No. 16 B, Kel. Bangka Belitung Darat, Kec. Pontianak Tenggara, Kota Pontianak, Kalbar (78125)<br>
                    Telp: 0561-8110048 | Email: smks.almadaniptk@gmail.com | NPSN: 30105195
                </p>
            </div>
        </div>
        <div class="text-right flex-shrink-0 self-start">
            <span class="inline-block px-2 py-0.5 bg-slate-100 border border-slate-300 rounded text-[8.5px] font-bold uppercase text-slate-700">Dokumen Resmi</span>
            <p class="text-[8.5px] text-slate-600 mt-1 font-medium">
                Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </p>
        </div>
    </div>

    <!-- HEADER DESKRIPSI PENJELASAN TABEL -->
    <div class="mb-3 bg-slate-50 p-2.5 rounded-lg border border-slate-300 w-full">
        <h2 class="text-center text-[11px] font-black uppercase tracking-wide text-slate-900 mb-0.5">LAPORAN REKAPITULASI PENEMPATAN MAGANG / PKL SISWA</h2>
        <p class="text-[9px] text-slate-700 leading-relaxed text-justify">
            Laporan resmi ini menyajikan data rekapitulasi penempatan siswa Praktik Kerja Lapangan (PKL) SMKS Al Madani Pontianak. Informasi mencakup alokasi siswa pada instansi/perusahaan mitra, pembimbing sekolah, mentor industri, periode pelaksanaan, serta status keaktifan peserta PKL.
        </p>
    </div>

    <!-- TABEL UTAMA LAPORAN PDF -->
    <table class="w-full text-left border-collapse border border-slate-400 text-[9px] mb-4">
        <thead>
            <tr class="bg-slate-200 text-slate-900 font-bold uppercase tracking-wider border-b border-slate-400">
                <th class="p-1.5 border border-slate-400 text-center w-6">No</th>
                <th class="p-1.5 border border-slate-400">Nama Siswa</th>
                <th class="p-1.5 border border-slate-400">Instansi / Perusahaan</th>
                <th class="p-1.5 border border-slate-400">Guru Pembimbing</th>
                <th class="p-1.5 border border-slate-400">Mentor Industri</th>
                <th class="p-1.5 border border-slate-400 text-center">Periode Magang</th>
                <th class="p-1.5 border border-slate-400 text-center w-16">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $pdfRow = 1; @endphp
            @forelse($placements as $placement)
            <tr class="border-b border-slate-300">
                <td class="p-1.5 border border-slate-300 text-center font-bold">{{ $pdfRow++ }}</td>
                <td class="p-1.5 border border-slate-300">
                    <div class="font-bold text-slate-900">{{ $placement->siswa->name }}</div>
                    <div class="text-[8px] text-slate-600">NISN/ID: {{ $placement->siswa->nomor_identitas }}</div>
                </td>
                <td class="p-1.5 border border-slate-300">
                    <div class="font-bold text-slate-800">{{ $placement->instansi->nama_perusahaan }}</div>
                    <div class="text-[8px] text-slate-600 truncate max-w-[200px]">{{ $placement->instansi->alamat }}</div>
                </td>
                <td class="p-1.5 border border-slate-300 font-medium">{{ $placement->guru->name }}</td>
                <td class="p-1.5 border border-slate-300 font-medium">
                    {{ $placement->mentor_id ? $placement->mentor->name : 'Belum Ditentukan' }}
                </td>
                <td class="p-1.5 border border-slate-300 text-center whitespace-nowrap">
                    {{ $placement->tanggal_mulai->format('d/m/Y') }} s/d {{ $placement->tanggal_selesai->format('d/m/Y') }}
                </td>
                <td class="p-1.5 border border-slate-300 text-center font-bold capitalize">
                    @if($placement->status == 'aktif')
                        <span class="text-emerald-700">Aktif</span>
                    @elseif($placement->status == 'selesai')
                        <span class="text-blue-700">Selesai</span>
                    @else
                        <span class="text-rose-700">Batal</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="p-4 text-center text-slate-500 italic">Belum ada data penempatan magang yang tercatat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- LEMBAR PENGESAHAN TANDA TANGAN -->
    <div class="mt-3 flex justify-between items-end text-[10px] w-full page-break-inside-avoid">
        <div>
            <p class="text-slate-600 font-bold">Catatan Ringkasan:</p>
            <p class="text-[8.5px] text-slate-500 italic mt-0.5">* Dokumen ini diterbitkan secara resmi oleh Sistem SIM PKL SMKS Al Madani Pontianak.</p>
        </div>
        <div class="text-center pr-2">
            <p class="text-slate-800 font-medium mb-0.5">Pontianak, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p class="mb-10 text-slate-800 font-bold">Koordinator PKL SMKS Al Madani,</p>
            <p class="font-black text-slate-900 underline">( ............................................................ )</p>
            <p class="text-[8.5px] text-slate-600 mt-0.5">NIP. ....................................................</p>
        </div>
    </div>
</div>

{{-- ANIMATION & OPTIMIZED PRINT STYLES --}}
<style>
    .animate-fade-in {
        animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* SETUP CETAK RAPI & PRESISI SEPERTI HALAMAN KALKULASI */
    @page {
        size: A4 landscape;
        margin: 0.8cm 0.8cm 0.8cm 0.8cm;
    }

    @media print {
        /* Hilangkan Seluruh Navigasi, Admin Layout, dan Elemen Browser */
        body, html {
            background: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: auto !important;
            overflow: visible !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        aside, nav, header, footer,
        .no-print,
        .animate-fade-in {
            display: none !important;
        }

        /* Tampilkan Area Laporan PDF Terisolasi dan Rapi */
        #pdfPrintArea {
            display: block !important;
            visibility: visible !important;
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #ffffff !important;
        }

        #pdfPrintArea * {
            visibility: visible !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
            page-break-inside: auto !important;
        }

        tr {
            page-break-inside: avoid !important;
            page-break-after: auto !important;
        }

        thead {
            display: table-header-group !important;
        }

        .page-break-inside-avoid {
            page-break-inside: avoid !important;
        }
    }
</style>

{{-- SCRIPT PENCARIAN & MODAL JS --}}
<script>
    // --- FUNGSI SALIN NISN / ID KE CLIPBOARD ---
    function copyToClipboard(text, buttonElement) {
        if (!navigator.clipboard) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);
            showCopyFeedback(buttonElement);
            return;
        }
        navigator.clipboard.writeText(text).then(() => {
            showCopyFeedback(buttonElement);
        }).catch(err => {
            console.error('Gagal menyalin text: ', err);
        });
    }

    function showCopyFeedback(btn) {
        const icon = btn.querySelector('i');
        const originalClass = icon.className;
        
        // Ubah ikon ke Centang Hijau
        icon.className = 'fas fa-check text-emerald-500 text-[10px]';
        btn.classList.add('bg-emerald-50');
        
        setTimeout(() => {
            icon.className = originalClass;
            btn.classList.remove('bg-emerald-50');
        }, 1500);
    }

    // --- FUNGSI EKSPOR CETAK PDF ---
    function triggerExportPdf() {
        window.print();
    }

    document.addEventListener('DOMContentLoaded', function () {
        // --- LOGIK PENCARIAN BAWAAN ---
        const searchInput = document.getElementById('placementSearchInput');
        const tableBody = document.getElementById('placementTableBody');
        
        if (searchInput && tableBody) {
            const rows = tableBody.getElementsByClassName('placement-row');
            const noResultRow = document.getElementById('noResultRow');
            const emptyPlaceholderRow = document.getElementById('emptyPlaceholderRow');

            searchInput.addEventListener('input', function () {
                const filter = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                if (emptyPlaceholderRow) return;

                for (let i = 0; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByClassName('name-cell')[0];
                    const instansiCell = rows[i].getElementsByClassName('instansi-cell')[0];
                    const guruCell = rows[i].getElementsByClassName('guru-cell')[0];
                    
                    if (nameCell || instansiCell || guruCell) {
                        const nameText = nameCell.textContent || nameCell.innerText;
                        const instansiText = instansiCell.textContent || instansiCell.innerText;
                        const guruText = guruCell.textContent || guruCell.innerText;

                        if (
                            nameText.toLowerCase().indexOf(filter) > -1 || 
                            instansiText.toLowerCase().indexOf(filter) > -1 ||
                            guruText.toLowerCase().indexOf(filter) > -1
                        ) {
                            rows[i].classList.remove('hidden');
                            visibleCount++;
                            
                            const indexCell = rows[i].getElementsByClassName('index-cell')[0];
                            if (indexCell) {
                                indexCell.textContent = visibleCount;
                            }
                        } else {
                            rows[i].classList.add('hidden');
                        }
                    }
                }

                if (visibleCount === 0 && filter !== '') {
                    noResultRow.classList.remove('hidden');
                } else {
                    noResultRow.classList.add('hidden');
                }
            });
        }

        // --- LOGIK MODAL DELETE PER BARIS BAWAAN ---
        const modal = document.getElementById('deleteConfirmationModal');
        const btnCancel = document.getElementById('btnCancelDelete');
        const btnConfirm = document.getElementById('btnConfirmDelete');
        let formToSubmit = null;

        document.addEventListener('click', function (e) {
            const triggerBtn = e.target.closest('.btn-trigger-delete');
            if (triggerBtn) {
                e.preventDefault();
                formToSubmit = triggerBtn.closest('.delete-placement-form');
                if (modal) modal.classList.remove('hidden');
            }
        });

        if (btnCancel) {
            btnCancel.addEventListener('click', function () {
                if (modal) modal.classList.add('hidden');
                formToSubmit = null;
            });
        }

        if (btnConfirm) {
            btnConfirm.addEventListener('click', function () {
                if (formToSubmit) formToSubmit.submit();
            });
        }

        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal.querySelector('.bg-slate-950\\/60')) {
                    modal.classList.add('hidden');
                    formToSubmit = null;
                }
            });
        }

        // --- LOGIK MODAL DELETE ALL ---
        const deleteAllModal = document.getElementById('deleteAllConfirmationModal');
        const btnTriggerDeleteAll = document.getElementById('btnTriggerDeleteAll');
        const btnCancelDeleteAll = document.getElementById('btnCancelDeleteAll');
        const btnConfirmDeleteAll = document.getElementById('btnConfirmDeleteAll');

        if (btnTriggerDeleteAll) {
            btnTriggerDeleteAll.addEventListener('click', function () {
                if (deleteAllModal) deleteAllModal.classList.remove('hidden');
            });
        }

        if (btnCancelDeleteAll) {
            btnCancelDeleteAll.addEventListener('click', function () {
                if (deleteAllModal) deleteAllModal.classList.add('hidden');
            });
        }

        if (btnConfirmDeleteAll) {
            btnConfirmDeleteAll.addEventListener('click', function () {
                const deleteAllForm = document.getElementById('deleteAllPlacementForm');
                if (deleteAllForm) {
                    deleteAllForm.submit();
                } else {
                    if (deleteAllModal) deleteAllModal.classList.add('hidden');
                }
            });
        }

        if (deleteAllModal) {
            deleteAllModal.addEventListener('click', function (e) {
                if (e.target === deleteAllModal.querySelector('.bg-slate-950\\/60')) {
                    deleteAllModal.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection