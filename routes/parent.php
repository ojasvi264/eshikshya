<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Parent\Auth\LoginController;
use App\Http\Controllers\Parent\DashboardController;

Route::group(['prefix' => 'parent'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest:parent');
    Route::post('login', [LoginController::class, 'login'])->name('parent.login')->middleware('guest:staff');
    Route::post('logout', [LoginController::class, 'logout'])->name('parent.logout');

    Route::group(['middleware' => 'parent'], function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('parent.dashboard');

    });
    });
