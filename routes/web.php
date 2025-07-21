<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\HafalanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsikologiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Pages
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Grouped Routes with Auth Middleware
Route::middleware(['auth:Pengguna'])->prefix('dashboard')->group(function () {
    // Admin Dashboard & Management Routes
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->middleware('role:admin')
        ->name('dashboard.admin.dashboard');

    // Santri Management (Admin)
    Route::prefix('admin/santri')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'indexSantri'])->name('admin.santri.index');
        Route::get('/create', [AdminController::class, 'createSantri'])->name('admin.santri.create');
        Route::post('/', [AdminController::class, 'storeSantri'])->name('admin.santri.store');
        Route::get('/{id}/edit', [AdminController::class, 'editSantri'])->name('admin.santri.edit');
        Route::put('/{id}', [AdminController::class, 'updateSantri'])->name('admin.santri.update');
        Route::delete('/{id}', [AdminController::class, 'destroySantri'])->name('admin.santri.destroy');

        // Academic Management for Santri (Admin View)
        Route::get('/{santri}/akademik', [AdminController::class, 'akademikSantri'])
            ->name('admin.santri.akademik');
        // JSON data endpoint for AJAX refresh
        Route::get('/admin/santri/{santri}/akademik/data-json', [AdminController::class, 'getAkademikDataJson'])
            ->name('admin.santri.akademik.data-json');
    });

    // Hafalan CRUD Routes (Admin)
    Route::prefix('hafalan')->middleware('role:admin')->group(function () {
        Route::post('/', [HafalanController::class, 'store'])->name('hafalan.store');
        Route::put('/{id}', [HafalanController::class, 'update'])->name('hafalan.update');
        Route::delete('/{id}', [HafalanController::class, 'destroy'])->name('hafalan.destroy');
    });

    // Psikologi CRUD Routes (Admin)
    Route::prefix('psikologi')->middleware('role:admin')->group(function () {
        Route::post('/', [PsikologiController::class, 'store'])->name('admin.psikologi.store');
        Route::put('/{id}', [PsikologiController::class, 'update'])->name('admin.psikologi.update');
        Route::delete('/{id}', [PsikologiController::class, 'destroy'])->name('admin.psikologi.destroy');
    });

    // Pembayaran CRUD Routes (Admin)
    Route::prefix('pembayaran')->middleware('role:admin')->group(function () {
        Route::post('/', [PembayaranController::class, 'store'])->name('admin.pembayaran.store');
        Route::put('/{id}', [PembayaranController::class, 'update'])->name('admin.pembayaran.update');
        Route::delete('/{id}', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');
    });

    // Wali Management (Admin)
    Route::prefix('admin/wali')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'indexWali'])->name('admin.wali.index');
        Route::get('/create', [AdminController::class, 'createWali'])->name('admin.wali.create');
        Route::post('/', [AdminController::class, 'storeWali'])->name('admin.wali.store');
        Route::get('/{id}/edit', [AdminController::class, 'editWali'])->name('admin.wali.edit');
        Route::put('/{id}', [AdminController::class, 'updateWali'])->name('admin.wali.update');
        Route::delete('/{id}', [AdminController::class, 'destroyWali'])->name('admin.wali.destroy');
    });

    // Pengguna Management (Admin)
    Route::prefix('admin/pengguna')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'indexPengguna'])->name('admin.pengguna.index');
        Route::get('/create', [AdminController::class, 'createPengguna'])->name('admin.pengguna.create');
        Route::post('/', [AdminController::class, 'storePengguna'])->name('admin.pengguna.store');
        Route::get('/{id}/edit', [AdminController::class, 'editPengguna'])->name('admin.pengguna.edit');
        Route::put('/{id}', [AdminController::class, 'updatePengguna'])->name('admin.pengguna.update');
        Route::delete('/{id}', [AdminController::class, 'destroyPengguna'])->name('admin.pengguna.destroy');
    });

    // Alumni Management (Admin)
    Route::prefix('admin/alumni')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'indexAlumni'])->name('admin.alumni.index');
        Route::get('/create', [AdminController::class, 'createAlumni'])->name('admin.alumni.create');
        Route::post('/', [AdminController::class, 'storeAlumni'])->name('admin.alumni.store');
        Route::get('/{id}/edit', [AdminController::class, 'editAlumni'])->name('admin.alumni.edit');
        Route::put('/{id}', [AdminController::class, 'updateAlumni'])->name('admin.alumni.update');
        Route::delete('/{id}', [AdminController::class, 'destroyAlumni'])->name('admin.alumni.destroy');
    });

    // Laporan Routes (Admin)
    Route::prefix('admin/laporan')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'indexLaporan'])->name('admin.laporan.index');
        Route::get('/{id}/detail', [AdminController::class, 'showLaporan'])->name('laporan.show');
        Route::get('/{id}/cetak', [AdminController::class, 'cetakLaporan'])->name('laporan.cetak');
    });

    // Pengurus Dashboard
    Route::get('/pengurus', function () {
        return view('dashboard.pengurus');
    })->middleware('role:pengurus')->name('dashboard.pengurus');

    // Santri Dashboard
    Route::prefix('santri')->middleware('role:santri')->group(function () {
        Route::get('/', [SantriController::class, 'dashboard'])->name('dashboard.santri');
        Route::get('/akademik', [SantriController::class, 'akademik'])->name('dashboard.akademik');
        Route::get('/keuangan', [SantriController::class, 'keuangan'])->name('dashboard.keuangan');
        Route::get('/keuangan/riwayat', [SantriController::class, 'riwayatKeuangan'])->name('keuangan.riwayat');
        Route::get('/santri/keuangan/export', [SantriController::class, 'exportKeuangan'])->name('keuangan.export');
        Route::get('/psikologi', [SantriController::class, 'psikologi'])->name('dashboard.psikologi');
        Route::get('/laporan', [SantriController::class, 'laporan'])->name('dashboard.laporan');
        Route::get('/profil', [ProfileController::class, 'showProfile'])->name('dashboard.profil');
        Route::get('/data', [ProfileController::class, 'getProfileDataJson'])->name('user.profile.data');
        Route::post('/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('user.profile.update');
        Route::post('/delete-picture', [ProfileController::class, 'deleteProfilePicture'])->name('user.profile.delete');
    });

    // Rute Wali
    Route::get('/wali', [WaliController::class, 'dashboard'])->name('dashboard.wali');
    Route::get('/wali/akademik', [WaliController::class, 'akademik'])->name('dashboard.wali.akademik');
    Route::get('/wali/keuangan', [WaliController::class, 'keuangan'])->name('dashboard.wali.keuangan');
    Route::get('/wali/keuangan/riwayat', [WaliController::class, 'riwayatKeuangan'])->name('dashboard.wali.keuangan.riwayat');
    Route::get('/wali/keuangan/export', [WaliController::class, 'exportKeuangan'])->name('dashboard.wali.keuangan.export');
    Route::get('/wali/psikologi', [WaliController::class, 'psikologi'])->name('dashboard.wali.psikologi');
    Route::get('/wali/profil', [WaliController::class, 'profil'])->name('dashboard.profil');
    Route::post('/wali/profil', [WaliController::class, 'updateProfil'])->name('dashboard.profil.update');
    Route::get('/wali/laporan', [WaliController::class, 'laporan'])->name('dashboard.wali.laporan');
    Route::get('/wali/laporan/{id}', [WaliController::class, 'showLaporan'])->name('dashboard.wali.laporan.show');
    Route::get('/wali/laporan/cetak/{id}', [WaliController::class, 'cetakLaporan'])->name('dashboard.wali.laporan.cetak');

    // Other Authenticated Routes
    Route::middleware(['auth:Pengguna'])->group(function () {
        Route::get('/laporan/{id}/download', [LaporanController::class, 'downloadPdf'])
            ->name('laporan.download');
    });
});