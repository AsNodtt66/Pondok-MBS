<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pesantren MBS') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        @if (Auth::guard('Pengguna')->check() && in_array(Route::currentRouteName(), [
            'dashboard.santri',
            'dashboard.wali',
            'dashboard.profil',
            'dashboard.akademik',
            'dashboard.keuangan',
            'dashboard.keuangan.riwayat',
            'dashboard.psikologi',
            'dashboard.laporan',
            'dashboard.wali.akademik',
            'dashboard.wali.keuangan',
            'dashboard.wali.keuangan.riwayat',
            'dashboard.wali.psikologi',
            'dashboard.wali.laporan',
            'dashboard.wali.laporan.show'
        ]))
            @include('components.sidebar')
        @endif
        
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            @if (Auth::guard('Pengguna')->check() && in_array(Route::currentRouteName(), [
                'dashboard.santri',
                'dashboard.wali',
                'dashboard.profil',
                'dashboard.akademik',
                'dashboard.keuangan',
                'dashboard.keuangan.riwayat',
                'dashboard.psikologi',
                'dashboard.laporan',
                'dashboard.wali.akademik',
                'dashboard.wali.keuangan',
                'dashboard.wali.keuangan.riwayat',
                'dashboard.wali.psikologi',
                'dashboard.wali.laporan',
                'dashboard.wali.laporan.show'
            ]))
                @include('components.header')
            @endif
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                @if (session('success'))
                    <div class="container mt-3">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="container mt-3">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>