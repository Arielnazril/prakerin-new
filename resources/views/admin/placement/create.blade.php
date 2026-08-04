@extends('layouts.admin_layout')

@section('page_title', 'Plotting Magang Baru')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 animate-fade-in">

        <!-- Header / Breadcrumb Section -->
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <!-- ICON BACK: Mengarah ke Halaman Kalkulasi Rekomendasi Penempatan -->
                <a href="{{ route('admin.placement.calculate') }}" 
                   class="flex items-center justify-center w-11 h-11 rounded-2xl bg-white text-slate-500 hover:text-blue-600 shadow-sm hover:shadow-md border border-slate-200/80 hover:border-blue-300 hover:bg-blue-50/50 transition-all duration-300 group">
                    <i class="fas fa-arrow-left text-base transition-transform group-hover:-translate-x-1"></i>
                </a>
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200/60 uppercase tracking-wider">
                            Penempatan Baru
                        </span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">Form Plotting Siswa</h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Hubungkan siswa dengan tempat magang dan pembimbingnya secara terintegrasi.</p>
                </div>
            </div>
        </div>

        <!-- Main Card Form -->
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-slate-300/40">

            <!-- Decorative Top Progress Bar with Subtle Gradient -->
            <div class="h-1.5 w-full bg-slate-100/80">
                <div class="h-1.5 bg-gradient-to-r from-blue-600 via-[--color-primary-dark] to-indigo-700 w-1/3 rounded-r-full shadow-sm"></div>
            </div>

            <form id="formPlottingMagang" action="{{ route('admin.placement.store') }}" method="POST" class="p-6 sm:p-10 space-y-10">
                @csrf

                <!-- SECTION 1: DATA SISWA & WAKTU -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="text-base font-extrabold text-slate-900 flex items-center tracking-wide">
                            <span class="bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-md shadow-blue-500/20 w-8 h-8 rounded-xl flex items-center justify-center font-black text-xs mr-3 ring-4 ring-blue-50">1</span>
                            Data Siswa & Masa Magang
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                                Pilih Siswa (Yang Belum Magang)
                                <span class="text-rose-500 ml-1">*</span>
                            </label>
                            <div class="relative rounded-2xl shadow-xs group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                    <i class="fas fa-graduation-cap text-base"></i>
                                </div>
                                <select id="siswa_select" name="siswa_id"
                                    class="w-full pl-11 pr-10 py-3.5 border border-slate-200/90 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 bg-slate-50/50 hover:bg-slate-50 focus:bg-white font-semibold text-slate-800 transition-all duration-200 appearance-none cursor-pointer text-sm"
                                    required>
                                    <option value="" disabled selected>-- Cari dan Pilih Nama Siswa --</option>
                                    @foreach ($siswas as $siswa)
                                        <option value="{{ $siswa->id }}" {{ request('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                            {{ $siswa->name }} ({{ $siswa->jurusan->kode_jurusan ?? 'No Jurusan' }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            @if ($siswas->isEmpty())
                                <div class="flex items-center space-x-2.5 mt-3 text-rose-700 bg-rose-50/90 px-4 py-3 rounded-2xl border border-rose-200/60 shadow-xs animate-pulse">
                                    <i class="fas fa-exclamation-circle text-sm flex-shrink-0"></i>
                                    <p class="text-xs font-semibold">* Belum ada data siswa yang mendaftar atau tersedia.</p>
                                </div>
                            @endif
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                                Tanggal Mulai
                                <span class="text-rose-500 ml-1">*</span>
                            </label>
                            <div class="relative rounded-2xl shadow-xs group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                    <i class="fas fa-calendar-alt text-base"></i>
                                </div>
                                <input type="date" name="tanggal_mulai"
                                    class="w-full pl-11 pr-4 py-3.5 border border-slate-200/90 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 bg-slate-50/50 hover:bg-slate-50 focus:bg-white text-slate-800 font-semibold transition-all duration-200 text-sm cursor-pointer"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                                Tanggal Selesai
                                <span class="text-rose-500 ml-1">*</span>
                            </label>
                            <div class="relative rounded-2xl shadow-xs group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                    <i class="fas fa-calendar-check text-base"></i>
                                </div>
                                <input type="date" name="tanggal_selesai"
                                    class="w-full pl-11 pr-4 py-3.5 border border-slate-200/90 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 bg-slate-50/50 hover:bg-slate-50 focus:bg-white text-slate-800 font-semibold transition-all duration-200 text-sm cursor-pointer"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: LOKASI & PEMBIMBING -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="text-base font-extrabold text-slate-900 flex items-center tracking-wide">
                            <span class="bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-md shadow-blue-500/20 w-8 h-8 rounded-xl flex items-center justify-center font-black text-xs mr-3 ring-4 ring-blue-50">2</span>
                            Lokasi Penempatan & Pembimbing
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                                Perusahaan / Instansi
                                <span class="text-rose-500 ml-1">*</span>
                            </label>
                            
                            <!-- Container Tampilan Locked (Tampil Jika Hasil SPK) -->
                            <div id="instansi_locked_container" class="hidden relative rounded-2xl p-4 bg-slate-50 border-l-4 border-l-blue-600 border-y border-r border-slate-200/90 flex items-center justify-between shadow-xs transition-all">
                                <div class="flex items-center space-x-3.5">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100/80 text-blue-600 flex items-center justify-center shrink-0 shadow-xs">
                                        <i class="fas fa-building text-base"></i>
                                    </div>
                                    <div>
                                        <div id="instansi_locked_name" class="font-black text-slate-800 text-sm leading-snug">-</div>
                                        <div class="text-[10px] text-blue-600 font-bold uppercase tracking-wider flex items-center mt-0.5">
                                            <i class="fas fa-lock text-[9px] mr-1"></i> Terkunci Otomatis (SPK)
                                        </div>
                                    </div>
                                </div>
                                <span id="instansi_locked_grade_badge" class="px-3 py-1 rounded-xl text-xs font-black bg-blue-100 text-blue-800 border border-blue-200 shadow-2xs">
                                    Grade -
                                </span>
                            </div>

                            <!-- Native Select Dropdown (Disembunyikan atau Diberi Hidden Input Jika Terkunci) -->
                            <div id="instansi_select_wrapper" class="relative rounded-2xl shadow-xs group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                    <i class="fas fa-building text-base"></i>
                                </div>
                                <select id="instansi_select" name="instansi_id"
                                    class="w-full pl-11 pr-10 py-3.5 border border-slate-200/90 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 bg-slate-50/50 hover:bg-slate-50 focus:bg-white font-semibold text-slate-800 transition-all duration-200 appearance-none cursor-pointer text-sm"
                                    required onchange="filterMentors()">
                                    <option value="" disabled selected>-- Pilih Perusahaan --</option>
                                    @foreach ($instansis as $instansi)
                                        <option value="{{ $instansi->id }}">{{ $instansi->nama_perusahaan }}</option>
                                    @endforeach
                                </select>
                                <div id="instansi_select_arrow" class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            <input type="hidden" id="instansi_id_hidden" name="instansi_id_hidden" disabled>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2 flex items-center">
                                Guru Pembimbing Sekolah
                                <span class="text-rose-500 ml-1">*</span>
                            </label>
                            <div class="relative rounded-2xl shadow-xs group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                    <i class="fas fa-chalkboard-teacher text-base"></i>
                                </div>
                                <select name="guru_id"
                                    class="w-full pl-11 pr-10 py-3.5 border border-slate-200/90 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 bg-slate-50/50 hover:bg-slate-50 focus:bg-white font-semibold text-slate-800 transition-all duration-200 appearance-none cursor-pointer text-sm"
                                    required>
                                    <option value="" disabled selected>-- Pilih Guru Pembimbing --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">Mentor Lapangan (DUDI)</label>
                            <div class="relative rounded-2xl shadow-xs">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400" id="mentor_icon">
                                    <i class="fas fa-user-shield text-base text-slate-400"></i>
                                </div>
                                <select id="mentor_select" name="mentor_id"
                                    class="w-full pl-11 pr-10 py-3.5 border border-slate-200/80 rounded-2xl bg-slate-100/80 text-slate-400 cursor-not-allowed font-semibold transition-all duration-300 appearance-none text-sm"
                                    disabled>
                                    <option value="" selected>-- Menyusul (Belum Ada Mentor) --</option>
                                    @foreach ($mentors as $mentor)
                                        <option value="{{ $mentor->id }}" data-instansi="{{ $mentor->instansi_id }}">
                                            {{ $mentor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            
                            <!-- Dynamic Hint Box -->
                            <div id="mentor_hint_container" class="mt-3 p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 flex items-start space-x-3 transition-all duration-300 shadow-xs">
                                <div class="mt-0.5 text-blue-500 shrink-0" id="hint_icon_wrapper">
                                    <i class="fas fa-info-circle text-sm" id="hint_icon"></i>
                                </div>
                                <p class="text-xs text-slate-600 font-medium leading-relaxed" id="mentor_hint">
                                    Silakan tentukan pilihan Perusahaan / Instansi terlebih dahulu untuk memunculkan daftar Mentor Lapangan yang bertugas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <!-- BUTTON BATAL: Mengarah ke Halaman Kalkulasi Rekomendasi Penempatan -->
                    <a href="{{ route('admin.placement.calculate') }}" 
                       class="w-full sm:w-auto text-center bg-slate-100 hover:bg-slate-200/80 text-slate-700 font-extrabold py-3.5 px-8 rounded-2xl transition duration-200 text-xs uppercase tracking-wider">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-[--color-primary-dark] text-white font-extrabold py-3.5 px-10 rounded-2xl hover:from-blue-700 hover:to-blue-900 shadow-lg shadow-blue-600/25 hover:shadow-xl hover:shadow-blue-600/35 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center text-xs uppercase tracking-wider cursor-pointer">
                        <i class="fas fa-save mr-2 text-sm"></i> Simpan Penempatan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- POPUP MODAL HASIL REKOMENDASI MAGANG SPK (TEXT KHUSUS KHUSUS UNTUK ADMIN) -->
    <div id="modalRekomendasiMagang" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/70 backdrop-blur-md flex items-center justify-center p-4">
        <div id="modalContentMagang" class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
            <div class="p-8 bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 text-white text-center relative overflow-hidden">
                <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-12 -top-12 w-40 h-40 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="w-20 h-20 bg-emerald-500/20 border border-emerald-400/40 rounded-3xl flex items-center justify-center mx-auto mb-4 text-emerald-400 text-3xl shadow-xl shadow-emerald-950/50 backdrop-blur-sm animate-bounce-subtle">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="font-black text-2xl text-white tracking-tight">Rekomendasi SPK Ditemukan!</h3>
                <p class="text-xs text-slate-300 mt-1.5 font-medium tracking-wide">Hasil Analisis Rekomendasi SPK Penempatan Magang</p>
            </div>

            <div class="p-6 sm:p-8 space-y-6 text-center bg-white">
                <div class="p-4 rounded-2xl bg-blue-50/60 border border-blue-100 text-slate-700 text-sm font-medium leading-relaxed">
                    Rekomendasi Penempatan Instansi: <br>
                    <strong id="modalNamaPerusahaan" class="text-blue-700 font-black text-base block mt-1"></strong>
                </div>

                <div class="p-4 bg-slate-50 border border-slate-200/80 rounded-2xl space-y-3 text-left">
                    <div class="flex justify-between items-center text-xs pb-2 border-b border-slate-200/60">
                        <span class="text-slate-400 font-bold uppercase tracking-wider">Nama Siswa</span>
                        <span id="modalNamaSiswa" class="font-black text-slate-800 truncate max-w-[200px] text-right">-</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold uppercase tracking-wider">Kategori Instansi</span>
                        <span id="modalGradeBadge" class="px-3 py-1 rounded-lg font-black text-xs uppercase bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-2xs">
                            Grade -
                        </span>
                    </div>
                </div>

                <button type="button" onclick="closeRekomendasiModal()" 
                    class="w-full bg-slate-900 hover:bg-slate-800 active:bg-slate-950 text-white font-extrabold py-4 px-6 rounded-2xl text-xs uppercase tracking-wider shadow-lg shadow-slate-900/20 hover:shadow-xl transition-all duration-200 cursor-pointer">
                    Lanjutkan Pengisian Form
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden Master Data Container for JavaScript filtering -->
    <div id="master_mentors_pool" class="hidden">
        @foreach ($mentors as $mentor)
            <div data-id="{{ $mentor->id }}" data-name="{{ $mentor->name }}" data-instansi="{{ $mentor->instansi_id }}"></div>
        @endforeach
    </div>

    <script>
        const masterMentors = [];
        document.querySelectorAll('#master_mentors_pool div').forEach(el => {
            masterMentors.push({
                id: el.getAttribute('data-id'),
                name: el.getAttribute('data-name'),
                instansiId: el.getAttribute('data-instansi')
            });
        });

        const instansiGradeA = [
            "Pengadilan Tinggi Pontianak",
            "BKAD (Badan Keuangan dan Aset Daerah)",
            "POLNEP Prodi IT (Politeknik Negeri Pontianak)",
            "POLNEP UPATIK",
            "UBSI Pontianak (Universitas BSI)",
            "PT Ketel Uap"
        ];

        function filterMentors() {
            const instansiSelect = document.getElementById('instansi_select');
            const mentorSelect = document.getElementById('mentor_select');
            const mentorHint = document.getElementById('mentor_hint');
            const mentorHintContainer = document.getElementById('mentor_hint_container');
            const hintIconWrapper = document.getElementById('hint_icon_wrapper');
            const hintIcon = document.getElementById('hint_icon');
            const mentorIcon = document.getElementById('mentor_icon');
            
            const selectedInstansiId = instansiSelect.value;

            mentorSelect.innerHTML = "";
            mentorSelect.disabled = false;
            
            mentorSelect.classList.remove('bg-slate-100/80', 'text-slate-400', 'cursor-not-allowed', 'border-slate-200/80');
            mentorSelect.classList.add('bg-slate-50/50', 'hover:bg-slate-50', 'focus:bg-white', 'text-slate-800', 'border-slate-200/90', 'focus:ring-4', 'focus:ring-blue-500/10', 'focus:border-blue-600', 'cursor-pointer');
            
            const innerIcon = mentorIcon.querySelector('i');
            if(innerIcon) {
                innerIcon.classList.remove('text-slate-400');
                innerIcon.classList.add('text-slate-500');
            }

            const defaultOpt = document.createElement('option');
            defaultOpt.value = "";
            defaultOpt.selected = true;
            mentorSelect.appendChild(defaultOpt);

            const filteredMentors = masterMentors.filter(m => m.instansiId == selectedInstansiId);

            if (filteredMentors.length > 0) {
                defaultOpt.textContent = `-- Pilih Salah Satu Mentor (${filteredMentors.length} Tersedia) --`;
                
                filteredMentors.forEach(mentor => {
                    const opt = document.createElement('option');
                    opt.value = mentor.id;
                    opt.textContent = mentor.name;
                    mentorSelect.appendChild(opt);
                });

                mentorHint.textContent = "Mentor yang ditampilkan dikunci secara otomatis hanya untuk instansi terpilih.";
                mentorHintContainer.className = "mt-3 p-4 rounded-2xl bg-blue-50/80 border border-blue-200/70 flex items-start space-x-3 transition-all duration-300 shadow-xs";
                hintIconWrapper.className = "mt-0.5 text-blue-600 shrink-0";
                hintIcon.className = "fas fa-check-circle text-sm";
            } else {
                defaultOpt.textContent = "-- Tidak Ada Mentor di Perusahaan Ini --";
                
                mentorHint.textContent = "Perhatian: Belum ada akun Mentor untuk instansi ini. Silakan buat terlebih dahulu di menu Master Mentor.";
                mentorHintContainer.className = "mt-3 p-4 rounded-2xl bg-rose-50/90 border border-rose-200/80 flex items-start space-x-3 transition-all duration-300 animate-shake shadow-xs";
                hintIconWrapper.className = "mt-0.5 text-rose-600 shrink-0";
                hintIcon.className = "fas fa-exclamation-triangle text-sm";
            }
        }

        function closeRekomendasiModal() {
            const modal = document.getElementById('modalRekomendasiMagang');
            const content = document.getElementById('modalContentMagang');
            if (!modal) return;

            if (content) {
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
            }
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            
            const siswaIdParam = urlParams.get('siswa_id');
            const siswaNamaParam = urlParams.get('siswa_nama');
            const namaInstansiParam = urlParams.get('instansi_nama');
            
            const siswaSelect = document.getElementById('siswa_select');
            const instansiSelect = document.getElementById('instansi_select');

            let matchedSiswaNama = siswaNamaParam || '';

            // 1. AUTO SELECT SISWA
            if (siswaSelect) {
                let matched = false;

                // Cek ID terlebih dahulu
                if (siswaIdParam && siswaIdParam !== 'undefined' && siswaIdParam !== 'null') {
                    for (let i = 0; i < siswaSelect.options.length; i++) {
                        if (String(siswaSelect.options[i].value) === String(siswaIdParam)) {
                            siswaSelect.selectedIndex = i;
                            matched = true;
                            matchedSiswaNama = siswaSelect.options[i].text.split('(')[0].trim();
                            break;
                        }
                    }
                }

                // Jika ID tidak cocok, gunakan pencocokan nama yang persis
                if (!matched && siswaNamaParam) {
                    const searchNama = siswaNamaParam.toLowerCase().trim();
                    for (let i = 0; i < siswaSelect.options.length; i++) {
                        const optText = siswaSelect.options[i].text.toLowerCase().trim();
                        if (optText.includes(searchNama) || searchNama.includes(optText)) {
                            siswaSelect.selectedIndex = i;
                            matched = true;
                            matchedSiswaNama = siswaSelect.options[i].text.split('(')[0].trim();
                            break;
                        }
                    }
                }

                if (matched) {
                    siswaSelect.dispatchEvent(new Event('change'));
                }
            }

            // 2. AUTO SELECT INDUSTRI / INSTANSI & BUKA POPUP REKOMENDASI SPK
            if (namaInstansiParam && instansiSelect) {
                const cleanSearch = namaInstansiParam.toLowerCase().replace(/[^a-z0-9]/g, '');
                let matchedInstansiValue = null;
                let matchedInstansiText = '';

                if (cleanSearch.length > 0) {
                    for (let i = 0; i < instansiSelect.options.length; i++) {
                        const opt = instansiSelect.options[i];
                        if (!opt.value || opt.value === '') continue;

                        const optText = opt.text;
                        const cleanOptText = optText.toLowerCase().replace(/[^a-z0-9]/g, '');
                        
                        if (
                            cleanOptText === cleanSearch ||
                            cleanOptText.includes(cleanSearch) || 
                            cleanSearch.includes(cleanOptText)
                        ) {
                            matchedInstansiValue = opt.value;
                            matchedInstansiText = opt.text;
                            break;
                        }
                    }
                }

                if (matchedInstansiValue) {
                    // Set Nilai Dropdown
                    instansiSelect.value = matchedInstansiValue;
                    instansiSelect.dispatchEvent(new Event('change'));

                    if (typeof filterMentors === 'function') {
                        filterMentors();
                    }

                    // Tentukan Grade berdasarkan Nama Instansi
                    let isGradeA = instansiGradeA.some(gA => 
                        gA.toLowerCase().replace(/[^a-z0-9]/g, '').includes(cleanSearch) || 
                        cleanSearch.includes(gA.toLowerCase().replace(/[^a-z0-9]/g, ''))
                    );
                    let gradeText = isGradeA ? 'Grade A (Pemerintah/BUMN/Besar)' : 'Grade B (Swasta/UMKM)';

                    // UBAH TAMPILAN PERUSAHAAN MENJADI MURNI TERKUNCI (HILANGKAN DROPDOWN)
                    const lockedContainer = document.getElementById('instansi_locked_container');
                    const lockedName = document.getElementById('instansi_locked_name');
                    const lockedBadge = document.getElementById('instansi_locked_grade_badge');
                    const selectWrapper = document.getElementById('instansi_select_wrapper');
                    const hiddenInput = document.getElementById('instansi_id_hidden');

                    if (lockedContainer && selectWrapper) {
                        selectWrapper.classList.add('hidden');
                        instansiSelect.removeAttribute('name'); // Mencegah konflik nama saat dikirim

                        if (hiddenInput) {
                            hiddenInput.value = matchedInstansiValue;
                            hiddenInput.name = "instansi_id";
                            hiddenInput.removeAttribute('disabled');
                        }

                        if (lockedName) lockedName.textContent = matchedInstansiText;
                        if (lockedBadge) {
                            lockedBadge.textContent = isGradeA ? 'Grade A' : 'Grade B';
                            lockedBadge.className = isGradeA 
                                ? "px-3 py-1 rounded-xl text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-2xs"
                                : "px-3 py-1 rounded-xl text-xs font-black bg-amber-100 text-amber-800 border border-amber-200 shadow-2xs";
                        }
                        lockedContainer.classList.remove('hidden');
                    }

                    // ISI POPUP MODAL & TAMPILKAN
                    const modal = document.getElementById('modalRekomendasiMagang');
                    const modalContent = document.getElementById('modalContentMagang');
                    const modalPerusahaan = document.getElementById('modalNamaPerusahaan');
                    const modalSiswa = document.getElementById('modalNamaSiswa');
                    const modalBadge = document.getElementById('modalGradeBadge');

                    if (modalPerusahaan) modalPerusahaan.textContent = matchedInstansiText;
                    if (modalSiswa) modalSiswa.textContent = matchedSiswaNama || 'Siswa Terpilih';
                    if (modalBadge) {
                        modalBadge.textContent = gradeText;
                        modalBadge.className = isGradeA
                            ? "px-3 py-1 rounded-lg font-black text-xs uppercase bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-2xs"
                            : "px-3 py-1 rounded-lg font-black text-xs uppercase bg-amber-100 text-amber-800 border border-amber-200 shadow-2xs";
                    }

                    if (modal) {
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        setTimeout(() => {
                            if (modalContent) {
                                modalContent.classList.remove('scale-95', 'opacity-0');
                                modalContent.classList.add('scale-100', 'opacity-100');
                            }
                        }, 50);
                    }
                }
            }

            // 3. EVENT HAPUS SISWA DARI LOCALSTORAGE SETELAH FORM SUBMIT
            const formPlotting = document.getElementById('formPlottingMagang');
            if (formPlotting) {
                formPlotting.addEventListener('submit', function() {
                    let spkData = JSON.parse(localStorage.getItem('spk_siswa_data')) || [];
                    
                    const selectedSiswaText = siswaSelect && siswaSelect.options[siswaSelect.selectedIndex] 
                        ? siswaSelect.options[siswaSelect.selectedIndex].text 
                        : '';
                    const selectedSiswaVal = siswaSelect ? siswaSelect.value : '';

                    spkData = spkData.filter(s => {
                        const matchId = (s.id && String(s.id) === String(selectedSiswaVal));
                        const matchNama = (s.nama && selectedSiswaText.toLowerCase().includes(s.nama.toLowerCase()));
                        const matchUrlNama = (siswaNamaParam && s.nama && s.nama.toLowerCase() === siswaNamaParam.toLowerCase());
                        
                        return !(matchId || matchNama || matchUrlNama);
                    });

                    localStorage.setItem('spk_siswa_data', JSON.stringify(spkData));
                });
            }
        });
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }
        .animate-shake {
            animation: shake 0.3s ease-in-out;
        }
        @keyframes bounceSubtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .animate-bounce-subtle {
            animation: bounceSubtle 2.5s ease-in-out infinite;
        }
    </style>
@endsection