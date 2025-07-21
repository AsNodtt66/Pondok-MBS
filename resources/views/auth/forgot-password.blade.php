@extends('layouts.auth')

@section('auth-title', 'Lupa Password')

@section('auth-content')
<form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
    @csrf
    <div class="rounded-md shadow-sm -space-y-px">
        <div>
            <label for="email" class="sr-only">Email</label>
            <input id="email" name="email" type="email" autocomplete="email" required 
                   class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                   placeholder="Email yang terdaftar">
        </div>
    </div>

    <div class="text-sm text-center">
        <p class="text-gray-600">
            Masukkan email yang Anda gunakan saat mendaftar. Kami akan mengirimkan link untuk reset password.
        </p>
    </div>

    <div>
        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-paper-plane"></i>
            </span>
            Kirim Link Reset Password
        </button>
    </div>
    
    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-green-600 hover:text-green-500 font-medium">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke halaman login
        </a>
    </div>
</form>
@endsection