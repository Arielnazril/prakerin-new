@extends('layouts.admin_layout')

@section('page_title', 'Edit Data Guru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.guru.index') }}" class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-sm transition hover:bg-gray-50 hover:text-gray-700">
                <i class="fas fa-arrow-left text-base"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Guru</h2>
                <p class="text-xs text-gray-500 mt-0.5">Perbarui informasi profil guru pembimbing sekolah.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100/80 overflow-hidden">
        {{-- Header Dekoratif Tipis --}}
        <div class="h-1.5 w-full bg-yellow-500"></div>

        <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Lengkap Guru --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Nama Lengkap Guru</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-yellow-600 transition-colors">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ $guru->name }}" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 outline-none transition-all duration-200 placeholder-gray-400 text-gray-800" 
                            placeholder="Masukkan nama lengkap beserta gelar..." required>
                    </div>
                </div>

                {{-- NIP --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">NIP</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-yellow-600 transition-colors">
                            <i class="fas fa-id-card text-sm"></i>
                        </span>
                        <input type="text" name="nip" value="{{ $guru->nomor_identitas }}" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-mono focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 outline-none transition-all duration-200 placeholder-gray-400 text-gray-800" 
                            placeholder="Nomor Induk Pegawai..." required>
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 tracking-wide">Nomor HP</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-yellow-600 transition-colors">
                            <i class="fas fa-phone text-sm"></i>
                        </span>
                        <input type="text" name="no_hp" value="{{ $guru->no_hp }}" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 outline-none transition-all duration-200 placeholder-gray-400 text-gray-800"
                            placeholder="Contoh: 08123456xxx">
                    </div>
                </div>

                {{-- Password Baru (Kombinasi Kartu Terpisah) --}}
                <div class="col-span-1 md:col-span-2 bg-gray-50/70 border border-gray-200/60 rounded-xl p-5 mt-2 space-y-3">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 tracking-wide">Password Baru (Opsional)</label>
                        <p class="text-xs text-gray-400 mt-0.5">Biarkan kosong jika akun guru tetap menggunakan password lama.</p>
                    </div>
                    <div class="relative group bg-white rounded-xl">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-yellow-600 transition-colors">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 outline-none transition-all duration-200 text-gray-800 bg-transparent" 
                            placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                </div>
            </div>

            {{-- Bagian Tombol Aksi --}}
            <div class="flex justify-end pt-5 border-t border-gray-100 mt-6">
                <button type="submit" class="w-full sm:w-auto flex items-center justify-center bg-yellow-500 text-white font-bold py-3 px-8 rounded-xl hover:bg-yellow-600 shadow-lg shadow-yellow-500/20 active:scale-[0.98] transition-all duration-150 cursor-pointer">
                    <i class="fas fa-save mr-2 text-sm"></i> Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection