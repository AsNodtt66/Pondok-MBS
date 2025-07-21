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
                @if(isset($wali))
                    @method('PUT')
                @endif
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Nama_wali">Nama Wali</label>
                        <input type="text" class="form-control" id="Nama_wali" name="Nama_wali" 
                               value="{{ old('Nama_wali', $wali->Nama_wali ?? '') }}" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="Email_wali">Email</label>
                        <input type="email" class="form-control" id="Email_wali" name="Email_wali" 
                               value="{{ old('Email_wali', $wali->Email_wali ?? '') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="Alamat_wali">Alamat</label>
                    <textarea class="form-control" id="Alamat_wali" name="Alamat_wali" rows="3" required>{{ old('Alamat_wali', $wali->Alamat_wali ?? '') }}</textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Kontak">Kontak</label>
                        <input type="text" class="form-control" id="Kontak" name="Kontak" 
                               value="{{ old('Kontak', $wali->Kontak ?? '') }}" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="Hubungan">Hubungan</label>
                        <input type="text" class="form-control" id="Hubungan" name="Hubungan" 
                               value="{{ old('Hubungan', $wali->Hubungan ?? '') }}" required>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.wali.index') }}" class="btn btn-secondary">
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