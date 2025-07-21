@extends('layouts.app')

@section('content')
<div class="min-h-screen relative">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ asset('images/masjid.jpg') }}" alt="Pondok Pesantren">
        <div class="absolute inset-0 bg-blue-900 opacity-50 mix-blend-multiply" aria-hidden="true"></div>
    </div>

    <!-- Login Form Centered -->
    <div class="min-h-screen flex items-center justify-center relative z-10 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-2xl transform transition duration-500 hover:scale-105">
            <div class="text-center mb-8">
                <div class="mx-auto bg-blue-100 rounded-full w-24 h-24 flex items-center justify-center mb-4">
                    <i class="fas fa-mosque text-blue-600 text-4xl"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-blue-900">PONDOK PESANTREN</h1>
                <h2 class="text-2xl font-bold text-blue-800 mt-2">MBS Al-Amin Putri</h2>
                <p class="mt-2 text-blue-600">Membentuk generasi Qur'ani yang berakhlak mulia</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium text-blue-900">Username</label>
                    <input id="username" type="text" 
                        class="mt-1 block w-full px-4 py-3 border border-blue-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-blue-300"
                        name="username" value="{{ old('username') }}" 
                        placeholder="Masukkan username" required autocomplete="username" autofocus>

                    @error('username')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-blue-900">Password</label>
                    <input id="password" type="password" 
                        class="mt-1 block w-full px-4 py-3 border border-blue-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-blue-300"
                        name="password" 
                        placeholder="Masukkan password" required autocomplete="current-password">

                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-blue-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-blue-800">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                            Lupa password?
                        </a>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 p-3 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm text-red-600">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <button type="submit" 
                        class="w-full bg-blue-700 text-white py-3 px-4 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-sm text-blue-700">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            Daftar disini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection