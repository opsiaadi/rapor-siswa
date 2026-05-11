<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuruDataController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\WalikelasController;
use Illuminate\Support\Facades\Route;

// Welcome & Homepage
Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage');
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'index']);

// Admin - Dashboard & Management
Route::prefix('admin')->group(function (){
    Route::get('/dashboard/{id?}/{nama?}', [AdminController::class, 'tampilkan'])->name('admin.dashboard');

    // Mapel
    Route::get('/mapel', [MapelController::class, 'index'])->name('admin.mapel.index');
    Route::get('/mapel/create', [MapelController::class, 'create'])->name('admin.mapel.create');
    Route::post('/mapel', [MapelController::class, 'store'])->name('admin.mapel.store');
    Route::get('/mapel/{id}/edit', [MapelController::class, 'edit'])->name('admin.mapel.edit');
    Route::put('/mapel/{id}', [MapelController::class, 'update'])->name('admin.mapel.update');
    Route::delete('/mapel/{id}', [MapelController::class, 'destroy'])->name('admin.mapel.destroy');

    // Guru
    Route::get('/guru', [GuruDataController::class, 'index'])->name('admin.guru.index');
    Route::get('/guru/create', [GuruDataController::class, 'create'])->name('admin.guru.create');
    Route::post('/guru', [GuruDataController::class, 'store'])->name('admin.guru.store');
    Route::get('/guru/{id}/edit', [GuruDataController::class, 'edit'])->name('admin.guru.edit');
    Route::put('/guru/{id}', [GuruDataController::class, 'update'])->name('admin.guru.update');
    Route::delete('/guru/{id}', [GuruDataController::class, 'destroy'])->name('admin.guru.destroy');

    // Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

    // Siswa 
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
});

// Guru 
Route::prefix('guru')->group(function () {
    Route::get('/nilai', [GuruController::class, 'nilai'])->name('guru.nilai');
    Route::get('/dashboard/{id?}/{namaGuru?}', [GuruController::class, 'nama'])->name('guru.dashboard');
    Route::post('/nilai', [GuruController::class, 'nilai'])->name('guru.nilai.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Walikelas
Route::prefix('walikelas')->group(function () {
    Route::get('/dashboard', [WalikelasController::class, 'dashboard'])->name('walikelas.dashboard');
    Route::get('/finalisasi', [WalikelasController::class, 'finalisasi'])->name('walikelas.finalisasi');
    Route::get('/siswa', [WalikelasController::class, 'siswa'])->name('walikelas.siswa');
    Route::get('/rapor/{siswaId}', [WalikelasController::class, 'rapor'])->name('walikelas.rapor');
    Route::post('/rapor/{siswaId}', [WalikelasController::class, 'simpanKeterangan'])->name('walikelas.rapor.simpan');
    Route::get('/rapor-lihat/{siswaId}', [WalikelasController::class, 'raporLihat'])->name('walikelas.rapor-lihat');
});
