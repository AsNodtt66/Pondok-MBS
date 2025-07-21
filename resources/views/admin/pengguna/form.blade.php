@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $title }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ $action }}">
                @csrf
                @if(isset($pengguna))
                    @method('PUT')
                @endif
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_pengguna">Nama Pengguna</label>
                        <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" 
                               value="{{ old('nama_pengguna', $pengguna->nama_pengguna ?? '') }}" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="{{ old('username', $pengguna->username ?? '') }}" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">{{ isset($pengguna) ? 'Password Baru' : 'Password' }}</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               {{ isset($pengguna) ? '' : 'required' }}>
                        <small class="form-text text-muted">
                            {{ isset($pengguna) ? 'Biarkan kosong jika tidak ingin mengubah password' : '' }}
                        </small>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="role_id">Peran</label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <option value="">Pilih Peran</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" 
                                    {{ old('role_id', $pengguna->role_id ?? '') == $role->id ? 'selected' : '' }}>
                                    {{ $role->Nama_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="aktif" {{ old('status', $pengguna->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $pengguna->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection