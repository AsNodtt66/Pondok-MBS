@extends('layouts.app')

@section('content')
<div class="bg-blue-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/3 flex justify-center">
                <div class="bg-blue-700 rounded-full p-2 border-4 border-white shadow-xl">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->Nama_alumni) }}&background=0f172a&color=fff&size=200" 
                         alt="{{ $alumni->Nama_alumni }}" 
                         class="rounded-full w-48 h-48 object-cover">
                </div>
            </div>
            <div class="md:w-2/3 mt-8 md:mt-0 md:pl-10 text-center md:text-left">
                <h1 class="text-4xl font-extrabold">{{ $alumni->Nama_alumni }}</h1>
                <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-4">
                    <div class="bg-blue-800 px-4 py-2 rounded-full flex items-center">
                        <i class="fas fa-user-graduate mr-2"></i>
                        <span>Alumni</span>
                    </div>
                    @foreach($alumni->lulusans as $lulusan)
                    <div class="bg-blue-800 px-4 py-2 rounded-full flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>Lulus {{ $lulusan->Tahun_lulus }}</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <div class="bg-blue-800 rounded-full p-3 mr-4">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <p class="text-blue-200">Email</p>
                            <p class="text-white font-medium">{{ $alumni->Email }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="bg-blue-800 rounded-full p-3 mr-4">
                            <i class="fas fa-phone-alt text-xl"></i>
                        </div>
                        <div>
                            <p class="text-blue-200">Telepon</p>
                            <p class="text-white font-medium">{{ $alumni->No_hp }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Data Utama -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Profil Alumni</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800">Informasi Pribadi</h3>
                        <div class="mt-4 space-y-3">
                            <div>
                                <p class="text-blue-600">Tanggal Lahir</p>
                                <p class="text-blue-900 font-medium">{{ $alumni->Tanggal_lhr ? \Carbon\Carbon::parse($alumni->Tanggal_lhr)->format('d F Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-blue-600">Jenis Kelamin</p>
                                <p class="text-blue-900 font-medium">{{ $alumni->Jenis_kelamin }}</p>
                            </div>
                            <div>
                                <p class="text-blue-600">Status</p>
                                <p class="text-blue-900 font-medium">{{ ucfirst($alumni->Status_aksk) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800">Data Kelulusan</h3>
                        <div class="mt-4 space-y-4">
                            @forelse ($alumni->lulusans as $lulusan)
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-blue-600">Tahun Lulus</p>
                                        <p class="text-blue-900 font-medium text-lg">{{ $lulusan->Tahun_lulus }}</p>
                                    </div>
                                    <div class="bg-blue-100 text-blue-800 rounded-full p-3">
                                        <i class="fas fa-graduation-cap text-xl"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p class="text-blue-600">Jurusan</p>
                                    <p class="text-blue-900 font-medium">{{ $lulusan->Jurusan ?? '-' }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <p class="text-blue-600 text-center">Belum ada data kelulusan</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Riwayat Pendidikan -->
            <div class="bg-white rounded-xl shadow-md p-6 mt-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Riwayat Pendidikan</h2>
                
                <div class="relative">
                    <!-- Garis timeline -->
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-blue-200"></div>
                    
                    <!-- Item Timeline -->
                    <div class="relative pl-12 pb-8">
                        <div class="absolute left-0 top-0 bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-blue-900">Pondok Pesantren MBS Al-Amin Putri</h3>
                        <p class="text-blue-600">2015 - 2021</p>
                        <p class="mt-2 text-blue-700">Jurusan Tahfidz Al-Qur'an dan Ilmu Agama</p>
                    </div>
                    
                    <!-- Item Timeline -->
                    <div class="relative pl-12 pb-8">
                        <div class="absolute left-0 top-0 bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-university text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-blue-900">Universitas Islam Negeri Malang</h3>
                        <p class="text-blue-600">2021 - Sekarang</p>
                        <p class="mt-2 text-blue-700">S1 Pendidikan Agama Islam</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wali dan Aktivitas -->
        <div>
            <!-- Wali Santri -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Wali Santri</h2>
                
                @if($alumni->wali)
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-full p-3 mr-4">
                        <i class="fas fa-user-friends text-2xl text-blue-700"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-blue-900">{{ $alumni->wali->Nama_wali }}</h3>
                        <p class="text-blue-600">{{ $alumni->wali->Hubungan }}</p>
                    </div>
                </div>
                
                <div class="mt-6 space-y-3">
                    <div>
                        <p class="text-blue-600">Alamat</p>
                        <p class="text-blue-900">{{ $alumni->wali->Alamat_wali }}</p>
                    </div>
                    <div>
                        <p class="text-blue-600">Kontak</p>
                        <p class="text-blue-900">{{ $alumni->wali->Kontak }}</p>
                    </div>
                    <div>
                        <p class="text-blue-600">Email</p>
                        <p class="text-blue-900">{{ $alumni->wali->Email_wali }}</p>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <i class="fas fa-user-slash text-4xl text-blue-300 mb-4"></i>
                    <p class="text-blue-600">Tidak ada data wali</p>
                </div>
                @endif
            </div>
            
            <!-- Aktivitas Terbaru -->
            <div class="bg-white rounded-xl shadow-md p-6 mt-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Aktivitas Terbaru</h2>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-blue-100 text-blue-800 rounded-full p-2 mr-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-blue-900">Menjadi Pengajar Tahfidz</h3>
                            <p class="text-blue-600 text-sm">15 Juni 2023</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 text-blue-800 rounded-full p-2 mr-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-blue-900">Menerbitkan Buku Panduan Tahfidz</h3>
                            <p class="text-blue-600 text-sm">5 Mei 2023</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 text-blue-800 rounded-full p-2 mr-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-blue-900">Memimpin Pesantren Kilat</h3>
                            <p class="text-blue-600 text-sm">22 April 2023</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kontak Alumni -->
            <div class="bg-blue-800 text-white rounded-xl shadow-md p-6 mt-8">
                <h2 class="text-2xl font-bold mb-6">Hubungi Alumni</h2>
                
                <form>
                    <div class="mb-4">
                        <label class="block text-blue-100 mb-2">Nama Anda</label>
                        <input type="text" class="w-full bg-blue-700 border border-blue-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nama lengkap">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-blue-100 mb-2">Email</label>
                        <input type="email" class="w-full bg-blue-700 border border-blue-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="email@example.com">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-blue-100 mb-2">Pesan</label>
                        <textarea rows="4" class="w-full bg-blue-700 border border-blue-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tulis pesan Anda..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-white text-blue-800 font-bold py-3 rounded-lg hover:bg-blue-100 transition duration-300">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection