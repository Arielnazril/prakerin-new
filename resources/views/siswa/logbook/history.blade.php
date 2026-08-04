@extends('layouts.siswa_layout')

@section('page_title', 'Riwayat Logbook')

@section('content')

<div class="space-y-6 select-none pb-12 antialiased">
    
    {{-- TOP BAR SECTION (DARK SLATE & AMBER ACCENT) --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-900 p-6 sm:p-7 rounded-3xl border border-slate-800 shadow-xl shadow-slate-900/20 relative overflow-hidden group">
        {{-- Elegant Accent Elements --}}
        <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-amber-500/10 via-amber-500/5 to-transparent pointer-events-none"></div>
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-amber-600/15 rounded-full blur-2xl group-hover:bg-amber-600/25 transition-all duration-700 pointer-events-none"></div>

        <div class="relative z-10 space-y-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-[11px] font-extrabold text-amber-400 tracking-wider uppercase mb-1">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span> Activity Logs
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight flex items-center gap-2.5">
                <span class="w-2 h-7 bg-amber-500 rounded-full inline-block"></span>
                Jurnal Kegiatan
            </h2>
            <p class="text-xs sm:text-sm text-slate-300 font-medium pl-4">
                Daftar kegiatan harian yang telah kamu kerjakan selama masa magang.
            </p>
        </div>
        
        <a href="{{ route('siswa.logbook.create') }}" class="relative z-10 w-full sm:w-auto bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-bold py-3.5 px-6 rounded-2xl shadow-lg shadow-amber-900/30 flex items-center justify-center transition-all duration-200 transform hover:-translate-y-0.5 active:scale-95 text-sm border border-amber-500/30 shrink-0">
            <i class="fas fa-plus-circle mr-2 text-base"></i> Tulis Kegiatan
        </a>
    </div>

    {{-- FITUR BARU: RINGKASAN REKAP LOGBOOK --}}
    @if(count($logbooks) > 0)
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
            <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Total Entri</p>
                    <p class="text-xl font-black text-slate-800 font-mono mt-0.5">{{ count($logbooks) }}</p>
                </div>
                <div class="p-2.5 bg-slate-100 text-slate-700 rounded-xl">
                    <i class="fas fa-list text-sm"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Disetujui</p>
                    <p class="text-xl font-black text-emerald-600 font-mono mt-0.5">{{ $logbooks->where('status', 'disetujui')->count() }}</p>
                </div>
                <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
                    <i class="fas fa-check text-sm"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Pending</p>
                    <p class="text-xl font-black text-amber-600 font-mono mt-0.5">{{ $logbooks->where('status', 'pending')->count() }}</p>
                </div>
                <div class="p-2.5 bg-amber-50 text-amber-600 rounded-xl">
                    <i class="fas fa-clock text-sm"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Ditolak</p>
                    <p class="text-xl font-black text-red-600 font-mono mt-0.5">{{ $logbooks->where('status', 'ditolak')->count() }}</p>
                </div>
                <div class="p-2.5 bg-red-50 text-red-600 rounded-xl">
                    <i class="fas fa-times text-sm"></i>
                </div>
            </div>
        </div>
    @endif

    {{-- LOGBOOK CARDS CONTAINER --}}
    <div class="space-y-4">
        @forelse($logbooks as $logbook)
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 p-5 md:p-6 hover:shadow-xl hover:border-slate-300 transition-all duration-300 relative overflow-hidden group">
            
            {{-- Status Strip Accent for Card --}}
            <div class="absolute left-0 top-0 bottom-0 w-2 
                @if($logbook->status == 'disetujui') bg-emerald-500
                @elseif($logbook->status == 'ditolak') bg-red-500
                @else bg-amber-500 @endif">
            </div>

            <div class="flex flex-col md:flex-row gap-6">

                {{-- LEFT COLUMN: DATE & TIME --}}
                <div class="md:w-1/5 flex flex-row md:flex-col justify-between md:justify-start border-b md:border-b-0 md:border-r border-slate-100 pb-4 md:pb-0 md:pr-5">
                    <div class="text-center md:text-left">
                        <span class="block text-4xl font-black text-slate-900 tracking-tight leading-none font-mono">{{ $logbook->tanggal->format('d') }}</span>
                        <span class="block text-xs font-extrabold text-amber-700 uppercase tracking-widest mt-1.5">{{ $logbook->tanggal->format('M Y') }}</span>
                    </div>
                    <div class="text-right md:text-left md:mt-5">
                        <span class="block text-[10px] text-slate-400 font-black uppercase tracking-wider">Jam Kerja</span>
                        <span class="inline-flex items-center text-xs font-mono font-bold text-slate-800 bg-slate-100 border border-slate-200/80 px-2.5 py-1.5 rounded-xl mt-1 shadow-2xs">
                            <i class="far fa-clock mr-1.5 text-amber-600"></i>
                            {{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}
                        </span>
                    </div>
                </div>

                {{-- MIDDLE COLUMN: MAIN CONTENT & DOCUMENTATION --}}
                <div class="md:w-3/5 space-y-3">
                    <h3 class="font-bold text-xs text-slate-400 uppercase tracking-wider flex items-center justify-between">
                        <span class="flex items-center">
                            <i class="fas fa-clipboard-list mr-2 text-slate-800"></i> Deskripsi Kegiatan
                        </span>
                        @if($logbook->foto)
                            <span class="text-[10px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200/60">
                                <i class="fas fa-camera mr-1"></i> Dokumentasi
                            </span>
                        @endif
                    </h3>
                    <p class="text-slate-800 leading-relaxed whitespace-pre-line text-sm font-medium bg-slate-50/70 p-4 rounded-2xl border border-slate-200/60">{{ $logbook->kegiatan }}</p>

                    @if($logbook->foto)
                        <div class="mt-4 pt-1">
                            <p class="text-[10px] text-slate-400 mb-1.5 font-black uppercase tracking-wider">Dokumentasi Terlampir:</p>
                            <div class="relative inline-block overflow-hidden rounded-2xl border border-slate-200 shadow-sm bg-slate-50 group/img">
                                <img src="{{ asset('storage/' . $logbook->foto) }}" alt="Bukti Kegiatan" class="h-28 w-auto object-cover hover:scale-105 transition duration-300 cursor-pointer rounded-2xl" onclick="window.open(this.src)">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover/img:opacity-100 transition duration-200 pointer-events-none flex items-center justify-center rounded-2xl backdrop-blur-xs">
                                    <i class="fas fa-search-plus text-white text-lg drop-shadow"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT COLUMN: STATUS BADGES & ACTION BUTTONS --}}
                <div class="md:w-1/5 flex flex-row md:flex-col justify-between items-center md:items-end border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0 md:pl-5 gap-4">
                    
                    {{-- Status Pills --}}
                    <div>
                        @if($logbook->status == 'disetujui')
                            <span class="bg-emerald-50 text-emerald-800 px-3.5 py-1.5 rounded-xl text-xs font-bold flex items-center border border-emerald-200/80 shadow-2xs">
                                <span class="h-2 w-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span> Disetujui
                            </span>
                        @elseif($logbook->status == 'ditolak')
                            <span class="bg-red-50 text-red-800 px-3.5 py-1.5 rounded-xl text-xs font-bold flex items-center border border-red-200/80 shadow-2xs">
                                <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span> Ditolak
                            </span>
                        @else
                            <span class="bg-amber-50 text-amber-900 px-3.5 py-1.5 rounded-xl text-xs font-bold flex items-center border border-amber-200/80 shadow-2xs">
                                <span class="h-2 w-2 rounded-full bg-amber-500 mr-2 animate-ping"></span> Pending
                            </span>
                        @endif
                    </div>

                    {{-- Actions Container (Edit & Hapus Selalu Tersedia) --}}
                    <div class="flex space-x-2">
                        <a href="{{ route('siswa.logbook.edit', $logbook->id) }}" class="text-amber-700 hover:text-white hover:bg-amber-600 border border-amber-200 hover:border-amber-600 p-2.5 rounded-xl transition shadow-2xs active:scale-95 bg-amber-50/50 text-sm" title="Edit Logbook">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('siswa.logbook.destroy', $logbook->id) }}" method="POST" class="delete-logbook-form">
                            @csrf @method('DELETE')
                            <button type="button" class="btn-trigger-delete-logbook text-red-600 hover:text-white hover:bg-red-600 border border-red-200 hover:border-red-600 p-2.5 rounded-xl transition shadow-2xs active:scale-95 bg-red-50/50 text-sm cursor-pointer" title="Hapus Logbook">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- FEEDBACK/MENTOR NOTES SECTION --}}
            @if($logbook->catatan_pembimbing)
                <div class="mt-5 bg-slate-900/5 p-4 rounded-2xl border border-slate-200/80 text-sm text-slate-800">
                    <span class="font-extrabold text-slate-900 block mb-1 text-xs uppercase tracking-wider flex items-center">
                        <i class="fas fa-comment-dots mr-1.5 text-amber-600 text-sm"></i> Catatan Mentor / Pembimbing:
                    </span>
                    <p class="italic text-slate-700 font-medium leading-relaxed">"{{ $logbook->catatan_pembimbing }}"</p>
                </div>
            @endif
        </div>
        @empty
        {{-- EMPTY STATE SECTION --}}
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300 shadow-xs max-w-2xl mx-auto my-6">
            <div class="h-20 w-20 bg-slate-900/5 rounded-3xl flex items-center justify-center mx-auto mb-4 border border-slate-200">
                <i class="fas fa-book-reader text-slate-800 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900 tracking-tight">Belum ada kegiatan</h3>
            <p class="text-slate-400 text-xs sm:text-sm mb-6 font-medium max-w-xs mx-auto">Kamu belum mengisi logbook sama sekali. Catat progres magang harianmu di sini.</p>
            <a href="{{ route('siswa.logbook.create') }}" class="inline-flex items-center justify-center bg-slate-900 text-white px-7 py-3.5 rounded-2xl font-bold hover:bg-slate-800 shadow-lg transition active:scale-95 text-sm border border-slate-700">
                <i class="fas fa-plus-circle mr-2"></i> Mulai Isi Sekarang
            </a>
        </div>
        @endforelse
    </div>
</div>

{{-- MODAL POP-UP KONFIRMASI HAPUS LOGBOOK --}}
<div id="deleteLogbookModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    {{-- Backdrop dengan Efek Blur --}}
    <div id="deleteLogbookBackdrop" class="absolute inset-0 bg-slate-950/60 backdrop-blur-md transition-opacity duration-300 opacity-0"></div>
    
    {{-- Card Content Modal --}}
    <div id="deleteLogbookCard" class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full mx-4 p-7 transform transition-all duration-300 scale-95 opacity-0 border border-slate-100 overflow-hidden text-center z-10">
        <div class="flex flex-col items-center">
            {{-- Icon Danger Animated --}}
            <div class="h-16 w-16 bg-red-50 text-red-600 rounded-2xl border border-red-100 flex items-center justify-center text-2xl mb-4 shadow-lg shadow-red-500/10">
                <i class="fas fa-trash-alt animate-bounce"></i>
            </div>
            
            <h3 class="text-xl font-black text-slate-900 mb-2 tracking-tight">Hapus Logbook Kegiatan?</h3>
            <p class="text-xs sm:text-sm text-slate-500 font-medium leading-relaxed mb-6">
                Apakah kamu yakin ingin menghapus catatan kegiatan harian ini? Tindakan ini <span class="font-bold text-red-600">tidak dapat dibatalkan</span>.
            </p>
            
            {{-- Action Buttons --}}
            <div class="flex w-full gap-3">
                <button type="button" id="btnCancelDeleteLogbook" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 px-4 rounded-2xl transition text-xs uppercase tracking-wider outline-none cursor-pointer">
                    Batal
                </button>
                <button type="button" id="btnConfirmDeleteLogbook" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-2xl shadow-lg shadow-red-600/30 hover:shadow-xl transition text-xs uppercase tracking-wider outline-none cursor-pointer">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PENGENDALI MODAL HAPUS LOGBOOK --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('deleteLogbookModal');
        const backdrop = document.getElementById('deleteLogbookBackdrop');
        const card = document.getElementById('deleteLogbookCard');
        const btnCancel = document.getElementById('btnCancelDeleteLogbook');
        const btnConfirm = document.getElementById('btnConfirmDeleteLogbook');
        let formToSubmit = null;

        function openModal() {
            if (!modal) return;
            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            if (!modal) return;
            backdrop.classList.add('opacity-0');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                formToSubmit = null;
            }, 300);
        }

        document.addEventListener('click', function (e) {
            const triggerBtn = e.target.closest('.btn-trigger-delete-logbook');
            if (triggerBtn) {
                e.preventDefault();
                formToSubmit = triggerBtn.closest('.delete-logbook-form');
                openModal();
            }
        });

        if (btnCancel) {
            btnCancel.addEventListener('click', closeModal);
        }

        if (backdrop) {
            backdrop.addEventListener('click', closeModal);
        }

        if (btnConfirm) {
            btnConfirm.addEventListener('click', function () {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });
        }
    });
</script>
@endsection