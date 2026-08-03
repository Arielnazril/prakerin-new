@extends('layouts.admin_layout')

@section('page_title', 'Plotting Magang Baru')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 animate-fade-in">

        <!-- Header / Breadcrumb Section -->
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.placement.index') }}" 
                   class="flex items-center justify-center w-11 h-11 rounded-2xl bg-white text-slate-500 hover:text-blue-600 shadow-md shadow-slate-200/50 border border-slate-200/80 hover:border-blue-300 hover:bg-blue-50/50 hover:shadow-lg transition-all duration-300 group">
                    <i class="fas fa-arrow-left text-base transition-transform group-hover:-translate-x-1"></i>
                </a>
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200/60">
                            Penempatan Baru
                        </span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">Form Plotting Siswa</h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Hubungkan siswa dengan tempat magang dan pembimbingnya secara terintegrasi.</p>
                </div>
            </div>
        </div>

        <!-- Main Card Form -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-slate-300/50">

            <!-- Decorative Top Progress Bar with Subtle Gradient -->
            <div class="h-1.5 w-full bg-slate-100/80">
                <div class="h-1.5 bg-gradient-to-r from-blue-600 via-[--color-primary-dark] to-indigo-700 w-1/3 rounded-r-full shadow-sm"></div>
            </div>

            <form action="{{ route('admin.placement.store') }}" method="POST" class="p-6 sm:p-10 space-y-10">
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
                                <select name="siswa_id"
                                    class="w-full pl-11 pr-10 py-3.5 border border-slate-200/90 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 bg-slate-50/50 hover:bg-slate-50 focus:bg-white font-semibold text-slate-800 transition-all duration-200 appearance-none cursor-pointer text-sm"
                                    required>
                                    <option value="" disabled selected>-- Cari dan Pilih Nama Siswa --</option>
                                    @foreach ($siswas as $siswa)
                                        <option value="{{ $siswa->id }}">
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
                            <div class="relative rounded-2xl shadow-xs group">
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
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
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
                    <a href="{{ route('admin.placement.index') }}" 
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

    <!-- Hidden Master Data Container for JavaScript filtering -->
    <div id="master_mentors_pool" class="hidden">
        @foreach ($mentors as $mentor)
            <div data-id="{{ $mentor->id }}" data-name="{{ $mentor->name }}" data-instansi="{{ $mentor->instansi_id }}"></div>
        @endforeach
    </div>

    <script>
        // Simpan data master mentor sejak halaman pertama kali dimuat ke dalam Array Object
        const masterMentors = [];
        document.querySelectorAll('#master_mentors_pool div').forEach(el => {
            masterMentors.push({
                id: el.getAttribute('data-id'),
                name: el.getAttribute('data-name'),
                instansiId: el.getAttribute('data-instansi')
            });
        });

        function filterMentors() {
            const instansiSelect = document.getElementById('instansi_select');
            const mentorSelect = document.getElementById('mentor_select');
            const mentorHint = document.getElementById('mentor_hint');
            const mentorHintContainer = document.getElementById('mentor_hint_container');
            const hintIconWrapper = document.getElementById('hint_icon_wrapper');
            const hintIcon = document.getElementById('hint_icon');
            const mentorIcon = document.getElementById('mentor_icon');
            
            const selectedInstansiId = instansiSelect.value;

            // 1. Reset dan Aktifkan Dropdown Mentor
            mentorSelect.innerHTML = "";
            mentorSelect.disabled = false;
            
            // Efek transisi style ketika diaktifkan (disesuaikan dengan tema premium baru)
            mentorSelect.classList.remove('bg-slate-100/80', 'text-slate-400', 'cursor-not-allowed', 'border-slate-200/80');
            mentorSelect.classList.add('bg-slate-50/50', 'hover:bg-slate-50', 'focus:bg-white', 'text-slate-800', 'border-slate-200/90', 'focus:ring-4', 'focus:ring-blue-500/10', 'focus:border-blue-600', 'cursor-pointer');
            
            // Perbarui warna icon pada pembungkus absolute
            const innerIcon = mentorIcon.querySelector('i');
            if(innerIcon) {
                innerIcon.classList.remove('text-slate-400');
                innerIcon.classList.add('text-slate-500');
            }

            // Tambahkan default option bawaan kamu
            const defaultOpt = document.createElement('option');
            defaultOpt.value = "";
            defaultOpt.selected = true;
            mentorSelect.appendChild(defaultOpt);

            // Filter data dari master array
            const filteredMentors = masterMentors.filter(m => m.instansiId == selectedInstansiId);

            // 2. Terapkan logika penambahan opsi dan feedback visual
            if (filteredMentors.length > 0) {
                defaultOpt.textContent = `-- Pilih Salah Satu Mentor (${filteredMentors.length} Tersedia) --`;
                
                filteredMentors.forEach(mentor => {
                    const opt = document.createElement('option');
                    opt.value = mentor.id;
                    opt.textContent = mentor.name;
                    mentorSelect.appendChild(opt);
                });

                // Tampilan hint sukses/info (Biru lembut)
                mentorHint.textContent = "Mentor yang ditampilkan dikunci secara otomatis hanya untuk instansi terpilih.";
                mentorHintContainer.className = "mt-3 p-4 rounded-2xl bg-blue-50/80 border border-blue-200/70 flex items-start space-x-3 transition-all duration-300 shadow-xs";
                hintIconWrapper.className = "mt-0.5 text-blue-600 shrink-0";
                hintIcon.className = "fas fa-check-circle text-sm";
            } else {
                defaultOpt.textContent = "-- Tidak Ada Mentor di Perusahaan Ini --";
                
                // Tampilan hint error/warning (Merah lembut)
                mentorHint.textContent = "Perhatian: Belum ada akun Mentor untuk instansi ini. Silakan buat terlebih dahulu di menu Master Mentor.";
                mentorHintContainer.className = "mt-3 p-4 rounded-2xl bg-rose-50/90 border border-rose-200/80 flex items-start space-x-3 transition-all duration-300 animate-shake shadow-xs";
                hintIconWrapper.className = "mt-0.5 text-rose-600 shrink-0";
                hintIcon.className = "fas fa-exclamation-triangle text-sm";
            }
        }
    </script>

    <!-- Custom inline utility animation css styles -->
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
    </style>
@endsection