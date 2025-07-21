@extends('layouts.dashboard')

@section('title', 'Laporan - Pondok Pesantren MBS')

@section('dashboard-content')
<div class="container mx-auto p-6">
    <!-- Header Laporan -->
    <div class="bg-gradient-to-r from-green-500 to-teal-600 rounded-xl shadow-2xl p-6 mb-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Laporan Pondok Pesantren MBS</h1>
                <p class="text-green-100">Tanggal Generate: {{ $laporan->Tanggal_generate instanceof DateTime ? 
                $laporan->Tanggal_generate->format('d M Y H:i') : (is_string($laporan->Tanggal_generate) ? \Carbon\Carbon::parse($laporan->Tanggal_generate)->format('d M Y H:i') : now()->format('d M Y H:i')) }}</p>
            </div>
            <div class="no-print">
                <a href="{{ route('laporan.download', $laporan->id) }}" class="bg-white text-green-600 px-6 py-3 rounded-lg hover:bg-green-50 transition duration-300 shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Unduh PDF
                </a>
            </div>
        </div>
        <hr class="my-4 border-green-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-green-100"><strong class="text-white">Nama Santri:</strong> {{ $laporan->santri->Nama_santri ?? 'Tidak diketahui' }}</p>
                <p class="text-green-100">Tanggal Laporan: {{ $laporan->Tanggal_lapor instanceof DateTime ? 
                $laporan->Tanggal_lapor->format('d M Y H:i') : (is_string($laporan->Tanggal_lapor) ? \Carbon\Carbon::parse($laporan->Tanggal_generate)->format('d M Y H:i') : now()->format('d M Y H:i')) }}</p>
            </div>
            <div>
                <p class="text-green-100"><strong class="text-white">Jenis Laporan:</strong> {{ $laporan->Jenis_laporan }}</p>
                <p class="text-green-100"><strong class="text-white">Santri ID:</strong> {{ $laporan->psikologiSantri->santri->Santri_id ?? $laporan->progressHafalan->santri->Santri_id ?? $laporan->pembayaran->santri->Santri_id ?? 'Tidak tersedia' }}</p>
            </div>
        </div>
    </div>

    <!-- Tab Interaktif -->
    <div class="bg-white rounded-xl shadow-xl p-6 mb-6">
        <div class="flex border-b border-gray-200">
            <button class="tab-button px-6 py-3 font-semibold text-gray-600 hover:text-green-600 focus:outline-none transition-all duration-300 {{ $activeTab === 'psikologi' ? 'border-b-4 border-green-500 text-green-600' : '' }}" data-tab="psikologi">
                <i class="fas fa-brain mr-2"></i> Psikologi
            </button>
            <button class="tab-button px-6 py-3 font-semibold text-gray-600 hover:text-green-600 focus:outline-none transition-all duration-300 {{ $activeTab === 'hafalan' ? 'border-b-4 border-green-500 text-green-600' : '' }}" data-tab="hafalan">
                <i class="fas fa-book-quran mr-2"></i> Hafalan
            </button>
            <button class="tab-button px-6 py-3 font-semibold text-gray-600 hover:text-green-600 focus:outline-none transition-all duration-300 {{ $activeTab === 'keuangan' ? 'border-b-4 border-green-500 text-green-600' : '' }}" data-tab="keuangan">
                <i class="fas fa-money-bill-wave mr-2"></i> Keuangan
            </button>
        </div>

        <!-- Konten Tab -->
        <div id="psikologi-tab" class="tab-content {{ $activeTab === 'psikologi' ? '' : 'hidden' }} mt-6">
            @if($laporan->psikologiSantri)
                <div class="bg-blue-50 rounded-lg p-4 mb-6 border-l-4 border-blue-500">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                        <i class="fas fa-brain mr-2"></i> Riwayat Psikologi
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-blue-100 text-blue-800">
                                <tr>
                                    <th class="px-6 py-3 text-left">Tanggal Konseling</th>
                                    <th class="px-6 py-3 text-left">Hasil Psikologi</th>
                                    <th class="px-6 py-3 text-left">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-blue-50 transition duration-150">
                                    <td class="px-6 py-4">{{ $laporan->psikologiSantri->Tanggal_konseling instanceof DateTime ? 
                                    $laporan->psikologiSantri->Tanggal_konseling->format('d M Y') : (is_string($laporan->psikologiSantri
                                    ->Tanggal_konseling) ? \Carbon\Carbon::parse($laporan->psikologiSantri->Tanggal_konseling)->format('d M Y') : 'Tidak tersedia') }}</td>
                                    <td class="px-6 py-4">{{ $laporan->psikologiSantri->Hasil_psikologi }}</td>
                                    <td class="px-6 py-4">{{ $laporan->psikologiSantri->Catatan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <i class="fas fa-info-circle text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">Tidak ada data psikologi untuk laporan ini.</p>
                </div>
            @endif
        </div>

        <div id="hafalan-tab" class="tab-content {{ $activeTab === 'hafalan' ? '' : 'hidden' }} mt-6">
            @if($laporan->progressHafalan)
                <div class="bg-green-50 rounded-lg p-4 mb-6 border-l-4 border-green-500">
                    <h2 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                        <i class="fas fa-book-quran mr-2"></i> Progress Hafalan
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-green-100 text-green-800">
                                <tr>
                                    <th class="px-6 py-3 text-left">Surah</th>
                                    <th class="px-6 py-3 text-left">Ayat Mulai</th>
                                    <th class="px-6 py-3 text-left">Ayat Selesai</th>
                                    <th class="px-6 py-3 text-left">Tanggal Setor</th>
                                    <th class="px-6 py-3 text-left">Status Setor</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-green-50 transition duration-150">
                                    <td class="px-6 py-4">{{ $laporan->progressHafalan->Surah }}</td>
                                    <td class="px-6 py-4">{{ $laporan->progressHafalan->Ayat_mulai }}</td>
                                    <td class="px-6 py-4">{{ $laporan->progressHafalan->Ayat_selesai }}</td>
                                    <td class="px-6 py-4">{{ $laporan->progressHafalan->Tanggal_setor instanceof DateTime ? 
                                    $laporan->progressHafalan->Tanggal_setor->format('d M Y') : (is_string($laporan->progressHafalan
                                    ->Tanggal_setor) ? \Carbon\Carbon::parse($laporan->progressHafalan->Tanggal_setor)->format('d M Y') : 'Tidak tersedia') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-sm {{ $laporan->progressHafalan->Status_setor === 'Lulus' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $laporan->progressHafalan->Status_setor }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <i class="fas fa-info-circle text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">Tidak ada data hafalan untuk laporan ini.</p>
                </div>
            @endif
        </div>

        <div id="keuangan-tab" class="tab-content {{ $activeTab === 'keuangan' ? '' : 'hidden' }} mt-6">
            @if($laporan->pembayaran)
                <div class="bg-purple-50 rounded-lg p-4 mb-6 border-l-4 border-purple-500">
                    <h2 class="text-xl font-semibold text-purple-800 mb-4 flex items-center">
                        <i class="fas fa-money-bill-wave mr-2"></i> Status Pembayaran
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-purple-100 text-purple-800">
                                <tr>
                                    <th class="px-6 py-3 text-left">Jenis Pembayaran</th>
                                    <th class="px-6 py-3 text-left">Jumlah</th>
                                    <th class="px-6 py-3 text-left">Tanggal Bayar</th>
                                    <th class="px-6 py-3 text-left">Metode Bayar</th>
                                    <th class="px-6 py-3 text-left">Status Bayar</th>
                                    <th class="px-6 py-3 text-left">Jatuh Tempo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-purple-50 transition duration-150">
                                    <td class="px-6 py-4">{{ $laporan->pembayaran->Jenis_pembayaran }}</td>
                                    <td class="px-6 py-4 font-medium">Rp {{ number_format($laporan->pembayaran->Jumlah, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $laporan->pembayaran->Tanggal_bayar instanceof DateTime ? $laporan->pembayaran->Tanggal_bayar
                                    ->format('d M Y') : (is_string($laporan->pembayaran->Tanggal_bayar) ? \Carbon\Carbon::parse($laporan
                                    ->pembayaran->Tanggal_bayar)->format('d M Y') : 'Tidak tersedia') }}</td>
                                    <td class="px-6 py-4">{{ $laporan->pembayaran->Metode_bayar }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-sm {{ $laporan->pembayaran->Status_bayar === 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($laporan->pembayaran->Status_bayar) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $laporan->pembayaran->Jatuh_tempo instanceof DateTime ? $laporan->pembayaran->Jatuh_tempo->format('d M Y') : (is_string($laporan->pembayaran->Jatuh_tempo) ? \Carbon\Carbon::parse($laporan->pembayaran->Jatuh_tempo)->format('d M Y') : 'Tidak ditentukan') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <i class="fas fa-info-circle text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">Tidak ada data keuangan untuk laporan ini.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @page { margin: 20mm; }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .table-report th, .table-report td { border: 1px solid #e5e7eb; padding: 8px; }
    .table-report th { background-color: #f3f4f6; }
    .print-only { display: block; }
    @media print {
        .no-print { display: none; }
        .print-only { display: block !important; }
        body { font-size: 12pt; }
        .bg-blue-50, .bg-green-50, .bg-purple-50 { background-color: rgba(239, 246, 255, 0.5) !important; }
        .border-blue-500, .border-green-500, .border-purple-500 { border-color: #6b7280 !important; }
        .text-blue-800, .text-green-800, .text-purple-800 { color: #1f2937 !important; }
        .bg-gradient-to-r { background: #fff !important; color: #000 !important; }
        .shadow-xl, .shadow-2xl { box-shadow: none !important; }
    }
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.tab-content');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                buttons.forEach(btn => btn.classList.remove('border-b-4', 'border-green-500', 'text-green-600'));
                contents.forEach(content => content.classList.add('hidden'));

                const tab = button.getAttribute('data-tab');
                button.classList.add('border-b-4', 'border-green-500', 'text-green-600');
                document.getElementById(`${tab}-tab`).classList.remove('hidden');
                
                // Smooth scroll to the tab content
                document.getElementById(`${tab}-tab`).scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Initialize active tab
        document.querySelector('[data-tab="' + '{{ $activeTab }}' + '"]').click();
    });
</script>
@endsection