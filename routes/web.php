<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuruDataController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\EskulController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WalikelasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RaporController; 

Route::get('/rapor', [RaporController::class, 'show']);

Route::post('/rapor', [RaporController::class, 'simpan'])->name('rapor.simpan');

Route::view('/', 'welcome');
Route::view('/homepage', 'homepage');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'index']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard/{id?}/{nama?}', [AdminController::class, 'tampilkan'])->name('dashboard');
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('index');
        Route::put('/', 'update')->name('update');
        Route::delete('foto', 'destroyFoto')->name('remove-foto');
    });

    Route::resource('/mapel', MapelController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/guru', GuruDataController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/kelas', KelasController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/siswa', SiswaController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/eskul', EskulController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications', [NotificationController::class, 'handleAction'])->name('notifications.action');
});

Route::middleware(['auth', 'role:guru,walikelas'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard/{id?}/{namaGuru?}', [GuruController::class, 'nama'])->name('dashboard');
    Route::get('/nilai', [GuruController::class, 'nilai'])->name('nilai');
    Route::post('/nilai', [GuruController::class, 'kirimNilai'])->name('nilai.post');
    Route::get('/rapor', [GuruController::class, 'daftarRapor'])->name('rapor');
    Route::get('/rapor/{siswaId}', [GuruController::class, 'lihatRapor'])->name('rapor.lihat');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications', [NotificationController::class, 'handleAction'])->name('notifications.action');
});

Route::middleware(['auth', 'role:walikelas'])->prefix('walikelas')->name('walikelas.')->group(function () {
    Route::get('/dashboard', [WalikelasController::class, 'dashboard'])->name('dashboard');
    Route::get('/finalisasi', [WalikelasController::class, 'finalisasi'])->name('finalisasi');
    Route::get('/siswa', [WalikelasController::class, 'siswa'])->name('siswa');
    Route::get('/rapor/{siswaId}', [WalikelasController::class, 'rapor'])->name('rapor');
    Route::get('/rapor/{siswaId}/edit', [WalikelasController::class, 'editRapor'])->name('rapor.edit');
    Route::post('/rapor/{siswaId}', [WalikelasController::class, 'simpanKeterangan'])->name('rapor.simpan');
    Route::get('/rapor-lihat/{siswaId}', [WalikelasController::class, 'lihatRapor'])->name('rapor-lihat');
    Route::get('/cetak/{siswaId}', [WalikelasController::class, 'lihatRapor'])->name('cetak.rapor');
});
