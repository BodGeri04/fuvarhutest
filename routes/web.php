<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
