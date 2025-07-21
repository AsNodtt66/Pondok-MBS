@extends('layouts.dashboard')

@section('title', 'Profil Santri')

@section('dashboard-content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Kolom Kiri - Foto & Info Dasar -->
    <div class="bg-gradient-to-br from-blue-700 to-slate-600 rounded-xl shadow-lg p-6 transform transition duration-300 hover:scale-105">
        <div class="flex flex-col items-center text-white">
            <div class="bg-gray-800 border-2 border-dashed rounded-full w-32 h-32 flex items-center justify-center mb-4 overflow-hidden">
                <img id="profileImage" src="{{ $santri->foto_profil ? asset('storage/' . $santri->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil" class="w-full h-full object-cover">
            </div>
            <h2 class="text-xl font-bold">{{ $santri->Nama_santri ?? '-' }}</h2>
            <p class="text-yellow-100">NIS: {{ $santri->Santri_id ?? '-' }}</p>
            
            <div class="w-full mt-6 space-y-3">
                <div class="flex justify-between">
                    <span class="text-yellow-100">Kelas:</span>
                    <span class="font-medium">{{ $santri->Kelas ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-yellow-100">Status:</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                        {{ $santri->Status_aksk ?? 'Tidak Diketahui' }}
                    </span>
                </div>
            </div>
            
            <div class="mt-6 w-full space-y-2">
                <button type="button" class="w-full bg-blue-100 text-blue-900 py-2 rounded-md hover:bg-yellow-400" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-camera mr-2"></i>Ganti Foto
                </button>
                @if($santri->foto_profil)
                    <form action="{{ route('user.profile.delete') }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="w-full bg-red-100 text-red-900 py-2 rounded-md hover:bg-red-200" onclick="return confirm('Yakin mau hapus foto profil?')">
                            <i class="fas fa-trash mr-2"></i>Hapus Foto
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Kolom Tengah & Kanan - Data Lengkap -->
    <div class="lg:col-span-2 grid grid-cols-1 gap-6">
        <!-- Data Pribadi -->
        <div class="bg-gradient-to-br from-slate-700 to-slate-400 rounded-xl shadow-lg p-6 transform transition duration-300 hover:scale-105">
            <h3 class="text-lg font-bold text-white mb-4">Data Pribadi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-white">
                <div>
                    <label class="block text-sm font-medium text-yellow-100">Tempat Lahir</label>
                    <p class="mt-1">{{ $santri->tempat_lahir ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-yellow-100">Tanggal Lahir</label>
                    <p class="mt-1">{{ $santri->Tanggal_lhr ? $santri->Tanggal_lhr->format('d F Y') : '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-yellow-100">Jenis Kelamin</label>
                    <p class="mt-1">{{ $santri->Jenis_kelamin ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-yellow-100">No. HP</label>
                    <p class="mt-1">{{ $santri->No_hp ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-yellow-100">Email</label>
                    <p class="mt-1">{{ $santri->Email ?? '-' }}</p>
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-yellow-100">Alamat Lengkap</label>
                <p class="text-yellow-100 mt-1">{{ $santri->alamat ?? '-' }}</p>
            </div>
        </div>
        
        <!-- Data Wali -->
        <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-xl shadow-lg p-6 transform transition duration-300 hover:scale-105">
            <h3 class="text-lg font-bold text-white mb-4">Data Wali</h3>
            
            @if($santri->wali)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-white">
                    <div>
                        <label class="block text-sm font-medium text-yellow-100">Nama Wali</label>
                        <p class="mt-1">{{ $santri->wali->Nama_wali ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-yellow-100">Alamat Wali</label>
                        <p class="mt-1">{{ $santri->wali->Alamat_wali ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-yellow-100">Kontak Wali</label>
                        <p class="mt-1">{{ $santri->wali->Kontak ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-yellow-100">Email Wali</label>
                        <p class="mt-1">{{ $santri->wali->Email_wali ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-yellow-100">Hubungan</label>
                        <p class="mt-1">{{ $santri->wali->Hubungan ?? '-' }}</p>
                    </div>
                </div>
            @else
                <div class="text-white text-center">
                    <p>Data wali belum tersedia. Silakan hubungi pengurus untuk memperbarui data.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Edit Foto Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Ganti Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="text-center mb-3">
                        <img src="{{ $santri->foto_profil ? asset('storage/' . $santri->foto_profil) : asset('images/default-profile.png') }}" 
                             alt="Foto Profil" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #d9b999;">
                    </div>
                    <div class="mb-3">
                        <label for="foto_profil" class="form-label">Pilih Foto Baru</label>
                        <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*">
                        @if($santri->foto_profil)
                            <small class="form-text text-muted">Foto saat ini: <a href="{{ asset('storage/' . $santri->foto_profil) }}" target="_blank">Lihat</a></small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Animasi loading untuk form submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            if (button && !button.disabled) {
                button.disabled = true;
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Memproses...';
                setTimeout(() => {
                    button.disabled = false;
                    button.innerHTML = originalText;
                }, 5000);
            }
        });
    });
</script>
<style>
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .modal-header {
        background: #d9b999;
        color: #3b2a1a;
        border-bottom: none;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .modal-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
    }
    .modal-body {
        padding: 30px;
    }
    .form-label {
        color: #3b2a1a;
        font-weight: 600;
    }
    .form-control {
        border: 1px solid #d9b999;
        border-radius: 8px;
        padding: 10px;
    }
    .form-control:focus {
        border-color: #a67c00;
        box-shadow: 0 0 8px rgba(166, 124, 0, 0.3);
    }
    .btn-primary {
        background: #3b2a1a;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
    .btn-primary:hover {
        background: #5a442a;
        transform: translateY(-2px);
    }
    .btn-secondary {
        background: #5a442a;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
    .btn-secondary:hover {
        background: #3b2a1a;
        transform: translateY(-2px);
    }
</style>
@endpush
@endsection