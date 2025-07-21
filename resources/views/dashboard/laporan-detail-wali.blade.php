@extends('layouts.dashboard')

@section('title', 'Detail Laporan')

@section('dashboard-content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Detail Laporan - LAP-{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Santri</th>
                    <td>{{ $laporan->santri->Nama_santri ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Laporan</th>
                    <td>{{ $laporan->Tanggal_lapor ? $laporan->Tanggal_lapor->format('d M Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Laporan</th>
                    <td>{{ $laporan->Jenis_laporan ?? '-' }}</td>
                </tr>
                @if($laporan->psikologiSantri)
                <tr>
                    <th>Tanggal Konseling</th>
                    <td>{{ $laporan->psikologiSantri->Tanggal_konseling ? $laporan->psikologiSantri->Tanggal_konseling->format('d M Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Hasil Psikologi</th>
                    <td>{{ $laporan->psikologiSantri->Hasil_psikologi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>{{ $laporan->psikologiSantri->Catatan ?? '-' }}</td>
                </tr>
                @endif
                @if($laporan->pembayaran)
                <tr>
                    <th>Jenis Pembayaran</th>
                    <td>{{ $laporan->pembayaran->Jenis_pembayaran ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ "Rp. " . number_format($laporan->pembayaran->Jumlah, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Bayar</th>
                    <td>{{ $laporan->pembayaran->Tanggal_bayar ? $laporan->pembayaran->Tanggal_bayar->format('d M Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Status Bayar</th>
                    <td>{{ $laporan->pembayaran->Status_bayar ?? '-' }}</td>
                </tr>
                @endif
                @if($laporan->progressHafalan)
                <tr>
                    <th>Surah</th>
                    <td>{{ $laporan->progressHafalan->Surah ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Ayat Mulai</th>
                    <td>{{ $laporan->progressHafalan->Ayat_mulai ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Ayat Selesai</th>
                    <td>{{ $laporan->progressHafalan->Ayat_selesai ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Setor</th>
                    <td>{{ $laporan->progressHafalan->Tanggal_setor ? $laporan->progressHafalan->Tanggal_setor->format('d M Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Status Setor</th>
                    <td>{{ $laporan->progressHafalan->Status_setor ?? '-' }}</td>
                </tr>
                @endif
                <tr>
                    <th>Status Laporan</th>
                    <td>{{ $laporan->status ?? 'Belum Diproses' }}</td>
                </tr>
            </table>
            <div class="form-footer_detail">
                <div class="buttons">
                    <a class="btn-sm bg-primary" href="{{ route('dashboard.wali.laporan.cetak', $laporan->id) }}">Cetak Laporan</a>
                    <a class="btn-sm bg-transparent" href="{{ route('dashboard.wali.laporan') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection