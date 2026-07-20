@extends('layouts.admin_layout')

@section('page_title', 'Tambah Mentor Industri')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- HEADER SECTION --}}
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.pembimbing.index') }}" class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-sm transition hover:bg-gray-50 hover:text-gray-700">
                <i class="fas fa-arrow-left text-base"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Form Tambah Mentor</h2>
                <p class="text-xs text-gray-500 mt-0.5">Daftarkan pembimbing baru dari instansi mitra industri.</p>
            </div>
        </div>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100/80 overflow-hidden">
        {{-- Header Dekoratif Tipis --}}
        <div class="h-1.5 w-full bg-[--color-primary-dark]"></div>

        <form action="{{ route('admin.pembimbing.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            {{-- Asal Perusahaan (Instansi) --}}
            <div class="space-y-2">
                <label class="block text-sm font-bold text-gray-700 tracking-wide">Asal Perusahaan (Instansi) <span class="text-red-500">*</span></label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-building text-sm"></i>
                    </span>
                    <select name="instansi_id" class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 bg-white text-gray-800 appearance-none cursor-pointer" required>
                        <option value="" disabled selected>-- Pilih Perusahaan --</option>
                        @foreach($instansis as $instansi)
                            <option value="{{ $instansi->id }}">{{ $instansi->nama_perusahaan }}</option>
                        @endforeach
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-gray-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Jika perusahaan belum ada, tambahkan dulu di menu Data Industri.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Lengkap Mentor --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Nama Lengkap Mentor</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" required placeholder="Contoh: Pak Hartono">
                    </div>
                </div>

                {{-- Username Login --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Username Login</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-user-tag text-sm"></i>
                        </span>
                        <input type="text" name="username" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" required placeholder="mentor_telkom">
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Nomor HP</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-phone text-sm"></i>
                        </span>
                        <input type="text" name="no_hp" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" placeholder="0812...">
                    </div>
                </div>

                {{-- Password --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Password</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" required placeholder="Minimal 6 karakter">
                    </div>
                </div>
            </div>

            {{-- FOOTER / ACTION BUTTONS --}}
            <div class="flex items-center justify-end pt-5 border-t border-gray-100 mt-6">
                <a href="{{ route('admin.pembimbing.index') }}" 
                    class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 font-bold text-sm hover:bg-gray-50 active:bg-gray-100 transition duration-150 mr-3 text-center min-w-[100px] cursor-pointer">
                    Batal
                </a>
                <button type="submit" class="flex items-center justify-center bg-[--color-primary-dark] text-white font-bold py-3 px-8 rounded-xl text-sm hover:bg-blue-900 shadow-lg shadow-blue-900/10 active:scale-[0.98] transition-all duration-150 transform hover:-translate-y-0.5 cursor-pointer">
                    <i class="fas fa-save mr-2 text-xs"></i> Simpan Mentor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection