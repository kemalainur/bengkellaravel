<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth.check')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pelanggan CRUD
    Route::resource('pelanggan', PelangganController::class)->except(['show']);

    // Motor CRUD
    Route::resource('motor', MotorController::class)->except(['show']);

    // Item CRUD
    Route::resource('item', ItemController::class)->except(['show']);

    // Transaksi CRUD
    Route::resource('transaksi', TransaksiController::class);

    // Detail CRUD (nested under transaksi)
    Route::get('/transaksi/{nostruk}/detail/create', [DetailController::class, 'create'])->name('detail.create');
    Route::post('/transaksi/{nostruk}/detail', [DetailController::class, 'store'])->name('detail.store');
    Route::get('/transaksi/{nostruk}/detail/{id}/edit', [DetailController::class, 'edit'])->name('detail.edit');
    Route::put('/transaksi/{nostruk}/detail/{id}', [DetailController::class, 'update'])->name('detail.update');
    Route::delete('/transaksi/{nostruk}/detail/{id}', [DetailController::class, 'destroy'])->name('detail.destroy');
});
