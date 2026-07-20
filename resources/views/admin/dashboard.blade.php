@extends('layouts.admin_layout')

@section('page_title', 'Dashboard Administrator')

@section('content')
<div class="space-y-8 select-none pb-12">

    {{-- KARTU UCAPAN SELAMAT DATANG (ELEGAN & INTERAKTIF) --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950 p-6 sm:p-8 text-white shadow-xl shadow-slate-900/10 border border-slate-700/60 transition-all duration-500 hover:-translate-y-0.5 group">
        {{-- Light Glow Overlay & Decorative Blur --}}
        <div class="absolute -right-12 -top-12 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl group-hover:bg-blue-400/30 transition-all duration-700 pointer-events-none"></div>
        <div class="absolute -left-12 -bottom-12 w-56 h-56 bg-indigo-500/20 rounded-full blur-2xl group-hover:bg-indigo-400/30 transition-all duration-700 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-extrabold text-blue-300 tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Control Center
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight flex flex-wrap items-center gap-2.5">
                    Selamat Datang, 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-sky-300 font-black tracking-wide">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </span>
                    <span class="inline-block animate-bounce text-2xl sm:text-3xl">👋</span>
                </h2>
                <p class="text-slate-300 text-sm sm:text-base font-medium leading-relaxed">Panel kontrol pusat untuk memantau kegiatan PKL dan Verifikasi Pendaftaran secara real-time.</p>
            </div>

            <div class="relative z-10 bg-white/10 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/15 text-white text-sm font-bold shadow-lg flex items-center shrink-0 gap-4 w-full sm:w-auto justify-between sm:justify-start">
                <div class="flex items-center border-r border-white/20 pr-4 text-slate-200">
                    <i class="far fa-calendar-alt mr-2.5 text-blue-400 text-base animate-pulse"></i> 
                    <span id="digital-date" class="font-bold text-xs sm:text-sm text-slate-100">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <div class="flex items-center pl-1 font-mono tracking-wider bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-3.5 py-1.5 rounded-xl text-xs font-black shadow-md border border-blue-400/30 group-hover:scale-105 transition-transform">
                    <i class="far fa-clock mr-2 text-xs animate-spin" style="animation-duration: 8s;"></i>
                    <span id="digital-clock">00:00:00</span>
                </div>
            </div>
        </div>
    </div>

    {{-- GRID KARTU STATISTIK (SIMETRIS, GLASS-LIKE, HOVER ANIMATED) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5 sm:gap-6">

        {{-- Total Siswa --}}
        <div class="stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-blue-500 group cursor-pointer flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-blue-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-blue-600 transition-colors">Total Siswa</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $totalSiswa }}">0</h3>
                </div>
                <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl border border-blue-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-blue-600 group-hover:to-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-blue-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Terdaftar Sistem</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-blue-500"></i>
            </div>
        </div>

        {{-- Guru Pembimbing --}}
        <a href="{{ route('admin.guru.index') }}" class="block stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 hover:z-20 border-t-4 border-t-emerald-500 group cursor-pointer no-underline flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-emerald-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Guru Pembimbing</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $totalGuru }}">0</h3>
                </div>
                <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-emerald-600 group-hover:to-teal-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Tenaga Pendidik</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-emerald-500"></i>
            </div>
        </a>

        {{-- Mitra Industri --}}
        <a href="{{ route('admin.instansi.index') }}" class="block stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 hover:z-20 border-t-4 border-t-purple-500 group cursor-pointer no-underline flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-purple-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-purple-600 transition-colors">Mitra Industri</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $totalIndustri }}">0</h3>
                </div>
                <div class="p-3.5 bg-purple-50 text-purple-600 rounded-2xl border border-purple-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-purple-600 group-hover:to-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-purple-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-building text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Perusahaan Partner</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-purple-500"></i>
            </div>
        </a>

        {{-- Mentor Industri --}}
        <div class="stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 border-t-4 border-t-cyan-500 group cursor-pointer flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-cyan-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-cyan-600 transition-colors">Mentor Industri</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $totalMentor }}">0</h3>
                </div>
                <div class="p-3.5 bg-cyan-50 text-cyan-600 rounded-2xl border border-cyan-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-cyan-600 group-hover:to-blue-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-cyan-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-user-tie text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Pembimbing Lapangan</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-cyan-500"></i>
            </div>
        </div>

        {{-- Sedang Magang --}}
        <a href="{{ route('admin.siswa.index') }}" class="block stat-card relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 transform hover:-translate-y-1.5 hover:z-20 border-t-4 border-t-amber-500 group cursor-pointer no-underline flex flex-col justify-between h-48">
            <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-amber-50/80 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-3">
                <div class="space-y-1.5">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest group-hover:text-amber-600 transition-colors">Sedang Magang</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight font-mono counter-val" data-target="{{ $siswaMagang }}">0</h3>
                </div>
                <div class="p-3.5 bg-amber-50 text-amber-600 rounded-2xl border border-amber-100 transition-all duration-300 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:to-amber-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-amber-500/30 group-hover:rotate-6 shrink-0">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
            </div>
            <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-400 font-bold justify-between mt-auto">
                <span>Siswa Aktif PKL</span>
                <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-amber-500"></i>
            </div>
        </a>

    </div>

    {{-- TABEL VERIFIKASI PENDAFTARAN (MODERN & RESPONSIVE) --}}
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-slate-200/80 transition-all duration-300 hover:shadow-md">
        <div class="px-6 sm:px-8 py-5 border-b border-slate-100 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 bg-gradient-to-r from-slate-50/90 via-white to-slate-50/90">
            <div class="flex items-center">
                <div class="bg-rose-50 p-3 rounded-2xl mr-4 border border-rose-100 text-rose-500 shadow-2xs group-hover:scale-105 transition-transform shrink-0">
                    <i class="fas fa-user-plus text-lg animate-pulse"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base sm:text-lg tracking-tight">Verifikasi Pendaftaran Siswa</h3>
                    <p class="text-xs sm:text-sm text-slate-400 mt-0.5 font-medium">Daftar siswa baru yang menunggu persetujuan verifikasi akun</p>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full lg:w-auto justify-between lg:justify-end">
                {{-- Live Search Input untuk Tabel Verifikasi --}}
                @if($siswaPending->count() > 0)
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="verifySearchInput" placeholder="Cari nama, NIS, jurusan..." 
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200/80 rounded-xl text-xs font-semibold text-slate-700 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-400 focus:bg-white outline-none transition-all shadow-2xs">
                </div>
                @endif

                @if($siswaPending->count() > 0)
                    <span class="bg-gradient-to-r from-rose-500 to-red-600 text-white py-1.5 px-4 rounded-xl text-[11px] font-black uppercase tracking-wider shadow-sm shadow-rose-500/20 animate-pulse whitespace-nowrap border border-rose-600/10 shrink-0">
                        {{ $siswaPending->count() }} Perlu Tindakan
                    </span>
                @else
                    <span class="bg-emerald-50 text-emerald-700 py-1.5 px-4 rounded-xl text-[11px] font-black uppercase tracking-wider border border-emerald-200/80 shadow-2xs whitespace-nowrap shrink-0 flex items-center gap-1.5">
                        <i class="fas fa-check-circle text-emerald-500"></i> Semua Beres
                    </span>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/80 text-slate-400 uppercase text-[10px] font-black tracking-widest border-b border-slate-100">
                    <tr>
                        <th class="px-6 sm:px-8 py-4">Nama Siswa</th>
                        <th class="px-6 py-4">NIS</th>
                        <th class="px-6 py-4">Jurusan</th>
                        <th class="px-6 py-4">Tanggal Daftar</th>
                        <th class="px-6 sm:px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="verifyTableBody" class="divide-y divide-slate-100 text-sm">
                    @forelse($siswaPending as $siswa)
                    <tr class="pending-row hover:bg-slate-50/80 transition-all duration-200 group">
                        <td class="px-6 sm:px-8 py-4 font-extrabold text-slate-800 tracking-wide search-target">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-md shadow-blue-500/10 group-hover:scale-105 transition-transform shrink-0">
                                    {{ substr($siswa->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $siswa->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-mono text-xs font-semibold tracking-wider search-target">
                            <span class="bg-slate-100/70 group-hover:bg-white px-3 py-1.5 rounded-lg border border-slate-200/60 text-slate-700 shadow-2xs inline-block">{{ $siswa->nomor_identitas }}</span>
                        </td>
                        <td class="px-6 py-4 search-target">
                            <span class="bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100 group-hover:text-indigo-800 px-3 py-1 rounded-full text-[10px] font-black border border-indigo-100 uppercase tracking-wider shadow-2xs transition-colors inline-block">
                                {{ $siswa->jurusan->kode_jurusan ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs font-semibold">
                            <div class="flex items-center bg-slate-50/80 group-hover:bg-white w-max px-3 py-1.5 rounded-xl border border-slate-200/60 transition-colors shadow-2xs">
                                <i class="far fa-calendar-alt mr-2 text-blue-500 text-xs"></i>
                                {{ $siswa->created_at->locale('id')->isoFormat('D MMMM Y') }}
                            </div>
                        </td>
                        <td class="px-6 sm:px-8 py-4">
                            <div class="flex justify-center items-center gap-2">
                                {{-- Form Terima dengan Konfirmasi Kustom --}}
                                <form action="{{ route('admin.siswa.verify', $siswa->id) }}" method="POST" class="form-verify-approve">
                                    @csrf
                                    <button type="button" data-name="{{ $siswa->name }}" class="btn-approve bg-emerald-500 text-white px-3.5 py-1.5 rounded-xl text-xs font-black hover:bg-emerald-600 shadow-sm shadow-emerald-500/20 hover:shadow-md hover:shadow-emerald-500/30 transition-all flex items-center transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                                        <i class="fas fa-check mr-1.5 text-[10px]"></i> Terima
                                    </button>
                                </form>

                                {{-- Form Tolak dengan Konfirmasi Kustom --}}
                                <form action="{{ route('admin.siswa.reject', $siswa->id) }}" method="POST" class="form-verify-reject">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" data-name="{{ $siswa->name }}" class="btn-reject bg-rose-500 text-white px-3.5 py-1.5 rounded-xl text-xs font-black hover:bg-rose-600 shadow-sm shadow-rose-500/20 hover:shadow-md hover:shadow-rose-500/30 transition-all flex items-center transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                                        <i class="fas fa-trash mr-1.5 text-[10px]"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-slate-400 bg-slate-50/30">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="h-16 w-16 bg-white text-slate-300 rounded-3xl flex items-center justify-center mb-4 border border-dashed border-slate-200 shadow-sm group hover:rotate-12 transition-transform duration-300">
                                    <i class="fas fa-clipboard-check text-2xl text-slate-300"></i>
                                </div>
                                <p class="text-sm font-black text-slate-700 tracking-tight">Tidak ada pendaftaran baru</p>
                                <p class="text-xs text-slate-400 mt-1 font-medium leading-relaxed">Semua akun pendaftaran siswa saat ini telah selesai diverifikasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Baris Pesan Live Search Tidak Ditemukan --}}
                    <tr id="noVerifyResult" class="hidden">
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 bg-slate-50/50 italic text-xs font-medium">
                            <i class="fas fa-search-minus mr-2 text-slate-400"></i>
                            Siswa yang dicari tidak ditemukan dalam daftar verifikasi pending.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- MODAL POP-UP KONFIRMASI INTERAKTIF KUSTOM (VERIFIKASI / TOLAK) --}}
<div id="actionModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300" id="modalBackdrop"></div>
    
    {{-- Card Content --}}
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full mx-4 p-7 transform transition-all border border-slate-100 overflow-hidden scale-95 opacity-0 duration-300" id="modalCard">
        <div class="flex flex-col items-center text-center">
            {{-- Dynamic Icon Container --}}
            <div id="modalIconBg" class="h-16 w-16 rounded-full flex items-center justify-center text-2xl mb-4 shadow-inner transition-colors duration-300">
                <i id="modalIcon" class="fas"></i>
            </div>
            
            <h3 id="modalTitle" class="text-xl font-black text-slate-900 mb-1 tracking-tight">Konfirmasi Action</h3>
            <p id="modalDescription" class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6 font-medium">
                Apakah Anda yakin ingin melakukan tindakan ini pada <span id="modalTargetName" class="font-bold text-slate-800"></span>?
            </p>
            
            {{-- Action Buttons --}}
            <div class="flex w-full gap-3">
                <button type="button" id="btnCancelModal" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold py-3 px-4 rounded-xl transition text-xs outline-none cursor-pointer">
                    Batal
                </button>
                <button type="button" id="btnConfirmModal" class="flex-1 text-white font-extrabold py-3 px-4 rounded-xl shadow-md transition text-xs outline-none cursor-pointer transform hover:-translate-y-0.5">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT JAVASCRIPT LENGKAP & INTERAKTIF --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // 1. JAM & TANGGAL DIGITAL REAL-TIME
        function updateClock() {
            const now = new Date();
            
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            const clockElement = document.getElementById('digital-clock');
            if (clockElement) {
                clockElement.textContent = `${hours}:${minutes}:${seconds}`;
            }

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const dayName = days[now.getDay()];
            const dayOfMonth = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();

            const dateElement = document.getElementById('digital-date');
            if (dateElement) {
                dateElement.textContent = `${dayName}, ${dayOfMonth} ${monthName} ${year}`;
            }
        }
        updateClock();
        setInterval(updateClock, 1000);

        // 2. COUNTER ANIMATION UNTUK KARTU STATISTIK
        const counters = document.querySelectorAll('.counter-val');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            if (target === 0) {
                counter.innerText = '0';
                return;
            }
            
            let count = 0;
            const speed = 200; // Semakin kecil semakin cepat
            const inc = target / (speed / 10);

            const updateCount = () => {
                count += inc;
                if (count < target) {
                    counter.innerText = Math.ceil(count);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });

        // 3. LIVE SEARCH TABEL VERIFIKASI
        const searchInput = document.getElementById('verifySearchInput');
        const verifyTableBody = document.getElementById('verifyTableBody');
        
        if (searchInput && verifyTableBody) {
            const rows = verifyTableBody.getElementsByClassName('pending-row');
            const noResultRow = document.getElementById('noVerifyResult');

            searchInput.addEventListener('input', function () {
                const query = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const targets = row.getElementsByClassName('search-target');
                    let textContent = '';
                    
                    for (let j = 0; j < targets.length; j++) {
                        textContent += ' ' + targets[j].textContent.toLowerCase();
                    }

                    if (textContent.indexOf(query) > -1) {
                        row.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        row.classList.add('hidden');
                    }
                }

                if (noResultRow) {
                    if (visibleCount === 0 && query !== '') {
                        noResultRow.classList.remove('hidden');
                    } else {
                        noResultRow.classList.add('hidden');
                    }
                }
            });
        }

        // 4. CUSTOM MODAL CONFIRMATION (TERIMA / TOLAK SISWA)
        const actionModal = document.getElementById('actionModal');
        const modalCard = document.getElementById('modalCard');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalIconBg = document.getElementById('modalIconBg');
        const modalIcon = document.getElementById('modalIcon');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        const modalTargetName = document.getElementById('modalTargetName');
        const btnCancelModal = document.getElementById('btnCancelModal');
        const btnConfirmModal = document.getElementById('btnConfirmModal');

        let targetFormToSubmit = null;

        function openModal(type, targetName, form) {
            targetFormToSubmit = form;
            modalTargetName.textContent = targetName;

            if (type === 'approve') {
                modalIconBg.className = 'h-16 w-16 rounded-full flex items-center justify-center text-2xl mb-4 bg-emerald-50 text-emerald-500 shadow-inner animate-bounce';
                modalIcon.className = 'fas fa-user-check';
                modalTitle.textContent = 'Terima Pendaftaran';
                modalDescription.innerHTML = `Apakah Anda yakin ingin menyetujui akun siswa <span class="font-bold text-emerald-600">${targetName}</span>? Siswa akan dapat terhubung ke sistem.`;
                btnConfirmModal.className = 'flex-1 bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold py-2.5 px-4 rounded-xl shadow-md transition text-xs outline-none cursor-pointer';
            } else {
                modalIconBg.className = 'h-16 w-16 rounded-full flex items-center justify-center text-2xl mb-4 bg-rose-50 text-rose-500 shadow-inner animate-bounce';
                modalIcon.className = 'fas fa-user-times';
                modalTitle.textContent = 'Tolak Pendaftaran';
                modalDescription.innerHTML = `Apakah Anda yakin ingin menolak dan menghapus pendaftaran siswa <span class="font-bold text-rose-600">${targetName}</span>? Tindakan ini tidak dapat dibatalkan.`;
                btnConfirmModal.className = 'flex-1 bg-rose-500 hover:bg-rose-600 text-white font-extrabold py-2.5 px-4 rounded-xl shadow-md transition text-xs outline-none cursor-pointer';
            }

            actionModal.classList.remove('hidden');
            setTimeout(() => {
                modalCard.classList.remove('scale-95', 'opacity-0');
                modalCard.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalCard.classList.remove('scale-100', 'opacity-100');
            modalCard.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                actionModal.classList.add('hidden');
                targetFormToSubmit = null;
            }, 200);
        }

        // Event Listener Tombol Terima
        document.querySelectorAll('.btn-approve').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const form = this.closest('.form-verify-approve');
                openModal('approve', name, form);
            });
        });

        // Event Listener Tombol Tolak
        document.querySelectorAll('.btn-reject').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const form = this.closest('.form-verify-reject');
                openModal('reject', name, form);
            });
        });

        if (btnCancelModal) btnCancelModal.addEventListener('click', closeModal);
        if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);

        if (btnConfirmModal) {
            btnConfirmModal.addEventListener('click', function () {
                if (targetFormToSubmit) {
                    targetFormToSubmit.submit();
                }
            });
        }
    });
</script>
@endsection