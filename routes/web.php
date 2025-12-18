<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PartmanDashboardController;
use App\Http\Controllers\PartmanItemController;
use App\Http\Controllers\AdvisorDashboardController;
use App\Http\Controllers\AdvisorPelangganController;
use App\Http\Controllers\AdvisorMotorController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// =====================================================
// AUTH ROUTES (Public)
// =====================================================
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer Auth
Route::get('/customer/login', [AuthController::class, 'showCustomerLogin'])->name('customer.login');
Route::post('/customer/login', [AuthController::class, 'customerLogin'])->name('customer.login.post');
Route::post('/customer/logout', [AuthController::class, 'customerLogout'])->name('customer.logout');

// =====================================================
// ADMIN ROUTES - Full Access + Laporan Keuangan
// =====================================================
Route::middleware(['auth.check', 'role:Admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Laporan Keuangan
    Route::get('/admin/laporan', [AdminDashboardController::class, 'laporan'])->name('admin.laporan');

    // Pelanggan CRUD
    Route::resource('pelanggan', PelangganController::class)->except(['show']);

    // Motor CRUD
    Route::resource('motor', MotorController::class)->except(['show']);

    // Item CRUD
    Route::resource('item', ItemController::class)->except(['show']);

    // Transaksi CRUD
    Route::resource('transaksi', TransaksiController::class);
    
    // Cetak Invoice
    Route::get('/transaksi/{nostruk}/invoice', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
    Route::post('/transaksi/{nostruk}/cetak', [TransaksiController::class, 'cetakInvoice'])->name('transaksi.cetak');
    
    // Update Status Transaksi
    Route::patch('/transaksi/{nostruk}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');

    // Detail CRUD (nested under transaksi)
    Route::get('/transaksi/{nostruk}/detail/create', [DetailController::class, 'create'])->name('detail.create');
    Route::post('/transaksi/{nostruk}/detail', [DetailController::class, 'store'])->name('detail.store');
    Route::get('/transaksi/{nostruk}/detail/{id}/edit', [DetailController::class, 'edit'])->name('detail.edit');
    Route::put('/transaksi/{nostruk}/detail/{id}', [DetailController::class, 'update'])->name('detail.update');
    Route::delete('/transaksi/{nostruk}/detail/{id}', [DetailController::class, 'destroy'])->name('detail.destroy');
});

// Legacy dashboard route (redirect to admin)
Route::middleware(['auth.check'])->get('/dashboard', function () {
    $jabatan = session('jabatan');
    switch ($jabatan) {
        case 'Partman':
            return redirect()->route('partman.dashboard');
        case 'Service Advisor':
            return redirect()->route('advisor.dashboard');
        default:
            return redirect()->route('admin.dashboard');
    }
})->name('dashboard');

// =====================================================
// PARTMAN ROUTES - Only Item CRUD
// =====================================================
Route::middleware(['auth.check', 'role:Partman'])->prefix('partman')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PartmanDashboardController::class, 'index'])->name('partman.dashboard');

    // Item CRUD with dedicated controller
    Route::get('/item', [PartmanItemController::class, 'index'])->name('partman.item.index');
    Route::get('/item/create', [PartmanItemController::class, 'create'])->name('partman.item.create');
    Route::post('/item', [PartmanItemController::class, 'store'])->name('partman.item.store');
    Route::get('/item/{item}/edit', [PartmanItemController::class, 'edit'])->name('partman.item.edit');
    Route::put('/item/{item}', [PartmanItemController::class, 'update'])->name('partman.item.update');
    Route::delete('/item/{item}', [PartmanItemController::class, 'destroy'])->name('partman.item.destroy');
});

// =====================================================
// SERVICE ADVISOR ROUTES - Pelanggan & Motor CRUD
// =====================================================
Route::middleware(['auth.check', 'role:Service Advisor'])->prefix('advisor')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdvisorDashboardController::class, 'index'])->name('advisor.dashboard');

    // Pelanggan CRUD with dedicated controller
    Route::get('/pelanggan', [AdvisorPelangganController::class, 'index'])->name('advisor.pelanggan.index');
    Route::get('/pelanggan/create', [AdvisorPelangganController::class, 'create'])->name('advisor.pelanggan.create');
    Route::post('/pelanggan', [AdvisorPelangganController::class, 'store'])->name('advisor.pelanggan.store');
    Route::get('/pelanggan/{pelanggan}/edit', [AdvisorPelangganController::class, 'edit'])->name('advisor.pelanggan.edit');
    Route::put('/pelanggan/{pelanggan}', [AdvisorPelangganController::class, 'update'])->name('advisor.pelanggan.update');
    Route::delete('/pelanggan/{pelanggan}', [AdvisorPelangganController::class, 'destroy'])->name('advisor.pelanggan.destroy');

    // Motor CRUD with dedicated controller
    Route::get('/motor', [AdvisorMotorController::class, 'index'])->name('advisor.motor.index');
    Route::get('/motor/create', [AdvisorMotorController::class, 'create'])->name('advisor.motor.create');
    Route::post('/motor', [AdvisorMotorController::class, 'store'])->name('advisor.motor.store');
    Route::get('/motor/{motor}/edit', [AdvisorMotorController::class, 'edit'])->name('advisor.motor.edit');
    Route::put('/motor/{motor}', [AdvisorMotorController::class, 'update'])->name('advisor.motor.update');
    Route::delete('/motor/{motor}', [AdvisorMotorController::class, 'destroy'])->name('advisor.motor.destroy');
});

// =====================================================
// CUSTOMER ROUTES - Check Service Status
// =====================================================
Route::middleware(['customer.check'])->prefix('customer')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/transaksi/{nostruk}', [CustomerDashboardController::class, 'showTransaksi'])->name('customer.transaksi');
});
