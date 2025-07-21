@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

<div class="min-h-screen bg-gradient-to-br from-green-900 to-green-600 flex items-center justify-center  ">
    <div class="bg-white bg-opacity-90 p-8 rounded-xl shadow-2xl transform transition duration-500 hover:scale-105 w-full max-w-md mt-4">
        <div class="text-center mb-6">
            <img src="{{ asset('images/masjid-bg.jpg') }}" alt="Logo" class="mx-auto w-32 h-32 mb-2">
            <h1 class="text-2xl font-bold text-green-600">HALLO SELAMAT DATANG</h1>
            <p class="text-green-700">Pondok Pesantren MBS Al-Amin Putri</p>
        </div>

        <form method="POST" action="/register" class="space-y-6" onsubmit="return validateForm()">
            @csrf

            <div>
                <label for="name" class="block text-sm 
                font-medium text-gray-700"><i class="fas fa-user"></i>
                Nama</label>
                <input id="nama_pengguna" type="text" class="mt-1 block 
                w-full px-4 py-2 border border-gray-300 rounded-md 
                shadow-sm focus:ring-green-500 focus:border-green-500 
                transition duration-200" name="nama_pengguna" value="{{ old
                ('nama_pengguna') }}" required 
                autocomplete="nama_pengguna" autofocus 
                placeholder="Masukkan nama Anda">
                @error('nama_pengguna')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
                <small id="nameError" style="color: red; d
                isplay: none;">Nama harus diisi</small>
            </div>

            <div>
                <label for="username" class="block text-sm font-medium
                 text-gray-700"><i class="fas fa-envelope"></i> Username
                </label>
                <input id="username" type="text" class="mt-1 block w-full
                 px-4 py-2 border border-gray-300 rounded-md shadow-sm 
                 focus:ring-green-500 focus:border-green-500 transition 
                 duration-200" name="username" value="{{ old('username') }}
                 " required autocomplete="username" 
                 placeholder="Masukkan username Anda">
                 @error('username')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
                <small id="usernameError" style="color: red; display: 
                none;">Username harus diisi</small>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium
                 text-gray-700"><i class="fas fa-lock"></i> Password</label>
                 <input id="password" type="password" class="mt-1 block 
                 w-full px-4 py-2 border border-gray-300 rounded-md 
                 shadow-sm focus:ring-green-500 focus:border-green-500 
                 transition duration-200" name="password" required 
                 autocomplete="new-password" placeholder="Masukkan password Anda">
                 @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
                <small id="passwordError" style="color: red; display: 
                none;">Password harus diisi</small>
            </div>

            <div>
                <label for="role_id" class="block text-sm font-medium
                 text-gray-700">Role</label>
                <select id="role_id" name="role_id" class="mt-1 block 
                w-full px-4 py-2 border border-gray-300 rounded-md 
                shadow-sm focus:ring-green-500 focus:border-green-500 
                transition duration-200">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ 
                        $role->Nama_role }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full bg-green-600
                 text-white py-2 px-4 rounded-md hover:bg-green-700 
                 focus:outline-none focus:ring-2 focus:ring-offset-2
                  focus:ring-green-500 transition duration-200">
                    Register
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="/login" class="text-sm text-yellow-600
             hover:text-yellow-500">Login</a>
        </div>
    </div>
</div>

<script>
        function validateForm() {
        var name = document.getElementById('nama_pengguna').value;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var isValid = true;

        if (name === '') {
            document.getElementById('nameError').style.display = 'block';
            isValid = false;
        } else {
            document.getElementById('nameError').style.display = 'none';
        }

        if (username === '') {
            document.getElementById('usernameError').style.display = 'block';
            isValid = false;
        } else {
            document.getElementById('usernameError').style.display = 'none';
        }

        if (password === '') {
            document.getElementById('passwordError').style.display = 'block';
            isValid = false;
        } else {
            document.getElementById('passwordError').style.display = 'none';
        }

        return isValid;

    }
</script>
@endsection