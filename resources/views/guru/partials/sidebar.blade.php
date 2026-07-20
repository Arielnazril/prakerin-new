<aside id="sidebar" class="bg-[--color-primary-dark] text-white flex flex-col z-30 sidebar-transition h-screen shadow-2xl overflow-hidden fixed lg:static inset-y-0 left-0">

    {{-- HEADER SIDEBAR --}}
    <div class="h-16 flex items-center justify-center border-b border-white/10 shadow-sm bg-blue-950/40 relative overflow-hidden group">
        {{-- Efek cahaya latar belakang halus --}}
        <div class="absolute -right-10 -top-10 w-24 h-24 bg-blue-500/10 rounded-full blur-xl transition-all duration-500 group-hover:bg-blue-500/20"></div>
        
        <div class="flex items-center space-x-3 px-4 z-10 w-full justify-start pl-6">
            <div class="bg-white/95 p-1.5 rounded-xl shadow-md flex-shrink-0 sidebar-logo transition-all duration-300 transform group-hover:scale-105 border border-white/20">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-6 w-6 object-contain">
            </div>
            <div class="sidebar-header-text transition-all duration-300 overflow-hidden whitespace-nowrap">
                <h1 class="text-sm font-black tracking-widest leading-none bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent">GURU</h1>
                <p class="text-[9px] text-blue-300/90 font-bold uppercase tracking-widest mt-0.5">Academic Panel</p>
            </div>
        </div>
    </div>

    {{-- MENU ITEM SIDEBAR --}}
    <div class="flex-1 overflow-y-auto py-6 px-4 custom-scrollbar space-y-1.5">

        @include('admin.partials.sidebar_item', ['route' => 'dashboard', 'icon' => 'fas fa-chart-pie', 'label' => 'Dashboard'])

        <div class="pt-5 pb-1.5 px-3 text-[10px] font-black text-blue-300/70 uppercase tracking-widest sidebar-text whitespace-nowrap transition-all duration-300">Akademik</div>

        {{-- UPDATE LABEL DISINI --}}
        @include('admin.partials.sidebar_item', ['route' => 'guru.penilaian.index', 'icon' => 'fas fa-clipboard-check', 'label' => 'Penilaian & Riwayat'])

        <div class="pt-5 pb-1.5 px-3 text-[10px] font-black text-blue-300/70 uppercase tracking-widest sidebar-text whitespace-nowrap transition-all duration-300">Pengaturan</div>

        @include('admin.partials.sidebar_item', ['route' => 'profile.edit', 'icon' => 'fas fa-id-card', 'label' => 'Profil Saya'])
    </div>

    {{-- FOOTER SIDEBAR (TOMBOL KELUAR) --}}
    <div class="p-4 border-t border-white/10 bg-blue-950/20 backdrop-blur-sm">
        {{-- Mengubah type button agar memicu pop up konfirmasi terlebih dahulu --}}
        <button type="button" onclick="openLogoutModal()" class="flex items-center justify-center w-full p-2.5 rounded-xl bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 transition-all duration-300 shadow-md shadow-red-900/30 hover:shadow-xl text-white group overflow-hidden active:scale-[0.98] transform cursor-pointer">
            <i class="fas fa-power-off text-base sidebar-icon transition-transform duration-300 group-hover:rotate-45"></i>
            <span class="ml-2.5 font-bold text-sm sidebar-text whitespace-nowrap tracking-wide">Keluar</span>
        </button>
    </div>
</aside>

{{-- POP-UP / MODAL KONFIRMASI LOGOUT --}}
<div id="logout-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-950/60 backdrop-blur-sm p-4 transition-all duration-300 opacity-0">
    {{-- Kotak Modal / Pop-up --}}
    <div id="logout-modal-card" class="bg-white rounded-2xl border border-gray-100 shadow-2xl max-w-sm w-full p-6 text-center transform scale-90 transition-all duration-300 relative overflow-hidden group">
        {{-- Garis Aksen Atas --}}
        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-red-500 to-orange-500"></div>
        
        {{-- Icon Peringatan --}}
        <div class="mx-auto h-14 w-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center border border-red-100 text-xl mb-4 shadow-sm transform group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-exclamation-triangle animate-pulse"></i>
        </div>
        
        {{-- Teks --}}
        <h3 class="text-lg font-black text-gray-800 tracking-tight">Konfirmasi Keluar</h3>
        <p class="text-gray-500 text-xs font-medium mt-1.5 leading-relaxed">Apakah Anda yakin ingin mengakhiri sesi akademik dan keluar dari sistem?</p>
        
        {{-- Pilihan Aksi --}}
        <div class="grid grid-cols-2 gap-3 mt-6">
            <button type="button" onclick="closeLogoutModal()" class="w-full py-2.5 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold text-xs border border-gray-200 shadow-2xs active:scale-[0.98] transition-all duration-200 cursor-pointer">
                Batal
            </button>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-bold text-xs shadow-md shadow-red-200 active:scale-[0.98] transition-all duration-200 cursor-pointer">
                    Ya, Keluar
                </button>
            </form>
        </div>
    </div>
</div>

{{-- LOGIK JAVASCRIPT POP-UP --}}
<script>
    function openLogoutModal() {
        const modal = document.getElementById('logout-modal');
        const card = document.getElementById('logout-modal-card');
        
        modal.classList.remove('hidden');
        // Pemicu rendering ulang browser untuk animasi transisi
        void modal.offsetWidth;
        
        modal.classList.add('opacity-100');
        card.classList.remove('scale-90');
        card.classList.add('scale-100');
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logout-modal');
        const card = document.getElementById('logout-modal-card');
        
        modal.classList.remove('opacity-100');
        card.classList.remove('scale-100');
        card.classList.add('scale-90');
        
        // Menyembunyikan elemen setelah animasi selesai (300ms)
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Menutup pop-up saat mengklik luar area kotak konfirmasi
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('logout-modal');
        if (e.target === modal) {
            closeLogoutModal();
        }
    });
</script>