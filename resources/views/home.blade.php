@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-status-card 
                icon="fas fa-users"
                title="Total Santri"
                value="350"
                color="blue"
                trend="up"
                trendValue="5% dari bulan lalu"
            />
            
            <x-status-card 
                icon="fas fa-graduation-cap"
                title="Santri Lulus"
                value="42"
                color="green"
                trend="up"
                trendValue="10% dari tahun lalu"
            />
            
            <x-status-card 
                icon="fas fa-money-bill-wave"
                title="Pembayaran Tuntas"
                value="92%"
                color="purple"
                description="320 dari 350 santri"
            />
            
            <x-status-card 
                icon="fas fa-book-quran"
                title="Hafalan Baru"
                value="28"
                color="red"
                description="Minggu ini"
            />
        </div>

        <div class="mt-8 bg-white overflow-hidden shadow-xl rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-blue-900 mb-4">Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    <div class="flex items-start border-b pb-3">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                            <i class="fas fa-book text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Ujian Hafalan Juz 30</h4>
                            <p class="text-sm text-gray-500">25 Santri akan menguji hafalan hari ini</p>
                            <p class="text-xs text-gray-400 mt-1"><i class="far fa-clock mr-1"></i> 2 jam yang lalu</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start border-b pb-3">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Pembayaran SPP Bulanan</h4>
                            <p class="text-sm text-gray-500">75% santri telah membayar SPP bulan ini</p>
                            <p class="text-xs text-gray-400 mt-1"><i class="far fa-clock mr-1"></i> 1 hari yang lalu</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-purple-100 p-2 rounded-full mr-3">
                            <i class="fas fa-user-graduate text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Wisuda Tahfidz</h4>
                            <p class="text-sm text-gray-500">Persiapan wisuda 15 santri tahfidz</p>
                            <p class="text-xs text-gray-400 mt-1"><i class="far fa-clock mr-1"></i> 2 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection