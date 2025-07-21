@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-blue-600 to-blue-400 text-white rounded-xl shadow-lg py-16 transform transition duration-300 hover:scale-105">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
            Alumni Pondok Pesantren MBS
        </h1>
        <p class="mt-6 text-xl max-w-3xl mx-auto">
            Generasi Qur'ani yang telah mengabdikan ilmu di masyarakat
        </p>
        <div class="mt-16 flex space-x-4">
            <a href="{{ route('home') }}" class="bg-white text-blue-800 px-6 py-3 rounded-md font-medium hover:bg-blue-50">
                <i class="fas fa-arrow-left mr-1 "></i>Kembali 
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Statistik -->
        <div class="bg-blue-800 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="bg-blue-700 rounded-full p-4 mr-4">
                    <i class="fas fa-user-graduate text-3xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold">1,200+</p>
                    <p class="text-blue-200">Alumni Terdaftar</p>
                </div>
            </div>
        </div>
        
        <div class="bg-blue-800 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="bg-blue-700 rounded-full p-4 mr-4">
                    <i class="fas fa-book-open text-3xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold">95%</p>
                    <p class="text-blue-200">Melanjutkan Kuliah</p>
                </div>
            </div>
        </div>
        
        <div class="bg-blue-800 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="bg-blue-700 rounded-full p-4 mr-4">
                    <i class="fas fa-hands-helping text-3xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold">300+</p>
                    <p class="text-blue-200">Menjadi Pengajar</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filter dan Pencarian -->
    <div class="mt-12 bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="text-2xl font-bold text-blue-900 mb-4 md:mb-0">Daftar Alumni</h2>
            <div class="flex space-x-4">
                <div class="relative">
                    <select class="appearance-none bg-blue-50 border border-blue-300 text-blue-900 rounded-lg pl-10 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Semua Tahun</option>
                        <option>2023</option>
                        <option>2022</option>
                        <option>2021</option>
                    </select>
                    <i class="fas fa-calendar absolute left-3 top-3 text-blue-500"></i>
                </div>
                
                <div class="relative">
                    <input type="text" placeholder="Cari alumni..." class="bg-blue-50 border border-blue-300 text-blue-900 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-blue-500"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Daftar Alumni -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($alumnis as $alumni)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-blue-100 transform transition duration-500 hover:scale-105">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-blue-900">{{ $alumni->Nama_alumni }}</h3>
                        <p class="text-blue-600 mt-1">
                            <i class="fas fa-envelope mr-2"></i>{{ $alumni->Email }}
                        </p>
                        <p class="text-blue-600 mt-1">
                            <i class="fas fa-phone mr-2"></i>{{ $alumni->No_hp }}
                        </p>
                    </div>
                    <div class="bg-blue-100 text-blue-800 rounded-full p-3">
                        <i class="fas fa-user-graduate text-2xl"></i>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-blue-100">
                    <h4 class="text-lg font-semibold text-blue-900">Data Kelulusan</h4>
                    @if ($alumni->lulusans->count() > 0)
                        @foreach ($alumni->lulusans as $lulusan)
                        <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                            <p class="text-blue-800">
                                <span class="font-bold">Tahun Lulus:</span> {{ $lulusan->Tahun_lulus }}
                            </p>
                            <p class="text-blue-800 mt-1">
                                <span class="font-bold">Jurusan:</span> {{ $lulusan->Jurusan ?? '-' }}
                            </p>
                        </div>
                        @endforeach
                    @else
                        <p class="text-blue-500 italic mt-2">Belum ada data kelulusan</p>
                    @endif
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('alumni.show', $alumni->id) }}" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-lg text-center block transition duration-300">
                        Lihat Profil Lengkap <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <div class="bg-blue-50 rounded-lg p-8">
                <i class="fas fa-user-graduate text-5xl text-blue-400 mb-4"></i>
                <h3 class="text-2xl font-bold text-blue-900">Data Alumni Belum Tersedia</h3>
                <p class="text-blue-600 mt-2">Belum ada data alumni yang tercatat</p>
            </div>
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if ($alumnis->hasPages())
    <div class="mt-12">
        {{ $alumnis->links() }}
    </div>
    @endif
</div>

<!-- Success Stories Section -->
<div class="bg-blue-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-blue-900 sm:text-4xl">
                Kisah Sukses Alumni
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-blue-700">
                Inspirasi dari para alumni yang telah berhasil mengaplikasikan ilmu pesantren
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Testimonial 1 -->
            <div class="bg-white overflow-hidden shadow rounded-xl">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-blue-900">Aisyah Rahmah</h4>
                            <p class="text-blue-600">Lulusan 2019 - Tahfidz</p>
                        </div>
                    </div>
                    <blockquote class="mt-4">
                        <p class="text-blue-700 italic">"Pendidikan di MBS tidak hanya mengajarkan ilmu agama, tapi juga membentuk karakter dan kepribadian yang kuat. Saya sekarang melanjutkan studi di UIN Malang jurusan Pendidikan Agama Islam."</p>
                    </blockquote>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-white overflow-hidden shadow rounded-xl">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-blue-900">Muhammad Fauzi</h4>
                            <p class="text-blue-600">Lulusan 2020 - Ilmu Al-Qur'an</p>
                        </div>
                    </div>
                    <blockquote class="mt-4">
                        <p class="text-blue-700 italic">"Sistem pendidikan di MBS sangat membantu saya dalam memahami Al-Qur'an secara mendalam. Sekarang saya menjadi pengajar tahfidz di salah satu madrasah di Surabaya."</p>
                    </blockquote>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="bg-white overflow-hidden shadow rounded-xl">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-blue-900">Fatimah Zahra</h4>
                            <p class="text-blue-600">Lulusan 2021 - Pendidikan Agama</p>
                        </div>
                    </div>
                    <blockquote class="mt-4">
                        <p class="text-blue-700 italic">"Saya sangat berterima kasih kepada para ustadzah di MBS yang telah membimbing saya. Sekarang saya sedang melanjutkan studi S2 di Universitas Al-Azhar Kairo, Mesir."</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection