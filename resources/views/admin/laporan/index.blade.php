@extends('layouts.admin')

@section('title', 'Manajemen Laporan')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Data Laporan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>ID Laporan</th>
                            <th>Nama Santri</th>
                            <th>Jenis Laporan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporans as $laporan)
                        <tr>
                            <td>LAP-{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $laporan->santri->Nama_santri ?? '-' }}</td>
                            <td>{{ $laporan->Jenis_laporan }}</td>
                            <td>{{ $laporan->created_at->format('d M Y') }}</td>
                            <td>
                                @if($laporan->status == 'selesai')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif($laporan->status == 'proses')
                                    <span class="badge badge-warning">Proses</span>
                                @else
                                    <span class="badge badge-danger">Belum Diproses</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('laporan.show', $laporan->id) }}" 
                                       class="btn btn-sm btn-info mr-2" 
                                       data-toggle="tooltip" 
                                       title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('laporan.cetak', $laporan->id) }}" 
                                       class="btn btn-sm btn-primary mr-2" 
                                       data-toggle="tooltip" 
                                       title="Cetak">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data laporan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection