@extends('layouts.admin')

@section('title', 'Manajemen Wali')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-black d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Wali</h3>
            <a href="{{ route('admin.wali.create') }}" class="btn btn-dark w-40 h-10">
                <i class="fas fa-plus mr-2"></i>Tambah Wali
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Nama Wali</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Email</th>
                            <th>Hubungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($walis as $wali)
                        <tr>
                            <td>{{ $wali->id }}</td>
                            <td>{{ $wali->Nama_wali }}</td>
                            <td>{{ Str::limit($wali->Alamat_wali, 30) }}</td>
                            <td>{{ $wali->Kontak }}</td>
                            <td>{{ $wali->Email_wali }}</td>
                            <td>{{ $wali->Hubungan }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.wali.edit', $wali->id) }}" 
                                       class="btn btn-sm btn-warning mr-2" 
                                       data-toggle="tooltip" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.wali.destroy', $wali->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                data-toggle="tooltip" 
                                                title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus wali ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data wali</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $walis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection