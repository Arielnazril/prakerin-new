<aside id="sidebar" class="bg-[--color-primary-dark] text-white flex flex-col z-40 sidebar-transition h-screen shadow-2xl overflow-hidden fixed lg:static inset-y-0 left-0 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out w-64 max-w-[80vw] sm:max-w-xs lg:max-w-none">

    {{-- HEADER SIDEBAR --}}
    <div class="h-16 flex items-center justify-between border-b border-white/10 shadow-sm bg-blue-950/40 relative overflow-hidden group px-3.5 sm:px-4 shrink-0">
        {{-- Efek cahaya latar belakang --}}
        <div class="absolute -right-10 -top-10 w-24 h-24 bg-blue-500/10 rounded-full blur-xl transition-all duration-500 group-hover:bg-blue-500/20 pointer-events-none"></div>
        
        <div class="flex items-center space-x-3 z-10 min-w-0 flex-1 pl-1 sm:pl-2">
            <div class="bg-white/95 p-1.5 rounded-xl shadow-md flex-shrink-0 sidebar-logo transition-all duration-300 transform group-hover:scale-105 border border-white/20">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-6 w-6 object-contain">
            </div>
            <div class="sidebar-header-text transition-all duration-300 overflow-hidden whitespace-nowrap min-w-0">
                <h1 class="text-sm font-black tracking-widest leading-none bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent truncate">SISWA</h1>
                <p class="text-[9px] text-blue-300/90 font-bold uppercase tracking-widest mt-0.5 truncate">Area Magang</p>
            </div>
        </div>

        {{-- Tombol Close Khusus Layar Mobile --}}
        <button type="button" onclick="closeSidebar()" class="lg:hidden text-white/70 hover:text-white p-2.5 -mr-1.5 rounded-xl active:bg-white/10 focus:outline-none z-20 transition-colors cursor-pointer flex items-center justify-center shrink-0">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>

    {{-- MENU ITEM SIDEBAR --}}
    <div class="flex-1 overflow-y-auto py-5 sm:py-6 px-3.5 sm:px-4 custom-scrollbar space-y-1.5 overscroll-contain" style="-webkit-overflow-scrolling: touch;">

        @include('admin.partials.sidebar_item', ['route' => 'siswa.dashboard', 'icon' => 'fas fa-chart-pie', 'label' => 'Dashboard'])
        @include('admin.partials.sidebar_item', ['route' => 'siswa.transkrip.index', 'icon' => 'fas fa-file-alt', 'label' => 'Transkrip'])

        <div class="pt-4 sm:pt-5 pb-1.5 px-3 text-[10px] font-black text-blue-300/70 uppercase tracking-widest sidebar-text whitespace-nowrap transition-all duration-300 select-none">Kegiatan Harian</div>

        @include('admin.partials.sidebar_item', ['route' => 'siswa.logbook.history', 'icon' => 'fas fa-book-open', 'label' => 'Riwayat Logbook'])
        @include('admin.partials.sidebar_item', ['route' => 'siswa.logbook.create', 'icon' => 'fas fa-edit', 'label' => 'Isi Logbook Baru'])

        <div class="pt-4 sm:pt-5 pb-1.5 px-3 text-[10px] font-black text-blue-300/70 uppercase tracking-widest sidebar-text whitespace-nowrap transition-all duration-300 select-none">Akun</div>

        @include('admin.partials.sidebar_item', ['route' => 'profile.edit', 'icon' => 'fas fa-id-card', 'label' => 'Profil Saya'])
    </div>

    {{-- FOOTER SIDEBAR (TOMBOL MEMBUKA MODAL LOGOUT) --}}
    <div class="p-3.5 sm:p-4 border-t border-white/10 bg-blue-950/20 backdrop-blur-sm shrink-0">
        <button type="button" onclick="openLogoutModal()" class="flex items-center justify-center w-full p-2.5 sm:p-3 rounded-xl bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 transition-all duration-300 shadow-md shadow-red-900/30 hover:shadow-xl text-white group overflow-hidden active:scale-[0.98] transform cursor-pointer">
            <i class="fas fa-sign-out-alt text-base sidebar-icon transition-transform duration-300 group-hover:-translate-x-1 shrink-0"></i>
            <span class="ml-2.5 font-bold text-xs sm:text-sm sidebar-text whitespace-nowrap tracking-wide">Keluar</span>
        </button>
    </div>
</aside>

{{-- BACKDROP / OVERLAY MOBILE SIDEBAR --}}
<div id="sidebar-overlay" onclick="closeSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-30 hidden lg:hidden transition-opacity duration-300 opacity-0"></div>

{{-- POP-UP / MODAL KONFIRMASI LOGOUT --}}
<div id="logout-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-950/60 backdrop-blur-sm p-4 transition-all duration-300 opacity-0">
    {{-- Kotak Modal / Pop-up --}}
    <div id="logout-modal-card" class="bg-white rounded-2xl border border-gray-100 shadow-2xl max-w-[320px] sm:max-w-sm w-full p-5 sm:p-6 text-center transform scale-90 transition-all duration-300 relative overflow-hidden group mx-auto my-auto">
        {{-- Garis Aksen Atas --}}
        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-red-500 to-orange-500"></div>
        
        {{-- Icon Peringatan --}}
        <div class="mx-auto h-12 w-12 sm:h-14 sm:w-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center border border-red-100 text-lg sm:text-xl mb-3.5 sm:mb-4 shadow-sm transform group-hover:scale-110 transition-transform duration-300 shrink-0">
            <i class="fas fa-exclamation-triangle animate-pulse"></i>
        </div>
        
        {{-- Teks --}}
        <h3 class="text-base sm:text-lg font-black text-gray-800 tracking-tight">Konfirmasi Keluar</h3>
        <p class="text-gray-500 text-xs font-medium mt-1.5 leading-relaxed px-1">Apakah kamu yakin ingin keluar dari aplikasi?</p>
        
        {{-- Pilihan Aksi --}}
        <div class="grid grid-cols-2 gap-2.5 sm:gap-3 mt-5 sm:mt-6">
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

{{-- LOGIK JAVASCRIPT RESPONSIVE SIDEBAR & POP-UP --}}
<script>
    // --- PENANGANAN TOGGLE SIDEBAR MOBILE ---
    function openSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            
            overlay.classList.remove('hidden');
            void overlay.offsetWidth; // Force reflow
            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');
        }
    }

    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);
        }
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('-translate-x-full')) {
            openSidebar();
        } else {
            closeSidebar();
        }
    }

    // --- PENANGANAN MODAL LOGOUT ---
    function openLogoutModal() {
        if (window.innerWidth < 1024) {
            closeSidebar();
        }

        const modal = document.getElementById('logout-modal');
        const card = document.getElementById('logout-modal-card');
        
        modal.classList.remove('hidden');
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
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // --- EVENT LISTENERS OTOMATIS ---
    document.addEventListener('DOMContentLoaded', function() {
        // Menutup pop-up modal logout saat mengklik luar area kotak konfirmasi
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('logout-modal');
            if (e.target === modal) {
                closeLogoutModal();
            }
        });

        // Menutup dengan tombol Escape (ESC)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLogoutModal();
                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            }
        });

        // Reset state jika ukuran layar diubah ke desktop (≥ 1024px)
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const overlay = document.getElementById('sidebar-overlay');
                if (overlay) {
                    overlay.classList.add('hidden', 'opacity-0');
                    overlay.classList.remove('opacity-100');
                }
            }
        });
    });
</script>