<aside id="sidebar" class="bg-[#234F35] text-white flex flex-col z-30 sidebar-transition h-screen shadow-[5px_0_30px_rgba(0,0,0,0.25)] border-r border-white/5 overflow-hidden {{-- Default width diatur via JS/Layout --}}">

    <!-- Header Sidebar - Efek Glassmorphism & Pendaran Premium -->
    <div class="h-16 flex items-center justify-center border-b border-white/10 shadow-sm bg-gradient-to-r from-emerald-950/40 via-[#234F35]/60 to-emerald-950/40 backdrop-blur-md relative group/header">
        <!-- Aksen garis bawah menyala tipis -->
        <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-[#89C74A]/40 to-transparent"></div>
        
        <div class="flex items-center space-x-3 px-4 w-full justify-start sm:justify-center">
            <!-- Kontainer Logo Premium -->
            <div class="bg-white p-2 rounded-xl shadow-md flex-shrink-0 sidebar-logo transition-all duration-300 transform group-hover/header:scale-105 group-hover/header:rotate-2 ring-2 ring-white/10">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-6 w-6 object-contain">
            </div>
            <!-- Teks Judul Panel -->
            <div class="sidebar-header-text transition-all duration-300 overflow-hidden whitespace-nowrap">
                <h1 class="text-sm font-extrabold tracking-wider leading-none bg-gradient-to-r from-white via-slate-100 to-emerald-100 bg-clip-text text-transparent">E-PRAKERIN</h1>
                <p class="text-[9px] text-[#89C74A] font-bold uppercase tracking-widest mt-0.5">Admin Panel</p>
            </div>
        </div>
    </div>

    <!-- Area Menu Navigasi Utama -->
    <div class="flex-1 overflow-y-auto py-5 px-3 custom-scrollbar space-y-1.5 selection:bg-[#234F35] selection:text-white">

        @include('admin.partials.sidebar_item', ['route' => 'dashboard', 'icon' => 'fas fa-chart-pie', 'label' => 'Dashboard'])

        <!-- Kategori: Master Data -->
        <div class="flex items-center pt-5 pb-2 px-3 gap-2 sidebar-text whitespace-nowrap">
            <span class="text-[9px] font-black text-[#89C74A] uppercase tracking-widest">Master Data</span>
            <span class="h-[1px] flex-1 bg-gradient-to-r from-[#89C74A]/30 to-transparent rounded"></span>
        </div>

        @include('admin.partials.sidebar_item', ['route' => 'admin.siswa.index', 'icon' => 'fas fa-user-graduate', 'label' => 'Data Siswa'])
        @include('admin.partials.sidebar_item', ['route' => 'admin.guru.index', 'icon' => 'fas fa-chalkboard-teacher', 'label' => 'Data Guru'])
        @include('admin.partials.sidebar_item', ['route' => 'admin.instansi.index', 'icon' => 'fas fa-industry', 'label' => 'Data Industri'])
        @include('admin.partials.sidebar_item', ['route' => 'admin.pembimbing.index', 'icon' => 'fas fa-user-tie', 'label' => 'Mentor Industri'])
        @include('admin.partials.sidebar_item', ['route' => 'admin.jurusan.index', 'icon' => 'fas fa-graduation-cap', 'label' => 'Jurusan'])

        <!-- Kategori: Magang -->
        <div class="flex items-center pt-5 pb-2 px-3 gap-2 sidebar-text whitespace-nowrap">
            <span class="text-[9px] font-black text-[#89C74A] uppercase tracking-widest">Magang</span>
            <span class="h-[1px] flex-1 bg-gradient-to-r from-[#89C74A]/30 to-transparent rounded"></span>
        </div>

        @include('admin.partials.sidebar_item', ['route' => 'admin.placement.calculate', 'icon' => 'fas fa-calculator', 'label' => 'Kalkulasi Rekomendasi'])
        @include('admin.partials.sidebar_item', ['route' => 'admin.placement.create', 'icon' => 'fas fa-user-plus', 'label' => 'Plotting Siswa'])
        @include('admin.partials.sidebar_item', ['route' => 'admin.placement.index', 'icon' => 'fas fa-map-marked-alt', 'label' => 'Data Penempatan'])
        @include('admin.partials.sidebar_item', ['route' => 'admin.rekap.index', 'icon' => 'fas fa-clipboard-check', 'label' => 'Rekap Nilai'])
        @include('admin.partials.sidebar_item', ['route' => 'profile.edit', 'icon' => 'fas fa-user-cog', 'label' => 'Profil Saya'])
    </div>

    <!-- Footer Sidebar - Tombol Logout Premium -->
    <div class="p-4 border-t border-white/10 bg-black/10 backdrop-blur-sm">
        <form id="logoutSidebarForm" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="button" id="btnOpenLogoutModal" class="flex items-center justify-center w-full py-3 px-4 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-red-600/20 text-white font-bold tracking-wide text-xs uppercase relative overflow-hidden group/btn transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                <!-- Efek kilatan cahaya (shimmer) saat disorot -->
                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-white/0 via-white/15 to-white/0 -translate-x-full group-hover/btn:animate-[sidebar-shimmer_1.5s_infinite]"></span>
                
                <i class="fas fa-power-off text-sm sidebar-icon transition-all duration-300 group-hover/btn:scale-110"></i>
                <span class="ml-2.5 sidebar-text whitespace-nowrap tracking-widest">Logout</span>
            </button>
        </form>
    </div>

    <!-- Gaya CSS Kustom Tambahan khusus Animasi Shimmer Footer & Scrollbar -->
    <style>
        @keyframes sidebar-shimmer {
            100% { transform: translateX(100%); }
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</aside>

<!-- Modal Pop-Up Konfirmasi Logout Interaktif -->
<div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center hidden select-none">
    <!-- Overlay Backdrop dengan blur -->
    <div id="logoutModalBackdrop" class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 opacity-0"></div>

    <!-- Kontainer Kartu Modal -->
    <div id="logoutModalCard" class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full mx-4 p-6 transform transition-all duration-300 scale-95 opacity-0 border border-gray-100 overflow-hidden text-slate-800">
        <!-- Aksen Gelombang Warna Merah di Bagian Atas -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-red-500 via-rose-500 to-red-600"></div>

        <div class="flex flex-col items-center text-center">
            <!-- Icon Power-off Melayang -->
            <div class="h-16 w-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center text-2xl mb-4 border border-red-100 shadow-inner group">
                <i class="fas fa-power-off animate-pulse"></i>
            </div>

            <!-- Judul & Deskripsi -->
            <h3 class="text-lg font-black text-slate-800 tracking-tight">Konfirmasi Keluar</h3>
            <p class="text-xs text-slate-500 mt-1 font-medium leading-relaxed">
                Apakah Anda yakin ingin mengakhiri sesi dan keluar dari panel admin?
            </p>

            <!-- Tombol Aksi -->
            <div class="flex w-full gap-3 mt-6">
                <button type="button" id="btnCancelLogout" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold py-2.5 px-4 rounded-xl transition text-xs outline-none cursor-pointer">
                    Batal
                </button>
                <button type="button" id="btnConfirmLogout" class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-extrabold py-2.5 px-4 rounded-xl shadow-md shadow-red-500/20 hover:shadow-lg transition text-xs outline-none cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0">
                    Ya, Logout
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script Pengendali Pop-Up Logout -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnOpenLogoutModal = document.getElementById('btnOpenLogoutModal');
        const logoutModal = document.getElementById('logoutModal');
        const logoutModalBackdrop = document.getElementById('logoutModalBackdrop');
        const logoutModalCard = document.getElementById('logoutModalCard');
        const btnCancelLogout = document.getElementById('btnCancelLogout');
        const btnConfirmLogout = document.getElementById('btnConfirmLogout');
        const logoutSidebarForm = document.getElementById('logoutSidebarForm');

        function openLogoutModal() {
            if (!logoutModal) return;
            logoutModal.classList.remove('hidden');
            setTimeout(() => {
                logoutModalBackdrop.classList.remove('opacity-0');
                logoutModalCard.classList.remove('scale-95', 'opacity-0');
                logoutModalCard.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeLogoutModal() {
            if (!logoutModal) return;
            logoutModalBackdrop.classList.add('opacity-0');
            logoutModalCard.classList.remove('scale-100', 'opacity-100');
            logoutModalCard.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                logoutModal.classList.add('hidden');
            }, 300);
        }

        if (btnOpenLogoutModal) {
            btnOpenLogoutModal.addEventListener('click', openLogoutModal);
        }

        if (btnCancelLogout) {
            btnCancelLogout.addEventListener('click', closeLogoutModal);
        }

        if (logoutModalBackdrop) {
            logoutModalBackdrop.addEventListener('click', closeLogoutModal);
        }

        if (btnConfirmLogout && logoutSidebarForm) {
            btnConfirmLogout.addEventListener('click', function () {
                logoutSidebarForm.submit();
            });
        }
    });
</script>