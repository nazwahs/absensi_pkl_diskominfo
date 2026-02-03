<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('guest')->group(function () {

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.forgot');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');
});

Route::middleware(['auth', 'cekuser'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/izin-sakit', [UserController::class, 'izinSakit'])->name('izin-sakit');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat');
    Route::post('/izin-sakit', [AbsensiController::class, 'izinSakitStore'])->name('izin-sakit.store');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
});

Route::middleware(['auth', 'cekadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan', [AdminController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan/notifikasi', [AdminController::class, 'updateNotifikasi'])->name('notifikasi.update');
    Route::get('/permohonan-izin', [AdminController::class, 'permohonanIzin'])->name('permohonan-izin');
    Route::post('/permohonan/{id}/setujui', [AdminController::class, 'setujuiPermohonan'])->name('permohonan.setujui');
    Route::post('/permohonan/{id}/tolak', [AdminController::class, 'tolakPermohonan'])->name('permohonan.tolak');
    Route::get('/riwayat', [AdminController::class, 'riwayatAbsensi'])->name('riwayat');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');