<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('/drivers', [DriverController::class, 'store'])->name('drivers.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::resource('jobs', JobController::class);
    // Munka törlése
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
