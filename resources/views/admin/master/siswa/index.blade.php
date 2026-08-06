@extends('layouts.admin_layout')

@section('page_title', 'Manajemen Data Siswa')

@section('content')
<div class="space-y-8 selection:bg-blue-600 selection:text-white px-2 sm:px-0 select-none font-sans antialiased">

    {{-- TABEL PENDAFTARAN BARU (BUTUH VERIFIKASI) - TAMPILAN TERBARU & MODERN --}}
    @if($siswaPending->count() > 0)
    <div class="bg-white rounded-3xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-rose-100/80">
        {{-- Header Card --}}
        <div class="px-6 py-5 border-b border-rose-100/60 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-rose-50/80 via-white to-rose-50/20">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 bg-rose-500/10 rounded-2xl flex items-center justify-center border border-rose-200/50 text-rose-600 shadow-sm shrink-0">
                    <i class="fas fa-user-plus text-lg animate-pulse"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-800 text-base tracking-tight">Pendaftaran Baru (Butuh Verifikasi)</h3>
                    <p class="text-xs text-slate-500 mt-0.5 font-medium">Siswa pendaftar baru yang memerlukan persetujuan akun administrator</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-rose-500 to-red-600 text-white text-[11px] font-bold px-3.5 py-1.5 rounded-full shadow-sm shadow-rose-500/20 uppercase tracking-wider border border-rose-400/30">
                    <i class="fas fa-clock text-[10px] animate-pulse"></i> {{ $siswaPending->count() }} Perlu Tindakan
                </span>
            </div>
        </div>

        {{-- Table Content --}}
        <div class="overflow-x-auto p-4 sm:p-6">
            <table class="w-full text-left border-collapse min-w-[650px] border border-rose-200/80 rounded-2xl overflow-hidden shadow-2xs">
                <thead class="bg-slate-100/80 text-slate-600 uppercase text-[10px] font-extrabold tracking-widest border-b border-rose-200/80 divide-x divide-rose-200/80">
                    <tr>
                        <th class="px-6 py-3.5">Waktu Daftar</th>
                        <th class="px-6 py-3.5">Nama Siswa</th>
                        <th class="px-6 py-3.5">NIS</th>
                        <th class="px-6 py-3.5">Jurusan</th>
                        <th class="px-6 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-rose-100 bg-white">
                    @foreach($siswaPending as $siswa)
                    <tr class="hover:bg-rose-50/30 transition-colors duration-200 group divide-x divide-rose-100">
                        {{-- Waktu Daftar --}}
                        <td class="px-6 py-4 text-xs text-slate-500 font-medium">
                            <div class="inline-flex items-center bg-slate-50 group-hover:bg-white px-3 py-1 rounded-lg border border-slate-200/60 group-hover:border-rose-200 transition-colors shadow-2xs">
                                <i class="far fa-clock mr-1.5 text-rose-500 text-xs"></i>
                                <span>{{ $siswa->created_at->diffForHumans() }}</span>
                            </div>
                        </td>

                        {{-- Nama Siswa & Avatar Icon --}}
                        <td class="px-6 py-4 font-bold text-slate-800 group-hover:text-rose-600 transition-colors duration-150 text-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-rose-500 to-red-500 text-white font-black text-xs flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform shrink-0">
                                    {{ substr($siswa->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="tracking-wide text-slate-800 group-hover:text-rose-600 font-bold transition-colors">{{ $siswa->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Pendaftar Barusan</span>
                                </div>
                            </div>
                        </td>

                        {{-- NIS dengan Tombol Salin --}}
                        <td class="px-6 py-4 text-slate-600 font-mono text-xs font-semibold">
                            <div class="inline-flex items-center gap-1.5 bg-slate-50 group-hover:bg-white px-2.5 py-1 rounded-md border border-slate-200/80 shadow-2xs">
                                <span>{{ $siswa->nomor_identitas }}</span>
                                <button type="button" onclick="copyToClipboard('{{ $siswa->nomor_identitas }}', this)" class="text-slate-400 hover:text-blue-600 focus:outline-none transition-colors p-0.5 cursor-pointer" title="Salin NIS">
                                    <i class="far fa-copy text-xs"></i>
                                </button>
                            </div>
                        </td>

                        {{-- Jurusan DENGAN ICON --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 group-hover:bg-rose-100/80 px-2.5 py-1 rounded-lg text-[10px] font-extrabold border border-rose-200/60 uppercase tracking-wider shadow-2xs">
                                <i class="fas fa-graduation-cap text-rose-500 text-xs"></i>
                                <span>{{ $siswa->jurusan->kode_jurusan ?? '-' }}</span>
                            </span>
                        </td>

                        {{-- Tombol Aksi --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-2">
                                <form id="verify-form-{{ $siswa->id }}" action="{{ route('admin.siswa.verify', $siswa->id) }}" method="POST">
                                    @csrf
                                    <button type="button" onclick="confirmVerify('verify-form-{{ $siswa->id }}', '{{ $siswa->name }}')" class="bg-emerald-500 text-white px-3.5 py-1.5 rounded-xl text-xs font-extrabold hover:bg-emerald-600 shadow-sm hover:shadow-emerald-500/20 transition-all flex items-center cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0">
                                        <i class="fas fa-check mr-1.5 text-[10px]"></i> Terima
                                    </button>
                                </form>

                                <button type="button" onclick="openDeleteModal({{ $siswa->id }}, '{{ $siswa->name }}', 'pending')" class="bg-rose-500 text-white px-3.5 py-1.5 rounded-xl text-xs font-extrabold hover:bg-rose-600 shadow-sm hover:shadow-rose-500/20 transition-all flex items-center cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0">
                                    <i class="fas fa-times mr-1.5 text-[10px]"></i> Tolak
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- TABEL SISWA AKTIF --}}
    <div class="bg-white rounded-3xl shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/70 overflow-hidden">
        {{-- HEADER DAN INPUT PENCARIAN --}}
        <div class="px-6 py-6 border-b border-slate-200/80 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/30">
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Data Siswa Aktif</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Daftar siswa yang sudah resmi terdaftar di sistem.</p>
            </div>
            
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
                {{-- Komponen Input Pencarian Baru --}}
                <div class="relative min-w-[260px]">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fas fa-search text-slate-400 text-xs"></i>
                    </span>
                    <input type="text" id="siswaSearchInput" placeholder="Cari nama atau NIS siswa..." 
                        class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-xl text-xs font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 bg-white outline-none transition-all duration-200 placeholder:text-slate-400">
                </div>

                {{-- INFORMASI TOTAL SISWA AKTIF --}}
                <div class="bg-blue-50/80 text-blue-700 border border-blue-100 px-4 py-2 rounded-xl font-bold text-xs text-center whitespace-nowrap shadow-2xs flex items-center justify-center gap-1.5">
                    <i class="fas fa-users text-blue-500 text-xs"></i>
                    <span>Total: {{ $siswaAktif->count() }} Siswa</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto p-4 sm:p-6">
            <table class="w-full text-left border-collapse min-w-[700px] border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs">
                <thead class="bg-slate-100/80 text-slate-600 uppercase text-[10px] font-extrabold tracking-widest border-b border-slate-200/80 divide-x divide-slate-200/80">
                    <tr>
                        <th class="px-6 py-3.5">No</th>
                        <th class="px-6 py-3.5">Nama Siswa</th>
                        <th class="px-6 py-3.5">NIS</th>
                        <th class="px-6 py-3.5">Jurusan</th>
                        <th class="px-6 py-3.5">Email / Kontak</th>
                        <th class="px-6 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="siswaTableBody" class="divide-y divide-slate-200/80 bg-white">
                    @forelse($siswaAktif as $index => $siswa)
                    <tr class="siswa-row hover:bg-slate-50/90 transition-colors duration-150 divide-x divide-slate-200/80">
                        <td class="px-6 py-4 text-slate-400 text-xs font-medium index-cell">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800 name-cell">
                            <span class="text-sm text-slate-800 tracking-wide">{{ $siswa->name }}</span>
                            <span class="flex items-center gap-1 text-[10px] font-medium text-emerald-600 mt-0.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Akun Aktif
                            </span>
                        </td>
                        
                        {{-- NIS dengan Tombol Salin --}}
                        <td class="px-6 py-4 font-mono text-xs font-semibold text-slate-600 nis-cell">
                            <div class="inline-flex items-center gap-1.5 bg-slate-50 px-2.5 py-1 rounded-md border border-slate-200/70">
                                <span>{{ $siswa->nomor_identitas }}</span>
                                <button type="button" onclick="copyToClipboard('{{ $siswa->nomor_identitas }}', this)" class="text-slate-400 hover:text-blue-600 focus:outline-none transition-colors p-0.5 cursor-pointer" title="Salin NIS">
                                    <i class="far fa-copy text-xs"></i>
                                </button>
                            </div>
                        </td>

                        {{-- Jurusan DENGAN ICON --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-100 text-[10px] font-extrabold px-2.5 py-1 rounded-lg uppercase tracking-wider">
                                <i class="fas fa-graduation-cap text-blue-500 text-xs"></i>
                                <span>{{ $siswa->jurusan->kode_jurusan ?? '-' }}</span>
                            </span>
                        </td>

                        {{-- EMAIL / KONTAK DENGAN ICON GMAIL DAN WHATSAPP --}}
                        <td class="px-6 py-4 text-xs text-slate-500">
                            <div class="flex items-center mb-1 text-slate-600 font-medium">
                                <i class="text-rose-500 mr-2 w-3.5 text-center text-sm">
                                    <svg class="w-3.5 h-3.5 inline-block fill-current text-rose-500" viewBox="0 0 24 24">
                                        <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.272H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L12 9.545l8.073-6.052c1.618-1.214 3.927-.059 3.927 1.964z"/>
                                    </svg>
                                </i>
                                {{ $siswa->email }}
                            </div>
                            <div class="flex items-center text-slate-500">
                                <i class="fab fa-whatsapp text-emerald-500 mr-2 w-3.5 text-center text-sm"></i>
                                <span class="text-slate-600">{{ $siswa->no_hp ?? '-' }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="w-8 h-8 flex items-center justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-xl transition-all duration-200 shadow-2xs border border-amber-200/50 cursor-pointer" title="Edit Data">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <button type="button" onclick="openDeleteModal({{ $siswa->id }}, '{{ $siswa->name }}', 'aktif')" class="w-8 h-8 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition-all duration-200 shadow-2xs border border-rose-200/50 cursor-pointer" title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyPlaceholderRow">
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400 bg-slate-50/50">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <i class="fas fa-user-slash text-3xl text-slate-300"></i>
                                <p class="text-sm font-medium">Belum ada data siswa aktif. Silakan verifikasi pendaftaran baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Baris Cadangan untuk pesan jika hasil pencarian kosong --}}
                    <tr id="noResultRow" class="hidden">
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 bg-slate-50/30 italic text-sm">
                            <i class="fas fa-search mr-1.5 opacity-60"></i> Tidak ditemukan data siswa yang cocok dengan kata kunci pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Kustom Konfirmasi Hapus / Tolak (Desain Modern & Elegan) -->
<div id="deleteCustomModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-md flex items-center justify-center transition-all duration-300 p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md border border-slate-100 transform transition-all animate-modal-in overflow-hidden relative">
        
        <!-- Decoration Gradient Bar -->
        <div class="h-2 w-full bg-gradient-to-r from-red-500 via-rose-500 to-amber-500"></div>

        <!-- Close Button (X) Upper Right -->
        <button type="button" onclick="closeDeleteModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 w-8 h-8 rounded-full flex items-center justify-center transition-all cursor-pointer">
            <i class="fas fa-times text-sm"></i>
        </button>

        <div class="p-7 text-center space-y-5">
            <!-- Animated Warning Badge -->
            <div class="relative mx-auto w-20 h-20 flex items-center justify-center">
                <div class="absolute inset-0 bg-rose-500/10 rounded-3xl animate-ping opacity-75"></div>
                <div class="relative w-20 h-20 bg-gradient-to-tr from-rose-50 to-red-50 text-rose-500 rounded-3xl flex items-center justify-center text-3xl border border-rose-200/60 shadow-inner">
                    <i class="fas fa-exclamation-triangle drop-shadow-sm"></i>
                </div>
            </div>
            
            <div class="space-y-2">
                <h3 id="modalTitle" class="font-black text-slate-900 tracking-tight text-xl">Konfirmasi Hapus Data</h3>
                
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                    Apakah Anda yakin ingin <span id="modalActionText" class="font-bold text-slate-800">menghapus</span> data siswa ini?
                </p>

                <!-- Card Highlight Target Name -->
                <div class="bg-slate-50 border border-slate-200/70 rounded-2xl p-3 my-3 flex items-center justify-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-slate-800 text-white font-black text-xs flex items-center justify-center shrink-0">
                        <i class="fas fa-user text-xs"></i>
                    </div>
                    <span id="modalTargetName" class="font-bold text-slate-800 text-sm tracking-wide truncate max-w-[220px]"></span>
                </div>

                <!-- Alert Warning Container -->
                <div id="modalAlertNote" class="text-xs text-rose-700 bg-rose-50/80 p-3.5 rounded-2xl border border-rose-200/80 font-medium text-left leading-relaxed shadow-2xs"></div>
            </div>
        </div>
        
        <form id="deleteCustomForm" method="POST" class="px-7 pb-7 text-sm bg-white">
            @csrf
            @method('DELETE')
            
            <div class="flex items-center justify-center gap-3 pt-1">
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 px-5 py-3.5 text-xs font-bold text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200/70 rounded-2xl transition-all tracking-wider uppercase cursor-pointer text-center">
                    Batal
                </button>
                <button type="submit" class="w-1/2 bg-gradient-to-r from-red-600 via-rose-600 to-red-500 text-white px-5 py-3.5 rounded-2xl font-bold hover:opacity-95 shadow-lg shadow-rose-500/25 transform hover:-translate-y-0.5 active:translate-y-0 transition-all tracking-wider uppercase cursor-pointer flex items-center justify-center gap-2">
                    <i class="fas fa-trash text-xs"></i> Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Animasi Modal -->
<style>
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.92) translateY(16px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-modal-in { animation: modalIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
</style>

<!-- CDN SweetAlert2 untuk Pop-up Elegan -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SCRIPT PENCARIAN, SALIN CLIENT-SIDE & SWEETALERT INTEGRASI --}}
<script>
    // FUNGSI UNTUK SALIN NIS KE CLIPBOARD
    function copyToClipboard(text, btnElement) {
        if (!text || text === '-') return;

        navigator.clipboard.writeText(text).then(() => {
            const icon = btnElement.querySelector('i');
            
            // Ubah tampilan icon menjadi ceklis hijau
            icon.className = 'fas fa-check text-emerald-500 text-xs';
            btnElement.setAttribute('title', 'Tersalin!');

            // Kembalikan ke icon awal setelah 1.5 detik
            setTimeout(() => {
                icon.className = 'far fa-copy text-xs';
                btnElement.setAttribute('title', 'Salin NIS');
            }, 1500);
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // --- SWEETALERT2 POP-UP SUCCESS DARI CONTROLLER ---
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '<span style="color: #0f172a; font-weight: 800;">Berhasil!</span>',
                html: '<span style="color: #64748b; font-size: 14px;">{{ session('success') }}</span>',
                background: '#ffffff',
                borderRadius: '24px',
                padding: '2rem',
                confirmButtonText: 'Lanjutkan',
                confirmButtonColor: '#0f172a',
                customClass: {
                    popup: 'shadow-2xl border border-slate-100',
                    confirmButton: 'px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-wider'
                }
            });
        @endif

        // --- PENCARIAN SISWA AKTIF ---
        const searchInput = document.getElementById('siswaSearchInput');
        const tableBody = document.getElementById('siswaTableBody');
        
        if (searchInput && tableBody) {
            const rows = tableBody.getElementsByClassName('siswa-row');
            const noResultRow = document.getElementById('noResultRow');
            const emptyPlaceholderRow = document.getElementById('emptyPlaceholderRow');

            searchInput.addEventListener('input', function () {
                const filter = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                // Jika tabel dari database memang kosong sejak awal, lewati fungsi pencarian
                if (emptyPlaceholderRow) return;

                for (let i = 0; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByClassName('name-cell')[0];
                    const nisCell = rows[i].getElementsByClassName('nis-cell')[0];
                    
                    if (nameCell || nisCell) {
                        const nameText = nameCell.textContent || nameCell.innerText;
                        const nisText = nisCell.textContent || nisCell.innerText;

                        if (nameText.toLowerCase().indexOf(filter) > -1 || nisText.toLowerCase().indexOf(filter) > -1) {
                            rows[i].classList.remove('hidden');
                            visibleCount++;
                            
                            // Menata ulang penomoran dinamis agar urutan tetap 1, 2, 3 sesuai hasil filter
                            const indexCell = rows[i].getElementsByClassName('index-cell')[0];
                            if (indexCell) {
                                indexCell.textContent = visibleCount;
                            }
                        } else {
                            rows[i].classList.add('hidden');
                        }
                    }
                }

                // Menampilkan notifikasi "Tidak ditemukan" jika pencarian nihil
                if (visibleCount === 0 && filter !== '') {
                    noResultRow.classList.remove('hidden');
                } else {
                    noResultRow.classList.add('hidden');
                }
            });
        }
    });

    // SISTEM PENGATURAN SWEETALERT UNTUK VERIFIKASI AKUN
    function confirmVerify(formId, namaSiswa) {
        Swal.fire({
            title: '<span style="color: #0f172a; font-weight: 800;">Verifikasi Akun?</span>',
            html: 'Aktifkan pendaftaran & akses akun untuk siswa <b>' + namaSiswa + '</b>?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Terima',
            cancelButtonText: 'Batal',
            background: '#ffffff',
            borderRadius: '24px',
            padding: '2rem',
            customClass: {
                popup: 'shadow-2xl border border-slate-100',
                confirmButton: 'px-5 py-3 rounded-xl font-bold text-xs uppercase tracking-wider',
                cancelButton: 'px-5 py-3 rounded-xl font-bold text-xs uppercase tracking-wider'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }

    // SISTEM PENGATURAN MODAL KUSTOM HAPUS / TOLAK
    function openDeleteModal(id, name, type) {
        const modal = document.getElementById('deleteCustomModal');
        const form = document.getElementById('deleteCustomForm');
        const modalTitle = document.getElementById('modalTitle');
        const modalActionText = document.getElementById('modalActionText');
        const modalTargetName = document.getElementById('modalTargetName');
        const modalAlertNote = document.getElementById('modalAlertNote');

        // Isi nama target
        modalTargetName.innerText = name;

        // Bedakan keterangan & rute tujuan berdasarkan jenis tombol yang diklik
        if (type === 'pending') {
            modalTitle.innerText = "Konfirmasi Tolak Pendaftaran";
            modalActionText.innerText = "menolak serta menghapus pendaftaran";
            modalAlertNote.innerHTML = "<i class='fas fa-info-circle mr-1 text-rose-600'></i> Berkas pendaftaran awal siswa ini akan dihapus permanen dari antrean verifikasi.";
            
            // Masukkan route destroy pendaftaran pending
            let url = "{{ route('admin.siswa.destroy', ':id') }}";
            form.action = url.replace(':id', id);
        } else {
            modalTitle.innerText = "Konfirmasi Hapus Siswa Aktif";
            modalActionText.innerText = "menghapus akun beserta data permanen";
            modalAlertNote.innerHTML = "<i class='fas fa-exclamation-circle mr-1 text-rose-600'></i> <b>Tindakan Berbahaya!</b> Logbook harian dan seluruh akumulasi nilai siswa terkait akan ikut terhapus dari basis data.";
            
            // Masukkan route destroy akun aktif
            let url = "{{ route('admin.siswa.destroy', ':id') }}";
            form.action = url.replace(':id', id);
        }

        // Munculkan Modal
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteCustomModal').classList.add('hidden');
    }
</script>
@endsection