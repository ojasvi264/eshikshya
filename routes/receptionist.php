<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Receptionist\Auth\LoginController;
use App\Http\Controllers\Receptionist\DashboardController;
use App\Http\Controllers\Receptionist\PurposeController;
use App\Http\Controllers\Receptionist\ComplainTypeController;
use App\Http\Controllers\Receptionist\SourceController;
use App\Http\Controllers\Receptionist\ReferenceController;
use App\Http\Controllers\Receptionist\AdmissionInquiryController;
use App\Http\Controllers\Receptionist\VisitorController;
use App\Http\Controllers\Receptionist\PhoneCallLogController;
use App\Http\Controllers\Receptionist\PostalDispatchController;
use App\Http\Controllers\Receptionist\PostalReceiveController;
use App\Http\Controllers\Receptionist\ComplainController;

Route::group(['prefix' => 'receptionist'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest:staff');
    Route::post('login', [LoginController::class, 'login'])->name('receptionist.login')->middleware('guest:staff');
    Route::post('logout', [LoginController::class, 'logout'])->name('receptionist.logout');

    Route::group(['middleware' => 'receptionist'], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('receptionist.dashboard');

        //----------------------------------for purpose--------------
        Route::get('/purpose', [PurposeController::class, 'purposeCreate'])->name('receptionist.purpose');
        Route::post('/purpose/add', [PurposeController::class, 'purposeStore'])->name('receptionist.purpose.add');
        Route::get('/purpose', [PurposeController::class, 'purposeShow'])->name('receptionist.purpose');
        Route::get('purpose-edit/{id}', [PurposeController::class, 'purposeEdit'])->name('receptionist.purpose.edit');
        Route::post('purpose-update/', [PurposeController::class, 'purposeUpdate'])->name('receptionist.purpose.update');
        Route::delete('/purpose/destroy/{id}', [PurposeController::class, 'purposeDestroy'])->name('receptionist.purpose.destroy');

        //----------------------------------for complain type--------------
        Route::get('complain-type', [ComplainTypeController::class, 'complainTypeCreate'])->name('receptionist.complain-type');
        Route::post('complain-type/add', [ComplainTypeController::class, 'complainTypeStore'])->name('receptionist.complain-type/add');
        Route::get('complain-type', [ComplainTypeController::class, 'complainTypeShow'])->name('receptionist.complain-type');
        Route::get('complain-type-edit/{id}', [ComplainTypeController::class, 'complainTypeEdit'])->name('receptionist.complain-type.edit');
        Route::post('complain-type-update/', [ComplainTypeController::class, 'complainTypeUpdate'])->name('receptionist.complain-type.update');
        Route::delete('/complain-type/destroy/{id}', [ComplainTypeController::class, 'complainTypeDestroy'])->name('receptionist.complain-type.destroy');

        //----------------------------------for source--------------
        Route::get('source', [SourceController::class, 'sourceCreate'])->name('receptionist.source');
        Route::post('source/add', [SourceController::class, 'sourceStore'])->name('receptionist.source/add');
        Route::get('source', [SourceController::class, 'sourceShow'])->name('receptionist.source');
        Route::get('source-edit/{id}', [SourceController::class, 'sourceEdit'])->name('receptionist.source.edit');
        Route::post('source-update/', [SourceController::class, 'sourceUpdate'])->name('receptionist.source.update');
        Route::delete('/source/destroy/{id}', [SourceController::class, 'sourceDestroy'])->name('receptionist.source.destroy');

        //----------------------------------for reference--------------
        Route::get('reference', [ReferenceController::class, 'referenceCreate'])->name('receptionist.reference');
        Route::post('reference/add', [ReferenceController::class, 'referenceStore'])->name('receptionist.reference/add');
        Route::get('reference', [ReferenceController::class, 'referenceShow'])->name('receptionist.reference');
        Route::get('reference-edit/{id}', [ReferenceController::class, 'referenceEdit'])->name('receptionist.reference.edit');
        Route::post('reference-update/', [ReferenceController::class, 'referenceUpdate'])->name('receptionist.reference.update');
        Route::delete('/reference/destroy/{id}', [ReferenceController::class, 'referenceDestroy'])->name('receptionist.reference.destroy');

        //----------------------------------for admission inquiry--------------
        Route::get('admission-inquiry', [AdmissionInquiryController::class, 'admissionInquiryCreate'])->name('receptionist.admission-inquiry');
        Route::post('admission-inquiry/add', [AdmissionInquiryController::class, 'admissionInquiryStore'])->name('receptionist.admission-inquiry/add');
        Route::get('admission-inquiry/view', [AdmissionInquiryController::class, 'admissionInquiryShow'])->name('receptionist.admission-inquiry');
        Route::get('admission-inquiry-edit/{id}', [AdmissionInquiryController::class, 'admissionInquiryEdit'])->name('receptionist.admission-inquiry.edit');
        Route::post('admission-inquiry-update/', [AdmissionInquiryController::class, 'admissionInquiryUpdate'])->name('receptionist.admission-inquiry.update');
        Route::delete('/admission-inquiry/destroy/{id}', [AdmissionInquiryController::class, 'admissionInquiryDestroy'])->name('receptionist.admission-inquiry.destroy');

        //----------------------------------for visitor book----------------
        Route::get('visitor-book', [VisitorController::class, 'visitorCreate'])->name('receptionist.visitor-book');
        Route::post('visitor-book/add', [VisitorController::class, 'visitorStore'])->name('receptionist.visitor-book/add');
        Route::get('visitor-book/view', [VisitorController::class, 'visitorShow'])->name('receptionist.visitor-book');
        Route::get('visitor-book-edit/{id}', [VisitorController::class, 'visitorEdit'])->name('receptionist.visitor-book.edit');
        Route::post('visitor-book-update/', [VisitorController::class, 'visitorUpdate'])->name('receptionist.visitor-book.update');
        Route::delete('/visitor-book/destroy/{id}', [VisitorController::class, 'visitorDestroy'])->name('receptionist.visitor-book.destroy');

        //----------------------------------for phone call log--------------
        Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogCreate'])->name('receptionist.phone-call-log');
        Route::post('phone-call-log/add', [PhoneCallLogController::class, 'phoneCallLogStore'])->name('receptionist.phone-call-log/add');
        Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogShow'])->name('receptionist.phone-call-log');
        Route::get('phone-call-log-edit/{id}', [PhoneCallLogController::class, 'phoneCallLogEdit'])->name('receptionist.phone-call-log.edit');
        Route::post('phone-call-log-update/', [PhoneCallLogController::class, 'phoneCallLogUpdate'])->name('receptionist.phone-call-log.update');
        Route::delete('/phone-call-log/destroy/{id}', [PhoneCallLogController::class, 'phoneCallLogDestroy'])->name('receptionist.phone-call-log.destroy');

        //----------------------------------for postal dispatch--------------
        Route::get('postal-dispatch', [PostalDispatchController::class, 'create'])->name('receptionist.postal-dispatch');
        Route::post('postal-dispatch/add', [PostalDispatchController::class, 'store'])->name('receptionist.postal-dispatch/add');
        Route::get('postal-dispatch/view', [PostalDispatchController::class, 'show'])->name('receptionist.postal-dispatch');
        Route::get('postal-dispatch/{id}', [PostalDispatchController::class, 'edit'])->name('receptionist.postal-dispatch.edit');
        Route::post('postal-dispatch-update/', [PostalDispatchController::class, 'update'])->name('receptionist.postal-dispatch.update');
        Route::delete('/postal-dispatch/destroy/{id}', [PostalDispatchController::class, 'destroy'])->name('receptionist.postal-dispatch.destroy');

        //----------------------------------for postal receive--------------
        Route::get('postal-receive', [PostalReceiveController::class, 'postalReceiveCreate'])->name('receptionist.postal-receive');
        Route::post('postal-receive/add', [PostalReceiveController::class, 'postalReceiveStore'])->name('receptionist.postal-receive/add');
        Route::get('postal-receive/view', [PostalReceiveController::class, 'postalReceiveShow'])->name('receptionist.postal-receive');
        Route::get('postal-receive-edit/{id}', [PostalReceiveController::class, 'postalReceiveEdit'])->name('receptionist.postal-receive.edit');
        Route::post('postal-receive-update/', [PostalReceiveController::class, 'postalReceiveUpdate'])->name('receptionist.postal-receive.update');
        Route::delete('/postal-receive/destroy/{id}', [PostalReceiveController::class, 'postalReceiveDestroy'])->name('receptionist.postal-receive.destroy');

        //----------------------------------for complain--------------
        Route::get('complain', [ComplainController::class, 'complainCreate'])->name('receptionist.complain');
        Route::post('complain/add', [ComplainController::class, 'complainStore'])->name('receptionist.complain/add');
        Route::get('complain/view', [ComplainController::class, 'complainShow'])->name('receptionist.complain');
        Route::get('complain-edit/{id}', [ComplainController::class, 'complainEdit'])->name('receptionist.complain.edit');
        Route::post('complain-update/', [ComplainController::class, 'complainUpdate'])->name('receptionist.complain.update');
        Route::delete('/complain/destroy/{id}', [ComplainController::class, 'complainDestroy'])->name('receptionist.complain.destroy');

        /*Apply Leave*/
        Route::resource('apply_leave', 'ApplyLeaveController', [
            'names' => [
                'index' => 'receptionist.apply_leave.index',
                'create' => 'receptionist.apply_leave.create',
                'store' => 'receptionist.apply_leave.store',
                'edit' => 'receptionist.apply_leave.edit',
                'update' => 'receptionist.apply_leave.update',
                'destroy' => 'receptionist.apply_leave.destroy',
            ]
        ]);
    });});
