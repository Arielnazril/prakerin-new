@extends('layouts.admin_layout')

@section('page_title', 'Tambah Industri Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- HEADER SECTION --}}
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.instansi.index') }}" class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-sm transition hover:bg-gray-50 hover:text-gray-700">
                <i class="fas fa-arrow-left text-base"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Form Tambah Perusahaan</h2>
                <p class="text-xs text-gray-500 mt-0.5">Daftarkan profil informasi mitra industri atau instansi baru.</p>
            </div>
        </div>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100/80 overflow-hidden">
        {{-- Header Dekoratif Tipis --}}
        <div class="h-1.5 w-full bg-[--color-primary-dark]"></div>

        <form action="{{ route('admin.instansi.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Perusahaan / Instansi --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Nama Perusahaan / Instansi <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-building text-sm"></i>
                        </span>
                        <input type="text" name="nama_perusahaan" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" 
                            placeholder="PT. Sejahtera" required>
                    </div>
                </div>

                {{-- Email Perusahaan --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Email Perusahaan</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email_perusahaan" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" 
                            placeholder="hrd@company.com">
                    </div>
                </div>

                {{-- Nomor Telepon --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Nomor Telepon</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-phone text-sm"></i>
                        </span>
                        <input type="text" name="telepon" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" 
                            placeholder="021-xxxxxx">
                    </div>
                </div>

                {{-- Alamat Lengkap --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <div class="relative group flex items-start">
                        <span class="absolute top-3.5 left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </span>
                        <textarea name="alamat" rows="3" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400 resize-none" 
                            placeholder="Jl. Jendral Sudirman No..." required></textarea>
                    </div>
                </div>

                {{-- Website --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Website (Opsional)</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-globe text-sm"></i>
                        </span>
                        <input type="url" name="website" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 text-gray-800 placeholder-gray-400" 
                            placeholder="https://www.company.com">
                    </div>
                </div>
            </div>

            {{-- FOOTER / ACTION BUTTONS --}}
            <div class="flex items-center justify-end pt-5 border-t border-gray-100 mt-6">
                <button type="reset" 
                    class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 font-bold text-sm hover:bg-gray-50 active:bg-gray-100 transition duration-150 mr-3 text-center min-w-[100px] cursor-pointer">
                    Reset
                </button>
                <button type="submit" 
                    class="flex items-center justify-center bg-[--color-primary-dark] text-white font-bold py-3 px-8 rounded-xl text-sm hover:bg-blue-900 shadow-lg shadow-blue-900/10 active:scale-[0.98] transition-all duration-150 transform hover:-translate-y-0.5 cursor-pointer">
                    <i class="fas fa-save mr-2 text-xs"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection