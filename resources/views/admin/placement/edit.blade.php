@extends('layouts.admin_layout')

@section('page_title', 'Update Pembimbing Magang')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-0">
    {{-- Tombol Kembali & Judul Halaman yang Dipercantik --}}
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.placement.index') }}" class="flex items-center justify-center w-10 h-10 bg-white hover:bg-gray-100 text-gray-500 hover:text-gray-700 rounded-xl shadow-sm border border-gray-200 transition-all duration-200">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Update Pembimbing</h2>
                <p class="text-xs text-gray-500">Sesuaikan ploting guru pembimbing sekolah dan mentor industri.</p>
            </div>
        </div>
    </div>

    {{-- Kartu Utama Moderen --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-100/70 border border-gray-100 overflow-hidden">
        {{-- Aksen Dekorasi Atas Kartu --}}
        <div class="h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

        <div class="p-6 sm:p-8">
            {{-- Header Informasi Siswa & Instansi --}}
            <div class="mb-6 bg-slate-50 border border-slate-100 p-4 rounded-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 block mb-0.5">Nama Siswa</span>
                    <h3 class="text-lg font-bold text-gray-800">{{ $placement->siswa->name }}</h3>
                </div>
                <div class="sm:text-right">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 block mb-1">Lokasi Magang</span>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                        <i class="fas fa-building mr-1.5"></i> {{ $placement->instansi->nama_perusahaan }}
                    </span>
                </div>
            </div>

            <form action="{{ route('admin.placement.update', $placement->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Select: Guru Pembimbing --}}
                <div>
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-gray-600 mb-2">Guru Pembimbing</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-chalkboard-teacher text-sm"></i>
                        </div>
                        <select name="guru_id" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 bg-white" required>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ $placement->guru_id == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Select: Mentor Lapangan --}}
                <div>
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-gray-600 mb-2">Mentor Lapangan (Dari {{ $placement->instansi->nama_perusahaan }})</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-user-tie text-sm"></i>
                        </div>
                        <select name="mentor_id" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 bg-white" required>
                            <option value="" disabled selected>-- Pilih Mentor --</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ $placement->mentor_id == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->name }} ({{ $mentor->no_hp ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Peringatan Kustom Jika Mentor Kosong --}}
                    @if($mentors->isEmpty())
                        <div class="mt-3 text-xs text-red-600 bg-red-50 border border-red-100 p-3.5 rounded-xl flex items-start space-x-2 animate-pulse">
                            <i class="fas fa-exclamation-triangle mt-0.5 text-sm"></i>
                            <div>
                                <span class="font-semibold block">Belum ada data mentor untuk perusahaan ini.</span>
                                <a href="{{ route('admin.pembimbing.create') }}" class="underline font-bold hover:text-red-800 transition mt-0.5 inline-block">Buat Akun Mentor Dulu</a>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Bagian Tombol Aksi Akhir --}}
                <div class="flex justify-end items-center gap-3 pt-5 border-t border-gray-100">
                    <a href="{{ route('admin.placement.index') }}" class="text-gray-500 hover:text-gray-700 hover:bg-gray-100 font-semibold py-2.5 px-5 rounded-xl transition text-sm text-center">
                        Batal
                    </a>
                    <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md hover:shadow-lg shadow-blue-500/20 active:scale-[0.98] transition-all duration-150 flex items-center justify-center space-x-2 cursor-pointer text-sm">
                        <i class="fas fa-save"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection