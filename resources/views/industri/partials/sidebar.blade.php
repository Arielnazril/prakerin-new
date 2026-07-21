<aside id="sidebar" class="bg-[--color-primary-dark] text-white flex flex-col z-30 sidebar-transition h-screen shadow-2xl overflow-hidden fixed lg:static inset-y-0 left-0 border-r border-white/5 -translate-x-full lg:translate-x-0 w-64">

    {{-- SIDEBAR HEADER --}}
    <div class="h-16 flex items-center justify-between px-4 sm:px-5 border-b border-white/10 shadow-xs bg-slate-900/50 backdrop-blur-md relative group/header shrink-0">
        {{-- Efek Glow Halus di Header --}}
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/15 via-indigo-500/10 to-transparent opacity-0 group-hover/header:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
        
        <div class="flex items-center space-x-3 z-10 w-full justify-start sm:justify-center lg:justify-start min-w-0 pr-2">
            <div class="bg-white p-1.5 rounded-2xl shadow-md shadow-black/20 flex-shrink-0 sidebar-logo transition-all duration-300 transform group-hover/header:scale-105 group-hover/header:rotate-3 border border-white/20">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-6 w-6 object-contain">
            </div>
            <div class="sidebar-header-text transition-all duration-300 overflow-hidden whitespace-nowrap min-w-0">
                <h1 class="text-sm font-black tracking-widest leading-none text-white bg-clip-text bg-gradient-to-r from-white via-slate-100 to-slate-300 truncate">MENTOR</h1>
                <p class="text-[9px] text-blue-300 font-extrabold uppercase tracking-widest mt-1 opacity-90 flex items-center gap-1.5 truncate">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 shadow-xs shadow-emerald-400/50 animate-pulse shrink-0"></span> Industri Panel
                </p>
            </div>
        </div>

        {{-- TOMBOL PENUTUP (X) KHUSUS TAMPILAN MOBILE --}}
        <button type="button" onclick="closeSidebarMobile()" class="lg:hidden text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 active:scale-95 transition-all duration-200 z-20 shrink-0 focus:outline-none" title="Tutup Sidebar">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>

    {{-- SIDEBAR NAVIGATION ITEMS --}}
    <div class="flex-1 overflow-y-auto py-5 px-3.5 custom-scrollbar space-y-1.5 scroll-smooth">

        {{-- DASHBOARD MENU --}}
        @include('admin.partials.sidebar_item', [
            'route' => 'industri.dashboard', 
            'icon' => 'fas fa-chart-pie', 
            'label' => 'Dashboard'
        ])

        {{-- SECTION HEADER: MONITORING --}}
        <div class="pt-6 pb-2 px-3 text-[10px] font-black text-blue-200/50 uppercase tracking-widest sidebar-text whitespace-nowrap transition-all duration-300">
            Monitoring Siswa
        </div>

        {{-- VALIDASI LOGBOOK MENU --}}
        @include('admin.partials.sidebar_item', [
            'route' => 'industri.validasi.index', 
            'icon' => 'fas fa-file-signature', 
            'label' => 'Validasi Logbook'
        ])

        {{-- PENILAIAN MENU --}}
        @include('admin.partials.sidebar_item', [
            'route' => 'industri.penilaian.index', 
            'icon' => 'fas fa-award', 
            'label' => 'Penilaian & Riwayat'
        ])

        {{-- SECTION HEADER: PENGATURAN --}}
        <div class="pt-6 pb-2 px-3 text-[10px] font-black text-blue-200/50 uppercase tracking-widest sidebar-text whitespace-nowrap transition-all duration-300">
            Pengaturan
        </div>

        {{-- PROFIL MENU --}}
        @include('admin.partials.sidebar_item', [
            'route' => 'profile.edit', 
            'icon' => 'fas fa-user-shield', 
            'label' => 'Profil Saya'
        ])
    </div>

    {{-- SIDEBAR FOOTER (LOGOUT DENGAN MODIFIKASI POP-UP) --}}
    <div class="p-4 border-t border-white/10 bg-slate-900/40 backdrop-blur-md shrink-0">
        {{-- Button Pemicu Pop-Up --}}
        <button type="button" onclick="toggleLogoutModal(true)" class="flex items-center justify-center w-full p-2.5 rounded-2xl bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 active:scale-[0.98] transition-all duration-300 shadow-lg shadow-red-950/40 text-white group overflow-hidden font-extrabold cursor-pointer border border-red-500/30">
            <i class="fas fa-power-off text-sm sidebar-icon transition-transform duration-300 group-hover:rotate-12 group-hover:scale-110"></i>
            <span class="ml-2.5 sidebar-text whitespace-nowrap tracking-wider text-xs uppercase">Keluar</span>
        </button>
    </div>
</aside>

{{-- MODAL POP-UP KONFIRMASI LOGOUT --}}
<div id="logout-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
    {{-- Overlay Latar Belakang Gelap Lembut Blur --}}
    <div onclick="toggleLogoutModal(false)" class="absolute inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity duration-300"></div>
    
    {{-- Kotak Dialog Konten --}}
    <div class="relative bg-white rounded-3xl max-w-sm w-full p-6 sm:p-7 shadow-2xl border border-slate-100 transform scale-90 opacity-0 transition-all duration-300 space-y-5">
        {{-- Icon Warning Logout --}}
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-rose-50 text-rose-500 shadow-inner border border-rose-100/60">
            <i class="fas fa-sign-out-alt text-2xl"></i>
        </div>
        
        {{-- Konten Teks --}}
        <div class="text-center space-y-1.5">
            <h3 class="text-lg font-black text-slate-900 tracking-tight">Konfirmasi Keluar</h3>
            <p class="text-xs font-medium text-slate-500 px-2 leading-relaxed">
                Apakah Anda yakin ingin mengakhiri sesi penilaian mentor dan keluar dari aplikasi?
            </p>
        </div>
        
        {{-- Tombol Aksi Pilihan --}}
        <div class="grid grid-cols-2 gap-3 pt-1">
            <button type="button" onclick="toggleLogoutModal(false)" class="px-4 py-3 rounded-xl border border-slate-200 text-xs font-extrabold text-slate-600 hover:bg-slate-50 active:scale-95 transition-all duration-200 cursor-pointer">
                Batal
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-3 rounded-xl bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-xs font-black text-white shadow-md shadow-red-500/20 active:scale-95 transition-all duration-200 cursor-pointer">
                    Ya, Keluar
                </button>
            </form>
        </div>
    </div>
</div>

{{-- JAVASCRIPT UNTUK MENGATUR POP-UP SECARA INTERAKTIF & HALUS --}}
<script>
    function toggleLogoutModal(show) {
        const modal = document.getElementById('logout-modal');
        const modalBox = modal.querySelector('.relative');
        
        if (show) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                modalBox.classList.remove('scale-90', 'opacity-0');
                modalBox.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            modalBox.classList.remove('scale-100', 'opacity-100');
            modalBox.classList.add('scale-90', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }, 200);
        }
    }

    // Fungsi Penutup Sidebar Mobile
    function closeSidebarMobile() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        
        if (sidebar) {
            sidebar.classList.add('-translate-x-full');
        }
        if (overlay) {
            overlay.classList.add('hidden');
        }
    }
</script>

{{-- STYLING PEMBATAS SCROLLBAR TAMBAHAN UNTUK SIDEBAR --}}
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.25);
    }
</style>