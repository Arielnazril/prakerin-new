@extends('layouts.admin_layout')

@section('page_title', 'Master Data Jurusan')

@section('content')
<div class="space-y-8 selection:bg-indigo-500 selection:text-white animate-fade-in px-2 sm:px-0 font-sans antialiased">

    <!-- Header Section Premium -->
    <div class="relative overflow-hidden rounded-3xl bg-slate-900 p-8 sm:p-10 shadow-2xl shadow-indigo-950/30 border border-slate-800/80">
        <!-- Glow Elements Background -->
        <div class="absolute -right-16 -top-16 w-80 h-80 bg-gradient-to-br from-indigo-500/20 to-blue-600/0 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-80 h-80 bg-gradient-to-tr from-violet-600/20 to-pink-500/0 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b15_1px,transparent_1px),linear-gradient(to_bottom,#1e293b15_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center gap-1.5 bg-indigo-500/10 text-indigo-400 text-[11px] font-extrabold px-3.5 py-1 rounded-full border border-indigo-500/20 uppercase tracking-widest backdrop-blur-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                        Master Data
                    </span>
                </div>
                <h2 class="text-2xl sm:text-4xl font-black tracking-tight text-white flex items-center gap-3.5">
                    <span class="p-3 bg-gradient-to-br from-indigo-500/20 to-blue-500/20 text-indigo-400 rounded-2xl border border-indigo-500/30 backdrop-blur-xl shadow-inner flex items-center justify-center">
                        <i class="fas fa-graduation-cap"></i>
                    </span>
                    Daftar Jurusan
                </h2>
                <p class="text-xs sm:text-sm text-slate-400 font-medium leading-relaxed pt-1">
                    Kelola data kompetensi keahlian dan jurusan sekolah secara terpusat untuk integrasi sistem PKL.
                </p>
            </div>
            
            <button onclick="openModal('addModal')" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 hover:from-indigo-500 hover:to-blue-500 text-white font-extrabold py-3.5 px-7 rounded-2xl shadow-xl shadow-indigo-600/25 hover:shadow-indigo-500/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center text-xs uppercase tracking-wider cursor-pointer flex-shrink-0 group">
                <i class="fas fa-plus mr-2.5 text-xs transition-transform duration-300 group-hover:rotate-90"></i> Tambah Jurusan
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100/80 overflow-hidden transition-all duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[650px] table-fixed">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-400 uppercase text-[11px] font-black tracking-widest">
                        <th class="px-6 py-5 w-20 text-center">No</th>
                        <th class="px-6 py-5 w-auto">Nama Jurusan</th>
                        <th class="px-6 py-5 w-52">Kode Jurusan</th>
                        <th class="px-6 py-5 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($jurusans as $index => $jurusan)
                    <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group">
                        <td class="px-6 py-5 text-center text-slate-400 font-extrabold text-xs index-cell group-hover:text-indigo-600 transition-colors">
                            {{ sprintf('%02d', $index + 1) }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-4">
                                <div class="h-11 w-11 rounded-2xl bg-gradient-to-tr from-indigo-600 to-blue-500 text-white flex items-center justify-center font-black text-sm flex-shrink-0 shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform duration-200">
                                    {{ substr($jurusan->nama_jurusan, 0, 1) }}
                                </div>
                                <div class="font-bold text-slate-800 tracking-tight text-base group-hover:text-indigo-600 transition-colors truncate">
                                    {{ $jurusan->nama_jurusan }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center bg-indigo-50 text-indigo-700 border border-indigo-100 text-xs font-black font-mono px-3.5 py-1.5 rounded-xl shadow-2xs tracking-wider uppercase group-hover:bg-indigo-100/80 transition-colors">
                                <i class="fas fa-tag mr-2 opacity-60 text-[10px]"></i> {{ $jurusan->kode_jurusan }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="openEditModal({{ $jurusan->id }}, '{{ $jurusan->nama_jurusan }}', '{{ $jurusan->kode_jurusan }}')"
                                        class="bg-amber-50 text-amber-600 border border-amber-200/80 p-2.5 rounded-xl hover:bg-amber-500 hover:text-white hover:border-amber-500 transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-amber-500/20 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer" title="Edit Data">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>

                                <button type="button" onclick="openDeleteModal({{ $jurusan->id }}, '{{ $jurusan->nama_jurusan }}')" 
                                        class="bg-rose-50 text-rose-600 border border-rose-200/80 p-2.5 rounded-xl hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all duration-200 shadow-xs hover:shadow-md hover:shadow-rose-500/20 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer" title="Hapus Data">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center text-slate-400 bg-slate-50/30">
                            <div class="max-w-xs mx-auto flex flex-col items-center justify-center space-y-4">
                                <div class="w-20 h-20 rounded-3xl bg-white border border-slate-200/80 flex items-center justify-center text-slate-300 text-3xl shadow-sm">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-base font-extrabold text-slate-700">Belum Ada Data Jurusan</p>
                                    <p class="text-xs text-slate-400 leading-relaxed">Silakan tambahkan data jurusan baru dengan mengklik tombol Tambah Jurusan di atas.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Jurusan -->
<div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-md flex items-center justify-center transition-all duration-300 p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg border border-slate-100 transform transition-all scale-100 animate-modal-in overflow-hidden relative">
        <!-- Header Strip -->
        <div class="h-2 w-full bg-gradient-to-r from-indigo-500 via-indigo-600 to-blue-600"></div>
        
        <div class="px-7 pt-7 pb-4 flex justify-between items-center bg-white border-b border-slate-100/80">
            <div class="space-y-1">
                <h3 class="font-black text-slate-900 tracking-tight text-xl flex items-center gap-2.5">
                    <span class="p-2 bg-indigo-50 text-indigo-600 rounded-xl text-xs border border-indigo-100"><i class="fas fa-plus"></i></span>
                    Tambah Jurusan Baru
                </h3>
                <p class="text-xs font-medium text-slate-400">Masukkan rincian informasi data kompetensi keahlian</p>
            </div>
            <button onclick="closeModal('addModal')" class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 border border-slate-100 transition-all duration-200 cursor-pointer">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.jurusan.store') }}" method="POST" class="p-7 space-y-5 text-sm bg-white">
            @csrf
            
            <div class="grid grid-cols-1 gap-5">
                <!-- Input Nama Jurusan -->
                <div class="space-y-2">
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Nama Lengkap Jurusan</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-indigo-600 transition-colors">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <input type="text" name="nama_jurusan" required class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl bg-slate-50/50 focus:bg-white focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-600 outline-none transition-all duration-200 font-semibold text-slate-800 placeholder:text-slate-400 text-sm shadow-2xs" placeholder="Contoh: Rekayasa Perangkat Lunak">
                    </div>
                </div>
                
                <!-- Input Kode Jurusan -->
                <div class="space-y-2">
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Singkatan / Kode Jurusan</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-indigo-600 transition-colors">
                            <i class="fas fa-font text-sm"></i>
                        </div>
                        <input type="text" name="kode_jurusan" required class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl bg-slate-50/50 focus:bg-white focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-600 outline-none transition-all duration-200 font-bold font-mono text-slate-800 placeholder:text-slate-400 text-sm shadow-2xs" placeholder="Contoh: RPL">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100 mt-6">
                <button type="button" onclick="closeModal('addModal')" class="px-5 py-3 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition-all uppercase tracking-wider cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-6 py-3.5 rounded-xl font-extrabold hover:from-indigo-700 hover:to-blue-700 shadow-lg shadow-indigo-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all uppercase tracking-wider cursor-pointer flex items-center gap-2 text-xs">
                    <i class="fas fa-check-circle"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Jurusan -->
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-md flex items-center justify-center transition-all duration-300 p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg border border-slate-100 transform transition-all scale-100 animate-modal-in overflow-hidden relative">
        <!-- Header Strip -->
        <div class="h-2 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600"></div>
        
        <div class="px-7 pt-7 pb-4 flex justify-between items-center bg-white border-b border-slate-100/80">
            <div class="space-y-1">
                <h3 class="font-black text-slate-900 tracking-tight text-xl flex items-center gap-2.5">
                    <span class="p-2 bg-amber-50 text-amber-500 rounded-xl text-xs border border-amber-100"><i class="fas fa-edit"></i></span>
                    Edit Informasi Jurusan
                </h3>
                <p class="text-xs font-medium text-slate-400">Perbarui rincian informasi data kompetensi keahlian terkait</p>
            </div>
            <button onclick="closeModal('editModal')" class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 border border-slate-100 transition-all duration-200 cursor-pointer">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        
        <form id="editForm" method="POST" class="p-7 space-y-5 text-sm bg-white">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-5">
                <!-- Input Nama Jurusan -->
                <div class="space-y-2">
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Nama Lengkap Jurusan</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-amber-500 transition-colors">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <input type="text" id="edit_nama" name="nama_jurusan" required class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl bg-slate-50/50 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-200 font-semibold text-slate-800 text-sm shadow-2xs">
                    </div>
                </div>
                
                <!-- Input Kode Jurusan -->
                <div class="space-y-2">
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Singkatan / Kode Jurusan</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-amber-500 transition-colors">
                            <i class="fas fa-font text-sm"></i>
                        </div>
                        <input type="text" id="edit_kode" name="kode_jurusan" required class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl bg-slate-50/50 focus:bg-white focus:ring-4 focus:ring-amber-500/15 focus:border-amber-500 outline-none transition-all duration-200 font-bold font-mono text-slate-800 text-sm shadow-2xs">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100 mt-6">
                <button type="button" onclick="closeModal('editModal')" class="px-5 py-3 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition-all uppercase tracking-wider cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-amber-500 to-orange-500 text-white px-6 py-3.5 rounded-xl font-extrabold hover:from-amber-600 hover:to-orange-600 shadow-lg shadow-amber-500/20 hover:-translate-y-0.5 active:translate-y-0 transition-all uppercase tracking-wider cursor-pointer flex items-center gap-2 text-xs">
                    <i class="fas fa-sync-alt"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Jurusan -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/60 backdrop-blur-md flex items-center justify-center transition-all duration-300 p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 transform transition-all scale-100 animate-modal-in overflow-hidden relative">
        <!-- Header Strip -->
        <div class="h-2 w-full bg-gradient-to-r from-rose-500 via-red-500 to-rose-600"></div>
        
        <div class="p-7 text-center space-y-4">
            <!-- Icon Warning -->
            <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center text-2xl mx-auto shadow-inner border border-rose-100">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <div class="space-y-2">
                <h3 class="font-black text-slate-900 tracking-tight text-xl">Konfirmasi Hapus Data</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Apakah Anda yakin ingin menghapus jurusan <span id="delete_nama_target" class="font-bold text-slate-800"></span>? 
                    <span class="block mt-3 text-xs text-rose-600 bg-rose-50/80 p-3 rounded-2xl border border-rose-100 font-medium text-left"><i class="fas fa-info-circle mr-1"></i> Tindakan ini tidak dapat dibatalkan dan data siswa terkait mungkin akan mengalami error.</span>
                </p>
            </div>
        </div>
        
        <form id="deleteForm" method="POST" class="px-7 pb-7 text-sm bg-white">
            @csrf
            @method('DELETE')
            
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeModal('deleteModal')" class="w-full px-5 py-3.5 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl border border-slate-200 transition-all uppercase tracking-wider cursor-pointer text-center">
                    Batal
                </button>
                <button type="submit" class="w-full bg-gradient-to-r from-rose-600 to-red-600 text-white px-6 py-3.5 rounded-xl font-extrabold hover:from-rose-700 hover:to-red-700 shadow-lg shadow-rose-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all uppercase tracking-wider cursor-pointer flex items-center justify-center gap-2 text-xs">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Animasi Kustom -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-modal-in { animation: modalIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
</style>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    // Logic untuk mengisi data ke Modal Edit secara dinamis
    function openEditModal(id, nama, kode) {
        // 1. Isi input value
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_kode').value = kode;

        // 2. Ganti URL Action Form
        let url = "{{ route('admin.jurusan.update', ':id') }}";
        url = url.replace(':id', id);

        document.getElementById('editForm').action = url;

        // 3. Buka Modal
        openModal('editModal');
    }

    // Logic untuk memicu Modal Hapus Kustom secara dinamis
    function openDeleteModal(id, nama) {
        // 1. Tampilkan nama jurusan yang akan dihapus di dalam card text
        document.getElementById('delete_nama_target').innerText = nama;

        // 2. Ganti URL Action Form Hapus secara dinamis sesuai ID data
        let url = "{{ route('admin.jurusan.destroy', ':id') }}";
        url = url.replace(':id', id);
        document.getElementById('deleteForm').action = url;

        // 3. Tampilkan Modal
        openModal('deleteModal');
    }
</script>
@endsection