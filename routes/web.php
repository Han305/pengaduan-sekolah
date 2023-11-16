<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('/',  'login')->name('login');
    Route::post('/',  'loginprocess')->name('login.process');
    Route::get('/register',  'register')->name('register');
    Route::post('/register',  'registerprocess')->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::controller(PostController::class)->prefix('/admin')->group(function() {        
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/laporan', 'laporan')->name('laporan');
        Route::get('/create', 'create')->name('laporan.create');
        Route::post('/create', 'store')->name('laporan.store');
        Route::get('/{post}/edit', 'edit')->name('laporan.edit');
        Route::put('/{post}/edit', 'update')->name('laporan.update');
        Route::get('/{post}/delete', 'destroy')->name('laporan.destroy');
    });
    
    Route::get('/admin/riwayat', [RiwayatController::class, 'riwayat'])->name('riwayat');
    Route::get('/admin/laporan/{id}', [RiwayatController::class, 'store'])->name('laporan.tanggapi');
    Route::get('/admin/riwayat/{post}/delete', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');
    
    Route::get('/pengaduan', [PengaduanController::class, 'pengaduan'])->name('pengaduan');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('store');
    Route::get('/pengaduan/akun', [PengaduanController::class, 'akun'])->name('pengaduan.akun');
    Route::post('/pengaduan/akun/update', [PengaduanController::class, 'update'])->name('pengaduan.update');
    
    Route::get('/admin/datauser', [UserController::class, 'index'])->name('datauser');
    Route::get('/admin/datauser/create', [UserController::class, 'create'])->name('datauser.create');    
    Route::post('/admin/datauser/create', [UserController::class, 'store'])->name('datauser.store');    
    Route::get('/admin/datauser/edit/{id}', [UserController::class, 'edit'])->name('datauser.edit');    
    Route::put('/admin/datauser/edit/{id}', [UserController::class, 'update'])->name('datauser.update');    
    Route::get('/admin/datauser/hapus/{id}', [UserController::class, 'destroy'])->name('datauser.destroy');    
    
    
    Route::get('/admin/akun', [AccountController::class, 'index'])->name('akun');
    Route::post('/admin/akun/update', [AccountController::class, 'update'])->name('akun.update');
});