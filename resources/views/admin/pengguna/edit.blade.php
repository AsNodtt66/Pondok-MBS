@extends('layouts.admin')

@section('title', 'Edit Data Pengguna')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit Pengguna: {{ $pengguna->nama_pengguna }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pengguna.update', $pengguna->id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_pengguna">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" 
                               value="{{ old('nama_pengguna', $pengguna->nama_pengguna) }}" required>
                        @error('nama_pengguna')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="{{ old('username', $pengguna->username) }}" required>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="role_id">Peran <span class="text-danger">*</span></label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <option value="">Pilih Peran</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" 
                                    {{ old('role_id', $pengguna->role_id) == $role->id ? 'selected' : '' }}>
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
                            <option value="aktif" {{ old('status', $pengguna->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $pengguna->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card mt-4 border-primary">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Informasi Akun</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Dibuat:</strong> {{ $pengguna->created_at->format('d M Y H:i') }}</p>
                                <p><strong>Terakhir Diubah:</strong> {{ $pengguna->updated_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status Terakhir:</strong>
                                    <span class="badge badge-{{ $pengguna->status == 'aktif' ? 'success' : 'danger' }}">
                                        {{ ucfirst($pengguna->status) }}
                                    </span>
                                </p>
                                <p><strong>Peran Saat Ini:</strong>
                                    <span class="badge badge-info">
                                        {{ $pengguna->role->Nama_role ?? 'Tidak ada peran' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Perbarui Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection