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
            <a href="{{ route('admin.placement.create') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-2xl shadow-lg shadow-blue-600/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 text-xs sm:text-sm uppercase tracking-wider group cursor-pointer whitespace-nowrap">
                <i class="fas fa-plus-circle mr-2 text-base transition-transform group-hover:rotate-90 duration-300"></i> Plotting Baru
            </a>
        </div>
    </div>

    {{-- KOTAK PENCARIAN & STATISTIK RINGKASAN --}}
    <div class="bg-white p-5 sm:p-6 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-5">
        
        <!-- Grid Ringkasan Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 w-full lg:w-auto">
            
            {{-- Statistik Total Semua Siswa --}}
            <div class="bg-slate-50 hover:bg-slate-100/80 transition-colors p-3.5 rounded-2xl border border-slate-200/80 flex items-center justify-between group shadow-2xs">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-200/70 text-slate-700 flex items-center justify-center font-bold shadow-inner">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Siswa</p>
                        <p class="text-xs font-semibold text-slate-600">Terdaftar</p>
                    </div>
                </div>
                <span class="text-xs sm:text-sm font-black bg-white text-slate-800 px-3 py-1 rounded-xl border border-slate-200 shadow-2xs whitespace-nowrap">
                    {{ $placements->count() }} Siswa
                </span>
            </div>

            {{-- Statistik Siswa Aktif --}}
            <div class="bg-emerald-50/70 hover:bg-emerald-50 transition-colors p-3.5 rounded-2xl border border-emerald-100 flex items-center justify-between group shadow-2xs">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold shadow-inner">
                        <i class="fas fa-running text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600/70">Aktif Magang</p>
                        <p class="text-xs font-semibold text-emerald-700">Sedang Jalan</p>
                    </div>
                </div>
                <span class="text-xs sm:text-sm font-black bg-white text-emerald-700 px-3 py-1 rounded-xl border border-emerald-200/80 shadow-2xs whitespace-nowrap">
                    {{ $placements->where('status', 'aktif')->count() }} Siswa
                </span>
            </div>

            {{-- Statistik Siswa Selesai --}}
            <div class="bg-blue-50/70 hover:bg-blue-50 transition-colors p-3.5 rounded-2xl border border-blue-100 flex items-center justify-between group shadow-2xs">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold shadow-inner">
                        <i class="fas fa-check-circle text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-blue-600/70">Lulus / Selesai</p>
                        <p class="text-xs font-semibold text-blue-700">Selesai PKL</p>
                    </div>
                </div>
                <span class="text-xs sm:text-sm font-black bg-white text-blue-700 px-3 py-1 rounded-xl border border-blue-200/80 shadow-2xs whitespace-nowrap">
                    {{ $placements->where('status', 'selesai')->count() }} Siswa
                </span>
            </div>

        </div>
        
        <!-- Input Pencarian -->
        <div class="relative w-full lg:w-80 flex-shrink-0 group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                <i class="fas fa-search text-sm"></i>
            </span>
            <input type="text" id="placementSearchInput" placeholder="Cari siswa, instansi, atau guru..." 
                class="w-full pl-11 pr-4 py-3 bg-slate-50/80 focus:bg-white border border-slate-200 rounded-2xl text-xs sm:text-sm font-semibold text-slate-700 placeholder-slate-400 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 shadow-2xs">
        </div>
    </div>

    <!-- MAIN TABLE SECTION -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 uppercase text-[11px] font-black tracking-wider border-b border-slate-100">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Lokasi Magang (Instansi)</th>
                        <th class="px-6 py-4">Pembimbing</th>
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
                                    <div class="text-[11px] text-slate-400 font-semibold tracking-wide mt-0.5">{{ $placement->siswa->nomor_identitas }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="font-bold text-slate-800 instansi-cell leading-snug">{{ $placement->instansi->nama_perusahaan }}</div>
                            <div class="text-xs text-slate-400 font-medium mt-0.5 line-clamp-1" title="{{ $placement->instansi->alamat }}">{{ $placement->instansi->alamat }}</div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex flex-col gap-2.5">
                                <div class="flex items-center text-slate-700 text-xs font-semibold" title="Guru Sekolah">
                                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-2.5 flex-shrink-0">
                                        <i class="fas fa-chalkboard-teacher text-xs"></i>
                                    </span>
                                    <span class="leading-snug guru-cell text-slate-800">{{ $placement->guru->name }}</span>
                                </div>

                                @if($placement->mentor_id)
                                    <div class="flex items-center text-slate-700 text-xs font-semibold" title="Mentor Industri">
                                        <span class="w-6 h-6 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center mr-2.5 flex-shrink-0">
                                            <i class="fas fa-user-tie text-xs"></i>
                                        </span>
                                        <span class="leading-snug text-slate-800">{{ $placement->mentor->name }}</span>
                                    </div>
                                @else
                                    <span class="inline-flex items-center text-amber-700 bg-amber-50 border border-amber-200/60 px-2.5 py-1 rounded-xl text-[11px] font-extrabold w-fit animate-pulse">
                                        <i class="fas fa-exclamation-triangle mr-1.5 text-xs text-amber-500"></i> Belum Ada Mentor
                                    </span>
                                @endif
                            </div>
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
                        <td colspan="7" class="px-6 py-16 text-center text-slate-400 bg-slate-50/50">
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
                        <td colspan="7" class="px-6 py-10 text-center text-slate-400 bg-slate-50/50 italic text-xs font-medium">
                            <i class="fas fa-search-minus mr-2 text-slate-300 text-base"></i>
                            Tidak ditemukan data penempatan magang yang cocok dengan kata kunci pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL POP-UP KONFIRMASI HAPUS --}}
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

{{-- SCRIPT PENCARIAN & MODAL JS (TIDAK DIUBAH SAMA SEKALIKAN LOGIKANYA) --}}
<script>
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

                // Jika data memang kosong dari database, hentikan eksekusi pencarian
                if (emptyPlaceholderRow) return;

                for (let i = 0; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByClassName('name-cell')[0];
                    const instansiCell = rows[i].getElementsByClassName('instansi-cell')[0];
                    const guruCell = rows[i].getElementsByClassName('guru-cell')[0];
                    
                    if (nameCell || instansiCell || guruCell) {
                        const nameText = nameCell.textContent || nameCell.innerText;
                        const instansiText = instansiCell.textContent || instansiCell.innerText;
                        const guruText = guruCell.textContent || guruCell.innerText;

                        // Mencocokkan dengan Nama Siswa, Lokasi Instansi, atau Nama Guru Pembimbing
                        if (
                            nameText.toLowerCase().indexOf(filter) > -1 || 
                            instansiText.toLowerCase().indexOf(filter) > -1 ||
                            guruText.toLowerCase().indexOf(filter) > -1
                        ) {
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

                // Menampilkan notifikasi jika filter kata kunci menghasilkan data kosong
                if (visibleCount === 0 && filter !== '') {
                    noResultRow.classList.remove('hidden');
                } else {
                    noResultRow.classList.add('hidden');
                }
            });
        }

        // --- LOGIK MODAL DELETE KUSTOM ---
        const modal = document.getElementById('deleteConfirmationModal');
        const btnCancel = document.getElementById('btnCancelDelete');
        const btnConfirm = document.getElementById('btnConfirmDelete');
        let formToSubmit = null;

        // Delegasi event untuk mendeteksi klik tombol hapus di dalam tabel
        document.addEventListener('click', function (e) {
            const triggerBtn = e.target.closest('.btn-trigger-delete');
            if (triggerBtn) {
                e.preventDefault();
                // Simpan referensi form terkait yang ingin dieksekusi
                formToSubmit = triggerBtn.closest('.delete-placement-form');
                
                // Tampilkan modal
                if (modal) {
                    modal.classList.remove('hidden');
                }
            }
        });

        // Menutup modal saat klik tombol Kembali
        if (btnCancel) {
            btnCancel.addEventListener('click', function () {
                if (modal) {
                    modal.classList.add('hidden');
                }
                formToSubmit = null;
            });
        }

        // Mengeksekusi form submit asli saat klik tombol Ya, Batalkan
        if (btnConfirm) {
            btnConfirm.addEventListener('click', function () {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });
        }

        // Menutup modal jika area backdrop (luar card) diklik
        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal.querySelector('.bg-slate-950\\/60')) {
                    modal.classList.add('hidden');
                    formToSubmit = null;
                }
            });
        }
    });
</script>
@endsection