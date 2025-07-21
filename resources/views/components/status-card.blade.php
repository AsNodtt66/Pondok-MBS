@props([
    'icon' => 'fas fa-info-circle',
    'title' => 'Status',
    'value' => '0',
    'color' => 'blue',
    'trend' => 'up',
    'trendValue' => '0%',
    'description' => ''
])

@php
    $colors = [
        'blue' => 'bg-blue-100 text-blue-800',
        'green' => 'bg-green-100 text-green-800',
        'red' => 'bg-red-100 text-red-800',
        'yellow' => 'bg-yellow-100 text-yellow-800',
        'purple' => 'bg-purple-100 text-purple-800'
    ];
    
    $trendColors = [
        'up' => 'text-green-600',
        'down' => 'text-red-600'
    ];
@endphp

<div class="bg-white rounded-xl shadow-md p-5 transition duration-300 hover:shadow-lg">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-sm font-medium text-gray-500">{{ $title }}</h3>
            <p class="mt-2 text-3xl font-bold text-blue-900">{{ $value }}</p>
            
            @if($trendValue)
            <p class="mt-1 flex items-center {{ $trendColors[$trend] }}">
                @if($trend === 'up')
                <i class="fas fa-arrow-up mr-1"></i>
                @else
                <i class="fas fa-arrow-down mr-1"></i>
                @endif
                <span>{{ $trendValue }}</span>
            </p>
            @endif
            
            @if($description)
            <p class="mt-1 text-sm text-gray-600">{{ $description }}</p>
            @endif
        </div>
        <div class="bg-{{ $color }}-100 p-3 rounded-full">
            <i class="{{ $icon }} text-{{ $color }}-600 text-2xl"></i>
        </div>
    </div>
</div>