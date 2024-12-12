<?php

use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('/drivers', [DriverController::class, 'store'])->name('drivers.store');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
