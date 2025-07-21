@extends('layouts.dashboard')

@section('title', 'Riwayat Keuangan')

@section('dashboard-content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-xl shadow-lg p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">Riwayat Pembayaran</h1>
        <p class="opacity-90">Catatan lengkap semua transaksi keuangan untuk {{ $santri->Nama_santri }}</p>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white rounded-xl shadow-md p-4 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-file-invoice-dollar text-blue-500 mr-2"></i>
                Daftar Transaksi
            </h3>
        </div>
        <div class="flex space-x-3">
            <button onclick="window.print()" class="bg-blue-100 text-blue-800 px-4 py-2 rounded-md text-sm font-bold hover:bg-blue-200 transition-colors">
                <i class="fas fa-print mr-2"></i>Cetak
            </button>
            <a href="{{ route('dashboard.wali.keuangan.export') }}" class="bg-blue-100 text-blue-800 px-4 py-2 rounded-md text-sm font-bold hover:bg-blue-200 transition-colors">
                <i class="fas fa-file-export mr-2"></i>Export
            </a>
        </div>
    </div>

    <!-- Transaction History -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Tanggal Bayar
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Jenis Pembayaran
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pembayarans as $pembayaran)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $pembayaran->Tanggal_bayar ? $pembayaran->Tanggal_bayar->format('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $pembayaran->Jenis_pembayaran ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            Rp {{ number_format($pembayaran->Jumlah, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $pembayaran->Status_bayar == 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $pembayaran->Status_bayar ?? 'Belum Lunas' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($pembayaran->Status_bayar == 'Lunas')
                            <a href="{{ route('laporan.download', ['id' => $pembayaran->id]) }}" class="text-blue-600 hover:text-blue-900 font-bold">
                                <i class="fas fa-download mr-1"></i>Unduh
                            </a>
                            @else
                            <span class="text-gray-400">Tidak tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-600">
                            Tidak ada data pembayaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200 bg-blue-50">
            {{ $pembayarans->links() }}
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-blue-500 transform transition hover:scale-[1.02]">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                        <i class="fas fa-money-bill-wave text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Pembayaran</p>
                        <p class="text-xl font-bold">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-green-500 transform transition hover:scale-[1.02]">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <i class="fas fa-calendar-check text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Transaksi Tahun Ini</p>
                        <p class="text-xl font-bold">{{ $transaksiTahunIni }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-yellow-500 transform transition hover:scale-[1.02]">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="bg-yellow-100 p-3 rounded-full mr-4">
                        <i class="fas fa-percentage text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Pembayaran Tepat Waktu</p>
                        <p class="text-xl font-bold">{{ round($persentaseTepatWaktu, 1) }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print, #sidebar, header {
            display: none !important;
        }
        .bg-white {
            box-shadow: none;
            border: none;
        }
        .bg-blue-50 {
            background-color: #fff !important;
        }
        .hover\:bg-blue-50:hover {
            background-color: #fff !important;
        }
    }
</style>
@endsection