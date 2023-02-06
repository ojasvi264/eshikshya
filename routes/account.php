<?php

use App\Http\Controllers\Account\CategoryController;
Route::group(['prefix' => 'account','middleware' => ['IsSuperadmin','XSS']], function() {
    //----------------------------------for Account Category--------------
    Route::group(['prefix' => 'category'] , function (){
        Route::get('index', [CategoryController::class, 'index'])->name('account.category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('account.category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('account.category.store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('account.category.edit');
        Route::post('update', [CategoryController::class, 'update'])->name('account.category.update');
    });
});
