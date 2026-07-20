@extends('layouts.industri_layout')

@section('page_title', 'Detail Validasi')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">
    {{-- BACK BUTTON --}}
    <div>
        <a href="{{ route('industri.validasi.index') }}" class="text-gray-500 hover:text-blue-600 inline-flex items-center transition-all duration-200 font-bold text-sm group">
            <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

        {{-- LEFT SIDE: LOGBOOK DETAIL CARD --}}
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <div class="bg-gray-50/70 px-6 py-4 border-b border-gray-100 flex justify-between items-center gap-4">
                <h3 class="font-extrabold text-gray-800 text-sm uppercase tracking-wider flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i> Detail Kegiatan Siswa
                </h3>
                <span class="bg-blue-50 border border-blue-200 text-blue-700 text-xs font-black px-3 py-1.5 rounded-xl shadow-sm">
                    <i class="fas fa-user mr-1.5 text-blue-500"></i> {{ $logbook->siswa->name }}
                </span>
            </div>
            
            <div class="p-6 space-y-5">
                {{-- Date and Time Header --}}
                <div class="flex justify-between items-center border-b border-gray-100 pb-5">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-wider">Tanggal Kegiatan</p>
                        <p class="font-black text-gray-900 text-xl mt-0.5 tracking-tight">{{ $logbook->tanggal->format('d F Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-wider">Durasi / Jam Kerja</p>
                        <p class="inline-flex items-center font-mono font-bold text-sm text-gray-700 bg-gray-50 border border-gray-200 px-2.5 py-1.5 rounded-xl mt-1 shadow-sm">
                            <i class="far fa-clock mr-1.5 text-gray-400"></i>
                            {{ \Carbon\Carbon::parse($logbook->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($logbook->jam_keluar)->format('H:i') }}
                        </p>
                    </div>
                </div>

                {{-- Activity Description --}}
                <div class="space-y-2">
                    <p class="text-[10px] text-gray-400 uppercase font-black tracking-wider">Deskripsi Kegiatan</p>
                    <div class="bg-gray-50/40 p-4 rounded-xl text-gray-700 leading-relaxed whitespace-pre-line border border-gray-100 font-medium text-sm">
                        {{ $logbook->kegiatan }}
                    </div>
                </div>

                {{-- Documentation Photo --}}
                @if($logbook->foto)
                <div class="space-y-2 pt-2">
                    <p class="text-[10px] text-gray-400 uppercase font-black tracking-wider">Dokumentasi Terlampir</p>
                    <div class="relative overflow-hidden rounded-xl border border-gray-200 shadow-sm bg-gray-50 max-w-full group/img">
                        <img src="{{ asset('storage/' . $logbook->foto) }}" alt="Bukti Kegiatan" class="w-full h-auto object-cover hover:scale-[1.02] transition duration-300 cursor-pointer" onclick="window.open(this.src)">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover/img:opacity-100 transition pointer-events-none flex items-center justify-center">
                            <span class="bg-white/95 text-gray-800 text-xs font-bold px-3 py-1.5 rounded-xl shadow flex items-center gap-1.5">
                                <i class="fas fa-search-plus text-blue-600"></i> Perbesar Gambar
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- RIGHT SIDE: VALIDATION FORM CARD --}}
        <div class="md:col-span-1 sticky top-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300 space-y-4">
                <h3 class="font-extrabold text-gray-800 border-b border-gray-100 pb-3 text-sm uppercase tracking-wider flex items-center">
                    <i class="fas fa-check-double mr-2 text-blue-600"></i> Form Validasi
                </h3>

                <form action="{{ route('industri.validasi.update', $logbook->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-wider mb-2">Status Validasi</label>
                        <div class="relative">
                            <select name="status" class="w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-bold text-gray-700 bg-white appearance-none cursor-pointer" required>
                                <option value="disetujui" {{ $logbook->status == 'disetujui' ? 'selected' : '' }}>✅ Setujui</option>
                                <option value="ditolak" {{ $logbook->status == 'ditolak' ? 'selected' : '' }}>❌ Tolak / Revisi</option>
                                <option value="pending" {{ $logbook->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-wider mb-2">
                            Catatan Pembimbing <span class="text-gray-400 font-normal lowercase">(opsional)</span>
                        </label>
                        <textarea name="catatan_pembimbing" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-medium text-gray-700 placeholder-gray-400" placeholder="Berikan masukan atau alasan penolakan...">{{ $logbook->catatan_pembimbing }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md shadow-blue-100 transition duration-200 transform hover:-translate-y-0.5 active:scale-95 text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i> Simpan Validasi
                    </button>
                </form>

                {{-- Alert Notification for Approved Status --}}
                @if($logbook->status == 'disetujui')
                    <div class="p-3 bg-emerald-50 text-emerald-800 text-xs rounded-xl border border-emerald-200/60 font-medium flex items-center gap-2 shadow-sm">
                        <i class="fas fa-check-circle text-emerald-500 text-sm"></i> Logbook ini sudah disetujui.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection