<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route Dashboard Utama
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');

    // Route untuk Admin Input Pesanan
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    // Route untuk Approver (Persetujuan)
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');

    // Route untuk Export Excel
    Route::get('/bookings/export', [BookingController::class, 'export'])->name('bookings.export');

    // Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';