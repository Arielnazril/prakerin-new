@extends('layouts.admin_layout')

@section('page_title', 'Edit Data Industri')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in px-4 sm:px-0 font-sans selection:bg-amber-500 selection:text-white antialiased">
    {{-- HEADER SECTION --}}
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.instansi.index') }}" 
               class="group flex h-11 w-11 items-center justify-center rounded-2xl bg-white border border-slate-200/80 text-slate-500 shadow-xs hover:shadow-md hover:border-amber-300 hover:text-amber-600 transition-all duration-300 transform hover:-translate-x-1 cursor-pointer">
                <i class="fas fa-arrow-left text-base transition-transform group-hover:scale-110"></i>
            </a>
            <div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                    Edit Perusahaan
                    <span class="relative flex h-3 w-3 ml-1 mt-0.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                    </span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 font-medium leading-relaxed">Perbarui detail profil informasi mitra industri sekolah secara akurat.</p>
            </div>
        </div>

        {{-- Badge Status Ringkas --}}
        <div class="hidden sm:inline-flex items-center gap-2 bg-amber-50 border border-amber-200/70 px-4 py-2 rounded-full shadow-2xs">
            <i class="fas fa-handshake text-xs text-amber-600"></i>
            <span class="text-xs font-bold text-amber-800 uppercase tracking-wider">Mitra Industri</span>
        </div>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100/80 overflow-hidden relative backdrop-blur-xl">
        
        {{-- Banner Dekoratif Gradien --}}
        <div class="h-2 w-full bg-gradient-to-r from-amber-400 via-orange-500 to-amber-500"></div>

        <form action="{{ route('admin.instansi.update', $instansi->id) }}" method="POST" class="p-6 sm:p-10 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                {{-- Nama Perusahaan --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                        Nama Perusahaan <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                            <i class="fas fa-building text-sm"></i>
                        </span>
                        <input type="text" name="nama_perusahaan" value="{{ $instansi->nama_perusahaan }}" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs" 
                            placeholder="Masukkan nama resmi instansi / perusahaan..." required>
                    </div>
                </div>

                {{-- Email Perusahaan --}}
                <div class="space-y-2">
                    <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                        Email Perusahaan
                    </label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email_perusahaan" value="{{ $instansi->email_perusahaan }}" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs"
                            placeholder="contoh@perusahaan.com">
                    </div>
                </div>

                {{-- Nomor Telepon --}}
                <div class="space-y-2">
                    <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                        Nomor Telepon
                    </label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                            <i class="fas fa-phone text-sm"></i>
                        </span>
                        <input type="text" name="telepon" value="{{ $instansi->telepon }}" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs"
                            placeholder="(021) 1234567 atau 0812...">
                    </div>
                </div>

                {{-- Alamat Lengkap --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                        Alamat Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group flex items-start">
                        <span class="absolute top-4 left-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </span>
                        <textarea name="alamat" rows="3" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs resize-none leading-relaxed" 
                            placeholder="Tuliskan alamat lengkap jalan, nomor, kota, dan kode pos..." required>{{ $instansi->alamat }}</textarea>
                    </div>
                </div>

                {{-- Website --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                        Situs Website
                    </label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                            <i class="fas fa-globe text-sm"></i>
                        </span>
                        <input type="url" name="website" value="{{ $instansi->website }}" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200/90 rounded-2xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-300 shadow-2xs"
                            placeholder="https://www.perusahaan.com">
                    </div>
                </div>
            </div>

            {{-- FOOTER / ACTION BUTTONS --}}
            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100 mt-8">
                <a href="{{ route('admin.instansi.index') }}" 
                    class="w-full sm:w-auto px-6 py-3.5 rounded-2xl border border-slate-200 text-slate-600 font-extrabold text-xs uppercase tracking-wider hover:bg-slate-100 hover:text-slate-800 active:bg-slate-200 transition duration-200 text-center flex items-center justify-center cursor-pointer">
                    <i class="fas fa-times mr-2 text-sm opacity-70"></i> Batal
                </a>
                
                <button type="submit" 
                    class="w-full sm:w-auto flex items-center justify-center bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 hover:from-amber-600 hover:to-orange-600 text-white font-extrabold py-3.5 px-8 rounded-2xl text-xs uppercase tracking-wider shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/35 active:scale-[0.98] transition-all duration-200 cursor-pointer">
                    <i class="fas fa-save mr-2.5 text-sm"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Animasi Tambahan --}}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection