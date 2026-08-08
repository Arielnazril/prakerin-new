@extends('layouts.admin_layout')

@section('page_title', 'Master Data Guru')

@section('content')
<div class="space-y-6 selection:bg-[#234F35] selection:text-white animate-fade-in px-2 sm:px-0">

    <!-- Header Section Modern & Elegan -->
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
                        <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                    Data Guru Pembimbing
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 font-medium pl-1 max-w-xl leading-relaxed">
                    Guru sekolah yang bertugas mendampingi dan memonitor siswa selama program Prakerin.
                </p>
            </div>
            
            <a href="{{ route('admin.guru.create') }}" class="w-full sm:w-auto bg-gradient-to-r from-[#234F35] to-emerald-800 hover:from-emerald-900 hover:to-[#234F35] text-white font-extrabold py-3.5 px-6 rounded-2xl shadow-lg shadow-[#234F35]/30 hover:shadow-xl hover:shadow-[#234F35]/40 transition-all duration-300 flex items-center justify-center transform hover:-translate-y-0.5 active:translate-y-0 text-xs uppercase tracking-wider whitespace-nowrap cursor-pointer flex-shrink-0">
                <i class="fas fa-user-plus mr-2.5 text-xs"></i> Tambah Guru
            </a>
        </div>
    </div>

    <!-- Kotak Informasi Total & Pencarian Modern -->
    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
        <div class="text-sm text-slate-700 bg-white border border-slate-200/80 px-5 py-3 rounded-2xl font-semibold shadow-xs flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#234F35] flex items-center justify-center text-sm shadow-xs border border-emerald-100">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-bold block uppercase tracking-wider">Total Guru</span>
                <span class="text-base font-black text-slate-800">{{ $gurus->count() }} <span class="text-xs font-medium text-slate-500">Orang</span></span>
            </div>
        </div>

        <div class="relative w-full sm:w-80 group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-[#234F35] transition-colors">
                <i class="fas fa-search text-sm"></i>
            </span>
            <input type="text" id="guruSearchInput" placeholder="Cari nama atau NIP guru..." 
                class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-2xl text-sm font-medium bg-white text-slate-800 placeholder:text-slate-400 focus:ring-4 focus:ring-[#234F35]/10 focus:border-[#234F35] outline-none transition-all duration-200 shadow-xs">
        </div>
    </div>

    <!-- Table Container Proporsional -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transition-all duration-300 p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[700px] table-fixed border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs">
                <thead>
                    <tr class="bg-slate-100/80 border-b border-slate-200/80 text-slate-600 uppercase text-[11px] font-black tracking-wider divide-x divide-slate-200/80">
                        <th class="px-4 py-4 text-center w-16">No</th>
                        <th class="px-5 py-4 w-[38%]">Nama Guru</th>
                        <th class="px-5 py-4 w-[28%]">NIP / Username</th>
                        <th class="px-5 py-4 w-[22%]">Kontak</th>
                        <th class="px-4 py-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody id="guruTableBody" class="divide-y divide-slate-200/80 text-sm bg-white">
                    @forelse($gurus as $index => $guru)
                    <tr class="guru-row hover:bg-slate-50/80 transition-colors duration-150 group divide-x divide-slate-200/80">
                        <td class="px-4 py-4 text-center text-slate-400 font-extrabold text-xs group-hover:text-slate-600 index-cell">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-5 py-4 font-medium text-slate-800 name-cell">
                            <div class="flex items-center space-x-3.5">
                                <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-[#234F35] to-emerald-800 text-white flex items-center justify-center font-black text-sm flex-shrink-0 shadow-md shadow-emerald-900/20 uppercase">
                                    {{ substr($guru->name, 0, 2) }}
                                </div>
                                <span class="font-bold text-slate-800 tracking-tight text-base group-hover:text-[#234F35] transition-colors truncate name-text">
                                    {{ $guru->name }}
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-4 nip-cell">
                            <span class="font-mono text-xs font-semibold text-slate-700 bg-slate-100 px-2.5 py-1.5 rounded-xl border border-slate-200/60 inline-flex items-center gap-1.5">
                                <i class="fas fa-id-badge text-slate-400 text-xs"></i>
                                <span class="nip-value">{{ $guru->nomor_identitas }}</span>
                                <button type="button" onclick="copyToClipboard('{{ $guru->nomor_identitas }}', this)" class="text-slate-400 hover:text-[#234F35] focus:outline-none transition-colors p-0.5 ml-1 cursor-pointer" title="Salin NIP">
                                    <i class="far fa-copy text-xs"></i>
                                </button>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-600 text-sm font-medium">
                            @if($guru->no_hp)
                                <span class="inline-flex items-center gap-1.5 text-[#234F35] whitespace-nowrap bg-emerald-50 border border-emerald-200/60 text-xs font-bold px-3 py-1.5 rounded-xl">
                                    <i class="fab fa-whatsapp text-[#234F35] text-sm"></i>
                                    {{ $guru->no_hp }}
                                </span>
                            @else
                                <span class="text-slate-300 italic">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.guru.edit', $guru->id) }}" class="bg-white text-amber-500 border border-amber-200 p-2.5 rounded-xl hover:bg-amber-500 hover:text-white transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-amber-500/20 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Hapus guru {{ $guru->name }}?');" class="delete-guru-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="bg-white text-rose-500 border border-rose-200 p-2.5 rounded-xl hover:bg-rose-500 hover:text-white transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-rose-500/20 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer delete-trigger-btn" data-name="{{ $guru->name }}" title="Hapus">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyPlaceholderRow">
                        <td colspan="5" class="px-6 py-16 text-center text-slate-400 bg-slate-50/50">
                            <div class="max-w-xs mx-auto flex flex-col items-center justify-center space-y-3">
                                <div class="w-16 h-16 rounded-3xl bg-slate-100 border border-slate-200/80 flex items-center justify-center text-slate-400 text-2xl shadow-inner">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-base font-bold text-slate-700">Belum Ada Data Guru</p>
                                    <p class="text-xs text-slate-400 leading-relaxed">Silakan tambahkan data guru pembimbing baru dengan menekan tombol Tambah Guru di atas.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Baris notifikasi jika hasil pencarian kosong --}}
                    <tr id="noResultRow" class="hidden">
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 bg-slate-50/50">
                            <div class="max-w-xs mx-auto flex flex-col items-center justify-center space-y-2">
                                <i class="fas fa-search-minus text-3xl text-slate-300"></i>
                                <p class="text-sm font-semibold text-slate-600">Pencarian Tidak Ditemukan</p>
                                <p class="text-xs text-slate-400">Tidak ditemukan data guru yang cocok dengan kata kunci tersebut.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL POP-UP KONFIRMASI DELETE MODERN --}}
<div id="deleteConfirmationModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop Gelap Belakang -->
    <div id="modalBackdrop" class="fixed inset-0 bg-slate-950/60 backdrop-blur-md transition-opacity duration-300 opacity-0"></div>

    <!-- Konten Card Modal -->
    <div id="modalContent" class="relative bg-white rounded-3xl max-w-md w-full shadow-2xl border border-slate-100 overflow-hidden transform scale-95 opacity-0 transition-all duration-300 ease-out z-10">
        <!-- Banner Dekoratif Atas -->
        <div class="h-2 w-full bg-gradient-to-r from-rose-500 via-red-500 to-rose-600"></div>
        
        <div class="p-6 text-center space-y-4">
            <!-- Ikon Peringatan -->
            <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center text-2xl mx-auto shadow-xs border border-rose-100 animate-bounce">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <!-- Teks Penjelasan -->
            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-900 tracking-tight text-lg">Konfirmasi Hapus Data</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Apakah Anda yakin ingin menghapus data guru <strong id="deleteTargetName" class="font-bold text-slate-800"></strong>?
                </p>
                <div class="bg-rose-50/50 border border-rose-100/50 rounded-2xl p-3 text-left mt-3">
                    <p class="text-xs text-rose-500 leading-normal font-medium">
                        <i class="fas fa-info-circle mr-1"></i> <strong>Peringatan:</strong> Tindakan ini bersifat permanen dan tidak dapat dibatalkan. Relasi data monitoring Prakerin yang terhubung mungkin akan terpengaruh.
                    </p>
                </div>
            </div>
            
            <!-- Tombol Navigasi Aksi -->
            <div class="pt-2 flex items-center justify-center gap-3 text-sm">
                <button type="button" id="cancelDeleteBtn" class="w-full px-5 py-3 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl border border-slate-200 transition-all tracking-wider uppercase cursor-pointer text-center">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="w-full bg-gradient-to-r from-rose-600 to-red-600 text-white px-6 py-3 rounded-xl font-bold hover:from-rose-700 hover:to-red-700 shadow-md hover:shadow-rose-600/20 transform hover:-translate-y-0.5 active:translate-y-0 transition-all tracking-wider uppercase cursor-pointer flex items-center justify-center gap-2">
                    <i class="fas fa-trash text-xs"></i> Ya, Hapus Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Animasi Tambahan khusus Halaman -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

