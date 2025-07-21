@extends('layouts.admin')

@section('title', 'Tambah Alumni')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-gradient-indigo text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-user-graduate mr-2"></i> Form Tambah Alumni
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alumni.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nama_alumni" class="font-weight-bold">Nama Alumni <span class="text-danger">*</span></label>
                                    <input type="text" name="Nama_alumni" id="Nama_alumni" class="form-control @error('Nama_alumni') is-invalid @enderror" value="{{ old('Nama_alumni') }}" required>
                                    @error('Nama_alumni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Santri_id" class="font-weight-bold">ID Santri <span class="text-danger">*</span></label>
                                    <input type="text" name="Santri_id" id="Santri_id" class="form-control @error('Santri_id') is-invalid @enderror" value="{{ old('Santri_id') }}" required>
                                    @error('Santri_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Tanggal_lhr" class="font-weight-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="Tanggal_lhr" id="Tanggal_lhr" class="form-control @error('Tanggal_lhr') is-invalid @enderror" value="{{ old('Tanggal_lhr') }}" required>
                                    @error('Tanggal_lhr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <div class="custom-control custom-radio mr-3">
                                            <input class="custom-control-input" type="radio" id="laki" name="Jenis_kelamin" value="Laki-laki" {{ old('Jenis_kelamin') == 'Laki-laki' ? 'checked' : 'checked' }}>
                                            <label for="laki" class="custom-control-label">Laki-laki</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="perempuan" name="Jenis_kelamin" value="Perempuan" {{ old('Jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                            <label for="perempuan" class="custom-control-label">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('Jenis_kelamin')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Status_aksk" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                                    <select name="Status_aksk" id="Status_aksk" class="form-control @error('Status_aksk') is-invalid @enderror" required>
                                        <option value="aktif" {{ old('Status_aksk') == 'aktif' ? 'selected' : 'selected' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('Status_aksk') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('Status_aksk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Wali_id" class="font-weight-bold">Wali</label>
                                    <select name="Wali_id" id="Wali_id" class="form-control @error('Wali_id') is-invalid @enderror">
                                        <option value="">Pilih Wali</option>
                                        @foreach($walis as $wali)
                                            <option value="{{ $wali->id }}" {{ old('Wali_id') == $wali->id ? 'selected' : '' }}>
                                                {{ $wali->Nama_wali }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Wali_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email" class="font-weight-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="Email" id="Email" class="form-control @error('Email') is-invalid @enderror" value="{{ old('Email') }}" required>
                                    @error('Email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="No_hp" class="font-weight-bold">No HP <span class="text-danger">*</span></label>
                                    <input type="text" name="No_hp" id="No_hp" class="form-control @error('No_hp') is-invalid @enderror" value="{{ old('No_hp') }}" required>
                                    @error('No_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-2"></i> Simpan Data
                            </button>
                            <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary px-4 ml-2">
                                <i class="fas fa-times mr-2"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection