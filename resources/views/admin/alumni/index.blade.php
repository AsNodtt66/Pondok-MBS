@extends('layouts.admin')

@section('title', 'Manajemen Alumni')

@section('content')
<div class="container-fluid">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Daftar Alumni</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.alumni.create') }}" class="btn btn-dark ">
                            <i class="fas fa-plus mr-1"></i> Tambah Alumni
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alumni</th>
                                    <th>ID Santri</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th>Wali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($alumnis as $alumni)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $alumni->Nama_alumni }}</td>
                                    <td>{{ $alumni->Santri_id }}</td>
                                    <td>{{ $alumni->Email }}</td>
                                    <td>{{ $alumni->No_hp }}</td>
                                    <td>
                                        @if($alumni->Status_aksk == 'aktif')
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($alumni->wali)
                                            {{ $alumni->wali->Nama_wali }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.alumni.edit', $alumni->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.alumni.destroy', $alumni->id) }}" method="POST" class="d-inline mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mt-3" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus alumni ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-user-graduate fa-3x text-gray-400 mb-2"></i>
                                            <p class="text-muted">Belum ada data alumni</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $alumnis->links() }}
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