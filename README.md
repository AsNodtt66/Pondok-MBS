
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Pondok MBS - Sistem Informasi Berbasis Web Pondok Pesantren MBS Al-Amin
Deskripsi Proyek
Pondok MBS adalah sistem informasi berbasis web yang dikembangkan untuk Pondok Pesantren MBS Al-Amin Putri, Malang, Jawa Timur. Sistem ini bertujuan mengotomatisasi pengelolaan data santri, progres hafalan, evaluasi psikologi, pembayaran SPP, dan data alumni, menggantikan metode manual berbasis buku catatan atau spreadsheet. Proyek ini dikembangkan oleh tim dari Program Studi Sistem Informasi, Fakultas Sains dan Teknologi, Universitas Islam Raden Rahmat, dengan bimbingan Dosen Pengampu Novia Ratnasari M.Pd. Sistem ini dibangun menggunakan framework Laravel 11 untuk meningkatkan efisiensi operasional dan transparansi pengelolaan pesantren.

## Fitur Utama
- Autentikasi Pengguna: Kontrol akses berbasis peran (admin, pengurus, santri, wali santri).
- Manajemen Santri: CRUD untuk biodata santri termasuk profil dan foto.
- Progres Hafalan: Pencatatan dan pelacakan juz, surah, ayat, serta evaluasi.
- Evaluasi Psikologi: Rekam perkembangan akhlak dan perilaku santri.
- Manajemen Pembayaran: Kelola SPP, biaya pendaftaran, dan status pembayaran.
- Data Alumni: Arsip data santri lulus dengan tahun kelulusan dan kontak.
- Laporan Otomatis: Generate laporan PDF untuk akademik, keuangan, dan alumni.
- Notifikasi: Pengingat pembayaran dan hafalan secara real-time.
- Antarmuka Responsif: Dukungan untuk mobile dan desktop dengan desain berbasis Tailwind CSS.

## Metodologi Pengembangan
Proyek ini menggunakan metodologi Agile dengan pendekatan iteratif untuk memastikan fleksibilitas dan kesesuaian dengan kebutuhan pengguna. Tahapan meliputi:
- Analisis kebutuhan melalui wawancara dengan pengelola pesantren.
- Perancangan UI/UX dengan wireframe dan mockup menggunakan Balsamiq dan Figma.
- Pengembangan bertahap dengan pengujian berkala.
- Kolaborasi intensif dengan pengguna untuk validasi fitur.

## Teknologi yang Digunakan
- Front-End: HTML, CSS (Tailwind CSS), JavaScript (AJAX).
- Back-End: PHP dengan Laravel 11.
- Database: MySQL (dikelola via phpMyAdmin).
- Tools: Laragon (server lokal), Visual Studio Code (editor), Chrome/Firefox (pengujian).
- Library: Barryvdh\DomPDF (laporan PDF), Carbon (manipulasi tanggal).

## Struktur Direktori
- app/Http/Controllers/: Kontroller untuk admin, santri, hafalan, psikologi, pembayaran, laporan, dan profil.
- routes/web.php: Definisi rute web.
- app/Models/: Model untuk entitas seperti Santri, Pembayaran, dll.
- resources/views/: Template Blade untuk dashboard, admin, alumni, dll.
- database/migrations/: Skema dan migrasi database.

## Instalasi
1. Clone repositori: git clone <repository-url>.
2. Masuk ke direktori proyek: cd pondok-mbs.
3. Instal dependensi: composer install.
4. Salin .env.example menjadi .env dan atur konfigurasi database.
5. Jalankan migrasi: php artisan migrate.
6. Mulai server lokal: php artisan serve.

## Kontributor
Ramadhony Firmansyahputra (23572011001) - Programming Developer.

## Lisensi
Proyek ini dilisensikan di bawah MIT License.

## Pengembangan Selanjutnya
1. Pelatihan lanjutan untuk pengguna.
2. Fitur analitik untuk visualisasi tren hafalan.
3. Integrasi API untuk aplikasi mobile.
4. Backup otomatis database dan pemeliharaan rutin.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# Pondok-MBS
Project Tugas Kuliah Web Pondok MBS
>>>>>>> fb299ede8f96a97556fae5abfde6c492727d198d
