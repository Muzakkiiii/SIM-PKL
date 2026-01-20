<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Form Pendaftaran (Bisa diakses siapa saja)
Route::get('/daftar', [RegistrationController::class, 'index'])->name('registration.index');

// Proses Simpan Data
Route::post('/daftar', [RegistrationController::class, 'store'])->name('registration.store');

// Dashboard Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
// Menampilkan form verifikasi (Edit)
Route::get('/admin/verifikasi/{id}', [AdminController::class, 'edit'])->name('admin.edit');
// Menyimpan hasil verifikasi (Update)
Route::put('/admin/verifikasi/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::get('/admin/cetak-surat/{id}', [AdminController::class, 'printLetter'])->name('admin.print');
