@extends('layouts.dashboard')

@section('title', 'Psikologi Santri')

@section('dashboard-content')
<div class="bg-gradient-to-br from-blue-300 to-blue-150 rounded-xl shadow-lg p-6 transform transition duration-300 hover:scale-105">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900 flex items-center">
            <i class="fas fa-heartbeat mr-2 text-blue-500"></i>
            Riwayat Konsultasi Psikologi
        </h3>
        <span class="text-sm text-gray-500">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</span>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-blue-100 to-indigo-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Hasil Psikologi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($psikologi as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->Tanggal_konseling instanceof \Carbon\Carbon ? $item->Tanggal_konseling
                        ->format('d M Y') : ($item->Tanggal_konseling ?? '-') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $item->Hasil_psikologi ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $item->Catatan ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500 bg-gray-50 rounded-b-lg">
                        <i class="fas fa-info-circle text-2xl text-blue-400 mb-2"></i>
                        <p>Belum ada riwayat konsultasi psikologi.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $psikologi->links('pagination::bootstrap-4') }}
    </div>

    @if($psikologi->isNotEmpty())
    <div class="mt-8 p-4 bg-indigo-50 rounded-lg shadow-inner">
        <h4 class="text-md font-semibold text-gray-800 mb-2">Catatan Penting</h4>
        <p class="text-sm text-gray-600">Pastikan untuk rutin melakukan konsultasi psikologi untuk mendukung kesehatan mental Anda. Hubungi pengurus jika perlu bantuan lebih lanjut.</p>
    </div>
    @endif
</div>
@endsection