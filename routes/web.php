<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'auth_login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('dashboard')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/master/sosmed', SosmedController::class)->names('sosmed');
    Route::resource('/statistik', StatistikController::class)->names('statistik');
    Route::middleware(['roles:PIMPINAN'])->group(function () {
        Route::resource('/master/user', UserController::class)->names('user');
        Route::get('/laporan/grafik', [LaporanController::class, 'grafik'])->name('laporan.grafik');
        Route::get('/laporan/tabel', [LaporanController::class, 'tabel'])->name('laporan.tabel');
        Route::get('/laporan/tabel/cetak', [LaporanController::class, 'tabel_cetak'])->name('laporan.tabel.cetak');
    });
});
