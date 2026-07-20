@extends('layouts.industri_layout')

@section('page_title', 'Input Penilaian')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">
    <a href="{{ route('industri.penilaian.index') }}" class="text-gray-500 hover:text-blue-600 inline-flex items-center transition font-bold text-sm bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm active:scale-95">
        <i class="fas fa-arrow-left mr-2 text-xs"></i> Kembali
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
        {{-- HEADER FORM --}}
        <div class="bg-blue-600 px-8 py-6 relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <h2 class="text-white font-extrabold text-xl flex items-center tracking-tight">
                <i class="fas fa-award mr-3 text-lg opacity-90"></i> Form Penilaian Kinerja
            </h2>
            <p class="text-blue-100 text-xs mt-1 font-medium">Siswa: <span class="font-black text-white underline decoration-blue-300 underline-offset-2">{{ $placement->siswa->name }}</span> <span class="font-mono text-blue-200">({{ $placement->siswa->nomor_identitas }})</span></p>
        </div>

        {{-- FORM BODY --}}
        <form action="{{ route('industri.penilaian.store', $placement->id) }}" method="POST" class="p-8 space-y-8">
            @csrf
            <input type="hidden" name="nama_siswa" value="{{ $placement->siswa->name }}">

            {{-- ASPEK NON-TEKNIS --}}
            <div class="space-y-3">
                <h3 class="font-extrabold text-gray-800 border-b border-gray-100 pb-3 flex items-center text-base tracking-tight">
                    <span class="bg-blue-50 text-blue-600 w-7 h-7 rounded-xl flex items-center justify-center mr-3 text-xs font-black border border-blue-100 shadow-sm">1</span>
                    Aspek Non-Teknis (Soft Skills)
                </h3>
                <div class="bg-blue-50/20 p-6 rounded-2xl border border-blue-100/50 transition duration-200 focus-within:border-blue-300">
                    <label class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Nilai Kedisiplinan & Sikap (0-100)</label>
                    <input type="number" name="aspek_non_teknis" min="0" max="100" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-blue-500 outline-none transition-all text-lg font-black text-blue-700 font-mono shadow-sm" placeholder="0" required>
                    <p class="text-xs text-gray-400 font-medium mt-2.5 leading-relaxed flex items-start gap-1.5">
                        <i class="fas fa-info-circle text-blue-400 mt-0.5"></i>
                        <span>Mencakup: Kedisiplinan waktu, Attitude (Sopan Santun), Kerjasama Tim, dan Komunikasi.</span>
                    </p>
                </div>
            </div>

            {{-- ASPEK TEKNIS --}}
            <div class="space-y-3">
                <h3 class="font-extrabold text-gray-800 border-b border-gray-100 pb-3 flex items-center text-base tracking-tight">
                    <span class="bg-blue-50 text-blue-600 w-7 h-7 rounded-xl flex items-center justify-center mr-3 text-xs font-black border border-blue-100 shadow-sm">2</span>
                    Aspek Teknis (Hard Skills)
                </h3>
                <div class="bg-blue-50/20 p-6 rounded-2xl border border-blue-100/50 transition duration-200 focus-within:border-blue-300">
                    <label class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Nilai Kompetensi Keahlian (0-100)</label>
                    <input type="number" name="aspek_teknis" min="0" max="100" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-blue-500 outline-none transition-all text-lg font-black text-blue-700 font-mono shadow-sm" placeholder="0" required>
                    <p class="text-xs text-gray-400 font-medium mt-2.5 leading-relaxed flex items-start gap-1.5">
                        <i class="fas fa-info-circle text-blue-400 mt-0.5"></i>
                        <span>Mencakup: Pemahaman tugas, Kualitas hasil kerja, dan Keterampilan teknis sesuai pekerjaan.</span>
                    </p>
                </div>
            </div>

            {{-- CATATAN KHUSUS --}}
            <div class="space-y-3">
                <h3 class="font-extrabold text-gray-800 border-b border-gray-100 pb-3 flex items-center text-base tracking-tight">
                    <span class="bg-blue-50 text-blue-600 w-7 h-7 rounded-xl flex items-center justify-center mr-3 text-xs font-black border border-blue-100 shadow-sm">3</span>
                    Ulasan / Catatan Khusus
                </h3>
                <textarea name="catatan" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-blue-500 outline-none transition-all text-sm font-medium text-gray-700 shadow-sm resize-none" placeholder="Tuliskan kesan, pesan, atau saran untuk pengembangan siswa..."></textarea>
            </div>

            {{-- BUTTON FOOTER --}}
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-extrabold text-sm py-3.5 px-8 rounded-xl hover:bg-blue-700 shadow-md shadow-blue-100 hover:shadow-lg hover:shadow-blue-200 transition duration-200 active:scale-95 flex items-center gap-2 cursor-pointer" onclick="return confirm('Apakah nilai sudah benar? Data tidak dapat diubah setelah disimpan.')">
                    <i class="fas fa-save text-xs opacity-90"></i> Simpan Nilai Akhir
                </button>
            </div>
        </form>
    </div>
</div>

@endsection