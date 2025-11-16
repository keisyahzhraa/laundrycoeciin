<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PengeluaranController;

// ========================================
// AUTH ROUTES (Login & Register)
// ========================================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ========================================
// LUPA PASSWORD
// ========================================
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ========================================
// DASHBOARD
// ========================================
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/pesanan', [DashboardController::class, 'getPesanan'])->name('pesanan');
    Route::get('/pengeluaran', [DashboardController::class, 'getPengeluaran'])->name('pengeluaran');
});

// ========================================
// MANAJEMEN PESANAN
// ========================================
Route::middleware('auth')->prefix('pesanan')->name('pesanan.')->group(function () {
    Route::get('/', [PesananController::class, 'index'])->name('index'); // /pesanan
    Route::get('/daftar', [PesananController::class, 'index'])->name('daftar'); // alias untuk sidebar
    Route::get('/tambah', [PesananController::class, 'create'])->name('tambah'); // /pesanan/tambah
    Route::post('/', [PesananController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PesananController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PesananController::class, 'update'])->name('update');
    Route::delete('/{id}', [PesananController::class, 'destroy'])->name('destroy');
});


// ========================================
// MANAJEMEN KEUANGAN
// ========================================
Route::middleware('auth')->prefix('keuangan')->group(function () {
    Route::get('/tambah-pengeluaran', [PengeluaranController::class, 'create'])->name('keuangan.tambah');
    Route::post('/tambah-pengeluaran', [PengeluaranController::class, 'store'])->name('keuangan.store');
    Route::get('/laporan', [PengeluaranController::class, 'index'])->name('keuangan.laporan');
    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');
});

// ========================================
// PROFIL ADMIN
// ========================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// ========================================
// LOGOUT
// ========================================
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
