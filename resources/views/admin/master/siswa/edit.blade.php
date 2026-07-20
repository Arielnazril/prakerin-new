@extends('layouts.admin_layout')

@section('page_title', 'Edit Data Siswa')

@section('content')
<div class="max-w-3xl mx-auto selection:bg-blue-600 selection:text-white px-2 sm:px-0">
    <!-- Tombol Kembali & Judul Halaman -->
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.siswa.index') }}" class="mr-4 w-10 h-10 bg-white text-gray-500 hover:text-blue-600 rounded-xl flex items-center justify-center border border-gray-100 shadow-sm hover:shadow transition-all group">
            <i class="fas fa-arrow-left text-lg group-hover:-translate-x-0.5 transition-transform"></i>
        </a>
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Edit Siswa</h2>
            <p class="text-xs text-gray-500">Perbarui informasi profil dan kredensial akun siswa aktif.</p>
        </div>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100/80 overflow-hidden">
        <!-- Dekorasi Top Bar -->
        <div class="h-1.5 w-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>

        <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Grid Input Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Nama Lengkap -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name', $siswa->name) }}" 
                            class="w-full pl-10 pr-4 py-3 border @error('name') border-red-400 focus:border-red-500 focus:ring-red-500/10 @else border-gray-300 focus:border-blue-500 focus:ring-blue-500/15 @enderror rounded-xl text-sm font-medium outline-none transition-all" required>
                    </div>
                    @error('name')
                        <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- NIS -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">NIS (Nomor Induk Siswa)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <i class="fas fa-id-card text-sm"></i>
                        </span>
                        <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas', $siswa->nomor_identitas) }}" 
                            class="w-full pl-10 pr-4 py-3 border font-mono @error('nomor_identitas') border-red-400 focus:border-red-500 focus:ring-red-500/10 @else border-gray-300 focus:border-blue-500 focus:ring-blue-500/15 @enderror rounded-xl text-sm font-medium outline-none transition-all" required>
                    </div>
                    @error('nomor_identitas')
                        <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jurusan -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">Jurusan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 z-10">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </span>
                        <select name="jurusan_id" class="w-full pl-10 pr-4 py-3 border @error('jurusan_id') border-red-400 focus:border-red-500 focus:ring-red-500/10 @else border-gray-300 focus:border-blue-500 focus:ring-blue-500/15 @enderror rounded-xl text-sm font-medium outline-none bg-white transition-all cursor-pointer appearance-none" required>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $siswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan }})
                                </option>
                            @endforeach
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                    @error('jurusan_id')
                        <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor HP / WA -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">Nomor HP / WA</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <i class="fab fa-whatsapp text-base font-bold"></i>
                        </span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}" 
                            class="w-full pl-10 pr-4 py-3 border @error('no_hp') border-red-400 focus:border-red-500 focus:ring-red-500/10 @else border-gray-300 focus:border-blue-500 focus:ring-blue-500/15 @enderror rounded-xl text-sm font-medium outline-none transition-all" placeholder="08...">
                    </div>
                    @error('no_hp')
                        <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bagian Reset Password -->
                <div class="col-span-1 md:col-span-2 bg-slate-50 p-5 rounded-2xl border border-slate-200/60 mt-2 space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center text-sm shadow-sm border border-amber-200/50 shrink-0">
                            <i class="fas fa-key"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-sm">Reset Password Siswa</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">Isi kolom di bawah HANYA jika ingin mengganti password login siswa ini. Jika tidak berencana mengubahnya, silakan biarkan kosong.</p>
                        </div>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" 
                            class="w-full pl-10 pr-4 py-3 border @error('password') border-red-400 focus:border-red-500 focus:ring-red-500/10 @else border-gray-300 focus:border-amber-500 focus:ring-amber-500/15 @enderror rounded-xl text-sm font-medium outline-none transition-all bg-white" placeholder="Masukkan password baru jika ingin diganti...">
                    </div>
                    @error('password')
                        <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi Simpan -->
            <div class="flex justify-end pt-5 border-t border-gray-100">
                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3.5 px-8 rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-md hover:shadow-blue-600/20 transform hover:-translate-y-0.5 active:translate-y-0 transition-all tracking-wide text-sm cursor-pointer text-center">
                    <i class="fas fa-save mr-1.5 text-xs"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection