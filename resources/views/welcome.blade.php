@extends('layouts.app')

@section('content')

<!-- Bagian hero -->
<div class="relative bg-blue-900 transform transition duration-200 hover:scale-105">
    <div class="absolute inset-0 rounded-xl shadow-lg">
        <img class="w-full h-full object-cover" src="{{ asset('images/masjid.jpg') }}" alt="Pondok Pesantren">
        <div class="absolute inset-0 bg-blue-900 opacity-60 mix-blend-multiply " aria-hidden="true"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            Pondok Pesantren MBS Al-Amin Putri
        </h1>
        <p class="mt-6 text-xl text-blue-100 max-w-3xl">
            Membentuk generasi Qur'ani yang berakhlak mulia dan berprestasi
        </p>
        <div class="mt-10 flex space-x-4">
            @php
                $user = Auth::guard('Pengguna')->user();
                $loginText = 'Masuk';
                $loginRoute = route('login');
                $icon = 'fas fa-sign-in-alt';

                if ($user && $user->role) {
                    $loginText = 'Masuk';
                    $icon = 'fas fa-sign-in-alt';
                    $loginRoute = match($user->role_id) {
                        \App\Models\Role::ADMIN => route('dashboard.admin.dashboard'),
                        \App\Models\Role::PENGURUS => route('dashboard.pengurus'),
                        \App\Models\Role::SANTRI => route('dashboard.santri'),
                        \App\Models\Role::WALI => route('dashboard.wali'),
                        default => route('login') . '?error=invalid_role'
                    };
                }
            @endphp
            <a href="{{ $loginRoute }}" class="bg-white text-blue-800 px-6 py-3 rounded-md font-medium hover:bg-blue-50">
                <i class="{{ $icon }} mr-2"></i>{{ $loginText }}
            </a>
            <a href="#tentang" class="bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700">
                <i class="fas fa-info-circle mr-2"></i>Tentang Kami
            </a>
            <a href="{{ route('alumni.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700">
                <i class="fas fa-user-graduate mr-2"></i>Alumni
            </a>
        </div>
    </div>
</div>

<section id="tentang" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Pondok Pesantren</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                MBS Al-Amin Putri
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                Pesantren modern yang mengintegrasikan pendidikan agama dan umum dengan sistem terpadu
            </p>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <i class="fas fa-book-quran text-blue-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Program Tahfidz</h3>
                            <p class="mt-2 text-gray-600">Program menghafal Al-Qur'an dengan metode terbaik</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Pendidikan Formal</h3>
                            <p class="mt-2 text-gray-600">Kurikulum terpadu antara Diniyah dan Madrasah</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <i class="fas fa-hands-helping text-blue-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Pengembangan Diri</h3>
                            <p class="mt-2 text-gray-600">Program pembentukan karakter dan kepemimpinan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Fasilitas</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Fasilitas Unggulan
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white overflow-hidden shadow rounded-xl transition duration-300 hover:shadow-xl">
                <div class="px-4 py-5 sm:p-6">
                    <div class="text-center">
                        <div class="mx-auto bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Perpustakaan</h3>
                        <p class="mt-2 text-gray-600">Koleksi buku lengkap untuk referensi belajar</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow rounded-xl transition duration-300 hover:shadow-xl">
                <div class="px-4 py-5 sm:p-6">
                    <div class="text-center">
                        <div class="mx-auto bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                            <i class="fas fa-laptop text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Lab Komputer</h3>
                        <p class="mt-2 text-gray-600">Fasilitas IT modern untuk pembelajaran</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow rounded-xl transition duration-300 hover:shadow-xl">
                <div class="px-4 py-5 sm:p-6">
                    <div class="text-center">
                        <div class="mx-auto bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                            <i class="fas fa-dumbbell text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Lapangan Olahraga</h3>
                        <p class="mt-2 text-gray-600">Fasilitas olahraga lengkap untuk kesehatan</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow rounded-xl transition duration-300 hover:shadow-xl">
                <div class="px-4 py-5 sm:p-6">
                    <div class="text-center">
                        <div class="mx-auto bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                            <i class="fas fa-utensils text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Kantin Sehat</h3>
                        <p class="mt-2 text-gray-600">Makanan bergizi dengan menu seimbang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
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
</section>

<section class="py-16 bg-blue-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold sm:text-4xl">
            <span class="block">Bergabunglah Dengan Kami</span>
        </h2>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-blue-100">
            Membentuk generasi Qur'ani yang berakhlak mulia dan berprestasi
        </p>
        <div class="mt-8 flex justify-center">
            <div class="inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-800 bg-white hover:bg-blue-50">
                    <i class="fas fa-file-alt mr-2"></i> Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<footer class="bg-blue-900 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Kontak</h3>
                <p class="flex items-start mt-2">
                    <i class="fas fa-map-marker-alt mr-3 mt-1"></i>
                    Jl. Adi Santoso Kepanjen Kab. Malang 
                </p>
                <p class="flex items-center mt-2">
                    <i class="fas fa-phone-alt mr-3"></i>
                    Phone: 0857 0663 0322
                </p>
                <p class="flex items-center mt-2">
                    <i class="fas fa-envelope mr-3"></i>
                    Email: mbsalaminkepanjen@gmail.com
                </p>
            </div>
            
            <div>
                <h3 class="text-lg font-bold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-300 transition duration-200"><i class="fas fa-home mr-2"></i> Beranda</a></li>
                    <li><a href="#tentang" class="hover:text-blue-300 transition duration-200"><i class="fas fa-info-circle mr-2"></i> Tentang Kami</a></li>
                    <li><a href="{{ route('alumni.index') }}" class="hover:text-blue-300 transition duration-200"><i class="fas fa-user-graduate mr-2"></i> Alumni</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-blue-300 transition duration-200"><i class="fas fa-sign-in-alt mr-2"></i> Login</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-bold mb-4">Media Sosial</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-blue-300 transition duration-200">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-300 transition duration-200">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-300 transition duration-200">
                        <i class="fab fa-youtube text-2xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-300 transition duration-200">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                </div>
                <div class="mt-6">
                    <img src="{{ asset('images/masjid-bg.jpg') }}" class="h-24 mx-auto md:mx-0">
                </div>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-blue-800 text-center">
            <p>&copy; {{ date('Y') }} Pondok Pesantren MBS Al-Amin Putri. All rights reserved.</p>
        </div>
    </div>
</footer>
@endsection