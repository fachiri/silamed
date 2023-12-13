<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'auth_login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('dashboard')->middleware(['web', 'auth', 'checkpassword'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::middleware(['roles:ADMIN,KARYAWAN'])->group(function () {
        Route::resource('/statistik', StatistikController::class)->names('statistik');
        Route::patch('/statistik/{uuid}/evaluasi', [StatistikController::class, 'evaluasi'])->name('statistik.evaluasi');
        Route::resource('/master/sosmed', SosmedController::class)->names('sosmed');
        Route::resource('/master/target', TargetController::class)->names('target');
    });
    
    Route::middleware(['roles:PIMPINAN,ADMIN'])->group(function () {
        Route::resource('/master/user', UserController::class)->names('user');
        Route::get('/laporan/grafik', [LaporanController::class, 'grafik'])->name('laporan.grafik');
        Route::get('/laporan/tabel', [LaporanController::class, 'tabel'])->name('laporan.tabel');
        Route::get('/laporan/tabel/cetak', [LaporanController::class, 'tabel_cetak'])->name('laporan.tabel.cetak');
    });
});

Route::prefix('dashboard')->middleware(['web', 'auth'])->group(function () {
    Route::get('/pengaturan', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/pengaturan/ubah_password', [SettingController::class, 'change_password'])->name('setting.change_password');
});
