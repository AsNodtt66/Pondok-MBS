@php
    // Gunakan guard 'Pengguna' untuk mendapatkan user yang terautentikasi
    $user = Auth::guard('Pengguna')->user();
@endphp

@if($user && in_array($user->role->Jenis_role, ['santri', 'wali']))
<aside id="sidebar" class="w-64 bg-blue-800 text-white min-h-screen flex flex-col transition-all duration-300 transform md:translate-x-0 -translate-x-full fixed md:static z-20" data-collapsed="false">
    <!-- Logo dan Nama Aplikasi -->
    <div class="p-4 border-b border-blue-700 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <a href="{{ route('home') }}" class="sidebar-icon">
                <img src="{{ asset('images/masjid.jpg') }}" alt="Pondok Pesantren Logo" class="h-10 w-10 rounded-full object-cover transition-all duration-300 logo-image" onerror="this.src='{{ asset('images/default-logo.png') }}';">
            </a>
            <div class="sidebar-text">
                <h2 class="text-xl font-bold">Pesantren MBS</h2>
                <p class="text-blue-200 text-sm">Sistem Informasi</p>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <button id="sidebarClose" class="md:hidden text-blue-200 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <!-- Menu Navigasi -->
    <nav class="mt-2 flex-1 overflow-y-auto">
        <ul>
            <li>
                <a href="{{ route('dashboard.' . $user->role->Jenis_role) }}" 
                   class="flex items-center px-4 py-3 hover:bg-blue-700 transition duration-200 @if(Request::routeIs('dashboard.' . $user->role->Jenis_role)) bg-blue-700 @endif group">
                    <i class="fa-solid fa-house-user mr-3 text-blue-300 group-hover:text-white sidebar-icon"></i>
                    <span class="group-hover:text-white sidebar-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.profil') }}" 
                   class="flex items-center px-4 py-3 hover:bg-blue-700 transition duration-200 @if(Request::routeIs('dashboard.profil')) bg-blue-700 @endif group">
                    <i class="fas fa-user mr-3 text-blue-300 group-hover:text-white sidebar-icon"></i>
                    <span class="group-hover:text-white sidebar-text">Profil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.' . ($user->role->Jenis_role == 'wali' ? 'wali.' : '') . 'akademik') }}" 
                   class="flex items-center px-4 py-3 hover:bg-blue-700 transition duration-200 @if(Request::routeIs('dashboard.' . ($user->role->Jenis_role == 'wali' ? 'wali.' : '') . 'akademik')) bg-blue-700 @endif group">
                    <i class="fas fa-book mr-3 text-blue-300 group-hover:text-white sidebar-icon"></i>
                    <span class="group-hover:text-white sidebar-text">Akademik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.' . ($user->role->Jenis_role == 'wali' ? 'wali.' : '') . 'keuangan') }}" 
                   class="flex items-center px-4 py-3 hover:bg-blue-700 transition duration-200 @if(Request::routeIs('dashboard.' . ($user->role->Jenis_role == 'wali' ? 'wali.' : '') . 'keuangan')) bg-blue-700 @endif group">
                    <i class="fas fa-money-bill-wave mr-3 text-blue-300 group-hover:text-white sidebar-icon"></i>
                    <span class="group-hover:text-white sidebar-text">Keuangan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.' . ($user->role->Jenis_role == 'wali' ? 'wali.' : '') . 'psikologi') }}" 
                   class="flex items-center px-4 py-3 hover:bg-blue-700 transition duration-200 @if(Request::routeIs('dashboard.' . ($user->role->Jenis_role == 'wali' ? 'wali.' : '') . 'psikologi')) bg-blue-700 @endif group">
                    <i class="fa-solid fa-chart-line mr-3 text-blue-300 group-hover:text-white sidebar-icon"></i>
                    <span class="group-hover:text-white sidebar-text">Psikologi Santri</span>
                </a>
            </li>
            @if($user->role->Jenis_role == 'wali')
            <li>
                <a href="{{ route('dashboard.wali.laporan') }}" 
                   class="flex items-center px-4 py-3 hover:bg-blue-700 transition duration-200 @if(Request::routeIs('dashboard.wali.laporan')) bg-blue-700 @endif group">
                    <i class="fas fa-file-alt mr-3 text-blue-300 group-hover:text-white sidebar-icon"></i>
                    <span class="group-hover:text-white sidebar-text">Laporan Santri</span>
                </a>
            </li>
            @endif
        </ul>
    </nav>
    
    <!-- Logout -->
    <div class="p-4 border-t border-blue-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 hover:bg-blue-700 transition duration-200 rounded group">
                <i class="fas fa-sign-out-alt mr-3 text-blue-300 group-hover:text-white sidebar-icon"></i>
                <span class="group-hover:text-white sidebar-text">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<!-- Overlay untuk mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden md:hidden"></div>

<style>
    /* Sidebar minimized state */
    #sidebar[data-collapsed="true"] {
        width: 80px;
    }
    #sidebar[data-collapsed="true"] .sidebar-text {
        display: none;
    }
    #sidebar[data-collapsed="true"] .sidebar-icon {
        margin-right: 0 !important;
        text-align: center;
        width: 100%;
    }
    #sidebar[data-collapsed="true"] .flex.items-center.space-x-3 {
        justify-content: center;
        padding: 0.5rem;
    }
    #sidebar[data-collapsed="true"] .flex.items-center.space-x-2 {
        justify-content: center;
    }
    /* Adjust main content margin */
    #sidebar[data-collapsed="true"] + .flex-1 {
        margin-left: 80px;
    }
    #sidebar[data-collapsed="true"] + .flex-1 {
        margin-left: 256px;
    }
    @media (max-width: 768px) {
        #sidebar + .flex-1 {
            margin-left: 0;
        }
    }
    /* Logo size adjustment */
    .logo-image {
        transition: all 0.3s ease;
    }
    #sidebar[data-collapsed="false"] .logo-image {
        height: 40px;
        width: 40px;
    }
    #sidebar[data-collapsed="true"] .logo-image {
        height: 30px;
        width: 30px;
    }
</style>

<script>
    // Toggle sidebar di mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });
    
    // Close sidebar
    document.getElementById('sidebarClose')?.addEventListener('click', closeSidebar);
    document.getElementById('sidebarOverlay')?.addEventListener('click', closeSidebar);
    
    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Close sidebar saat menu diklik (untuk mobile)
    document.querySelectorAll('#sidebar a').forEach(link => {
        link.addEventListener('click', closeSidebar);
    });
</script>
@endif