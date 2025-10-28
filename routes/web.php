<?php

use Illuminate\Support\Facades\Route;

// ========================================
// AUTH ROUTES (Login & Register)
// ========================================
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Dummy login - redirect ke dashboard
    return redirect()->route('dashboard');
})->name('login.submit');

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
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

// ========================================
// MANAJEMEN PESANAN
// ========================================
Route::get('/daftar-pesanan', function () {
    return view('manajemen_pesanan.pesanan');
})->name('pesanan.daftar');

Route::get('/manajemen-pesanan/tambah', function () {
    return view('manajemen_pesanan.tambah_pesanan');
})->name('pesanan.tambah');

// ========================================
// MANAJEMEN KEUANGAN
// ========================================
Route::get('/keuangan/tambah-pengeluaran', function () {
    return view('keuangan.tambah_pengeluaran');
})->name('keuangan.tambah');

Route::post('/keuangan/tambah-pengeluaran', function () {
    // Dummy submit - redirect kembali dengan pesan sukses
    return redirect()->route('keuangan.tambah')->with('success', 'Data pengeluaran berhasil ditambahkan!');
})->name('keuangan.store');

Route::get('/keuangan/laporan', function () {
    return view('keuangan.laporan_keuangan');
})->name('keuangan.laporan');

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