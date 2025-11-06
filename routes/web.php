<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PengeluaranController;

// ========================================
// AUTH ROUTES (Login & Register)
// ========================================
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Dummy login - redirect ke dashboard
    return redirect()->route('dashboard.index');
})->name('login.submit');

Route::get('/login-as-admin', function() {
    Auth::loginUsingId(1); // ID admin hasil seeder atau tinker
    return redirect()->route('dashboard.index');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // Dummy register - redirect ke login
    return redirect()->route('login');
})->name('register.submit');

// ========================================
// DASHBOARD
// ========================================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/pesanan', [DashboardController::class, 'getPesanan'])->name('dashboard.pesanan');
Route::get('/dashboard/pengeluaran', [DashboardController::class, 'getPengeluaran'])->name('dashboard.pengeluaran');

// ========================================
// MANAJEMEN PESANAN
// ========================================
Route::prefix('pesanan')->name('pesanan.')->group(function () {
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
Route::prefix('keuangan')->group(function () {
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
Route::get('/admin/profile', function () {
    return view('admin.admin_profile');
})->name('admin.profile');

// ========================================
// LOGOUT
// ========================================
Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');
