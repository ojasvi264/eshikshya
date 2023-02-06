<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accountant\Auth\LoginController;
use App\Http\Controllers\Accountant\DashboardController;
use App\Http\Controllers\Accountant\PurposeController;
use App\Http\Controllers\Accountant\ComplainTypeController;
use App\Http\Controllers\Accountant\SourceController;
use App\Http\Controllers\Accountant\ReferenceController;
use App\Http\Controllers\Accountant\AdmissionInquiryController;
use App\Http\Controllers\Accountant\VisitorController;
use App\Http\Controllers\Accountant\PhoneCallLogController;
use App\Http\Controllers\Accountant\PostalDispatchController;
use App\Http\Controllers\Accountant\PostalReceiveController;
use App\Http\Controllers\Accountant\ComplainController;

Route::group(['prefix' => 'accountant'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest:staff');
    Route::post('login', [LoginController::class, 'login'])->name('accountant.login')->middleware('guest:staff');
    Route::post('logout', [LoginController::class, 'logout'])->name('accountant.logout');

    Route::group(['middleware' => 'accountant'], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('accountant.dashboard');

        //----------------------------------for purpose--------------
        Route::get('/purpose', [PurposeController::class, 'purposeCreate'])->name('accountant.purpose');
        Route::post('/purpose/add', [PurposeController::class, 'purposeStore'])->name('accountant.purpose.add');
        Route::get('/purpose', [PurposeController::class, 'purposeShow'])->name('accountant.purpose');
        Route::get('purpose-edit/{id}', [PurposeController::class, 'purposeEdit'])->name('accountant.purpose.edit');
        Route::post('purpose-update/', [PurposeController::class, 'purposeUpdate'])->name('accountant.purpose.update');
        Route::delete('/purpose/destroy/{id}', [PurposeController::class, 'purposeDestroy'])->name('accountant.purpose.destroy');

        //----------------------------------for complain type--------------
        Route::get('complain-type', [ComplainTypeController::class, 'complainTypeCreate'])->name('accountant.complain-type');
        Route::post('complain-type/add', [ComplainTypeController::class, 'complainTypeStore'])->name('accountant.complain-type/add');
        Route::get('complain-type', [ComplainTypeController::class, 'complainTypeShow'])->name('accountant.complain-type');
        Route::get('complain-type-edit/{id}', [ComplainTypeController::class, 'complainTypeEdit'])->name('accountant.complain-type.edit');
        Route::post('complain-type-update/', [ComplainTypeController::class, 'complainTypeUpdate'])->name('accountant.complain-type.update');
        Route::delete('/complain-type/destroy/{id}', [ComplainTypeController::class, 'complainTypeDestroy'])->name('accountant.complain-type.destroy');

        //----------------------------------for source--------------
        Route::get('source', [SourceController::class, 'sourceCreate'])->name('accountant.source');
        Route::post('source/add', [SourceController::class, 'sourceStore'])->name('accountant.source/add');
        Route::get('source', [SourceController::class, 'sourceShow'])->name('accountant.source');
        Route::get('source-edit/{id}', [SourceController::class, 'sourceEdit'])->name('accountant.source.edit');
        Route::post('source-update/', [SourceController::class, 'sourceUpdate'])->name('accountant.source.update');
        Route::delete('/source/destroy/{id}', [SourceController::class, 'sourceDestroy'])->name('accountant.source.destroy');

        //----------------------------------for reference--------------
        Route::get('reference', [ReferenceController::class, 'referenceCreate'])->name('accountant.reference');
        Route::post('reference/add', [ReferenceController::class, 'referenceStore'])->name('accountant.reference/add');
        Route::get('reference', [ReferenceController::class, 'referenceShow'])->name('accountant.reference');
        Route::get('reference-edit/{id}', [ReferenceController::class, 'referenceEdit'])->name('accountant.reference.edit');
        Route::post('reference-update/', [ReferenceController::class, 'referenceUpdate'])->name('accountant.reference.update');
        Route::delete('/reference/destroy/{id}', [ReferenceController::class, 'referenceDestroy'])->name('accountant.reference.destroy');

        //----------------------------------for admission inquiry--------------
        Route::get('admission-inquiry', [AdmissionInquiryController::class, 'admissionInquiryCreate'])->name('accountant.admission-inquiry');
        Route::post('admission-inquiry/add', [AdmissionInquiryController::class, 'admissionInquiryStore'])->name('accountant.admission-inquiry/add');
        Route::get('admission-inquiry/view', [AdmissionInquiryController::class, 'admissionInquiryShow'])->name('accountant.admission-inquiry');
        Route::get('admission-inquiry-edit/{id}', [AdmissionInquiryController::class, 'admissionInquiryEdit'])->name('accountant.admission-inquiry.edit');
        Route::post('admission-inquiry-update/', [AdmissionInquiryController::class, 'admissionInquiryUpdate'])->name('accountant.admission-inquiry.update');
        Route::delete('/admission-inquiry/destroy/{id}', [AdmissionInquiryController::class, 'admissionInquiryDestroy'])->name('accountant.admission-inquiry.destroy');

        //----------------------------------for visitor book----------------
        Route::get('visitor-book', [VisitorController::class, 'visitorCreate'])->name('accountant.visitor-book');
        Route::post('visitor-book/add', [VisitorController::class, 'visitorStore'])->name('accountant.visitor-book/add');
        Route::get('visitor-book/view', [VisitorController::class, 'visitorShow'])->name('accountant.visitor-book');
        Route::get('visitor-book-edit/{id}', [VisitorController::class, 'visitorEdit'])->name('accountant.visitor-book.edit');
        Route::post('visitor-book-update/', [VisitorController::class, 'visitorUpdate'])->name('accountant.visitor-book.update');
        Route::delete('/visitor-book/destroy/{id}', [VisitorController::class, 'visitorDestroy'])->name('accountant.visitor-book.destroy');

        //----------------------------------for phone call log--------------
        Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogCreate'])->name('accountant.phone-call-log');
        Route::post('phone-call-log/add', [PhoneCallLogController::class, 'phoneCallLogStore'])->name('accountant.phone-call-log/add');
        Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogShow'])->name('accountant.phone-call-log');
        Route::get('phone-call-log-edit/{id}', [PhoneCallLogController::class, 'phoneCallLogEdit'])->name('accountant.phone-call-log.edit');
        Route::post('phone-call-log-update/', [PhoneCallLogController::class, 'phoneCallLogUpdate'])->name('accountant.phone-call-log.update');
        Route::delete('/phone-call-log/destroy/{id}', [PhoneCallLogController::class, 'phoneCallLogDestroy'])->name('accountant.phone-call-log.destroy');

        //----------------------------------for postal dispatch--------------
        Route::get('postal-dispatch', [PostalDispatchController::class, 'create'])->name('accountant.postal-dispatch');
        Route::post('postal-dispatch/add', [PostalDispatchController::class, 'store'])->name('accountant.postal-dispatch/add');
        Route::get('postal-dispatch/view', [PostalDispatchController::class, 'show'])->name('accountant.postal-dispatch');
        Route::get('postal-dispatch/{id}', [PostalDispatchController::class, 'edit'])->name('accountant.postal-dispatch.edit');
        Route::post('postal-dispatch-update/', [PostalDispatchController::class, 'update'])->name('accountant.postal-dispatch.update');
        Route::delete('/postal-dispatch/destroy/{id}', [PostalDispatchController::class, 'destroy'])->name('accountant.postal-dispatch.destroy');

        //----------------------------------for postal receive--------------
        Route::get('postal-receive', [PostalReceiveController::class, 'postalReceiveCreate'])->name('accountant.postal-receive');
        Route::post('postal-receive/add', [PostalReceiveController::class, 'postalReceiveStore'])->name('accountant.postal-receive/add');
        Route::get('postal-receive/view', [PostalReceiveController::class, 'postalReceiveShow'])->name('accountant.postal-receive');
        Route::get('postal-receive-edit/{id}', [PostalReceiveController::class, 'postalReceiveEdit'])->name('accountant.postal-receive.edit');
        Route::post('postal-receive-update/', [PostalReceiveController::class, 'postalReceiveUpdate'])->name('accountant.postal-receive.update');
        Route::delete('/postal-receive/destroy/{id}', [PostalReceiveController::class, 'postalReceiveDestroy'])->name('accountant.postal-receive.destroy');

        //----------------------------------for complain--------------
        Route::get('complain', [ComplainController::class, 'complainCreate'])->name('accountant.complain');
        Route::post('complain/add', [ComplainController::class, 'complainStore'])->name('accountant.complain/add');
        Route::get('complain/view', [ComplainController::class, 'complainShow'])->name('accountant.complain');
        Route::get('complain-edit/{id}', [ComplainController::class, 'complainEdit'])->name('accountant.complain.edit');
        Route::post('complain-update/', [ComplainController::class, 'complainUpdate'])->name('accountant.complain.update');
        Route::delete('/complain/destroy/{id}', [ComplainController::class, 'complainDestroy'])->name('accountant.complain.destroy');

        /*Apply Leave*/
        Route::resource('apply_leave', 'ApplyLeaveController', [
            'names' => [
                'index' => 'accountant.apply_leave.index',
                'create' => 'accountant.apply_leave.create',
                'store' => 'accountant.apply_leave.store',
                'edit' => 'accountant.apply_leave.edit',
                'update' => 'accountant.apply_leave.update',
                'destroy' => 'accountant.apply_leave.destroy',
            ]
        ]);

//----------------------------------For Inventory--------------
        /*Item Category*/
        Route::resource('item_category', 'ItemCategoryController', [
            'names' => [
                'index' => 'accountant.item_category.index',
                'create' => 'accountant.item_category.create',
                'store' => 'accountant.item_category.store',
                'edit' => 'accountant.item_category.edit',
                'update' => 'accountant.item_category.update',
                'destroy' => 'accountant.item_category.destroy',
            ]
        ]);

        /*Item Store*/
        Route::resource('item_store', 'temStoreController', [
            'names' => [
                'index' => 'accountant.item_store.index',
                'create' => 'accountant.item_store.create',
                'store' => 'accountant.item_store.store',
                'edit' => 'accountant.item_store.edit',
                'update' => 'accountant.item_store.update',
                'destroy' => 'accountant.item_store.destroy',
            ]
        ]);

        /*Item Supplier*/
        Route::resource('item_supplier', 'ItemSupplierController', [
            'names' => [
                'index' => 'accountant.item_supplier.index',
                'create' => 'accountant.item_supplier.create',
                'store' => 'accountant.item_supplier.store',
                'edit' => 'accountant.item_supplier.edit',
                'update' => 'accountant.item_supplier.update',
                'destroy' => 'accountant.item_supplier.destroy',
            ]
        ]);

        /*Item*/
        Route::resource('item', 'ItemController', [
            'names' => [
                'index' => 'accountant.item.index',
                'create' => 'accountant.item.create',
                'store' => 'accountant.item.store',
                'edit' => 'accountant.item.edit',
                'update' => 'accountant.item.update',
                'destroy' => 'accountant.item.destroy',
            ]
        ]);
//        Route::get('item_categories/{id}', [ItemController::class, 'getItemCategories'])->name('get_categories');

        /*Item Stock*/
        Route::resource('item_stock', 'ItemStockController', [
            'names' => [
                'index' => 'accountant.item_stock.index',
                'create' => 'accountant.item_stock.create',
                'store' => 'accountant.item_stock.store',
                'edit' => 'accountant.item_stock.edit',
                'update' => 'accountant.item_stock.update',
                'destroy' => 'accountant.item_stock.destroy',
            ]
        ]);
//        Route::get('item_quantity/{id}', [ItemStockController::class, 'getQuantity'])->name('get_quantity');

        /*Issue Item*/
        Route::resource('issue_item', 'IssueItemController', [
            'names' => [
                'index' => 'accountant.issue_item.index',
                'create' => 'accountant.issue_item.create',
                'store' => 'accountant.issue_item.store',
                'edit' => 'accountant.issue_item.edit',
                'update' => 'accountant.issue_item.update',
                'destroy' => 'accountant.issue_item.destroy',
            ]
        ]);
//        Route::get('return_item/{id}', [IssueItemController::class, 'returnItem'])->name('return_item');
    });});
