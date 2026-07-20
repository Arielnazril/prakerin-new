@extends('layouts.admin_layout')

@section('page_title', 'Edit Mentor Industri')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-0">
    {{-- Tombol Kembali & Judul Halaman yang Dipercantik --}}
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.pembimbing.index') }}" class="flex items-center justify-center w-10 h-10 bg-white hover:bg-gray-100 text-gray-500 hover:text-gray-700 rounded-xl shadow-sm border border-gray-200 transition-all duration-200">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Edit Mentor</h2>
                <p class="text-xs text-gray-500">Perbarui informasi profil pembimbing lapangan industri.</p>
            </div>
        </div>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">
            <i class="fas fa-pen-nib mr-1.5 text-xs"></i> Mode Edit
        </span>
    </div>

    {{-- Kartu Form Utama Modern --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-100/70 border border-gray-100 overflow-hidden">
        {{-- Aksen Dekorasi Atas Kartu --}}
        <div class="h-2 bg-gradient-to-r from-yellow-400 to-amber-500"></div>
        
        <form action="{{ route('admin.pembimbing.update', $mentor->id) }}" method="POST" class="space-y-6 p-6 sm:p-8">
            @csrf
            @method('PUT')

            {{-- Input: Asal Perusahaan dengan Ikon --}}
            <div>
                <label class="block text-xs font-extrabold uppercase tracking-wider text-gray-600 mb-2">Asal Perusahaan</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-building text-sm"></i>
                    </div>
                    <select name="instansi_id" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 bg-white" required>
                        @foreach($instansis as $instansi)
                            <option value="{{ $instansi->id }}" {{ $mentor->instansi_id == $instansi->id ? 'selected' : '' }}>
                                {{ $instansi->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Input: Nama Mentor dengan Ikon --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-gray-600 mb-2">Nama Mentor</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <input type="text" name="name" value="{{ $mentor->name }}" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200" required placeholder="Masukkan nama lengkap mentor">
                    </div>
                </div>

                {{-- Input: Username dengan Ikon --}}
                <div>
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-gray-600 mb-2">Username</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-id-badge text-sm"></i>
                        </div>
                        <input type="text" name="username" value="{{ $mentor->username }}" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-mono focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200" required placeholder="Username untuk login">
                    </div>
                </div>

                {{-- Input: Nomor HP dengan Ikon --}}
                <div>
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-gray-600 mb-2">Nomor HP</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-phone text-sm"></i>
                        </div>
                        <input type="text" name="no_hp" value="{{ $mentor->no_hp }}" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200" placeholder="Contoh: 081234567xxx">
                    </div>
                </div>

                {{-- Input: Password Baru dengan Ikon & Hint Informasi --}}
                <div class="col-span-1 md:col-span-2 bg-gray-50/50 border border-gray-200 p-4 rounded-xl">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-gray-600 mb-1">Password Baru (Opsional)</label>
                    <p class="text-[11px] text-gray-400 mb-3"><i class="fas fa-info-circle mr-1 text-blue-500"></i>Biarkan kolom ini kosong jika Anda tidak berniat mengganti password login mentor.</p>
                    <div class="relative rounded-xl shadow-sm bg-white">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-key text-sm"></i>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200" placeholder="Kosongkan jika tidak ubah password">
                    </div>
                </div>
            </div>

            {{-- Bagian Tombol Aksi Akhir --}}
            <div class="flex justify-end pt-5 border-t border-gray-100">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-yellow-500 to-amber-500 hover:from-yellow-600 hover:to-amber-600 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-lg shadow-amber-500/20 active:scale-[0.98] transition-all duration-150 flex items-center justify-center space-x-2 cursor-pointer text-sm">
                    <i class="fas fa-save"></i>
                    <span>Update Data</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection