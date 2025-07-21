@extends('layouts.dashboard')

@section('title', 'Akademik Santri')

@section('dashboard-content')
<div class="bg-gradient-to-br from-blue-300 to-blue-700 rounded-xl shadow-lg p-6 transform transition duration-300 hover:scale-105">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-white flex items-center">
            <i class="fas fa-book-quran mr-2 text-blue-600"></i>
            Catatan Hafalan Terbaru
        </h2>
        <span class="text-sm text-yellow-100">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</span>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-blue-800 to-blue-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Juz</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Surah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Ayat Mulai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Ayat Selesai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kualitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($progressHafalans as $item)
                <tr class="hover:bg-blue-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->Tanggal_setor instanceof \Carbon\Carbon ? $item->Tanggal_setor->format('d M Y') : (is_string($item->Tanggal_setor) ? \Carbon\Carbon::parse($item->Tanggal_setor)->format('d M Y') : '-') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Juz {{ $item->Juz }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->Surah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->Ayat_mulai }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->Ayat_selesai }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $item->Kualitas_hafalan == 'Lancar' ? 'bg-green-100 text-green-800' : 
                               ($item->Kualitas_hafalan == 'Kurang Lancar' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $item->Kualitas_hafalan ?? 'Tidak ada' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->Catatan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500 bg-blue-50 rounded-b-lg">
                        <i class="fas fa-info-circle text-2xl text-yellow-400 mb-2"></i>
                        <p>Belum ada data hafalan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $progressHafalans->links('pagination::bootstrap-4') }}
    </div>

    <div class="mt-8 p-4 bg-blue-800 bg-opacity-50 rounded-lg shadow-inner">
        <h3 class="text-lg font-semibold text-white mb-2">Statistik Hafalan</h3>
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-blue-400 p-4 rounded-lg text-center text-white">
                <p class="text-2xl font-bold">{{ $totalJuz }}</p>
                <p class="text-black-500">Total Juz</p>
            </div>
            <div class="bg-blue-400 p-4 rounded-lg text-center text-white">
                <p class="text-2xl font-bold">{{ round($persentaseLancar) }}%</p>
                <p class="text-black-500">Kelancaran</p>
            </div>
            <div class="bg-blue-400 p-4 rounded-lg text-center text-white">
                <p class="text-2xl font-bold">{{ round($rataJuzPerBulan, 2) }}</p>
                <p class="text-yellow-200">Rata Juz/Bulan</p>
            </div>
        </div>
    </div>
</div>
@endsection