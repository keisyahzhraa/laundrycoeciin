<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\HargaLayananController;

// ========================================
// AUTH ROUTES (Login & Register)
// ========================================
Route::prefix('register')->name('register')->group(function () {
Route::get('/', [AuthController::class, 'showRegisterForm']);
Route::post('/', [AuthController::class, 'register'])->name('.submit');
});

Route::prefix('login')->name('login')->group(function () {
Route::get('/', [AuthController::class, 'showLoginForm']);
Route::post('/', [AuthController::class, 'login'])->name('.submit');
});

// ========================================
// LUPA PASSWORD
// ========================================
Route::prefix('password')->name('password.')->group(function () {
Route::get('/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('request');
Route::post('/reset', [AuthController::class, 'resetPassword'])->name('update');
});

// ========================================
// DASHBOARD
// ========================================
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/pesanan', [DashboardController::class, 'getPesanan'])->name('pesanan');
    Route::get('/pengeluaran', [DashboardController::class, 'getPengeluaran'])->name('pengeluaran');
});

// ========================================
// MANAJEMEN PESANAN
// ========================================
Route::prefix('pesanan')->name('pesanan.')->group(function () {
    Route::get('/', [PesananController::class, 'index'])->name('daftar'); // /pesanan
    Route::get('/tambah', [PesananController::class, 'create'])->name('tambah'); // /pesanan/tambah
    Route::post('/tambah', [PesananController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PesananController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PesananController::class, 'update'])->name('update');
    Route::delete('/{id}', [PesananController::class, 'destroy'])->name('destroy');
    Route::post('/hitung-harga', [PesananController::class, 'hitungHarga'])->name('hitung_harga');
});

Route::put('/layanan/update', [HargaLayananController::class, 'update'])
    ->name('layanan.update');

// ========================================
// MANAJEMEN PENGELUARAN
// ========================================
Route::prefix('pengeluaran')->name('pengeluaran.')->group(function () {
    Route::get('/', [PengeluaranController::class, 'index'])->name('daftar');
    Route::get('/tambah', [PengeluaranController::class, 'create'])->name('tambah');
    Route::post('/tambah', [PengeluaranController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PengeluaranController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PengeluaranController::class, 'update'])->name('update');
    Route::delete('/{id}', [PengeluaranController::class, 'destroy'])->name('destroy');
});

// ========================================
// PROFIL ADMIN
// ========================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// ========================================
// LOGOUT
// ========================================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
