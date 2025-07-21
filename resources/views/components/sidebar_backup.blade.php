<aside class="w-64 bg-green-800 text-white min-h-screen">
    <div class="p-4 border-b border-green-700">
        <div class="flex items-center space-x-3">
    </div>
    
    <nav class="mt-5">
        <ul>
            <li>
                <a href="{{ route('dashboard.' . auth()->user()->role->Jenis_role) }}" class="flex items-center px-4 py-3 hover:bg-green-700 @if(Request::routeIs('dashboard.' . auth()->user()->role->Jenis_role)) bg-green-700 @endif">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.profil') }}" class="flex items-center px-4 py-3 hover:bg-green-700 @if(Request::routeIs('dashboard.profil')) bg-green-700 @endif">
                    <i class="fas fa-user mr-3"></i>
                    Profil
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.akademik') }}" class="flex items-center px-4 py-3 hover:bg-green-700 @if(Request::routeIs('dashboard.akademik')) bg-green-700 @endif">
                    <i class="fas fa-book mr-3"></i>
                    Akademik
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.keuangan') }}" class="flex items-center px-4 py-3 hover:bg-green-700 @if(Request::routeIs('dashboard.keuangan')) bg-green-700 @endif">
                    <i class="fas fa-money-bill-wave mr-3"></i>
                    Keuangan
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.psikologi') }}" class="flex items-center px-4 py-3 hover:bg-green-700 @if(Request::routeIs('dashboard.psikologi')) bg-green-700 @endif">
                    <i class="fa-solid fa-chart-line mr-3"></i>
                    Psikologi Santri
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.alumni') }}" class="flex items-center px-4 py-3 hover:bg-green-700 @if(Request::routeIs('dashboard.alumni')) bg-green-700 @endif">
                    <i class="fas fa-graduation-cap mr-3"></i>
                    Alumni
                </a>
            </li>
            @auth
                <li>
               @if(Auth::guard('Pengguna')->user()->santri_id)
                <a href="{{ route('laporan.show', Auth::guard('Pengguna')->user()->santri_id) }}"
                class="flex items-center px-4 py-3 hover:bg-green-700 @if(Request::routeIs('laporan.show')) bg-green-700 @endif">
                    <i class="fas fa-envelope mr-3"></i>
                    Laporan
                </a>
            @else
                <span class="text-gray-400">Laporan tidak tersedia</span>
            @endif
            </li>

            @endauth
            
            <li class="mt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 hover:bg-green-700">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Keluar
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>