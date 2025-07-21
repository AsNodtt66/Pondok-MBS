@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Tambah Pengguna Baru</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pengguna.store') }}">
                @csrf
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_pengguna">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" 
                               value="{{ old('nama_pengguna') }}" required>
                        @error('nama_pengguna')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="{{ old('username') }}" required>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="progress mt-2" style="height: 5px;">
                            <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <small id="password-strength-text" class="form-text"></small>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="role_id">Peran <span class="text-danger">*</span></label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <option value="">Pilih Peran</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->Nama_role }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="status">Status Akun <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus mr-2"></i>Buat Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        
        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const strength = calculatePasswordStrength(password);
            
            strengthBar.style.width = strength.percentage + '%';
            strengthBar.className = 'progress-bar ' + strength.color;
            strengthText.textContent = strength.text;
            strengthText.className = 'form-text ' + strength.textColor;
        });
        
        function calculatePasswordStrength(password) {
            let strength = 0;
            let text = '';
            let color = '';
            let textColor = '';
            let percentage = 0;
            
            if (password.length > 0) percentage += 10;
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[a-z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            percentage = Math.min(100, (password.length * 3) + (strength * 15));
            
            if (password.length === 0) {
                text = '';
                color = '';
                textColor = '';
            } else if (password.length < 8) {
                text = 'Sangat Lemah (minimal 8 karakter)';
                color = 'bg-danger';
                textColor = 'text-danger';
            } else if (strength <= 2) {
                text = 'Lemah';
                color = 'bg-danger';
                textColor = 'text-danger';
            } else if (strength <= 3) {
                text = 'Sedang';
                color = 'bg-warning';
                textColor = 'text-warning';
            } else if (strength <= 4) {
                text = 'Kuat';
                color = 'bg-info';
                textColor = 'text-info';
            } else {
                text = 'Sangat Kuat';
                color = 'bg-success';
                textColor = 'text-success';
            }
            
            return { percentage, text, color, textColor };
        }
    });
</script>
@endsection