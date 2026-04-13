<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuruDataController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WalikelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage');
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

// Admin - Dashboard
Route::get('/admin/dashboard/{id?}/{nama?}', [AdminController::class, 'tampilkan'])->name('admin.dashboard');

// Admin - CRUD Mapel
Route::get('/admin/mapel', [MapelController::class, 'index'])->name('admin.mapel.index');
Route::get('/admin/mapel/create', [MapelController::class, 'create'])->name('admin.mapel.create');
Route::post('/admin/mapel', [MapelController::class, 'store'])->name('admin.mapel.store');
Route::get('/admin/mapel/{id}/edit', [MapelController::class, 'edit'])->name('admin.mapel.edit');
Route::put('/admin/mapel/{id}', [MapelController::class, 'update'])->name('admin.mapel.update');
Route::delete('/admin/mapel/{id}', [MapelController::class, 'destroy'])->name('admin.mapel.destroy');

// Admin - CRUD Guru
Route::get('/admin/guru', [GuruDataController::class, 'index'])->name('admin.guru.index');
Route::get('/admin/guru/create', [GuruDataController::class, 'create'])->name('admin.guru.create');
Route::post('/admin/guru', [GuruDataController::class, 'store'])->name('admin.guru.store');
Route::get('/admin/guru/{id}/edit', [GuruDataController::class, 'edit'])->name('admin.guru.edit');
Route::put('/admin/guru/{id}', [GuruDataController::class, 'update'])->name('admin.guru.update');
Route::delete('/admin/guru/{id}', [GuruDataController::class, 'destroy'])->name('admin.guru.destroy');

// Admin - CRUD Kelas
Route::get('/admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
Route::get('/admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
Route::post('/admin/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
Route::get('/admin/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');
Route::put('/admin/kelas/{id}', [KelasController::class, 'update'])->name('admin.kelas.update');
Route::delete('/admin/kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

// Admin - CRUD Siswa
Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
Route::get('/admin/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
Route::get('/admin/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
Route::put('/admin/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
Route::delete('/admin/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

// Guru & Wali Kelas
Route::get('/dashboard_guru/{id?}/{namaGuru?}', [GuruController::class, 'nama']);
Route::get('/dashboard_walikelas/{id?}/{nama?}', [WalikelasController::class, 'nama']);
