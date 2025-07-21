@extends('layouts.dashboard')

@section('title', 'Keuangan Santri')

@section('dashboard-content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-xl shadow-lg p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">Manajemen Keuangan Santri</h1>
        <p class="opacity-90">Pantau dan kelola pembayaran Anda dengan mudah</p>
    </div>

    <!-- Financial Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Tagihan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-blue-500 transform transition hover:scale-[1.02]">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                        <i class="fas fa-file-invoice-dollar text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Tagihan</p>
                        <p class="text-xl font-bold text-red-600">Rp 1.200.000</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sudah Dibayar -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-green-500 transform transition hover:scale-[1.02]">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Sudah Dibayar</p>
                        <p class="text-xl font-bold text-green-600">Rp 900.000</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sisa Tagihan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-red-500 transform transition hover:scale-[1.02]">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="bg-red-100 p-3 rounded-full mr-4">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Sisa Tagihan</p>
                        <p class="text-xl font-bold text-red-700">Rp 300.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Alert -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-xl shadow-md p-4 text-white">
        <div class="flex items-start">
            <div class="flex-shrink-0 pt-1">
                <i class="fas fa-exclamation-circle text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-bold">Peringatan Pembayaran!</h3>
                <p class="text-sm opacity-90">Anda memiliki <strong>1 tagihan</strong> yang belum lunas. Segera lakukan pembayaran sebelum tanggal 10 Juli 2024.</p>
            </div>
            <button class="ml-auto bg-white text-blue-600 px-4 py-2 rounded-md text-sm font-bold hover:bg-blue-50">
                <i class="fas fa-money-bill-wave mr-2"></i>Bayar Sekarang
            </button>
        </div>
    </div>

    <!-- Bill Details -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between bg-gradient-to-r from-blue-50 to-white">
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fas fa-list-alt text-blue-500 mr-2"></i>Detail Tagihan
            </h3>
            <a href="{{ route('keuangan.riwayat') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-history mr-1"></i>Lihat Riwayat Pembayaran
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Jenis Tagihan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Periode
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
                            Jatuh Tempo
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
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                            SPP Pendidikan
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            Juli 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            10 Juli 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                            Rp 300.000
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Belum Lunas
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 font-bold">Bayar</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                            SPP Pendidikan
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            Juni 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            10 Juni 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                            Rp 300.000
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Lunas
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 font-bold">Lihat Bukti</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                            Uang Gedung
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            Tahun 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            10 Januari 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                            Rp 500.000
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Lunas
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 font-bold">Lihat Bukti</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-blue-50 to-white">
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fas fa-credit-card text-blue-500 mr-2"></i>Metode Pembayaran
            </h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all duration-300">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                        <i class="fas fa-university text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Transfer Bank</h4>
                        <p class="text-sm text-gray-600">BNI, BRI, BCA, Mandiri</p>
                    </div>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all duration-300">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                        <i class="fas fa-building text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Bayar di Kantor</h4>
                        <p class="text-sm text-gray-600">Sekretariat Pondok</p>
                    </div>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all duration-300">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                        <i class="fas fa-wallet text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">E-Wallet</h4>
                        <p class="text-sm text-gray-600">Dana, OVO, Gopay</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection