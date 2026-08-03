@extends('layouts.admin_layout')

@section('page_title', 'Kalkulasi Rekomendasi Penempatan')

@section('content')
<!-- CSS KHUSUS PRINT DENGAN TAMPILAN PORTRAIT RAPI, CARD GRADE A & B, DAN TABEL FULL -->
<style>
    /* Sembunyikan Kop & Card Khusus Print di layar browser normal */
    .print-only-header,
    .print-only-cards {
        display: none !important;
    }

    @media print {
        /* Set Kertas Portrait A4 dengan Margin Presisi */
        @page {
            size: A4 portrait;
            margin: 1cm 1cm 1cm 1cm;
        }

        /* Sembunyikan elemen non-cetak dari Layout Utama Admin */
        aside, nav, header, footer, 
        .no-print, 
        .animate-fade-in > div:not(#printableTableSection) {
            display: none !important;
        }

        /* Paksa area utama cetak terlihat penuh */
        body, html {
            background: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: auto !important;
            overflow: visible !important;
        }

        #printableTableSection {
            display: block !important;
            visibility: visible !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            border: none !important;
        }

        /* Tampilkan Kop Laporan Resmi dengan Logo Sekolah di PDF */
        .print-only-header {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 15px !important;
            margin-bottom: 15px !important;
            border-bottom: 2px solid #0f172a !important;
            padding-bottom: 10px !important;
            text-align: center !important;
        }

        .print-only-header img {
            width: 55px !important;
            height: auto !important;
            object-fit: contain !important;
        }

        .print-header-text {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
        }

        /* Tampilkan Card Grade A & B di atas tabel pada PDF */
        .print-only-cards {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
            gap: 12px !important;
            margin-bottom: 15px !important;
            width: 100% !important;
        }

        .print-card-box {
            width: 49% !important;
            border: 1px solid #94a3b8 !important;
            border-radius: 6px !important;
            padding: 8px 10px !important;
            background-color: #f8fafc !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .print-card-header {
            font-weight: 800 !important;
            font-size: 8.5pt !important;
            margin-bottom: 4px !important;
            border-bottom: 1px solid #cbd5e1 !important;
            padding-bottom: 3px !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .print-card-grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 3px 6px !important;
            font-size: 7pt !important;
            color: #1e293b !important;
        }

        .print-card-item {
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        /* Hilangkan overflow/scroll agar tabel pas 100% di kertas portrait */
        .overflow-x-auto {
            overflow: visible !important;
        }

        table {
            width: 100% !important;
            min-width: 100% !important;
            border-collapse: collapse !important;
            font-size: 6.5pt !important; /* Font dikecilkan agar muat & rapi */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
            table-layout: fixed !important;
        }

        th, td {
            border: 1px solid #64748b !important;
            padding: 3px 2px !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
            text-align: center !important;
            vertical-align: middle !important;
            color: #0f172a !important;
        }

        th {
            background-color: #f1f5f9 !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            font-size: 6.5pt !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Penyesuaian Font Elemen Spesifik Dalam Tabel Cetak */
        td .name-cell {
            font-size: 6.5pt !important;
        }

        td span {
            font-size: 6pt !important;
            padding: 1px 3px !important;
        }

        /* Align Left untuk Siswa & Rekomendasi Instansi agar Rapi */
        td.col-siswa, td.col-rekomendasi {
            text-align: left !important;
        }

        /* Sembunyikan Select & Tampilkan Teks Instansi Pilihan */
        .print-select-container select {
            display: none !important;
        }

        .print-select-container .print-selected-text {
            display: block !important;
            font-weight: bold !important;
            color: #000000 !important;
            font-size: 6.5pt !important;
        }
    }

    /* Style teks ganti dropdown saat print (hidden di browser normal) */
    .print-selected-text {
        display: none;
    }

    .animate-fade-in {
        animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="max-w-7xl mx-auto space-y-8 pb-12 animate-fade-in">

    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950 p-6 sm:p-8 rounded-3xl shadow-2xl text-white relative overflow-hidden border border-slate-700/50">
        <div class="absolute -right-12 -bottom-12 w-56 h-56 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-12 -top-12 w-56 h-56 bg-indigo-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-2">
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] sm:text-xs font-black bg-blue-500/20 text-blue-300 border border-blue-400/30 tracking-widest uppercase shadow-xs backdrop-blur-xs">
                    <i class="fas fa-brain mr-1.5 text-blue-400"></i> Sistem Pendukung Keputusan
                </span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-tight">
                Rekomendasi<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-indigo-200"> Penempatan</span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-300 font-medium max-w-2xl leading-relaxed">
                Hitung dan tentukan rekomendasi lokasi magang siswa berdasarkan kriteria akademik, kehadiran, dan kuota industri.
            </p>
        </div>
    </div>

    <!-- CONTAINER UTAMA SPK CALCULATOR -->
    <div class="space-y-6">

        <!-- FORM INPUT NILAI SISWA INTERAKTIF -->
        <div class="bg-white/95 backdrop-blur-md p-6 sm:p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 transition-all relative z-30">
            <div class="flex items-center space-x-3.5 mb-6 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-extrabold border border-blue-100/80 shadow-xs flex-shrink-0">
                    <i class="fas fa-user-check text-sm"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-800 text-base sm:text-lg tracking-tight">Pilih Siswa Aktif Untuk Kalkulasi</h3>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Pilih siswa dari daftar terdaftar untuk memproses analisis Fuzzy Sugeno + SAW secara langsung.</p>
                </div>
            </div>

            <form id="formKalkulasiSPK" onsubmit="prosesKalkulasiSPK(event)" class="grid grid-cols-1 md:grid-cols-4 gap-5 items-end relative">
                
                <!-- CUSTOM ELEGAN DROPDOWN SISWA WITH SEARCH -->
                <div class="space-y-2 relative z-50">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider">Pilih Siswa</label>
                    
                    @php
                        $daftar = isset($siswaAktif) && count($siswaAktif) > 0 ? $siswaAktif : (isset($siswas) ? $siswas : []);
                    @endphp

                    <!-- Native Hidden Select -->
                    <select id="selectSiswaAktif" name="siswa_id" required class="hidden">
                        <option value="" disabled selected>-- Pilih Siswa --</option>
                        @foreach($daftar as $index => $siswa)
                            @php
                                $namaJurusan = '-';
                                if (is_object($siswa->jurusan)) {
                                    $namaJurusan = $siswa->jurusan->nama_jurusan ?? $siswa->jurusan->nama ?? $siswa->jurusan->kode_jurusan ?? '-';
                                } elseif (is_array($siswa->jurusan)) {
                                    $namaJurusan = $siswa->jurusan['nama_jurusan'] ?? $siswa->jurusan['nama'] ?? $siswa->jurusan['kode_jurusan'] ?? '-';
                                } elseif (!empty($siswa->jurusan_nama)) {
                                    $namaJurusan = $siswa->jurusan_nama;
                                } elseif (is_string($siswa->jurusan) && !empty($siswa->jurusan)) {
                                    $decoded = json_decode($siswa->jurusan, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $namaJurusan = $decoded['nama_jurusan'] ?? $decoded['nama'] ?? $decoded['kode_jurusan'] ?? $siswa->jurusan;
                                    } else {
                                        $namaJurusan = $siswa->jurusan;
                                    }
                                } else {
                                    $namaJurusan = $siswa->major ?? $siswa->kelas ?? 'TKJ';
                                }

                                $nisSiswa = $siswa->nomor_identitas ?? $siswa->nis ?? '-';
                            @endphp
                            <option value="{{ $siswa->id }}" 
                                    id="opt_siswa_{{ $siswa->id }}"
                                    data-nama="{{ $siswa->name }}" 
                                    data-nis="{{ $nisSiswa }}" 
                                    data-jurusan="{{ $namaJurusan }}" 
                                    data-c1="{{ $siswa->nilai_akademik ?? $siswa->c1 ?? '' }}" 
                                    data-c2="{{ $siswa->kehadiran ?? $siswa->c2 ?? '' }}">
                                {{ $siswa->name }} - NIS: {{ $nisSiswa }} ({{ $namaJurusan }})
                            </option>
                        @endforeach
                    </select>

                    <!-- Trigger Button Minimalis -->
                    <div id="customDropdownTrigger" onclick="toggleCustomDropdown()" 
                        class="w-full px-4 py-2.5 bg-slate-50 hover:bg-white border border-slate-200 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500/10 rounded-xl text-xs sm:text-sm font-medium text-slate-700 outline-none transition-all cursor-pointer relative flex items-center justify-between min-h-[44px]">
                        
                        <div class="flex items-center space-x-2.5 truncate pr-6">
                            <i class="fas fa-user-circle text-slate-400 text-sm flex-shrink-0"></i>
                            <span id="customDropdownLabel" class="truncate text-slate-400">-- Pilih Siswa --</span>
                        </div>

                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 transition-transform duration-200" id="dropdownArrow">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </span>
                    </div>

                    <!-- Dropdown Menu List -->
                    <div id="customDropdownMenu" 
                        class="hidden absolute left-0 w-full sm:w-[500px] md:w-[600px] top-full mt-1.5 bg-white border border-slate-200 rounded-2xl shadow-2xl z-50 overflow-hidden transition-all duration-150">
                        
                        <!-- Input Cari Siswa -->
                        <div class="p-3 border-b border-slate-100 bg-slate-50/70">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                <input type="text" id="inputSearchDropdownSiswa" oninput="filterSiswaDropdown()" placeholder="Cari nama atau NIS siswa..." autocomplete="off"
                                    class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 shadow-xs">
                            </div>
                        </div>

                        <!-- Daftar Siswa -->
                        <div id="customDropdownList" class="max-h-72 overflow-y-auto p-2 space-y-1.5">
                            @foreach($daftar as $index => $siswa)
                                @php
                                    $namaJurusan = '-';
                                    if (is_object($siswa->jurusan)) {
                                        $namaJurusan = $siswa->jurusan->nama_jurusan ?? $siswa->jurusan->nama ?? $siswa->jurusan->kode_jurusan ?? '-';
                                    } elseif (is_array($siswa->jurusan)) {
                                        $namaJurusan = $siswa->jurusan['nama_jurusan'] ?? $siswa->jurusan['nama'] ?? $siswa->jurusan['kode_jurusan'] ?? '-';
                                    } elseif (!empty($siswa->jurusan_nama)) {
                                        $namaJurusan = $siswa->jurusan_nama;
                                    } elseif (is_string($siswa->jurusan) && !empty($siswa->jurusan)) {
                                        $decoded = json_decode($siswa->jurusan, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                            $namaJurusan = $decoded['nama_jurusan'] ?? $decoded['nama'] ?? $decoded['kode_jurusan'] ?? $siswa->jurusan;
                                        } else {
                                            $namaJurusan = $siswa->jurusan;
                                        }
                                    } else {
                                        $namaJurusan = $siswa->major ?? $siswa->kelas ?? 'TKJ';
                                    }

                                    $nisSiswa = $siswa->nomor_identitas ?? $siswa->nis ?? '-';
                                    $namaSiswa = $siswa->name ?? '';
                                @endphp
                                
                                <div id="custom_item_{{ $siswa->id }}"
                                    onclick="selectCustomSiswaOption(this, '{{ $siswa->id }}')" 
                                    data-nama="{{ $namaSiswa }}" 
                                    data-nama-search="{{ strtolower($namaSiswa) }}" 
                                    data-nis="{{ $nisSiswa }}" 
                                    data-jurusan="{{ $namaJurusan }}" 
                                    data-c1="{{ $siswa->nilai_akademik ?? $siswa->c1 ?? '' }}" 
                                    data-c2="{{ $siswa->kehadiran ?? $siswa->c2 ?? '' }}"
                                    class="custom-option-item p-2.5 hover:bg-blue-50/80 rounded-xl transition-colors cursor-pointer flex items-center justify-between gap-3 group border border-transparent hover:border-blue-100">
                                    
                                    <div class="flex items-center space-x-3 min-w-0">
                                        <div class="min-w-0 flex-1">
                                            <div class="font-extrabold text-slate-800 text-xs sm:text-sm group-hover:text-blue-600 truncate transition-colors item-nama">
                                                {{ $namaSiswa }}
                                            </div>
                                            <div class="text-[11px] text-slate-400 font-medium truncate item-nis">
                                                NIS: {{ $nisSiswa }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Badge Jurusan Minimalis -->
                                    <span class="text-[11px] text-slate-600 font-bold bg-slate-100 group-hover:bg-blue-100 group-hover:text-blue-700 px-2.5 py-1 rounded-lg flex-shrink-0 truncate transition-colors border border-slate-200/50 group-hover:border-blue-200">
                                        {{ $namaJurusan }}
                                    </span>
                                </div>
                            @endforeach

                            <div id="notFoundDropdown" class="hidden p-4 text-center text-xs text-slate-400 italic">
                                Siswa tidak ditemukan...
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input Nilai C1 -->
                <div class="space-y-2">
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider">Nilai Akademik (C1)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <i class="fas fa-graduation-cap text-xs"></i>
                        </span>
                        <input type="number" id="inputNilaiC1" min="0" max="100" step="0.1" required placeholder="Nilai Hard Skill (0-100)" 
                            class="w-full pl-10 pr-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all shadow-xs">
                    </div>
                </div>

                <!-- Input Nilai C2 -->
                <div class="space-y-2">
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider">Nilai Kehadiran (C2)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <i class="fas fa-user-check text-xs"></i>
                        </span>
                        <input type="number" id="inputNilaiC2" min="0" max="100" step="0.1" required placeholder="Nilai Soft Skill (0-100)" 
                            class="w-full pl-10 pr-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all shadow-xs">
                    </div>
                </div>

                <!-- Tombol Hitung -->
                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-extrabold py-3.5 px-6 rounded-xl shadow-md shadow-blue-600/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 text-xs uppercase tracking-wider flex items-center justify-center space-x-2 cursor-pointer border border-blue-400/20">
                        <i class="fas fa-calculator text-sm"></i>
                        <span>Hitung & Rekomendasikan</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- MODAL POPUP BERHASIL ELEGAN -->
        <div id="modalKalkulasiSukses" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6 transition-all duration-300">
            <div onclick="tutupModalSukses()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-md transition-opacity"></div>
            <div id="modalCardContent" class="bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-sm w-full p-6 text-center relative z-10 transform scale-95 opacity-0 transition-all duration-300">
                <div class="relative w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <div class="absolute inset-0 rounded-full bg-emerald-500/20 animate-ping"></div>
                    <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-400 text-white flex items-center justify-center text-2xl shadow-lg shadow-emerald-500/30 relative z-10">
                        <i class="fas fa-check"></i>
                    </div>
                </div>

                <h3 class="text-lg font-black text-slate-800 tracking-tight">Kalkulasi Berhasil!</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Data analisis Fuzzy Sugeno + SAW telah berhasil diproses.</p>

                <div class="mt-4 p-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-left space-y-2">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-medium">Siswa:</span>
                        <span id="popSiswaNama" class="font-bold text-slate-700 truncate max-w-[170px]">-</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-medium">Nilai C1 (Akademik):</span>
                        <span id="popNilaiC1" class="font-bold text-blue-600">-</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-medium">Nilai C2 (Kehadiran):</span>
                        <span id="popNilaiC2" class="font-bold text-indigo-600">-</span>
                    </div>
                </div>

                <div class="mt-5">
                    <button onclick="tutupModalSukses()" type="button" 
                        class="w-full bg-slate-900 hover:bg-slate-800 text-white font-extrabold py-3 px-5 rounded-xl text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer active:scale-95">
                        Lihat Hasil Analisis
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- PENCARIAN & STATISTIK RINGKASAN -->
    <div class="bg-white/95 backdrop-blur-md p-6 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 space-y-6">
        
        <!-- BARIS STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 w-full">
            <div class="relative overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100/80 hover:from-slate-100 transition-all duration-300 p-5 rounded-2xl border border-slate-200/80 flex items-center justify-between group shadow-2xs hover:shadow-md min-h-[88px]">
                <div class="flex items-center space-x-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-white text-slate-700 flex items-center justify-center font-bold shadow-xs border border-slate-200/70 group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                        <i class="fas fa-users text-lg text-slate-600"></i>
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Total Siswa</span>
                        <span class="text-sm font-black text-slate-800 mt-0.5">Siap Plotting</span>
                    </div>
                </div>
                <span id="statTotalSiswa" class="relative z-10 text-xs sm:text-sm font-black bg-white text-slate-800 px-3.5 py-2 rounded-xl border border-slate-200 shadow-2xs whitespace-nowrap ml-3">
                    0 Siswa
                </span>
            </div>

            <!-- CARD METODE FIS FUZZY SUGENO -->
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-50/90 via-teal-50/40 to-emerald-50/30 hover:from-emerald-100/80 transition-all duration-300 p-5 rounded-2xl border border-emerald-200/80 flex items-center justify-between group shadow-2xs hover:shadow-md min-h-[88px]">
                <div class="flex items-center space-x-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center font-bold shadow-xs border border-emerald-200/60 group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                        <i class="fas fa-brain text-lg text-emerald-600"></i>
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-600/80">Metode FIS</span>
                        <span class="text-sm font-black text-emerald-950 mt-0.5">Fuzzy Sugeno</span>
                    </div>
                </div>
                <button type="button" onclick="openRuleModal('Umum', '-', '-', '-')" class="relative z-10 text-xs font-black bg-white hover:bg-emerald-600 hover:text-white text-emerald-700 px-3 py-2 rounded-xl border border-emerald-200/80 shadow-2xs whitespace-nowrap ml-3 transition-all flex items-center space-x-1.5 cursor-pointer active:scale-95">
                    <i class="fas fa-table text-xs"></i>
                    <span>9 Rules</span>
                </button>
            </div>

            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-50/90 via-blue-50/40 to-indigo-50/30 hover:from-indigo-100/80 transition-all duration-300 p-5 rounded-2xl border border-indigo-200/80 flex items-center justify-between group shadow-2xs hover:shadow-md min-h-[88px]">
                <div class="flex items-center space-x-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center font-bold shadow-xs border border-indigo-200/60 group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                        <i class="fas fa-sort-amount-down text-lg text-indigo-600"></i>
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-indigo-600/80">Pembobotan</span>
                        <span class="text-sm font-black text-indigo-950 mt-0.5">Metode SAW</span>
                    </div>
                </div>
                <span class="relative z-10 text-xs sm:text-sm font-black bg-white text-indigo-700 px-3.5 py-2 rounded-xl border border-indigo-200/80 shadow-2xs whitespace-nowrap ml-3">
                    W1: 0.6 | W2: 0.4
                </span>
            </div>
        </div>

        <!-- BARIS INPUT PENCARIAN & CETAK PDF -->
        <div class="flex flex-col lg:flex-row items-center gap-4">
            <div class="relative flex items-center w-full group flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-200">
                    <i class="fas fa-search text-sm"></i>
                </div>
                <input type="text" id="calculateSearchInput" placeholder="Cari nama siswa..." 
                    class="w-full h-12 pl-11 pr-4 bg-slate-50/80 hover:bg-slate-100/70 focus:bg-white border border-slate-200 rounded-2xl text-sm font-semibold text-slate-700 placeholder-slate-400 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 shadow-2xs">
            </div>

            <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full lg:w-auto flex-shrink-0">
                <!-- <div class="flex items-center space-x-2 w-full sm:w-auto">
                    <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider whitespace-nowrap"><i class="fas fa-filter mr-1 text-slate-400"></i>Jurusan:</span>
                    <select id="filterJurusan" onchange="renderTableSPK()" class="h-12 bg-slate-50/80 hover:bg-slate-100 border border-slate-200 text-xs font-bold text-slate-700 rounded-2xl px-4 outline-none focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all cursor-pointer shadow-2xs w-full sm:w-auto">
                        <option value="ALL">Semua Jurusan</option>
                        <option value="TKJ">TKJ</option>
                        <option value="RPL">RPL</option>
                        <option value="MM">Multimedia</option>
                    </select>
                </div> -->

                <button type="button" onclick="cetakLaporanSPK()" class="h-12 w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold px-5 rounded-2xl shadow-md shadow-emerald-600/20 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 text-xs uppercase tracking-wider group cursor-pointer whitespace-nowrap border border-emerald-400/20">
                    <i class="fas fa-file-pdf mr-2 text-sm transition-transform group-hover:scale-110 duration-300"></i> Cetak Lap. SPK
                </button>
            </div>
        </div>

    </div>

    <!-- KATEGORI INSTANSI GRADE A & B (TAMPILAN WEB NORMAL) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Grade A -->
        <div class="bg-gradient-to-br from-emerald-50/90 via-teal-50/40 to-white p-6 rounded-3xl border border-emerald-200/80 shadow-md shadow-emerald-900/5 relative overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-emerald-100/80">
                <div class="flex items-center space-x-3">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white flex items-center justify-center font-black text-xs shadow-md shadow-emerald-600/30 flex-shrink-0">A</span>
                    <div>
                        <h3 class="font-extrabold text-emerald-950 text-sm sm:text-base leading-snug">Instansi Grade A (Pemerintah/BUMN/Besar)</h3>
                        <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Syarat Fuzzy: High Output (Nilai = 1.0)</p>
                    </div>
                </div>
                <span class="text-[11px] font-extrabold text-emerald-800 bg-emerald-100/90 px-3 py-1 rounded-full border border-emerald-200 shadow-2xs">6 Instansi</span>
            </div>
            <div id="containerKuotaGradeA" class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs font-bold text-emerald-950">
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-emerald-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-building text-emerald-600 text-xs"></i><span class="truncate">Pengadilan Tinggi Pontianak</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-emerald-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-building text-emerald-600 text-xs"></i><span class="truncate">BKAD (Badan Keuangan & Aset)</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-emerald-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-university text-emerald-600 text-xs"></i><span class="truncate">POLNEP Prodi IT</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-emerald-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-university text-emerald-600 text-xs"></i><span class="truncate">POLNEP UPATIK</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-emerald-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-graduation-cap text-emerald-600 text-xs"></i><span class="truncate">UBSI Pontianak</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-emerald-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-industry text-emerald-600 text-xs"></i><span class="truncate">PT Ketel Uap</span></div>
            </div>
        </div>

        <!-- Card Grade B -->
        <div class="bg-gradient-to-br from-amber-50/90 via-orange-50/40 to-white p-6 rounded-3xl border border-amber-200/80 shadow-md shadow-amber-900/5 relative overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-amber-100/80">
                <div class="flex items-center space-x-3">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-amber-600 to-orange-600 text-white flex items-center justify-center font-black text-xs shadow-md shadow-amber-600/30 flex-shrink-0">B</span>
                    <div>
                        <h3 class="font-extrabold text-amber-950 text-sm sm:text-base leading-snug">Instansi Grade B (Swasta/Menengah/UMKM)</h3>
                        <p class="text-[11px] text-amber-700 font-semibold mt-0.5">Syarat Fuzzy: Medium Output (Nilai = 0.5)</p>
                    </div>
                </div>
                <span class="text-[11px] font-extrabold text-amber-800 bg-amber-100/90 px-3 py-1 rounded-full border border-amber-200 shadow-2xs">6 Instansi</span>
            </div>
            <div id="containerKuotaGradeB" class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs font-bold text-amber-950">
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-amber-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-laptop text-amber-600 text-xs"></i><span class="truncate">EC Computer</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-amber-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-video text-amber-600 text-xs"></i><span class="truncate">Host CCTV</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-amber-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-briefcase text-amber-600 text-xs"></i><span class="truncate">PT Bagas Kara Adji Putra</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-amber-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-store text-amber-600 text-xs"></i><span class="truncate">BUMDes Kopri Serdam</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-amber-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-store text-amber-600 text-xs"></i><span class="truncate">BUMDes Parit Baru</span></div>
                <div class="flex items-center space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border border-amber-100/80 shadow-2xs hover:bg-white transition-colors"><i class="fas fa-city text-amber-600 text-xs"></i><span class="truncate">PT Kreasi Putra Hotama</span></div>
            </div>
        </div>
    </div>

    <!-- MAIN TABLE SECTION DENGAN KOP & CARD KHUSUS CETAK PDF -->
    <div id="printableTableSection" class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
        
        <!-- KOP DOKUMEN CETAK LAPORAN DENGAN LOGO SEKOLAH -->
        <div class="print-only-header">
            <img src="{{ asset('img/logo_smk.png') }}" alt="Logo Sekolah">
            <div class="print-header-text">
                <h2 style="font-size: 15pt; font-weight: 900; margin: 0; text-transform: uppercase; color: #0f172a; letter-spacing: 0.5px;">LAPORAN HASIL REKOMENDASI PENEMPATAN MAGANG</h2>
                <h3 style="font-size: 10pt; font-weight: 700; margin: 3px 0; color: #334155;">SISTEM PENDUKUNG KEPUTUSAN (FUZZY SUGENO + SAW)</h3>
                <p style="font-size: 8pt; color: #64748b; margin-top: 3px; font-style: italic;">Sistem Informasi E-PRAKERIN — Dicetak pada: <span id="printDateString"></span></p>
            </div>
        </div>

        <!-- CARD GRADE A & GRADE B KHUSUS DITAMPILKAN DI ATAS TABEL DI PDF -->
        <div class="print-only-cards">
            <!-- Card PDF Grade A -->
            <div class="print-card-box">
                <div class="print-card-header">
                    <span>Grade A (Pemerintah/BUMN/Besar)</span>
                    <span style="color: #047857;">[Score 1.0]</span>
                </div>
                <div class="print-card-grid">
                    <div class="print-card-item">• Pengadilan Tinggi</div>
                    <div class="print-card-item">• POLNEP UPATIK</div>
                    <div class="print-card-item">• BKAD Pontianak</div>
                    <div class="print-card-item">• UBSI Pontianak</div>
                    <div class="print-card-item">• POLNEP Prodi IT</div>
                    <div class="print-card-item">• PT Ketel Uap</div>
                </div>
            </div>

            <!-- Card PDF Grade B -->
            <div class="print-card-box">
                <div class="print-card-header">
                    <span>Grade B (Swasta/Menengah/UMKM)</span>
                    <span style="color: #b45309;">[Score 0.5]</span>
                </div>
                <div class="print-card-grid">
                    <div class="print-card-item">• EC Computer</div>
                    <div class="print-card-item">• BUMDes Kopri Serdam</div>
                    <div class="print-card-item">• Host CCTV</div>
                    <div class="print-card-item">• BUMDes Parit Baru</div>
                    <div class="print-card-item">• PT Bagas Kara Adji</div>
                    <div class="print-card-item">• PT Kreasi Putra Hotama</div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[1000px]">
                <thead>
                    <tr class="bg-slate-50/90 text-slate-500 uppercase text-[10px] font-black tracking-wider border-b border-slate-100">
                        <th style="width: 25%;" class="px-2.5 py-3 align-middle">Siswa</th>
                        <th style="width: 10%;" class="px-1.5 py-3 text-center align-middle">C1 (Hard)</th>
                        <th style="width: 10%;" class="px-1.5 py-3 text-center align-middle">C2 (Soft)</th>
                        <th style="width: 12%;" class="px-1.5 py-3 text-center align-middle">Hasil Sugeno</th>
                        <th style="width: 8%;" class="px-1.5 py-3 text-center align-middle">Norm R1</th>
                        <th style="width: 8%;" class="px-1.5 py-3 text-center align-middle">Norm R2</th>
                        <th style="width: 11%;" class="px-1.5 py-3 text-center align-middle">Nilai SAW (V)</th>
                        <th style="width: 26%;" class="px-2.5 py-3 align-middle">Rekomendasi Instansi</th>
                        <th style="width: 10%;" class="px-1.5 py-3 text-center align-middle no-print">Detail & Aksi</th>
                    </tr>
                </thead>
                <tbody id="calculateTableBody" class="divide-y divide-slate-100 text-xs">
                    <tr id="emptyPlaceholderRow">
                        <td colspan="9" class="px-6 py-16 text-center text-slate-400 bg-slate-50/30">
                            <div class="max-w-xs mx-auto flex flex-col items-center">
                                <div class="w-16 h-16 rounded-3xl bg-slate-100/80 border border-slate-200/80 flex items-center justify-center text-slate-400 text-2xl mb-4 shadow-inner">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <p class="font-extrabold text-slate-700 text-base">Belum Ada Data Kalkulasi</p>
                                <p class="text-xs text-slate-400 mt-1 mb-4 leading-relaxed">Silakan pilih Siswa Aktif pada Form Input di atas untuk menghitung rekomendasi penempatan.</p>
                            </div>
                        </td>
                    </tr>

                    <tr id="noResultRow" class="hidden">
                        <td colspan="9" class="px-6 py-10 text-center text-slate-400 bg-slate-50/30 italic text-xs font-semibold">
                            <i class="fas fa-search-minus mr-2 text-slate-300 text-base"></i>
                            Tidak ditemukan nama siswa yang cocok dengan kata kunci pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL EDIT SISWA -->
<div id="modalEditSiswa" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden animate-fade-in my-8">
        <div class="p-6 bg-slate-900 text-white flex justify-between items-center relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="font-black text-lg text-white" id="modalEditNamaTitle">Edit Nilai Siswa</h3>
                <p class="text-xs text-slate-300 mt-0.5 font-medium">Ubah kriteria nilai C1 dan C2</p>
            </div>
            <button onclick="closeEditModal()" class="relative z-10 w-9 h-9 rounded-full bg-slate-800 text-slate-300 hover:text-white hover:bg-slate-700 flex items-center justify-center transition-all cursor-pointer">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        <form onsubmit="simpanEditSiswa(event)" class="p-6 space-y-4">
            <input type="hidden" id="editNamaTarget">
            <div>
                <label class="block text-xs font-extrabold text-slate-600 uppercase mb-1">Nama Siswa</label>
                <input type="text" id="editNamaDisplay" readonly class="w-full px-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 cursor-not-allowed">
            </div>
            <div>
                <label class="block text-xs font-extrabold text-slate-600 uppercase mb-1">Nilai Akademik (C1)</label>
                <input type="number" id="editNilaiC1" min="0" max="100" step="0.1" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-xs font-extrabold text-slate-600 uppercase mb-1">Nilai Kehadiran (C2)</label>
                <input type="number" id="editNilaiC2" min="0" max="100" step="0.1" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div class="pt-2 flex items-center justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-slate-100 text-slate-600 font-extrabold rounded-xl text-xs hover:bg-slate-200 transition-all cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-extrabold rounded-xl text-xs hover:bg-blue-500 transition-all cursor-pointer shadow-md shadow-blue-600/20">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL HAPUS SISWA -->
<div id="modalHapusSiswa" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-sm overflow-hidden animate-fade-in my-8 text-center p-6">
        <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold mx-auto mb-4 text-lg">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 class="font-black text-slate-800 text-base">Hapus Siswa dari Tabel?</h3>
        <p class="text-xs text-slate-500 mt-1">Apakah Anda yakin ingin menghapus <span id="hapusNamaDisplay" class="font-extrabold text-slate-700"></span> dari daftar kalkulasi?</p>
        <div class="mt-6 flex items-center justify-center space-x-3">
            <button onclick="closeHapusModal()" class="px-4 py-2.5 bg-slate-100 text-slate-600 font-extrabold rounded-xl text-xs hover:bg-slate-200 transition-all cursor-pointer w-full">Batal</button>
            <button onclick="eksekusiHapusSiswa()" class="px-4 py-2.5 bg-rose-600 text-white font-extrabold rounded-xl text-xs hover:bg-rose-500 transition-all cursor-pointer w-full shadow-md shadow-rose-600/20">Hapus</button>
        </div>
    </div>
</div>

<!-- MODAL EVALUASI 9 RULE FUZZY SUGENO -->
<div id="ruleModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-2xl overflow-hidden animate-fade-in my-8">
        <div class="p-6 bg-slate-900 text-white flex justify-between items-center relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative z-10">
                <h3 class="font-black text-lg text-white" id="modalStudentName">Detail Evaluasi Fuzzy Sugeno</h3>
                <p class="text-xs text-slate-300 mt-0.5 font-medium">Analisis 9 Rule Keputusan Penempatan Magang</p>
            </div>
            <button onclick="closeRuleModal()" class="relative z-10 w-9 h-9 rounded-full bg-slate-800 text-slate-300 hover:text-white hover:bg-slate-700 flex items-center justify-center transition-all cursor-pointer">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        <div class="p-6 space-y-5">
            <div class="grid grid-cols-3 gap-3.5 text-center">
                <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100 shadow-2xs">
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Hard Skill (C1)</p>
                    <p class="text-base font-black text-slate-800 mt-1" id="modalC1">-</p>
                </div>
                <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100 shadow-2xs">
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Soft Skill (C2)</p>
                    <p class="text-base font-black text-slate-800 mt-1" id="modalC2">-</p>
                </div>
                <div class="bg-blue-50/80 p-3.5 rounded-2xl border border-blue-100 shadow-2xs">
                    <p class="text-[10px] font-extrabold text-blue-600 uppercase tracking-wider">Score Defuzifikasi</p>
                    <p class="text-base font-black text-blue-700 mt-1" id="modalScore">-</p>
                </div>
            </div>

            <!-- TABEL RULE -->
            <div class="border rounded-2xl overflow-hidden border-slate-200/80 shadow-2xs">
                <table class="w-full text-xs text-left border-collapse">
                    <thead class="bg-slate-100/80 text-slate-600 font-extrabold uppercase text-[10px] tracking-wider border-b border-slate-200/80">
                        <tr>
                            <th class="p-3.5 w-24">RULE</th>
                            <th class="p-3.5">KONDISI (HARD SKILL & SOFT SKILL)</th>
                            <th class="p-3.5 text-center w-40">OUTPUT GRADE</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 1</td>
                            <td class="p-3.5">Hard Skill Kurang & Soft Skill Kurang</td>
                            <td class="p-3.5 text-center font-bold text-amber-800 bg-amber-50">Grade B (0.5)</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 2</td>
                            <td class="p-3.5">Hard Skill Kurang & Soft Skill Cukup</td>
                            <td class="p-3.5 text-center font-bold text-amber-800 bg-amber-50">Grade B (0.5)</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 3</td>
                            <td class="p-3.5">Hard Skill Kurang & Soft Skill Sangat Baik</td>
                            <td class="p-3.5 text-center font-bold text-amber-800 bg-amber-50">Grade B (0.5)</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 4</td>
                            <td class="p-3.5">Hard Skill Cukup & Soft Skill Kurang</td>
                            <td class="p-3.5 text-center font-bold text-amber-800 bg-amber-50">Grade B (0.5)</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 5</td>
                            <td class="p-3.5">Hard Skill Cukup & Soft Skill Cukup</td>
                            <td class="p-3.5 text-center font-bold text-amber-800 bg-amber-50">Grade B (0.5)</td>
                        </tr>
                        <tr class="hover:bg-emerald-50/60 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 6</td>
                            <td class="p-3.5 font-bold text-emerald-950">Hard Skill Cukup & Soft Skill Sangat Baik</td>
                            <td class="p-3.5 text-center font-bold text-emerald-800 bg-emerald-100/70">Grade A (1.0)</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 7</td>
                            <td class="p-3.5">Hard Skill Baik & Soft Skill Kurang</td>
                            <td class="p-3.5 text-center font-bold text-amber-800 bg-amber-50">Grade B (0.5)</td>
                        </tr>
                        <tr class="hover:bg-emerald-50/60 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 8</td>
                            <td class="p-3.5 font-bold text-emerald-950">Hard Skill Baik & Soft Skill Cukup</td>
                            <td class="p-3.5 text-center font-bold text-emerald-800 bg-emerald-100/70">Grade A (1.0)</td>
                        </tr>
                        <tr class="hover:bg-emerald-50/60 transition-colors">
                            <td class="p-3.5 font-bold text-slate-500">Rule 9</td>
                            <td class="p-3.5 font-bold text-emerald-950">Hard Skill Baik & Soft Skill Sangat Baik</td>
                            <td class="p-3.5 text-center font-bold text-emerald-800 bg-emerald-100/70">Grade A (1.0)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4 bg-slate-50 text-right border-t border-slate-100">
            <button onclick="closeRuleModal()" class="px-5 py-2.5 bg-slate-800 text-white font-extrabold rounded-xl text-xs hover:bg-slate-700 transition-all cursor-pointer shadow-xs">Tutup</button>
        </div>
    </div>
</div>

<!-- MODAL BREAKDOWN PERHITUNGAN MATEMATIS AKADEMIS -->
<div id="modalMathBreakdown" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-3xl overflow-hidden animate-fade-in my-8">
        <div class="p-6 bg-slate-900 text-white flex justify-between items-center relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="font-black text-lg text-white" id="mathNamaTitle">Breakdown Perhitungan SPK</h3>
                <p class="text-xs text-slate-300 mt-0.5 font-medium">Langkah Matematis Transparan: Fuzzifikasi, Sugeno FIS, & SAW</p>
            </div>
            <button onclick="closeMathModal()" class="relative z-10 w-9 h-9 rounded-full bg-slate-800 text-slate-300 hover:text-white hover:bg-slate-700 flex items-center justify-center transition-all cursor-pointer">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        
        <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto text-xs text-slate-700">
            
            <!-- LANGKAH 1: FUZZIFIKASI -->
            <div class="space-y-2.5">
                <div class="flex items-center space-x-2 text-blue-700 font-extrabold text-sm border-b border-blue-100 pb-1.5">
                    <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs">1</span>
                    <h4>Tahap Fuzzifikasi (Kategori Himpunan Fuzzy)</h4>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-slate-50 p-3.5 rounded-2xl border border-slate-200/80">
                    <div>
                        <span class="font-extrabold text-slate-500 uppercase">Nilai Hard Skill (C1): <strong id="m_c1_val" class="text-slate-800"></strong></span>
                        <p class="mt-1 font-bold text-blue-600" id="m_c1_cat">-</p>
                    </div>
                    <div>
                        <span class="font-extrabold text-slate-500 uppercase">Nilai Kehadiran (C2): <strong id="m_c2_val" class="text-slate-800"></strong></span>
                        <p class="mt-1 font-bold text-indigo-600" id="m_c2_cat">-</p>
                    </div>
                </div>
            </div>

            <!-- LANGKAH 2: EVALUASI SUGENO -->
            <div class="space-y-2.5">
                <div class="flex items-center space-x-2 text-emerald-700 font-extrabold text-sm border-b border-emerald-100 pb-1.5">
                    <span class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">2</span>
                    <h4>Tahap Inferensi & Defuzzifikasi Fuzzy Sugeno</h4>
                </div>
                <div class="bg-emerald-50/60 p-3.5 rounded-2xl border border-emerald-200/80 space-y-2">
                    <p class="font-medium">Rule Aktif Terpenuhi: <strong id="m_sugeno_rule" class="text-emerald-900 font-bold">Rule -</strong></p>
                    <div class="flex justify-between items-center bg-white p-2.5 rounded-xl border border-emerald-100">
                        <span class="font-extrabold text-slate-600">Output Defuzzifikasi ($z$):</span>
                        <span id="m_sugeno_score" class="font-black text-emerald-700 text-sm"></span>
                    </div>
                </div>
            </div>

            <!-- LANGKAH 3: NORMALISASI SAW & PREFERENSI -->
            <div class="space-y-2.5">
                <div class="flex items-center space-x-2 text-indigo-700 font-extrabold text-sm border-b border-indigo-100 pb-1.5">
                    <span class="w-6 h-6 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs">3</span>
                    <h4>Tahap Pembobotan & Normalisasi SAW (Simple Additive Weighting)</h4>
                </div>
                <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-200/80 space-y-3">
                    <div class="grid grid-cols-2 gap-2 text-center">
                        <div class="bg-white p-2 rounded-xl border border-slate-200">
                            <span class="text-[10px] font-bold text-slate-400 block">Norm $r_1$ (Akademik)</span>
                            <span id="m_r1_val" class="font-extrabold text-slate-800 text-xs"></span>
                        </div>
                        <div class="bg-white p-2 rounded-xl border border-slate-200">
                            <span class="text-[10px] font-bold text-slate-400 block">Norm $r_2$ (Kehadiran)</span>
                            <span id="m_r2_val" class="font-extrabold text-slate-800 text-xs"></span>
                        </div>
                    </div>
                    <div class="p-3 bg-indigo-50/80 rounded-xl border border-indigo-100 space-y-1">
                        <span class="font-extrabold text-indigo-900">Rumus Nilai Preferensi ($V_i$):</span>
                        <p class="font-mono text-[11px] text-indigo-800" id="m_saw_formula">$V_i = (W_1 \times r_1) + (W_2 \times r_2)$</p>
                        <div class="pt-1 flex justify-between items-center">
                            <span class="font-extrabold text-slate-700">Skor Akhir Preferensi ($V$):</span>
                            <span id="m_v_final" class="font-black text-indigo-700 text-sm"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="p-4 bg-slate-50 text-right border-t border-slate-100">
            <button onclick="closeMathModal()" class="px-5 py-2.5 bg-slate-800 text-white font-extrabold rounded-xl text-xs hover:bg-slate-700 transition-all cursor-pointer shadow-xs">Tutup</button>
        </div>
    </div>
</div>

<script>
    let listSiswaSPK = JSON.parse(localStorage.getItem('spk_siswa_data')) || [];
    let targetHapusNama = null;
    let selectedSiswaData = null;

    const MAX_KUOTA_PER_INSTANSI = 5;

    const instansiGradeA = [
        "Pengadilan Tinggi Pontianak",
        "BKAD (Badan Keuangan dan Aset Daerah)",
        "POLNEP Prodi IT (Politeknik Negeri Pontianak)",
        "POLNEP UPATIK",
        "UBSI Pontianak (Universitas BSI)",
        "PT Ketel Uap"
    ];

    const instansiGradeB = [
        "EC Computer",
        "Host CCTV",
        "PT Bagas Kara Adji Putra",
        "BUMDes Kopri Serdam",
        "BUMDes Parit Baru",
        "PT Kreasi Putra Hotama"
    ];

    // FUNGSI KHUSUS CETAK LAPORAN DENGAN HEADER TANGGAL DAN TEKS PILIHAN INSTANSI
    function cetakLaporanSPK() {
        const dateElem = document.getElementById('printDateString');
        if (dateElem) {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            dateElem.textContent = now.toLocaleDateString('id-ID', options);
        }

        // Sync nilai pilihan dropdown ke span print-selected-text
        const rows = document.querySelectorAll('#calculateTableBody tr.calculate-row');
        rows.forEach(row => {
            const select = row.querySelector('.print-select-container select');
            const spanText = row.querySelector('.print-selected-text');
            if (select && spanText) {
                spanText.textContent = select.value;
            }
        });

        window.print();
    }

    // FUNGSI REAL-TIME UPDATE CARD MONITORING KUOTA INSTANSI
    function updateCardKuotaMonitoring() {
        const containerA = document.getElementById('containerKuotaGradeA');
        const containerB = document.getElementById('containerKuotaGradeB');

        let kuotaTerpakaiA = {};
        instansiGradeA.forEach(i => kuotaTerpakaiA[i] = 0);

        let kuotaTerpakaiB = {};
        instansiGradeB.forEach(i => kuotaTerpakaiB[i] = 0);

        const allSelects = document.querySelectorAll('#calculateTableBody select');
        
        allSelects.forEach(selectElem => {
            const selectedVal = selectElem.value;
            if (kuotaTerpakaiA[selectedVal] !== undefined) {
                kuotaTerpakaiA[selectedVal]++;
            } else if (kuotaTerpakaiB[selectedVal] !== undefined) {
                kuotaTerpakaiB[selectedVal]++;
            }

            const parent = selectElem.closest('.print-select-container');
            if (parent) {
                const printSpan = parent.querySelector('.print-selected-text');
                if (printSpan) printSpan.textContent = selectedVal;
            }
        });

        if (containerA) {
            containerA.innerHTML = instansiGradeA.map(inst => {
                const terisi = kuotaTerpakaiA[inst] || 0;
                const sisa = Math.max(0, MAX_KUOTA_PER_INSTANSI - terisi);
                const isFull = sisa === 0;

                return `
                    <div class="flex items-center justify-between space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border ${isFull ? 'border-rose-200 bg-rose-50/50' : 'border-emerald-100/80'} shadow-2xs hover:bg-white transition-colors">
                        <div class="flex items-center space-x-2 min-w-0">
                            <i class="fas fa-building text-emerald-600 text-xs flex-shrink-0"></i>
                            <span class="truncate" title="${inst}">${inst}</span>
                        </div>
                        <span class="text-[10px] font-black px-2 py-0.5 rounded-md flex-shrink-0 ${isFull ? 'bg-rose-600 text-white' : 'bg-emerald-100 text-emerald-800'}">
                            ${isFull ? 'FULL' : `Sisa ${sisa}`}
                        </span>
                    </div>
                `;
            }).join('');
        }

        if (containerB) {
            containerB.innerHTML = instansiGradeB.map(inst => {
                const terisi = kuotaTerpakaiB[inst] || 0;
                const sisa = Math.max(0, MAX_KUOTA_PER_INSTANSI - terisi);
                const isFull = sisa === 0;

                return `
                    <div class="flex items-center justify-between space-x-2.5 bg-white/80 backdrop-blur-xs p-2.5 rounded-xl border ${isFull ? 'border-rose-200 bg-rose-50/50' : 'border-amber-100/80'} shadow-2xs hover:bg-white transition-colors">
                        <div class="flex items-center space-x-2 min-w-0">
                            <i class="fas fa-laptop text-amber-600 text-xs flex-shrink-0"></i>
                            <span class="truncate" title="${inst}">${inst}</span>
                        </div>
                        <span class="text-[10px] font-black px-2 py-0.5 rounded-md flex-shrink-0 ${isFull ? 'bg-rose-600 text-white' : 'bg-amber-100 text-amber-800'}">
                            ${isFull ? 'FULL' : `Sisa ${sisa}`}
                        </span>
                    </div>
                `;
            }).join('');
        }
    }

    function toggleCustomDropdown() {
        const menu = document.getElementById('customDropdownMenu');
        const arrow = document.getElementById('dropdownArrow');
        const searchInput = document.getElementById('inputSearchDropdownSiswa');
        
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            if (arrow) arrow.style.transform = 'rotate(180deg)';
            
            setTimeout(() => {
                if (searchInput) {
                    searchInput.value = '';
                    searchInput.focus();
                    filterSiswaDropdown();
                }
            }, 50);
        } else {
            menu.classList.add('hidden');
            if (arrow) arrow.style.transform = 'rotate(0deg)';
        }
    }

    function filterSiswaDropdown() {
        const searchInput = document.getElementById('inputSearchDropdownSiswa');
        if (!searchInput) return;

        const query = searchInput.value.toLowerCase().trim();
        const items = document.querySelectorAll('#customDropdownList .custom-option-item');
        const notFound = document.getElementById('notFoundDropdown');
        let foundCount = 0;

        items.forEach(item => {
            if (item.classList.contains('hidden-spk')) {
                item.style.display = 'none';
                return;
            }

            const namaAttr = (item.getAttribute('data-nama-search') || item.getAttribute('data-nama') || '').toLowerCase();
            const nisAttr = (item.getAttribute('data-nis') || '').toLowerCase();

            if (namaAttr.includes(query) || nisAttr.includes(query)) {
                item.style.display = 'flex';
                foundCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (notFound) {
            if (foundCount === 0 && query !== '') {
                notFound.classList.remove('hidden');
            } else {
                notFound.classList.add('hidden');
            }
        }
    }

    function selectCustomSiswaOption(elem, idSiswa) {
        const nativeSelect = document.getElementById('selectSiswaAktif');
        const labelDisplay = document.getElementById('customDropdownLabel');
        
        const nama = elem.getAttribute('data-nama') || elem.querySelector('.item-nama')?.textContent.trim();
        const nis = elem.getAttribute('data-nis');
        const jurusan = elem.getAttribute('data-jurusan');
        const c1 = elem.getAttribute('data-c1');
        const c2 = elem.getAttribute('data-c2');

        selectedSiswaData = { nama, nis, jurusan, id: idSiswa };

        if (nativeSelect) nativeSelect.value = idSiswa;

        if (c1 && c1 !== '') document.getElementById('inputNilaiC1').value = c1;
        if (c2 && c2 !== '') document.getElementById('inputNilaiC2').value = c2;

        if (labelDisplay) {
            labelDisplay.innerHTML = `<span class="font-bold text-slate-800">${nama}</span> <span class="text-xs text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">NIS: ${nis}</span> <span class="text-xs text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded border border-blue-100 font-bold">${jurusan}</span>`;
        }

        toggleCustomDropdown();
    }

    function resetCustomDropdown() {
        const nativeSelect = document.getElementById('selectSiswaAktif');
        const labelDisplay = document.getElementById('customDropdownLabel');
        
        if (nativeSelect) nativeSelect.selectedIndex = 0;
        selectedSiswaData = null;
        if (labelDisplay) {
            labelDisplay.innerHTML = `<span class="truncate text-slate-500">-- Pilih Siswa Aktif --</span>`;
        }
    }

    function evalFuzzySugeno(c1, c2) {
        let hardSkill = "Kurang";
        if (c1 >= 80) hardSkill = "Baik";
        else if (c1 >= 70) hardSkill = "Cukup";

        let softSkill = "Kurang";
        if (c2 >= 85) softSkill = "Sangat Baik";
        else if (c2 >= 70) softSkill = "Cukup";

        if (hardSkill === "Cukup" && softSkill === "Sangat Baik") return { score: 1.0, grade: "A", rule: "Rule 6" };
        if (hardSkill === "Baik" && softSkill === "Cukup") return { score: 1.0, grade: "A", rule: "Rule 8" };
        if (hardSkill === "Baik" && softSkill === "Sangat Baik") return { score: 1.0, grade: "A", rule: "Rule 9" };

        let ruleText = "Rule 1";
        if (hardSkill === "Kurang" && softSkill === "Cukup") ruleText = "Rule 2";
        if (hardSkill === "Kurang" && softSkill === "Sangat Baik") ruleText = "Rule 3";
        if (hardSkill === "Cukup" && softSkill === "Kurang") ruleText = "Rule 4";
        if (hardSkill === "Cukup" && softSkill === "Cukup") ruleText = "Rule 5";
        if (hardSkill === "Baik" && softSkill === "Kurang") ruleText = "Rule 7";

        return { score: 0.5, grade: "B", rule: ruleText, hardSkill, softSkill };
    }

    function prosesKalkulasiSPK(e) {
        e.preventDefault();

        if (!selectedSiswaData || !selectedSiswaData.nama) {
            alert('Silakan pilih siswa aktif terlebih dahulu.');
            return;
        }

        const nama = selectedSiswaData.nama;
        const nis = selectedSiswaData.nis || '-';
        const jurusan = selectedSiswaData.jurusan || 'TKJ';
        const c1 = parseFloat(document.getElementById('inputNilaiC1').value);
        const c2 = parseFloat(document.getElementById('inputNilaiC2').value);

        if (!nama || isNaN(c1) || isNaN(c2)) return;

        const indexExisting = listSiswaSPK.findIndex(s => s.nama.toLowerCase() === nama.toLowerCase());
        const fuzzy = evalFuzzySugeno(c1, c2);

        if (indexExisting !== -1) {
            listSiswaSPK[indexExisting] = { nama, nis, jurusan, c1, c2, fuzzyScore: fuzzy.score, grade: fuzzy.grade, rule: fuzzy.rule, hardSkill: fuzzy.hardSkill, softSkill: fuzzy.softSkill };
        } else {
            listSiswaSPK.push({ nama, nis, jurusan, c1, c2, fuzzyScore: fuzzy.score, grade: fuzzy.grade, rule: fuzzy.rule, hardSkill: fuzzy.hardSkill, softSkill: fuzzy.softSkill });
        }

        localStorage.setItem('spk_siswa_data', JSON.stringify(listSiswaSPK));

        resetCustomDropdown();
        document.getElementById('inputNilaiC1').value = '';
        document.getElementById('inputNilaiC2').value = '';

        renderTableSPK();
        bukaModalSukses(nama, c1, c2);
    }

    function bukaModalSukses(nama, c1, c2) {
        const modal = document.getElementById('modalKalkulasiSukses');
        const modalContent = document.getElementById('modalCardContent');

        if (!modal) return;

        if (document.getElementById('popSiswaNama')) document.getElementById('popSiswaNama').textContent = nama;
        if (document.getElementById('popNilaiC1')) document.getElementById('popNilaiC1').textContent = c1;
        if (document.getElementById('popNilaiC2')) document.getElementById('popNilaiC2').textContent = c2;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            if (modalContent) {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }
        }, 10);
    }

    function tutupModalSukses() {
        const modal = document.getElementById('modalKalkulasiSukses');
        const modalContent = document.getElementById('modalCardContent');

        if (!modal) return;

        if (modalContent) {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
        }

        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }

    function updateDropdownOptions() {
        const existingNames = listSiswaSPK.map(s => s.nama.toLowerCase());
        const customItems = document.querySelectorAll('.custom-option-item');

        customItems.forEach(item => {
            const namaItem = (item.getAttribute('data-nama') || '').toLowerCase();
            if (existingNames.includes(namaItem)) {
                item.classList.add('hidden-spk');
                item.style.display = 'none';
            } else {
                item.classList.remove('hidden-spk');
                item.style.display = 'flex';
            }
        });
    }

    function editSiswaSPK(nama) {
        const item = listSiswaSPK.find(s => s.nama === nama);
        if (!item) return;

        document.getElementById('editNamaTarget').value = item.nama;
        document.getElementById('editNamaDisplay').value = item.nama;
        document.getElementById('modalEditNamaTitle').textContent = 'Siswa: ' + item.nama;
        document.getElementById('editNilaiC1').value = item.c1;
        document.getElementById('editNilaiC2').value = item.c2;

        document.getElementById('modalEditSiswa').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('modalEditSiswa').classList.add('hidden');
    }

    function simpanEditSiswa(e) {
        e.preventDefault();

        const nama = document.getElementById('editNamaTarget').value;
        const c1 = parseFloat(document.getElementById('editNilaiC1').value);
        const c2 = parseFloat(document.getElementById('editNilaiC2').value);

        if (!nama || isNaN(c1) || isNaN(c2)) return;

        const indexExisting = listSiswaSPK.findIndex(s => s.nama === nama);
        if (indexExisting !== -1) {
            const fuzzy = evalFuzzySugeno(c1, c2);
            listSiswaSPK[indexExisting] = { ...listSiswaSPK[indexExisting], c1, c2, fuzzyScore: fuzzy.score, grade: fuzzy.grade, rule: fuzzy.rule, hardSkill: fuzzy.hardSkill, softSkill: fuzzy.softSkill };
            localStorage.setItem('spk_siswa_data', JSON.stringify(listSiswaSPK));
            renderTableSPK();
        }

        closeEditModal();
    }

    function hapusSiswaSPK(nama) {
        targetHapusNama = nama;
        document.getElementById('hapusNamaDisplay').textContent = `"${nama}"`;
        document.getElementById('modalHapusSiswa').classList.remove('hidden');
    }

    function closeHapusModal() {
        targetHapusNama = null;
        document.getElementById('modalHapusSiswa').classList.add('hidden');
    }

    function eksekusiHapusSiswa() {
        if (!targetHapusNama) return;

        listSiswaSPK = listSiswaSPK.filter(s => s.nama !== targetHapusNama);
        localStorage.setItem('spk_siswa_data', JSON.stringify(listSiswaSPK));

        renderTableSPK();
        closeHapusModal();
    }

    // FUNGSI UTAMA RENDER TABEL HASIL SPK & FILTERING
    function renderTableSPK() {
        const tableBody = document.getElementById('calculateTableBody');
        const emptyRow = document.getElementById('emptyPlaceholderRow');
        const statTotal = document.getElementById('statTotalSiswa');
        const filterJurusanVal = document.getElementById('filterJurusan') ? document.getElementById('filterJurusan').value : 'ALL';

        if (statTotal) statTotal.textContent = listSiswaSPK.length + " Siswa";

        updateDropdownOptions();

        if (!tableBody) return;

        let filteredSiswa = listSiswaSPK;
        if (filterJurusanVal !== 'ALL') {
            filteredSiswa = listSiswaSPK.filter(s => (s.jurusan || '').toUpperCase().includes(filterJurusanVal));
        }

        if (filteredSiswa.length === 0) {
            if (emptyRow) emptyRow.classList.remove('hidden');
            const oldRows = tableBody.querySelectorAll('.calculate-row');
            oldRows.forEach(row => row.remove());
            updateCardKuotaMonitoring();
            return;
        } else {
            if (emptyRow) emptyRow.classList.add('hidden');
        }

        let maxC1 = Math.max(100, ...listSiswaSPK.map(s => s.c1));
        let maxC2 = Math.max(100, ...listSiswaSPK.map(s => s.c2));

        // Kalkulasi Matriks Normalisasi & Nilai Preferensi SAW
        let calculated = filteredSiswa.map(s => {
            let r1 = maxC1 > 0 ? (s.c1 / maxC1) : 1;
            let r2 = maxC2 > 0 ? (s.c2 / maxC2) : 1;
            
            let v_saw = (0.6 * r1) + (0.4 * r2);

            return {
                ...s,
                r1: r1.toFixed(2),
                r2: r2.toFixed(2),
                finalScore: v_saw.toFixed(2)
            };
        });

        calculated.sort((a, b) => b.finalScore - a.finalScore);

        const oldRows = tableBody.querySelectorAll('.calculate-row');
        oldRows.forEach(row => row.remove());

        let kuotaTerpakaiA = {};
        instansiGradeA.forEach(i => kuotaTerpakaiA[i] = 0);

        let kuotaTerpakaiB = {};
        instansiGradeB.forEach(i => kuotaTerpakaiB[i] = 0);

        calculated.forEach((row, idx) => {
            const isGradeA = row.grade === 'A';
            const tr = document.createElement('tr');
            tr.className = "calculate-row hover:bg-slate-50/80 transition-colors duration-150 border-b border-slate-200 divide-x divide-slate-200";

            let targetInstansiList = isGradeA ? instansiGradeA : instansiGradeB;
            let kuotaTracker = isGradeA ? kuotaTerpakaiA : kuotaTerpakaiB;

            let defaultInstansi = targetInstansiList.find(i => kuotaTracker[i] < MAX_KUOTA_PER_INSTANSI);
            if (!defaultInstansi) {
                defaultInstansi = targetInstansiList[targetInstansiList.length - 1];
            }

            if (kuotaTracker[defaultInstansi] !== undefined) {
                kuotaTracker[defaultInstansi]++;
            }

            let selectOptions = targetInstansiList.map(inst => {
                const isSelected = inst === defaultInstansi ? 'selected' : '';
                return `<option value="${inst}" ${isSelected}>
                    ${isGradeA ? '★ ' : ''}${inst}
                </option>`;
            }).join('');

            let optionsHTML = `
                <optgroup label="Rekomendasi SPK (${isGradeA ? 'Grade A - Pemerintah/BUMN' : 'Grade B - Swasta/UMKM'})">
                    ${selectOptions}
                </optgroup>
            `;

            tr.innerHTML = `
                <td class="px-2.5 py-2.5 align-middle col-siswa">
                    <div class="flex items-center space-x-2 overflow-hidden">
                        <div class="h-7 w-7 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-black text-[11px] flex-shrink-0 shadow-xs no-print">
                            ${row.nama.charAt(0).toUpperCase()}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="font-extrabold text-slate-800 text-xs name-cell leading-tight truncate">${row.nama}</div>
                            <div class="flex items-center space-x-1 mt-0.5">
                                <span class="text-[9px] text-slate-500 font-extrabold bg-slate-100 px-1 py-0.2 rounded border border-slate-200/60 truncate">
                                    NIS: ${row.nis || '-'}
                                </span>
                                <span class="text-[9px] text-blue-600 font-extrabold bg-blue-50 px-1 py-0.2 rounded border border-blue-100 truncate">
                                    ${row.jurusan || 'TKJ'}
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-1.5 py-2.5 text-center align-middle">
                    <span class="font-bold text-slate-700 text-[11px] bg-slate-50 border border-slate-200/80 px-1.5 py-0.5 rounded shadow-2xs">${row.c1}</span>
                </td>
                <td class="px-1.5 py-2.5 text-center align-middle">
                    <span class="font-bold text-slate-700 text-[11px] bg-slate-50 border border-slate-200/80 px-1.5 py-0.5 rounded shadow-2xs">${row.c2}</span>
                </td>
                <td class="px-1.5 py-2.5 text-center align-middle">
                    <div class="inline-flex flex-col items-center gap-0.5">
                        <span class="font-black text-[10px] px-1.5 py-0.5 rounded leading-tight border ${isGradeA ? 'bg-emerald-50 text-emerald-700 border-emerald-200/60' : 'bg-amber-50 text-amber-700 border-amber-200/60'}">${row.fuzzyScore}</span>
                        <span class="text-[8.5px] font-extrabold px-1 py-0.2 rounded leading-tight whitespace-nowrap ${isGradeA ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'}">
                            Grade ${row.grade} (${row.fuzzyScore})
                        </span>
                    </div>
                </td>
                <td class="px-1.5 py-2.5 text-center align-middle text-slate-600 text-[11px] font-bold">${row.r1}</td>
                <td class="px-1.5 py-2.5 text-center align-middle text-slate-600 text-[11px] font-bold">${row.r2}</td>
                <td class="px-1.5 py-2.5 text-center align-middle">
                    <span class="inline-flex items-center justify-center font-black border px-1.5 py-0.5 rounded-lg text-xs shadow-2xs ${isGradeA ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200'}">${row.finalScore}</span>
                </td>
                <td class="px-2.5 py-2.5 align-middle col-rekomendasi">
                    <div class="relative w-full print-select-container">
                        <select onchange="updateCardKuotaMonitoring()" class="w-full bg-slate-50 hover:bg-slate-100/80 focus:bg-white border rounded-xl px-2 py-1 text-[11px] font-bold transition-all cursor-pointer shadow-2xs truncate ${isGradeA ? 'text-emerald-800 border-emerald-300 focus:ring-emerald-500/20 focus:border-emerald-500' : 'text-amber-800 border-amber-300 focus:ring-amber-500/20 focus:border-amber-500'}">
                            ${optionsHTML}
                        </select>
                        <span class="print-selected-text">${defaultInstansi}</span>
                    </div>
                </td>
                <td class="px-1.5 py-2.5 text-center align-middle no-print">
                    <div class="flex items-center justify-center space-x-1">
                        <button onclick="openMathBreakdownModal('${row.nama}', '${row.c1}', '${row.c2}', '${row.fuzzyScore}', '${row.r1}', '${row.r2}', '${row.finalScore}', '${row.rule}')" class="p-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 border border-indigo-200/80 transition-all cursor-pointer shadow-2xs" title="Breakdown Matematis SPK">
                            <i class="fas fa-square-root-alt text-xs"></i>
                        </button>
                        <button onclick="openRuleModal('${row.nama}', '${row.c1}', '${row.c2}', '${row.fuzzyScore}')" class="p-1.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 border border-slate-200/80 hover:border-blue-200 transition-all cursor-pointer shadow-2xs" title="Lihat Evaluasi Rule">
                            <i class="fas fa-eye text-xs"></i>
                        </button>
                        <button onclick="editSiswaSPK('${row.nama}')" class="p-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 border border-amber-200/80 transition-all cursor-pointer shadow-2xs" title="Edit Nilai Siswa">
                            <i class="fas fa-edit text-xs"></i>
                        </button>
                        <button onclick="hapusSiswaSPK('${row.nama}')" class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/80 transition-all cursor-pointer shadow-2xs" title="Hapus Dari Tabel">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </div>
                </td>
            `;

            tableBody.appendChild(tr);
        });

        updateCardKuotaMonitoring();
    }

    function openMathBreakdownModal(nama, c1, c2, score, r1, r2, finalVal, rule) {
        document.getElementById('mathNamaTitle').textContent = "Breakdown SPK: " + nama;
        document.getElementById('m_c1_val').textContent = c1;
        document.getElementById('m_c2_val').textContent = c2;
        
        let c1Cat = c1 >= 80 ? "Baik (>=80)" : (c1 >= 70 ? "Cukup (70-79)" : "Kurang (<70)");
        let c2Cat = c2 >= 85 ? "Sangat Baik (>=85)" : (c2 >= 70 ? "Cukup (70-84)" : "Kurang (<70)");

        document.getElementById('m_c1_cat').textContent = c1Cat;
        document.getElementById('m_c2_cat').textContent = c2Cat;
        document.getElementById('m_sugeno_rule').textContent = (rule && rule !== 'undefined') ? rule : "Rule Evaluasi FIS";
        document.getElementById('m_sugeno_score').textContent = score;

        document.getElementById('m_r1_val').textContent = `${c1} / 100 = ${r1}`;
        document.getElementById('m_r2_val').textContent = `${c2} / 100 = ${r2}`;

        document.getElementById('m_saw_formula').textContent = `V = (0.6 × ${r1}) + (0.4 × ${r2})`;
        document.getElementById('m_v_final').textContent = finalVal;

        document.getElementById('modalMathBreakdown').classList.remove('hidden');
    }

    function closeMathModal() {
        document.getElementById('modalMathBreakdown').classList.add('hidden');
    }

    document.addEventListener('click', function(event) {
        const trigger = document.getElementById('customDropdownTrigger');
        const menu = document.getElementById('customDropdownMenu');
        
        if (trigger && menu && !trigger.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
            const arrow = document.getElementById('dropdownArrow');
            if (arrow) arrow.style.transform = 'rotate(0deg)';
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        renderTableSPK();

        const searchInput = document.getElementById('calculateSearchInput');
        const tableBody = document.getElementById('calculateTableBody');
        
        if (searchInput && tableBody) {
            const noResultRow = document.getElementById('noResultRow');

            searchInput.addEventListener('input', function () {
                const rows = tableBody.getElementsByClassName('calculate-row');
                const filter = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                for (let i = 0; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByClassName('name-cell')[0];
                    if (nameCell) {
                        const nameText = nameCell.textContent || nameCell.innerText;
                        if (nameText.toLowerCase().indexOf(filter) > -1) {
                            rows[i].classList.remove('hidden');
                            visibleCount++;
                        } else {
                            rows[i].classList.add('hidden');
                        }
                    }
                }

                if (visibleCount === 0 && filter !== '' && rows.length > 0) {
                    noResultRow.classList.remove('hidden');
                } else {
                    noResultRow.classList.add('hidden');
                }
            });
        }
    });

    function openRuleModal(nama, c1, c2, score) {
        document.getElementById('modalStudentName').textContent = nama === 'Umum' ? 'Detail Evaluasi 9 Rule Fuzzy Sugeno' : 'Detail Evaluasi - ' + nama;
        document.getElementById('modalC1').textContent = c1;
        document.getElementById('modalC2').textContent = c2;
        document.getElementById('modalScore').textContent = score;
        document.getElementById('ruleModal').classList.remove('hidden');
    }

    function closeRuleModal() {
        document.getElementById('ruleModal').classList.add('hidden');
    }
</script>
@endsection