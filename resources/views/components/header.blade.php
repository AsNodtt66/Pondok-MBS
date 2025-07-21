@php
    $user = Auth::guard('Pengguna')->user();
    $santri = $user ? \App\Models\Santri::find($user->santri_id) : null;
@endphp

@if($user && $santri)
<header class="bg-white text-blue-800 shadow-md relative z-10"> 
    <div class="flex justify-between items-center px-6 py-3">
        <!-- Left section - Logo, Hamburger, and Minimize Button -->
        <div class="flex items-center space-x-4">
            <!-- Hamburger menu for mobile -->
            <button id="sidebarToggle" class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- Minimize Sidebar Button -->
            <button id="sidebarToggleMinimize" class="text-blue-200 hover:text-blue-800 focus:outline-none hidden md:block">
                <i class="fa-solid fa-compress text-xl"></i>
            </button>
            
            <!-- Logo and App Name (optional, if you want to add it back) -->
            <div class="hidden md:flex items-center space-x-3">
                <!-- You can add logo here if desired, e.g., <img src="{{ asset('images/masjid.jpg') }}" alt="Logo" class="h-8"> -->
            </div>
        </div>
        
        <!-- Center section - Page Title -->
        <div class="flex-1 text-center md:text-left px-4">
            <h1 class="text-lg md:text-xl font-bold text-blue-800">@yield('title')</h1>
        </div>
        
        <!-- Right section - User Profile -->
        <div class="flex items-center space-x-6">
            <!-- Notification -->
            <div class="relative">
                <button id="notificationButton" class="text-blue-300 hover:text-blue-800 transition duration-200 relative">
                    <i class="fas fa-bell text-xl"></i>
                </button>
                
                <!-- Notification Dropdown -->
                <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200 text-gray-800">
                    <div class="px-4 py-3 border-b border-gray-400">
                        <h3 class="font-semibold text-blue-800">Notifikasi</h3>
                    </div>
                    <!-- Notification items would go here -->
                    <div class="px-4 py-3 text-center text-sm text-gray-500">
                        Tidak ada notifikasi baru
                    </div>
                </div>
            </div>
            
            <!-- User Profile -->
            <div class="relative">
                <button id="profileButton" class="flex items-center space-x-3 focus:outline-none group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center overflow-hidden border-2 border-blue-600 group-hover:border-white transition duration-200">
                            <img src="{{ $santri->foto_profil ? asset('storage/' . $santri->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-3 text-left hidden md:block">
                            <p class="text-sm font-medium text-blue-800">{{ $santri->Nama_santri ?? '-' }}</p>
                            <p class="text-xs text-blue-600">{{ $user->role->nama_role ?? 'Santri' }}</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down text-blue-600 ml-1 text-xs transition-transform duration-200 group-hover:text-blue-800"></i>
                </button>
                
                <!-- Profile Dropdown -->
                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-200">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-blue-800">{{ $santri->Nama_santri ?? '-' }}</p>
                        <p class="text-xs text-gray-500">{{ $user->role->nama_role ?? 'Santri' }}</p>
                    </div>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200" data-bs-toggle="modal" data-bs-target="#profileModal">
                        <i class="fas fa-user-circle mr-2 text-blue-600"></i> Profil Saya
                    </button>
                    <div class="border-t my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2 text-blue-600"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal Profil -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);">
            <div class="modal-header" style="background: #1e3a8a; color: white; border-bottom: none; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title" id="profileModalLabel" style="font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700;">Profil Saya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <div class="flex items-center space-x-4">
                    <img src="{{ $santri->foto_profil ? asset('storage/' . $santri->foto_profil) : asset('images/default-profile.png') }}" 
                         alt="Foto Profil" 
                         class="rounded-circle" 
                         style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #1e3a8a; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
                    <div>
                        <h5 style="color: #1e3a8a;">{{ $santri->Nama_santri ?? '-' }}</h5>
                        <p style="color: #3b82f6;"><strong>NIS:</strong> {{ $santri->Santri_id ?? '-' }}</p>
                        <p style="color: #3b82f6;"><strong>Kelas:</strong> {{ $santri->Kelas ?? '-' }}</p>
                        <p style="color: #3b82f6;"><strong>Status:</strong> {{ $santri->Status_aksk ?? 'Tidak Diketahui' }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 20px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: #64748b; color: #fff; border: none; border-radius: 5px;">Tutup</button>
                <a href="{{ route('dashboard.profil') }}" class="btn btn-primary" style="background: #1e3a8a; color: #fff; border: none; border-radius: 5px;">Lihat Profil Lengkap</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle dropdown notifikasi
    document.getElementById('notificationButton')?.addEventListener('click', function(e) {
        e.stopPropagation();
        const dropdown = document.getElementById('notificationDropdown');
        dropdown.classList.toggle('hidden');
        document.getElementById('profileDropdown')?.classList.add('hidden');
    });

    // Toggle dropdown profil
    document.getElementById('profileButton')?.addEventListener('click', function(e) {
        e.stopPropagation();
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('hidden');
        document.getElementById('notificationDropdown')?.classList.add('hidden');
        
        // Rotate chevron icon
        const chevron = this.querySelector('.fa-chevron-down');
        if (chevron) chevron.classList.toggle('rotate-180');
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#notificationButton') && !e.target.closest('#notificationDropdown')) {
            document.getElementById('notificationDropdown')?.classList.add('hidden');
        }
        
        if (!e.target.closest('#profileButton') && !e.target.closest('#profileDropdown')) {
            document.getElementById('profileDropdown')?.classList.add('hidden');
            const chevron = document.querySelector('#profileButton .fa-chevron-down');
            if (chevron) chevron.classList.remove('rotate-180');
        }
    });

    // Toggle minimize sidebar
    document.getElementById('sidebarToggleMinimize')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            const isCollapsed = sidebar.getAttribute('data-collapsed') === 'true';
            sidebar.setAttribute('data-collapsed', !isCollapsed);
            localStorage.setItem('sidebarCollapsed', !isCollapsed);
            console.log('Sidebar collapsed state:', !isCollapsed); // Debug log
        }
    });

    // Load sidebar state from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            sidebar.setAttribute('data-collapsed', isCollapsed);
            console.log('Initial sidebar state from localStorage:', isCollapsed); // Debug log
        }
    });
</script>
@endif