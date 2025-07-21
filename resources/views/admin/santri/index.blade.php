@extends('layouts.admin')

@section('title', 'Manajemen Santri')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Santri</h3>
            <div>
                <a href="{{ route('admin.santri.create') }}" class="btn btn-dark mr-2">
                    <i class="fas fa-plus mr-2"></i>Tambah Santri
                </a>
                <form action="{{ route('admin.santri.index') }}" method="GET" class="d-inline">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>ID Santri</th>
                            <th>Nama Santri</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santris as $santri)
                        <tr>
                            <td>{{ $santri->Santri_id }}</td>
                            <td>{{ $santri->Nama_santri }}</td>
                            <td>{{ $santri->Tanggal_lhr }}</td>
                            <td>{{ $santri->Jenis_kelamin }}</td>
                            <td>{{ $santri->Kelas ?? 'Belum Ditentukan' }}</td>
                            <td>{{ $santri->No_hp }}</td>
                            <td>
                                <span class="badge badge-{{ $santri->Status_aksk == 'aktif' ? 'success' : 'danger' }}">
                                    {{ ucfirst($santri->Status_aksk) }}
                                </span>
                            </td>
                            <td>{{ $santri->Email }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.santri.edit', $santri->id) }}" 
                                       class="btn btn-sm btn-warning mr-2" 
                                       data-toggle="tooltip" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.santri.destroy', $santri->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger mr-2" 
                                                data-toggle="tooltip" 
                                                title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus santri ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.santri.akademik', $santri->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       data-toggle="tooltip" 
                                       title="Akademik">
                                        <i class="fas fa-book"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data santri</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $santris->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection