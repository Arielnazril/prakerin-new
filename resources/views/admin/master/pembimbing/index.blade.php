@extends('layouts.admin_layout')

@section('page_title', 'Master Mentor Industri')

@section('content')
<div class="space-y-6 selection:bg-[#234F35] selection:text-white animate-fade-in px-2 sm:px-0">

    <!-- Header Section -->
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
                        <i class="fas fa-user-tie"></i>
                    </span>
                    Mentor Lapangan
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 font-medium pl-1 max-w-xl leading-relaxed">
                    Pembimbing dari pihak industri/perusahaan yang mendampingi siswa selama program Prakerin.
                </p>
            </div>
            
            <a href="{{ route('admin.pembimbing.create') }}" class="w-full sm:w-auto bg-gradient-to-r from-[#234F35] to-emerald-800 hover:from-emerald-900 hover:to-[#234F35] text-white font-extrabold py-3.5 px-6 rounded-2xl shadow-lg shadow-[#234F35]/30 hover:shadow-xl hover:shadow-[#234F35]/40 transition-all duration-300 flex items-center justify-center transform hover:-translate-y-0.5 active:translate-y-0 text-xs uppercase tracking-wider whitespace-nowrap cursor-pointer flex-shrink-0">
                <i class="fas fa-plus mr-2.5 text-xs"></i> Tambah Mentor
            </a>
        </div>
    </div>

    {{-- LOGIKA DETEKSI KLASIFIKASI GRADE MENTOR DARI MITRA INDUSTRI --}}
    @php
        $gradeAKeywords = ['pengadilan tinggi', 'bkad', 'polnep', 'ubsi', 'ketel uap'];
        $gradeBKeywords = ['ec computer', 'host cctv', 'bagas kara', 'bumdes', 'kreasi putra'];

        $getMentorGrade = function($mentor) use ($gradeAKeywords, $gradeBKeywords) {
            if (!isset($mentor->instansi)) return 'B';

            // 1. Pengecekan atribut 'grade' langsung dari relasi instansi
            $raw = strtoupper(trim((string)($mentor->instansi->grade ?? '')));
            if ($raw === 'A' || $raw === '1') return 'A';
            if ($raw === 'B' || $raw === '2') return 'B';

            // 2. Deteksi berdasarkan nama perusahaan mitra
            $namaLower = strtolower($mentor->instansi->nama_perusahaan ?? '');

            foreach ($gradeBKeywords as $keyword) {
                if (str_contains($namaLower, $keyword)) return 'B';
            }

            foreach ($gradeAKeywords as $keyword) {
                if (str_contains($namaLower, $keyword)) return 'A';
            }

            // Fallback default
            return (($mentor->instansi->id ?? $mentor->id) % 2 == 0) ? 'A' : 'B';
        };

        $countGradeA = 0;
        $countGradeB = 0;
        foreach($mentors as $m) {
            if ($getMentorGrade($m) === 'A') $countGradeA++;
            else $countGradeB++;
        }
    @endphp

    <!-- BARIS 1: Tab Filter Grade Mentor (Diberi space khusus agar tidak berdempetan) -->
    <div class="flex items-center bg-white p-2 rounded-2xl border border-slate-200/80 shadow-xs gap-2 overflow-x-auto">
        <button type="button" id="tabGradeA" onclick="switchGradeTab('A')" 
            class="grade-tab-btn flex-1 sm:flex-none px-6 py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2.5 transition-all duration-200 bg-gradient-to-r from-[#234F35] to-emerald-800 text-white shadow-md cursor-pointer whitespace-nowrap">
            <i class="fas fa-award text-[#89C74A] text-sm"></i>
            <span>Mentor Grade A (Pemerintah/BUMN/Besar)</span>
            <span id="badgeCountGradeA" class="bg-white/20 text-white px-2.5 py-0.5 rounded-lg text-[11px] font-black">
                {{ $countGradeA }}
            </span>
        </button>

        <button type="button" id="tabGradeB" onclick="switchGradeTab('B')" 
            class="grade-tab-btn flex-1 sm:flex-none px-6 py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2.5 transition-all duration-200 text-slate-500 hover:text-slate-800 hover:bg-slate-100/80 cursor-pointer whitespace-nowrap">
            <i class="fas fa-certificate text-amber-500 text-sm"></i>
            <span>Mentor Grade B (Swasta/Menengah/UMKM)</span>
            <span id="badgeCountGradeB" class="bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-lg text-[11px] font-black">
                {{ $countGradeB }}
            </span>
        </button>
    </div>

    <!-- BARIS 2: Total Ringkasan & Kotak Pencarian -->
    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
        <div class="text-sm text-slate-700 bg-white border border-slate-200/80 px-5 py-3.5 rounded-2xl font-semibold shadow-xs flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#234F35] flex items-center justify-center text-base shadow-xs border border-emerald-100 flex-shrink-0">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Total Mentor</span>
                <span class="text-base font-black text-slate-800">{{ count($mentors) }} <span class="text-xs font-medium text-slate-500">Orang</span></span>
            </div>
        </div>

        <div class="relative w-full sm:w-80 group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-[#234F35] transition-colors">
                <i class="fas fa-search text-sm"></i>
            </span>
            <input type="text" id="mentorSearchInput" placeholder="Cari nama mentor atau perusahaan..." 
                class="w-full pl-10 pr-4 py-3.5 border border-slate-200 rounded-2xl text-sm font-medium bg-white text-slate-800 placeholder:text-slate-400 focus:ring-4 focus:ring-[#234F35]/10 focus:border-[#234F35] outline-none transition-all duration-200 shadow-xs">
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transition-all duration-300 p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px] table-fixed border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs">
                <thead>
                    <tr class="bg-slate-100/80 border-b border-slate-200/80 text-slate-600 uppercase text-[11px] font-black tracking-wider divide-x divide-slate-200/80">
                        <th class="px-4 py-4 text-center w-14">No.</th>
                        <th class="px-5 py-4 w-[25%]">Nama Mentor</th>
                        <th class="px-5 py-4 w-[33%]">Perusahaan (Instansi)</th>
                        <th class="px-5 py-4 w-[18%]">Username Login</th>
                        <th class="px-5 py-4 w-[14%]">Kontak</th>
                        <th class="px-4 py-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody id="mentorTableBody" class="divide-y divide-slate-200/80 text-sm bg-white">
                    @forelse($mentors as $mentor)
                    @php
                        $mentorGrade = $getMentorGrade($mentor);
                    @endphp
                    <tr data-grade="{{ $mentorGrade }}" class="mentor-row hover:bg-slate-50/80 transition-colors duration-150 group divide-x divide-slate-200/80">
                        <td class="px-4 py-4 text-center text-slate-400 font-extrabold text-xs group-hover:text-slate-600">
                            {{ sprintf('%02d', $loop->iteration) }}
                        </td>
                        <td class="px-5 py-4 name-cell">
                            <div class="flex items-center space-x-3.5">
                                <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-[#234F35] to-emerald-800 text-white flex items-center justify-center font-black text-sm flex-shrink-0 shadow-md shadow-emerald-900/20 uppercase">
                                    {{ substr($mentor->name, 0, 1) }}
                                </div>
                                <div class="font-bold text-slate-800 tracking-tight text-base group-hover:text-[#234F35] transition-colors truncate">
                                    {{ $mentor->name }}
                                </div>
                            </div>
                        </td>
                        
                        {{-- BARIS KAMPUS/PERUSAHAAN DIRAPIKAN AGAR TIDAK BERDEMPETAN --}}
                        <td class="px-5 py-4 company-cell">
                            @if(isset($mentor->instansi->nama_perusahaan))
                                <div class="flex flex-col items-start gap-1.5 leading-snug">
                                    <span class="font-bold text-slate-800 text-sm tracking-tight">
                                        {{ $mentor->instansi->nama_perusahaan }}
                                    </span>
                                    <div>
                                        @if($mentorGrade === 'A')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-emerald-50 text-[#234F35] border border-emerald-200/80 shadow-2xs whitespace-nowrap">
                                                <i class="fas fa-star text-[#89C74A] text-[8px]"></i> GRADE A
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs whitespace-nowrap">
                                                <i class="fas fa-certificate text-amber-500 text-[8px]"></i> GRADE B
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <span class="inline-flex items-center bg-slate-100 text-slate-500 border border-slate-200/60 text-xs font-bold px-3 py-1.5 rounded-xl shadow-2xs">
                                    <i class="fas fa-minus-circle mr-1.5 opacity-60 text-[10px]"></i>
                                    Tidak Terkait
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-4">
                            <span class="font-mono text-xs font-semibold text-slate-700 bg-slate-100 px-2.5 py-1.5 rounded-xl border border-slate-200/60 inline-flex items-center gap-1.5">
                                <i class="fas fa-user-circle text-slate-400 text-xs"></i>
                                <span class="truncate max-w-[120px]">{{ $mentor->username }}</span>
                                <button type="button" onclick="copyToClipboard('{{ $mentor->username }}', this)" class="text-slate-400 hover:text-[#234F35] focus:outline-none transition-colors p-0.5 ml-1 cursor-pointer flex-shrink-0" title="Salin Username">
                                    <i class="far fa-copy text-xs"></i>
                                </button>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-600 text-sm font-medium">
                            @if($mentor->no_hp)
                                <span class="inline-flex items-center gap-1.5 text-[#234F35] whitespace-nowrap bg-emerald-50 border border-emerald-200/60 text-xs font-bold px-3 py-1.5 rounded-xl">
                                    <i class="fab fa-whatsapp text-[#234F35] text-sm"></i>
                                    {{ $mentor->no_hp }}
                                </span>
                            @else
                                <span class="text-slate-300 italic">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.pembimbing.edit', $mentor->id) }}" class="bg-white text-amber-500 border border-amber-200 p-2.5 rounded-xl hover:bg-amber-500 hover:text-white transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-amber-500/20 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer" title="Edit Data">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                
                                {{-- Form Delete yang dimodifikasi tanpa mengganggu method asli laravel --}}
                                <form action="{{ route('admin.pembimbing.destroy', $mentor->id) }}" method="POST" class="delete-mentor-form inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="bg-white text-rose-500 border border-rose-200 p-2.5 rounded-xl hover:bg-rose-500 hover:text-white transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-rose-500/20 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer btn-delete-trigger" data-mentor-name="{{ $mentor->name }}" title="Hapus Data">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyPlaceholderRow">
                        <td colspan="6" class="px-6 py-16 text-center text-slate-400 bg-slate-50/50">
                            <div class="max-w-xs mx-auto flex flex-col items-center justify-center space-y-3">
                                <div class="w-16 h-16 rounded-3xl bg-slate-100 border border-slate-200/80 flex items-center justify-center text-slate-400 text-2xl shadow-inner">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-base font-bold text-slate-700">Belum Ada Data Mentor</p>
                                    <p class="text-xs text-slate-400 leading-relaxed">Silakan tambahkan data mentor industri baru dengan menekan tombol Tambah Mentor di atas.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Baris notifikasi jika hasil pencarian kosong --}}
                    <tr id="noResultRow" class="hidden">
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400 bg-slate-50/50">
                            <div class="max-w-xs mx-auto flex flex-col items-center justify-center space-y-2">
                                <i class="fas fa-search-minus text-3xl text-slate-300"></i>
                                <p class="text-sm font-semibold text-slate-600">Pencarian Tidak Ditemukan</p>
                                <p class="text-xs text-slate-400">Tidak ditemukan data mentor yang cocok pada kategori Grade ini.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- WINDOWS CARD POP UP CONFIRMATION MODAL --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 flex items-center justify-center backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 transform transition-all scale-100 animate-modal-in overflow-hidden">
        <!-- Banner Dekoratif Atas -->
        <div class="h-2 w-full bg-gradient-to-r from-rose-500 via-red-500 to-rose-600"></div>
        
        <div class="p-6 text-center space-y-4">
            <!-- Icon Warning -->
            <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center text-2xl mx-auto shadow-sm border border-rose-100 animate-bounce">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-900 tracking-tight text-lg">Konfirmasi Hapus</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Apakah Anda yakin ingin menghapus data mentor <span id="modalMentorName" class="font-bold text-slate-800"></span>? 
                    <span class="block mt-2 text-xs text-rose-500 bg-rose-50/50 p-3 rounded-2xl border border-rose-100/50 font-medium">
                        <i class="fas fa-info-circle mr-1"></i> Setelah dihapus, tindakan ini tidak dapat dibatalkan.
                    </span>
                </p>
            </div>
        </div>

        <div class="flex items-center justify-center gap-3 px-6 pb-6 text-sm bg-white">
            <button type="button" id="btnCancelDelete" class="w-full px-5 py-3 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl border border-slate-200 transition-all tracking-wider uppercase cursor-pointer text-center">
                Batal
            </button>
            <button type="button" id="btnConfirmDelete" class="w-full bg-gradient-to-r from-rose-600 to-red-600 text-white px-6 py-3 rounded-xl font-bold hover:from-rose-700 hover:to-red-700 shadow-md hover:shadow-rose-600/20 transform hover:-translate-y-0.5 active:translate-y-0 transition-all tracking-wider uppercase cursor-pointer flex items-center justify-center gap-2">
                <i class="fas fa-trash text-xs"></i> Ya, Hapus
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

{{-- SCRIPT PENCARIAN JS CLIENT-SIDE, TAB GRADE, SALIN CLIPBOARD, & POP UP MODAL DELETE --}}
<script>
    let activeGradeTab = 'A';

    // FUNGSI SALIN USERNAME KE CLIPBOARD
    function copyToClipboard(text, btnElement) {
        if (!text || text === '-') return;

        navigator.clipboard.writeText(text).then(() => {
            const icon = btnElement.querySelector('i');
            
            // Ubah tampilan icon menjadi ceklis hijau
            icon.className = 'fas fa-check text-[#89C74A] text-xs';
            btnElement.setAttribute('title', 'Tersalin!');

            // Kembalikan ke icon awal setelah 1.5 detik
            setTimeout(() => {
                icon.className = 'far fa-copy text-xs';
                btnElement.setAttribute('title', 'Salin Username');
            }, 1500);
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    }

    // FUNGSI PENUKARAN TAB GRADE (GRADE A & GRADE B)
    function switchGradeTab(grade) {
        activeGradeTab = grade;

        const tabA = document.getElementById('tabGradeA');
        const tabB = document.getElementById('tabGradeB');
        const badgeA = document.getElementById('badgeCountGradeA');
        const badgeB = document.getElementById('badgeCountGradeB');

        if (!tabA || !tabB) return;

        if (grade === 'A') {
            tabA.className = "grade-tab-btn flex-1 sm:flex-none px-6 py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2.5 transition-all duration-200 bg-gradient-to-r from-[#234F35] to-emerald-800 text-white shadow-md cursor-pointer whitespace-nowrap";
            badgeA.className = "bg-white/20 text-white px-2.5 py-0.5 rounded-lg text-[11px] font-black";

            tabB.className = "grade-tab-btn flex-1 sm:flex-none px-6 py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2.5 transition-all duration-200 text-slate-500 hover:text-slate-800 hover:bg-slate-100/80 cursor-pointer whitespace-nowrap";
            badgeB.className = "bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-lg text-[11px] font-black";
        } else {
            tabB.className = "grade-tab-btn flex-1 sm:flex-none px-6 py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2.5 transition-all duration-200 bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md cursor-pointer whitespace-nowrap";
            badgeB.className = "bg-white/20 text-white px-2.5 py-0.5 rounded-lg text-[11px] font-black";

            tabA.className = "grade-tab-btn flex-1 sm:flex-none px-6 py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2.5 transition-all duration-200 text-slate-500 hover:text-slate-800 hover:bg-slate-100/80 cursor-pointer whitespace-nowrap";
            badgeA.className = "bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-lg text-[11px] font-black";
        }

        filterMentorTable();
    }

    // FUNGSI GABUNGAN FILTER TAB GRADE & PENCARIAN
    function filterMentorTable() {
        const searchInput = document.getElementById('mentorSearchInput');
        const tableBody = document.getElementById('mentorTableBody');
        if (!tableBody) return;

        const rows = tableBody.getElementsByClassName('mentor-row');
        const noResultRow = document.getElementById('noResultRow');
        const emptyPlaceholderRow = document.getElementById('emptyPlaceholderRow');

        if (emptyPlaceholderRow) return;

        const filter = searchInput ? searchInput.value.toLowerCase().trim() : '';
        let visibleCount = 0;

        for (let i = 0; i < rows.length; i++) {
            const rowGrade = rows[i].getAttribute('data-grade') || 'A';
            const nameCell = rows[i].getElementsByClassName('name-cell')[0];
            const companyCell = rows[i].getElementsByClassName('company-cell')[0];

            let matchesSearch = false;
            if (nameCell || companyCell) {
                const nameText = (nameCell.textContent || nameCell.innerText).toLowerCase();
                const companyText = (companyCell.textContent || companyCell.innerText).toLowerCase();

                if (nameText.indexOf(filter) > -1 || companyText.indexOf(filter) > -1) {
                    matchesSearch = true;
                }
            }

            if (rowGrade === activeGradeTab && matchesSearch) {
                rows[i].classList.remove('hidden');
                visibleCount++;
            } else {
                rows[i].classList.add('hidden');
            }
        }

        if (visibleCount === 0) {
            noResultRow.classList.remove('hidden');
        } else {
            noResultRow.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('mentorSearchInput');

        if (searchInput) {
            searchInput.addEventListener('input', filterMentorTable);
        }

        // Initialize default tab to Grade A
        switchGradeTab('A');

        // --- MANAJEMEN LOGIKA MODAL POP UP DELETE KUSTOM ---
        const deleteModal = document.getElementById('deleteModal');
        const modalMentorName = document.getElementById('modalMentorName');
        const btnCancelDelete = document.getElementById('btnCancelDelete');
        const btnConfirmDelete = document.getElementById('btnConfirmDelete');
        let formToSubmit = null;

        // Ambil semua tombol bertipe 'button' pemicu aksi hapus
        document.querySelectorAll('.btn-delete-trigger').forEach(button => {
            button.addEventListener('click', function () {
                formToSubmit = this.closest('.delete-mentor-form'); // Tangkap elemen form terkait
                const name = this.getAttribute('data-mentor-name'); // Tangkap nama mentor
                
                if (modalMentorName) modalMentorName.textContent = name;
                if (deleteModal) deleteModal.classList.remove('hidden'); // Tampilkan modal card
            });
        });

        // Event listener saat menekan tombol Batal
        if (btnCancelDelete) {
            btnCancelDelete.addEventListener('click', function () {
                if (deleteModal) deleteModal.classList.add('hidden');
                formToSubmit = null; // Reset form handler
            });
        }

        // Event listener saat menekan tombol Konfirmasi Eksekusi Hapus Halaman
        if (btnConfirmDelete) {
            btnConfirmDelete.addEventListener('click', function () {
                if (formToSubmit) {
                    formToSubmit.submit(); // Kirim payload form secara natural
                }
            });
        }
    });
</script>
@endsection