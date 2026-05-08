<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PustakawanController;

Route::get('/', function () {
    return redirect('/login');
});

// Route Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login.proses');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'prosesRegister'])->name('register.proses');
});

// Route Auth (Harus Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- DASHBOARD PUSTAKAWAN ---
    Route::middleware('role:pustakawan')->group(function () {
        // Dashboard Utama
        Route::get('/pustakawan/dashboard', [PustakawanController::class, 'dashboard'])->name('pustakawan.dashboard');

        // Route Kelola Buku
        Route::get('/pustakawan/buku', [PustakawanController::class, 'indexBuku'])->name('pustakawan.buku');
        Route::get('/pustakawan/buku/create', [PustakawanController::class, 'createBuku'])->name('pustakawan.buku.create');
        Route::post('/pustakawan/buku', [PustakawanController::class, 'storeBuku'])->name('pustakawan.buku.store');
        Route::get('/pustakawan/buku/{buku}/edit', [PustakawanController::class, 'editBuku'])->name('pustakawan.buku.edit');
        Route::put('/pustakawan/buku/{buku}', [PustakawanController::class, 'updateBuku'])->name('pustakawan.buku.update');
        Route::delete('/pustakawan/buku/{buku}', [PustakawanController::class, 'destroyBuku'])->name('pustakawan.buku.destroy');

        // (Nanti Route buat Anggota dan Transaksi taruh di sini)
    });

    // --- DASHBOARD ANGGOTA ---
    Route::middleware('role:anggota')->group(function () {
        Route::get('/anggota/dashboard', function () {
            return 'Dashboard Anggota (Nanti dibikin)';
        })->name('anggota.dashboard');
    });
});
