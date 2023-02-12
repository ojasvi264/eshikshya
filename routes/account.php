<?php

use App\Http\Controllers\Account\CategoryController;
use App\Http\Controllers\Account\voucherController;
use App\Http\Controllers\Account\voucherentryController;
use App\Http\Controllers\Account\accountreportController;
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

Route::group(['prefix' => 'account','middleware' => ['IsSuperadmin','XSS']], function() {
    //----------------------------------for voucher Category--------------
    Route::group(['prefix' => 'voucher'] , function (){
        Route::get('rejected', [voucherController::class, 'rejected'])->name('account.voucher.rejected');
        Route::get('getupapproved', [voucherController::class, 'getupapproved'])->name('account.voucher.getupapproved');
        Route::get('getapproved', [voucherController::class, 'getapproved'])->name('account.voucher.getapproved');
        Route::post('approve', [voucherController::class, 'approve'])->name('account.voucher.approve');
        Route::post('reject', [voucherController::class, 'reject'])->name('account.voucher.reject');
        Route::post('approveall', [voucherController::class, 'approveall'])->name('account.voucher.approveall');
    });
}); 

Route::group(['prefix' => 'account','middleware' => ['IsSuperadmin','XSS']], function() {
    //----------------------------------for voucher Category--------------
    Route::group(['prefix' => 'voucherentry'] , function (){
        Route::get('journalentry', [voucherentryController::class, 'journalentry'])->name('account.voucherentry.journalentry');
        Route::post('savejournalentry', [voucherentryController::class, 'savejournalentry'])->name('account.voucherentry.savejournalentry');
        Route::get('paymententry', [voucherentryController::class, 'paymententry'])->name('account.voucherentry.paymententry');
        Route::post('savepaymentvoucher', [voucherentryController::class, 'savepaymentvoucher'])->name('account.voucherentry.savepaymentvoucher');
        Route::get('receiptentry', [voucherentryController::class, 'receiptentry'])->name('account.voucherentry.receiptentry');
        Route::post('savereceiptvoucher', [voucherentryController::class, 'savereceiptvoucher'])->name('account.voucherentry.savereceiptvoucher');
    });
}); 

Route::group(['prefix' => 'account','middleware' => ['IsSuperadmin','XSS']], function() {
    //----------------------------------for voucher Category--------------
    Route::group(['prefix' => 'report'] , function (){
        Route::get('trailbalance', [accountreportController::class, 'trailbalance'])->name('account.report.trailbalance');
        Route::get('generalledger', [accountreportController::class, 'generalledger'])->name('account.report.generalledger');
        Route::get('profilandloss', [accountreportController::class, 'profilandloss'])->name('account.report.profilandloss');
        Route::get('balancesheet', [accountreportController::class, 'balancesheet'])->name('account.report.balancesheet');
        Route::get('daybook', [accountreportController::class, 'daybook'])->name('account.report.daybook');
    });
}); 
