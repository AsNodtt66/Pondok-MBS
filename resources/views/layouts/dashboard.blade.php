@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    <div class="flex-1 flex flex-col">
        <!-- Content -->
        <main class="flex-1 p-6 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                @yield('dashboard-content')
            </div>
        </main>
    </div>
</div>
@endsection