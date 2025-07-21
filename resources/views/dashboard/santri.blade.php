@extends('layouts.dashboard')

@section('title', 'Dashboard Santri')

@section('dashboard-content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card Informasi Santri -->
    <div class="bg-gradient-to-br from-blue-800 to-indigo-500 rounded-2xl shadow-2xl p-6 transform transition duration-300 hover:scale-105 hover:shadow-3xl border border-indigo-300">
        <div class="flex items-center space-x-5">
            <div class="bg-white p-1 rounded-full shadow-md overflow-hidden border border-gray-200">
                <img src="{{ $santri->foto_profil ? asset('storage/' . $santri->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil" class="w-20 h-20 object-cover rounded-full">
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-extrabold text-white drop-shadow-md">{{ $santri->Nama_santri }}</h3>
                <p class="text-yellow-200 font-semibold">ID: {{ $santri->Santri_id }}</p>
                <p class="text-sm mt-1">
                    <span class="px-3 py-1 rounded-full {{ $santri->Status_aksk == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} shadow-inner">
                        {{ ucfirst($santri->Status_aksk) }}
                    </span>
                </p>
            </div>
        </div>
        <div class="mt-5 grid grid-cols-2 gap-3 text-white">
            <div class="bg-indigo-600/30 p-2 rounded-lg">
                <p class="text-xs text-yellow-100 uppercase tracking-wide">Kelas</p>
                <p class="font-medium text-lg">{{ $santri->Kelas ?? '-' }}</p>
            </div>
            <div class="bg-indigo-600/30 p-2 rounded-lg">
                <p class="text-xs text-yellow-100 uppercase tracking-wide">Kontak</p>
                <p class="font-medium text-lg">{{ $santri->No_hp ?? 'Tidak ada' }}</p>
            </div>
        </div>
    </div>

    <!-- Card Progress Hafalan -->
    <div class="bg-gradient-to-br from-blue-700 to-slate-500 rounded-xl shadow-lg p-6 transform transition duration-300 hover:scale-105">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-white">Progress Hafalan</h3>
            <a href="{{ route('dashboard.akademik') }}" class="text-blue-100 text-sm hover:underline">Lihat Detail</a>
        </div>
        
        @if($latestHafalan)
        <div class="space-y-3 text-white">
            <div>
                <p class="text-sm text-yellow-100">Terakhir Disetor</p>
                <p class="font-medium">Juz {{ optional($latestHafalan)->Juz }} ({{ optional($latestHafalan)->Surah }}:{{ optional($latestHafalan)->Ayat_mulai }}-{{ optional($latestHafalan)->Ayat_selesai }})</p>
                <p class="text-sm text-yellow-100">{{ $formattedTanggalSetor ?? 'Tanggal tidak tersedia' }}</p>
            </div>
            <div>
                <p class="text-sm text-yellow-100">Kualitas</p>
                <span class="px-2 py-1 text-xs rounded-full 
                    {{ optional($latestHafalan)->Kualitas_hafalan == 'Lancar' ? 'bg-green-100 text-green-800' : 
                       (optional($latestHafalan)->Kualitas_hafalan == 'Kurang Lancar' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ optional($latestHafalan)->Kualitas_hafalan ?? 'Tidak ada data' }}
                </span>
            </div>
        </div>
        @else
        <p class="text-yellow-100 text-sm">Belum ada data hafalan</p>
        @endif
        
        <div class="mt-4">
            <div class="flex justify-between text-xs text-yellow-100">
                <span>Total Juz: {{ $totalJuz }} / 30</span>
                <span>{{ round(($totalJuz / 30) * 100) }}%</span>
            </div>
            <div class="w-full bg-gray-300 rounded-full h-2 mt-1">
                <div class="bg-green-500 h-2 rounded-full" style="width: {{ min(100, round(($totalJuz / 30) * 100)) }}%"></div>
            </div>
        </div>
    </div>

    <!-- Card Status Keuangan -->
    <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-xl shadow-lg p-6 transform transition duration-300 hover:scale-105">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-white">Status Keuangan</h3>
            <a href="{{ route('dashboard.keuangan') }}" class="text-blue-100 text-sm hover:underline">Lihat Detail</a>
        </div>
        
        @if($latestPembayaran)
        <div class="space-y-3 text-white">
            <div>
                <p class="text-sm text-yellow-100">Pembayaran Terakhir</p>
                <p class="font-medium">{{ optional($latestPembayaran)->Jenis_pembayaran ?? 'Tidak diketahui' }}</p>
                <p class="text-sm text-yellow-100">{{ $formattedTanggalBayar ?? 'Tanggal tidak tersedia' }}</p>
            </div>
            <div class="flex justify-between">
                <p class="text-sm text-yellow-100">Status</p>
                <span class="px-2 py-1 text-xs rounded-full 
                    {{ optional($latestPembayaran)->Status_bayar == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst(optional($latestPembayaran)->Status_bayar ?? 'Belum dibayar') }}
                </span>
            </div>
        </div>
        @else
        <p class="text-yellow-100 text-sm">Belum ada data pembayaran</p>
        @endif
        
        <div class="mt-4 text-white">
            <div class="flex justify-between text-sm">
                <span class="text-yellow-100">Total Tagihan:</span>
                <span class="font-bold">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm mt-1">
                <span class="text-yellow-100">Sudah Dibayar:</span>
                <span class="font-bold text-green-100">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm mt-1 font-bold border-t border-yellow-300 pt-2">
                <span class="text-yellow-100">Sisa:</span>
                <span class="{{ $sisaTagihan > 0 ? 'text-red-100' : 'text-green-100' }}">
                    Rp {{ number_format(abs($sisaTagihan), 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Hafalan Statistics Section -->
<div class="mt-8 bg-gradient-to-br from-blue-900 to-indigo-700 rounded-2xl shadow-2xl p-6 border border-indigo-400/20 relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute -right-10 -top-10 w-32 h-32 bg-yellow-400/10 rounded-full"></div>
    <div class="absolute -left-5 -bottom-5 w-20 h-20 bg-blue-400/10 rounded-full"></div>
    
    <div class="relative z-10">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white tracking-tight flex items-center">
                <i class="fas fa-quran mr-3 text-yellow-300 animate-pulse"></i>
                <span>Statistik Hafalan 6 Bulan Terakhir</span>
            </h3>
            <div class="text-yellow-100 text-sm bg-indigo-700/50 px-3 py-1 rounded-full backdrop-blur-sm flex items-center">
                <i class="fas fa-star mr-2 text-yellow-300"></i>
                <span>Total: {{ array_sum($chartHafalan['data']) }} Juz</span>
            </div>
        </div>
        
        @if($chartHafalan['hasData'])
        <div class="relative">
            <!-- Horizontal Grid Lines with improved styling -->
            <div class="absolute inset-0 flex flex-col justify-between pt-4 pb-2">
                @for($i = 0; $i <= 5; $i++)
                    <div class="border-t border-indigo-400/30"></div>
                @endfor
            </div>
            
            <!-- Bar Chart Container with better spacing -->
            <div class="flex h-52 items-end space-x-3 pt-4 px-2">
                @foreach($chartHafalan['labels'] as $index => $label)
                    @php
                        $juzCount = $chartHafalan['data'][$index];
                        $maxValue = max(1, max($chartHafalan['data']));
                        $heightPercentage = min(100, ($juzCount / $maxValue) * 100);
                        $colorClass = match(true) {
                            $juzCount >= 10 => 'from-yellow-400 to-yellow-600 shadow-lg shadow-yellow-500/20',
                            $juzCount >= 5 => 'from-green-400 to-green-600 shadow-lg shadow-green-500/20',
                            $juzCount >= 1 => 'from-blue-400 to-blue-600 shadow-lg shadow-blue-500/20',
                            default => 'from-gray-400 to-gray-600'
                        };
                    @endphp
                    
                    <div class="flex-1 flex flex-col items-center group transform hover:-translate-y-1 transition-transform duration-300">
                        <!-- Enhanced Bar with Gradient and Glow -->
                        <div 
                            class="w-full rounded-t-lg bg-gradient-to-b {{ $colorClass }} transition-all duration-500 ease-out relative"
                            style="height: {{ $heightPercentage }}%"
                            x-data="{ tooltip: false }"
                            @mouseover="tooltip = true"
                            @mouseleave="tooltip = false"
                        >
                            <!-- Animated inner bar for visual depth -->
                            <div class="absolute bottom-0 left-0 right-0 h-1/3 bg-white/20 rounded-t-lg"></div>
                            
                            <!-- Enhanced Tooltip -->
                            <div 
                                class="absolute -mt-12 px-3 py-2 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-xl transform -translate-x-1/2 left-1/2 flex items-center"
                                x-show="tooltip"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                            >
                                <i class="fas fa-quran mr-1 text-yellow-300"></i>
                                <span>{{ $juzCount }} Juz pada {{ $label }}</span>
                            </div>
                        </div>
                        
                        <!-- Month Label with animation -->
                        <div class="mt-3 text-xs text-center text-blue-100 font-medium transform group-hover:scale-110 transition-transform">
                            {{ substr($label, 0, 3) }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Enhanced Y-axis Labels -->
            <div class="absolute left-0 -bottom-6 flex justify-between w-full text-xs text-blue-100 px-2">
                @for($i = 0; $i <= 5; $i++)
                    <span>{{ round($i * ($maxValue / 5)) }}</span>
                @endfor
            </div>
        </div>
        
        <!-- Enhanced Legend with icons -->
        <div class="flex justify-center mt-8 space-x-6">
            <div class="flex items-center bg-indigo-800/50 px-3 py-1 rounded-full backdrop-blur-sm">
                <div class="w-3 h-3 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 mr-2"></div>
                <span class="text-xs text-blue-100 font-medium">Tinggi (10+ Juz)</span>
            </div>
            <div class="flex items-center bg-indigo-800/50 px-3 py-1 rounded-full backdrop-blur-sm">
                <div class="w-3 h-3 rounded-full bg-gradient-to-br from-green-400 to-green-500 mr-2"></div>
                <span class="text-xs text-blue-100 font-medium">Sedang (5-9 Juz)</span>
            </div>
            <div class="flex items-center bg-indigo-800/50 px-3 py-1 rounded-full backdrop-blur-sm">
                <div class="w-3 h-3 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 mr-2"></div>
                <span class="text-xs text-blue-100 font-medium">Rendah (1-4 Juz)</span>
            </div>
        </div>
        @else
        <!-- Enhanced Empty State -->
        <div class="text-center py-10 bg-indigo-800/20 rounded-lg backdrop-blur-sm">
            <div class="inline-block bg-gradient-to-br from-indigo-600 to-blue-800 p-4 rounded-full mb-4">
                <i class="fas fa-chart-line text-3xl text-yellow-300"></i>
            </div>
            <h4 class="text-yellow-100 text-lg font-medium mb-2">Belum Ada Data Hafalan</h4>
            <p class="text-blue-100 text-sm max-w-md mx-auto mb-4">Anda belum memiliki catatan hafalan untuk 6 bulan terakhir. Mulai setor hafalan untuk melihat statistik perkembangan Anda!</p>
            <a href="{{ route('dashboard.akademik') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-full transition-colors">
                <i class="fas fa-plus mr-2"></i> Tambah Hafalan
            </a>
            @if(isset($chartHafalan['error']))
                <div class="mt-4 text-red-200 text-xs bg-red-900/30 px-3 py-1 rounded-full inline-block">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $chartHafalan['error'] }}
                </div>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection