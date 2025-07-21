@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Pengguna</h3>
            <a href="{{ route('admin.pengguna.create') }}" class="btn btn-dark">
                <i class="fas fa-plus mr-2"></i>Tambah Pengguna
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
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penggunas as $pengguna)
                        <tr>
                            <td>{{ $pengguna->id }}</td>
                            <td>{{ $pengguna->nama_pengguna }}</td>
                            <td>{{ $pengguna->username }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $pengguna->role->Nama_role ?? 'Tidak ada peran' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $pengguna->status == 'aktif' ? 'success' : 'danger' }}">
                                    {{ ucfirst($pengguna->status) }}
                                </span>
                            </td>
                            <td>{{ $pengguna->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" 
                                       class="btn btn-sm btn-warning mr-2" 
                                       data-toggle="tooltip" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pengguna.destroy', $pengguna->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                data-toggle="tooltip" 
                                                title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pengguna</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $penggunas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection