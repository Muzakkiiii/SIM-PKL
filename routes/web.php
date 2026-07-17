<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Form Pendaftaran (Bisa diakses siapa saja)
Route::get('/daftar', [RegistrationController::class, 'index'])->name('registration.index');

// Proses Simpan Data
Route::post('/daftar', [RegistrationController::class, 'store'])->name('registration.store');

// Login Admin (Bisa diakses siapa saja)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Semua route /admin hanya bisa diakses jika sudah login
Route::middleware('auth')->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    // Menampilkan form verifikasi (Edit)
    Route::get('/verifikasi/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    // Menyimpan hasil verifikasi (Update)
    Route::put('/verifikasi/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/cetak-surat/{id}', [AdminController::class, 'printLetter'])->name('admin.print');
});