{{-- SCRIPT PENCARIAN JS CLIENT-SIDE & SALIN CLIPBOARD --}}
<script>
    // FUNGSI SALIN NIP / USERNAME KE CLIPBOARD
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
                btnElement.setAttribute('title', 'Salin NIP');
            }, 1500);
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('guruSearchInput');
        const tableBody = document.getElementById('guruTableBody');
        
        if (searchInput && tableBody) {
            const rows = tableBody.getElementsByClassName('guru-row');
            const noResultRow = document.getElementById('noResultRow');
            const emptyPlaceholderRow = document.getElementById('emptyPlaceholderRow');

            searchInput.addEventListener('input', function () {
                const filter = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                // Jika tabel dari database memang kosong sejak awal, batalkan pencarian
                if (emptyPlaceholderRow) return;

                for (let i = 0; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByClassName('name-text')[0];
                    const nipCell = rows[i].getElementsByClassName('nip-cell')[0];
                    
                    if (nameCell || nipCell) {
                        const nameText = nameCell.textContent || nameCell.innerText;
                        const nipText = nipCell.textContent || nipCell.innerText;

                        // Mencocokkan input pencarian dengan Nama atau NIP Guru
                        if (nameText.toLowerCase().indexOf(filter) > -1 || nipText.toLowerCase().indexOf(filter) > -1) {
                            rows[i].classList.remove('hidden');
                            visibleCount++;
                            
                            // Menata ulang penomoran dinamis agar urutan tetap rapi (1, 2, 3...)
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

        // ==========================================
        // HANDLER MODAL KONFIRMASI DELETE KUSTOM
        // ==========================================
        const modal = document.getElementById('deleteConfirmationModal');
        const backdrop = document.getElementById('modalBackdrop');
        const modalContent = document.getElementById('modalContent');
        const targetNameText = document.getElementById('deleteTargetName');
        const cancelBtn = document.getElementById('cancelDeleteBtn');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        
        let pendingFormToSubmit = null;

        // Pasang event listener pada seluruh tombol hapus
        document.querySelectorAll('.delete-trigger-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Temukan form parent terdekat
                pendingFormToSubmit = this.closest('.delete-guru-form');
                const teacherName = this.getAttribute('data-name');
                
                // Isi nama guru di dalam modal
                if (targetNameText) {
                    targetNameText.textContent = teacherName;
                }

                // Tampilkan Modal dengan animasi Fade-In dan Scale-Up
                modal.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            });
        });

        // Fungsi Menutup Modal dengan Animasi Out
        function closeModal() {
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                pendingFormToSubmit = null;
            }, 300); // Sesuai durasi transisi css (duration-300)
        }

        // Event Klik Batal
        cancelBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal);

        // Event Klik Ya, Hapus Data (Kirim Form)
        confirmBtn.addEventListener('click', function() {
            if (pendingFormToSubmit) {
                // Bypass event submit browser konvensional dan kirim form langsung ke server
                pendingFormToSubmit.submit();
            }
        });

        // Tutup modal dengan menekan tombol Escape (ESC) demi kenyamanan pengguna
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>
@endsection