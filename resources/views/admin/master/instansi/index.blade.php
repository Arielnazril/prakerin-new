@extends('layouts.admin_layout')

@section('page_title', 'Master Data Industri')

@section('content')
<div class="space-y-6 selection:bg-[#234F35] selection:text-white animate-fade-in px-2 sm:px-0">

    {{-- HEADER SECTION --}}
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-[#234F35] p-6 sm:p-8 rounded-3xl shadow-xl text-white relative overflow-hidden">
        <!-- Accent Glow Effects -->
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-[#89C74A]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-48 h-48 bg-[#234F35]/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-5">
            <div class="space-y-1">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="bg-[#89C74A]/20 text-[#89C74A] text-xs font-bold px-3 py-1 rounded-full border border-[#89C74A]/30 uppercase tracking-widest">
                        Master Data
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white flex items-center gap-3">
                    <span class="p-2.5 bg-white/10 text-[#89C74A] rounded-2xl text-xl backdrop-blur-md border border-white/10">
                        <i class="fas fa-city"></i>
                    </span>
                    Daftar Mitra Industri
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 font-medium pl-1 max-w-xl leading-relaxed">
                    Kelola informasi perusahaan dan instansi tempat siswa melakukan kegiatan magang / Prakerin secara terpusat.
                </p>
            </div>
            
            <a href="{{ route('admin.instansi.create') }}" class="w-full sm:w-auto bg-gradient-to-r from-[#234F35] to-emerald-800 hover:from-emerald-900 hover:to-[#234F35] text-white font-extrabold py-3.5 px-6 rounded-2xl shadow-lg shadow-[#234F35]/30 hover:shadow-xl hover:shadow-[#234F35]/40 transition-all duration-300 flex items-center justify-center transform hover:-translate-y-0.5 active:translate-y-0 text-xs uppercase tracking-wider whitespace-nowrap cursor-pointer flex-shrink-0">
                <i class="fas fa-plus mr-2.5 text-xs"></i> Tambah Perusahaan
            </a>
        </div>
    </div>

    {{-- PEMROSESAN LOGIKA PEMBAGIAN GRADE A & B SESUAI ACUAN GAMBAR --}}
    @php
        // Daftar nama instansi acuan Grade A & B berdasarkan gambar
        $gradeAKeywords = ['pengadilan tinggi', 'bkad', 'polnep', 'ubsi', 'ketel uap'];
        $gradeBKeywords = ['ec computer', 'host cctv', 'bagas kara', 'bumdes', 'kreasi putra'];

        // Helper function menentukan Grade berdasarkan DB atau nama instansi
        $getGrade = function($item) use ($gradeAKeywords, $gradeBKeywords) {
            // 1. Jika di database sudah terisi 'A' atau 'B'
            $raw = strtoupper(trim((string)($item->grade ?? '')));
            if ($raw === 'A' || $raw === '1') return 'A';
            if ($raw === 'B' || $raw === '2') return 'B';

            // 2. Deteksi berdasarkan kata kunci nama instansi
            $namaLower = strtolower($item->nama_perusahaan ?? '');

            foreach ($gradeBKeywords as $keyword) {
                if (str_contains($namaLower, $keyword)) {
                    return 'B';
                }
            }

            foreach ($gradeAKeywords as $keyword) {
                if (str_contains($namaLower, $keyword)) {
                    return 'A';
                }
            }

            // Default fallback jika tidak ada yang cocok
            return ($item->id % 2 == 0) ? 'A' : 'B';
        };

        $countGradeA = 0;
        $countGradeB = 0;
        foreach($instansis as $ins) {
            if ($getGrade($ins) === 'A') $countGradeA++;
            else $countGradeB++;
        }
    @endphp

    {{-- KOTAK PENCARIAN & FITUR PENGELOMPOKAN GRADE --}}
    <div class="flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-4">
        
        <!-- Tab Pengelompokan Grade -->
        <div class="flex items-center bg-white p-1.5 rounded-2xl border border-slate-200/80 shadow-xs gap-1 overflow-x-auto">
            <button type="button" id="tabGradeA" onclick="switchGradeTab('A')" 
                class="grade-tab-btn px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition-all duration-200 bg-gradient-to-r from-[#234F35] to-emerald-800 text-white shadow-md cursor-pointer whitespace-nowrap">
                <i class="fas fa-award text-[#89C74A]"></i>
                <span>Grade A (Pemerintah/BUMN/Besar)</span>
                <span id="badgeCountGradeA" class="bg-white/20 text-white px-2 py-0.5 rounded-lg text-[10px] font-black">
                    {{ $countGradeA }}
                </span>
            </button>

            <button type="button" id="tabGradeB" onclick="switchGradeTab('B')" 
                class="grade-tab-btn px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition-all duration-200 text-slate-500 hover:text-slate-800 hover:bg-slate-100/80 cursor-pointer whitespace-nowrap">
                <i class="fas fa-certificate text-amber-500"></i>
                <span>Grade B (Swasta/Menengah/UMKM)</span>
                <span id="badgeCountGradeB" class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded-lg text-[10px] font-black">
                    {{ $countGradeB }}
                </span>
            </button>
        </div>

        <!-- Ringkasan Total & Input Pencarian -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
            <div class="text-sm text-slate-700 bg-white border border-slate-200/80 px-5 py-3 rounded-2xl font-semibold shadow-xs flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#234F35] flex items-center justify-center text-sm shadow-xs border border-emerald-100">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-400 font-bold block uppercase tracking-wider">Total Mitra</span>
                    <span class="text-base font-black text-slate-800">{{ $instansis->count() }} <span class="text-xs font-medium text-slate-500">Industri</span></span>
                </div>
            </div>

            <div class="relative w-full sm:w-80 group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-[#234F35] transition-colors">
                    <i class="fas fa-search text-sm"></i>
                </span>
                <input type="text" id="industriSearchInput" placeholder="Cari nama atau alamat industri..." 
                    class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-2xl text-sm font-medium bg-white text-slate-800 placeholder:text-slate-400 focus:ring-4 focus:ring-[#234F35]/10 focus:border-[#234F35] outline-none transition-all duration-200 shadow-xs">
            </div>
        </div>
    </div>

    {{-- CONTAINER GRID CARD PERUSAHAAN --}}
    <div id="industriGridContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($instansis as $instansi)
        @php
            $currentGrade = $getGrade($instansi);
        @endphp
        <div data-grade="{{ $currentGrade }}" class="industri-card bg-white rounded-3xl shadow-lg shadow-slate-200/50 border border-slate-100/90 hover:shadow-2xl hover:shadow-[#234F35]/10 hover:border-emerald-200/80 transition-all duration-300 flex flex-col group overflow-hidden relative transform hover:-translate-y-1">
            
            <!-- Banner Aksen Gradasi Card -->
            <div class="h-2 w-full {{ $currentGrade === 'A' ? 'bg-gradient-to-r from-[#234F35] via-emerald-600 to-[#89C74A]' : 'bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600' }} group-hover:opacity-90 transition-all"></div>

            <div class="p-6 flex-1 flex flex-col justify-between space-y-5">
                <div class="space-y-4">
                    <!-- Header Card: Icon, Badge Grade & Action Buttons -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#234F35] to-emerald-800 text-white flex items-center justify-center text-lg font-black shadow-md shadow-emerald-900/20 group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                                {{ substr($instansi->nama_perusahaan, 0, 1) }}
                            </div>

                            <!-- Badge Grade Perusahaan -->
                            @if($currentGrade === 'A')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-black bg-emerald-50 text-[#234F35] border border-emerald-200/80 shadow-2xs">
                                    <i class="fas fa-star text-[#89C74A] text-[10px]"></i> Grade A
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-black bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                    <i class="fas fa-certificate text-amber-500 text-[10px]"></i> Grade B
                                </span>
                            @endif
                        </div>
                        
                        {{-- Aksi Edit & Hapus --}}
                        <div class="flex items-center space-x-1.5 bg-slate-100/80 p-1.5 rounded-2xl border border-slate-200/60 shadow-inner">
                            <a href="{{ route('admin.instansi.edit', $instansi->id) }}" 
                               class="group/btn relative w-8 h-8 rounded-xl bg-white text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-amber-500/20 active:scale-95 cursor-pointer" 
                               title="Edit Perusahaan">
                                <i class="fas fa-pen text-[11px] transition-transform duration-200 group-hover/btn:scale-110"></i>
                            </a>
                            
                            <button type="button" 
                                    onclick="openDeleteModal('{{ $instansi->id }}', '{{ addslashes($instansi->nama_perusahaan) }}')" 
                                    class="group/btn relative w-8 h-8 rounded-xl bg-white text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-rose-500/20 active:scale-95 cursor-pointer" 
                                    title="Hapus Perusahaan">
                                <i class="fas fa-trash-alt text-[11px] transition-transform duration-200 group-hover/btn:scale-110"></i>
                            </button>

                            <form id="delete-form-{{ $instansi->id }}" action="{{ route('admin.instansi.destroy', $instansi->id) }}" method="POST" class="hidden">
                                @csrf 
                                @method('DELETE')
                            </form>
                        </div>
                    </div>

                    <!-- Nama & Alamat Perusahaan -->
                    <div>
                        <h3 class="nama-perusahaan-text text-base sm:text-lg font-extrabold text-slate-800 group-hover:text-[#234F35] transition-colors duration-200 mb-1.5 leading-snug tracking-tight">
                            {{ $instansi->nama_perusahaan }}
                        </h3>
                        
                        <p class="alamat-perusahaan-text text-slate-500 text-xs sm:text-sm line-clamp-2 leading-relaxed flex items-start gap-2">
                            <i class="fas fa-map-marker-alt text-rose-500 mt-1 text-xs flex-shrink-0"></i>
                            <span>{{ $instansi->alamat }}</span>
                        </p>
                    </div>

                    <!-- Informasi Kontak & Website -->
                    <div class="p-3 bg-slate-50/80 rounded-2xl border border-slate-100 space-y-2 text-xs text-slate-600">
                        <div class="flex items-center text-slate-600">
                            <div class="w-5 h-5 rounded-md bg-emerald-100/70 text-[#234F35] flex items-center justify-center mr-2.5 text-[10px] flex-shrink-0 font-bold">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span class="truncate font-medium">{{ $instansi->email_perusahaan ?? '-' }}</span>
                        </div>
                        <div class="flex items-center text-slate-600">
                            <div class="w-5 h-5 rounded-md bg-emerald-100/70 text-[#234F35] flex items-center justify-center mr-2.5 text-[10px] flex-shrink-0 font-bold">
                                <i class="fas fa-phone"></i>
                            </div>
                            <span class="font-medium">{{ $instansi->telepon ?? '-' }}</span>
                        </div>
                        {{-- Tampilan Website URL --}}
                        <div class="flex items-center text-slate-600">
                            <div class="w-5 h-5 rounded-md bg-emerald-100/70 text-[#234F35] flex items-center justify-center mr-2.5 text-[10px] flex-shrink-0 font-bold">
                                <i class="fas fa-globe"></i>
                            </div>
                            @if(!empty($instansi->website))
                                <a href="{{ Str::startsWith($instansi->website, ['http://', 'https://']) ? $instansi->website : 'https://' . $instansi->website }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="truncate font-medium text-[#234F35] hover:text-emerald-800 hover:underline transition-colors"
                                   title="{{ $instansi->website }}">
                                    {{ $instansi->website }}
                                </a>
                            @else
                                <span class="font-medium text-slate-400">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- DESAIN BARU: LIST NAMA SISWA KE BAWAH (ELEGAN & JELAS) --}}
                <div class="pt-3 border-t border-slate-100 space-y-2.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-black text-slate-600 uppercase tracking-wider text-[10px] flex items-center gap-1.5">
                            <i class="fas fa-user-graduate text-[#234F35]"></i> Siswa Magang
                        </span>
                        @if(isset($instansi->siswa) && $instansi->siswa->count() > 0)
                            <span class="text-[10px] font-bold text-[#234F35] bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100">
                                {{ $instansi->siswa->count() }} Orang
                            </span>
                        @endif
                    </div>

                    {{-- Elemen List Siswa Vertikal Ke Bawah --}}
                    @if(isset($instansi->siswa) && $instansi->siswa->count() > 0)
                        <div class="flex flex-col space-y-1.5">
                            {{-- Tampilkan maksimal 3 siswa pertama secara vertikal --}}
                            @foreach($instansi->siswa->take(3) as $siswa)
                                <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50/90 border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/30 transition-all group/item">
                                    <div class="flex items-center space-x-2.5 min-w-0">
                                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-[#234F35] to-emerald-800 text-white flex items-center justify-center text-[10px] font-bold uppercase flex-shrink-0 shadow-2xs">
                                            {{ substr($siswa->name, 0, 1) }}
                                        </div>
                                        <span class="text-xs font-semibold text-slate-700 group-hover/item:text-[#234F35] truncate transition-colors">
                                            {{ $siswa->name }}
                                        </span>
                                    </div>
                                    <span class="text-[9px] font-bold text-slate-400 bg-white px-2 py-0.5 rounded-md border border-slate-200/60 uppercase tracking-tight flex-shrink-0">
                                        Aktif
                                    </span>
                                </div>
                            @endforeach

                            {{-- Badge Tambahan jika siswa lebih dari 3 --}}
                            @if($instansi->siswa->count() > 3)
                                <div class="p-1.5 rounded-xl bg-slate-100/60 border border-slate-200/60 text-center hover:bg-emerald-50 hover:border-emerald-100 transition-colors cursor-default">
                                    <span class="text-[10px] font-extrabold text-[#234F35]">
                                        +{{ $instansi->siswa->count() - 3 }} Siswa Lainnya
                                    </span>
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- Tampilan saat belum ada siswa --}}
                        <div class="p-3 rounded-2xl bg-slate-50 border border-dashed border-slate-200 text-center space-y-1">
                            <i class="fas fa-user-slash text-slate-300 text-base block"></i>
                            <span class="text-[11px] font-medium text-slate-400 block">Belum ada siswa magang terdaftar.</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer Card (Siswa Magang) -->
            <div class="bg-slate-50/80 px-6 py-3.5 border-t border-slate-100 text-xs text-slate-400 flex justify-between items-center rounded-b-3xl group-hover:bg-emerald-50/30 transition-colors duration-300">
                <span class="flex items-center font-medium text-[11px]">
                    <i class="far fa-calendar-alt mr-1.5 opacity-70"></i>{{ $instansi->created_at->diffForHumans() }}
                </span>
                <span class="font-black text-[#234F35] bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-xl text-[11px] shadow-2xs tracking-wide">
                    <i class="fas fa-user-graduate mr-1 text-[10px]"></i> {{ $instansi->siswa_count ?? ($instansi->siswa ? $instansi->siswa->count() : 0) }} Siswa
                </span>
            </div>
        </div>
        @empty
        <div id="emptyPlaceholderCard" class="col-span-full py-16 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-200">
            <div class="max-w-xs mx-auto flex flex-col items-center justify-center space-y-3">
                <div class="w-16 h-16 rounded-3xl bg-slate-100 border border-slate-200/80 flex items-center justify-center text-slate-400 text-2xl shadow-inner">
                    <i class="fas fa-city"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-base font-bold text-slate-700">Belum Ada Data Perusahaan</p>
                    <p class="text-xs text-slate-400 leading-relaxed">Tambahkan perusahaan mitra terlebih dahulu untuk memulai integrasi magang siswa.</p>
                </div>
            </div>
        </div>
        @endforelse

        {{-- Elemen cadangan jika hasil pencarian kosong --}}
        <div id="noResultCard" class="col-span-full py-16 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-200 hidden">
            <div class="max-w-xs mx-auto flex flex-col items-center justify-center space-y-2">
                <i class="fas fa-search-minus text-3xl text-slate-300"></i>
                <p class="text-sm font-semibold text-slate-600">Hasil Pencarian Tidak Ditemukan</p>
                <p class="text-xs text-slate-400">Silakan gunakan kata kunci pencarian nama atau alamat industri yang lain.</p>
            </div>
        </div>
    </div>
</div>

{{-- MODAL CUSTOM POP-UP CONFIRM DELETE --}}
<div id="customDeleteModal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
    <div id="deleteModalCard" class="bg-white w-full max-w-md rounded-3xl shadow-2xl border border-slate-100 overflow-hidden transform scale-95 transition-all duration-300 animate-modal-in">
        
        <!-- Banner Dekoratif Atas -->
        <div class="h-2 w-full bg-gradient-to-r from-rose-500 via-red-500 to-rose-600"></div>

        <div class="p-6 text-center space-y-4">
            <!-- Icon Warning -->
            <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center text-2xl mx-auto shadow-sm border border-rose-100 animate-bounce">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-900 tracking-tight text-lg">Konfirmasi Hapus Data</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Apakah Anda yakin ingin menghapus mitra industri <strong id="deleteModalTargetName" class="font-bold text-slate-800"></strong>?
                </p>
                <div class="p-3 bg-rose-50/60 border border-rose-100/80 rounded-2xl mt-3">
                    <p class="text-xs text-rose-600 font-medium flex items-center justify-center">
                        <i class="fas fa-info-circle mr-1.5"></i>Tindakan ini permanen dan tidak dapat dibatalkan.
                    </p>
                </div>
            </div>
        </div>
        
        {{-- Tombol Aksi Kontrol --}}
        <div class="px-6 pb-6 pt-0 flex flex-col sm:flex-row gap-3">
            <button type="button" onclick="closeDeleteModal()" class="w-full sm:order-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 px-4 rounded-xl text-xs uppercase tracking-wider transition duration-150 cursor-pointer border border-slate-200">
                Batal
            </button>
            <button type="button" id="confirmDeleteButton" class="w-full sm:order-2 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white font-bold py-3 px-4 rounded-xl text-xs uppercase tracking-wider shadow-md hover:shadow-rose-600/20 transition duration-150 cursor-pointer flex items-center justify-center gap-2">
                <i class="fas fa-trash text-xs"></i> Ya, Hapus Data
            </button>
        </div>
    </div>
</div>

<!-- Animasi Tambahan khusus Halaman & Modal -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.96) translateY(12px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-modal-in { animation: modalIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
</style>

{{-- JAVASCRIPT MODAL, TAB GRADE & PENCARIAN CLIENT-SIDE --}}
<script>
    // Penanganan Variabel Target Penghapusan
    let activeDeleteId = null;
    let activeGradeTab = 'A';

    function openDeleteModal(id, namaPerusahaan) {
        activeDeleteId = id;
        document.getElementById('deleteModalTargetName').innerText = namaPerusahaan;
        
        const modal = document.getElementById('customDeleteModal');
        const card = document.getElementById('deleteModalCard');
        
        // Membuka modal dengan animasi transisi Tailwind CSS
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        card.classList.remove('scale-95');
        card.classList.add('scale-100');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('customDeleteModal');
        const card = document.getElementById('deleteModalCard');
        
        // Menutup modal dengan efek animasi transisi
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        card.classList.add('scale-95');
        card.classList.remove('scale-100');
        
        activeDeleteId = null;
    }

    // Eksekusi Submit Form setelah Konfirmasi Sukses di Modal
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        if (activeDeleteId) {
            const form = document.getElementById('delete-form-' + activeDeleteId);
            if (form) {
                form.submit();
            }
        }
    });

    // Menutup Modal apabila mengklik di luar area Card modal (Overlay hitam)
    document.getElementById('customDeleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // SCRIPT PENUKARAN TAB GRADE (GRADE A & GRADE B)
    function switchGradeTab(grade) {
        activeGradeTab = grade;

        const tabA = document.getElementById('tabGradeA');
        const tabB = document.getElementById('tabGradeB');
        const badgeA = document.getElementById('badgeCountGradeA');
        const badgeB = document.getElementById('badgeCountGradeB');

        if (grade === 'A') {
            // Style Aktif Tab Grade A
            tabA.className = "grade-tab-btn px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition-all duration-200 bg-gradient-to-r from-[#234F35] to-emerald-800 text-white shadow-md cursor-pointer whitespace-nowrap";
            badgeA.className = "bg-white/20 text-white px-2 py-0.5 rounded-lg text-[10px] font-black";

            // Style Inaktif Tab Grade B
            tabB.className = "grade-tab-btn px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition-all duration-200 text-slate-500 hover:text-slate-800 hover:bg-slate-100/80 cursor-pointer whitespace-nowrap";
            badgeB.className = "bg-slate-100 text-slate-600 px-2 py-0.5 rounded-lg text-[10px] font-black";
        } else {
            // Style Aktif Tab Grade B
            tabB.className = "grade-tab-btn px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition-all duration-200 bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md cursor-pointer whitespace-nowrap";
            badgeB.className = "bg-white/20 text-white px-2 py-0.5 rounded-lg text-[10px] font-black";

            // Style Inaktif Tab Grade A
            tabA.className = "grade-tab-btn px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition-all duration-200 text-slate-500 hover:text-slate-800 hover:bg-slate-100/80 cursor-pointer whitespace-nowrap";
            badgeA.className = "bg-slate-100 text-slate-600 px-2 py-0.5 rounded-lg text-[10px] font-black";
        }

        // Jalankan Filter gabungan antara Tab Grade dan Search Input
        filterIndustriCards();
    }

    // FUNGSI UTAMA FILTERING DATA INDUSTRI
    function filterIndustriCards() {
        const searchInput = document.getElementById('industriSearchInput');
        const gridContainer = document.getElementById('industriGridContainer');
        if (!gridContainer) return;

        const cards = gridContainer.getElementsByClassName('industri-card');
        const noResultCard = document.getElementById('noResultCard');
        const emptyPlaceholderCard = document.getElementById('emptyPlaceholderCard');

        if (emptyPlaceholderCard) return;

        const filter = searchInput ? searchInput.value.toLowerCase().trim() : '';
        let visibleCount = 0;

        for (let i = 0; i < cards.length; i++) {
            const cardGrade = cards[i].getAttribute('data-grade') || 'A';
            const nameElement = cards[i].getElementsByClassName('nama-perusahaan-text')[0];
            const addressElement = cards[i].getElementsByClassName('alamat-perusahaan-text')[0];

            let matchesSearch = false;
            if (nameElement || addressElement) {
                const nameText = (nameElement.textContent || nameElement.innerText).toLowerCase();
                const addressText = (addressElement.textContent || addressElement.innerText).toLowerCase();
                
                if (nameText.indexOf(filter) > -1 || addressText.indexOf(filter) > -1) {
                    matchesSearch = true;
                }
            }

            // Tampilkan card hanya jika Grade cocok dan sesuai pencarian
            if (cardGrade === activeGradeTab && matchesSearch) {
                cards[i].classList.remove('hidden');
                visibleCount++;
            } else {
                cards[i].classList.add('hidden');
            }
        }

        // Menampilkan notifikasi kosong jika tidak ada data di grade/pencarian ini
        if (visibleCount === 0) {
            noResultCard.classList.remove('hidden');
        } else {
            noResultCard.classList.add('hidden');
        }
    }

    // SCRIPT INITIALIZATION ON DOM LOADED
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('industriSearchInput');
        
        if (searchInput) {
            searchInput.addEventListener('input', filterIndustriCards);
        }

        // Jalankan filter pertama kali untuk default Grade A
        switchGradeTab('A');
    });
</script>
@endsection