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
                @if(isset($santri))
                    @method('PUT')
                @endif
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Nama_santri">Nama Santri</label>
                        <input type="text" class="form-control" id="Nama_santri" name="Nama_santri" 
                               value="{{ old('Nama_santri', $santri->Nama_santri ?? '') }}" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="Santri_id">ID Santri</label>
                        <input type="text" class="form-control" id="Santri_id" name="Santri_id" 
                               value="{{ old('Santri_id', $santri->Santri_id ?? '') }}" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="Tanggal_lhr">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="Tanggal_lhr" name="Tanggal_lhr" 
                               value="{{ old('Tanggal_lhr', $santri->Tanggal_lhr ?? '') }}" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="Jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="Jenis_kelamin" name="Jenis_kelamin" required>
                            <option value="Laki-laki" {{ (old('Jenis_kelamin', $santri->Jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ (old('Jenis_kelamin', $santri->Jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="Status_aksk">Status</label>
                        <select class="form-control" id="Status_aksk" name="Status_aksk" required>
                            <option value="aktif" {{ (old('Status_aksk', $santri->Status_aksk ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ (old('Status_aksk', $santri->Status_aksk ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email" 
                               value="{{ old('Email', $santri->Email ?? '') }}" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="No_hp">No. HP</label>
                        <input type="text" class="form-control" id="No_hp" name="No_hp" 
                               value="{{ old('No_hp', $santri->No_hp ?? '') }}" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Wali_id">Wali</label>
                        <select class="form-control" id="Wali_id" name="Wali_id">
                            <option value="">Pilih Wali</option>
                            @foreach($walis as $wali)
                                <option value="{{ $wali->id }}" 
                                    {{ (old('Wali_id', $santri->Wali_id ?? '')) == $wali->id ? 'selected' : '' }}>
                                    {{ $wali->Nama_wali }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="Kelas">Kelas</label>
                        <input type="text" class="form-control" id="Kelas" name="Kelas" 
                               value="{{ old('Kelas', $santri->Kelas ?? '') }}">
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.santri.index') }}" class="btn btn-secondary">
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