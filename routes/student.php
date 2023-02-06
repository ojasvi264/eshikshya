<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Homework\HomeworkSubmissionController;

Route::group(['prefix' => 'student'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest:student');
    Route::post('login', [LoginController::class, 'login'])->name('student.login')->middleware('guest:staff');
    Route::post('logout', [LoginController::class, 'logout'])->name('student.logout');

    Route::group(['middleware' => 'student'], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');

        /*Apply Leave*/
        Route::resource('leave_request', 'LeaveRequestController', [
            'names' => [
                'index' => 'student.leave_request.index',
                'create' => 'student.leave_request.create',
                'store' => 'student.leave_request.store',
                'edit' => 'student.leave_request.edit',
                'update' => 'student.leave_request.update',
                'destroy' => 'student.leave_request.destroy',
            ]
        ]);

        /*Teacher Rating*/
        Route::resource('teacher_rating', 'TeacherRatingController', [
            'names' => [
                'index' => 'student.teacher_rating.index',
                'create' => 'student.teacher_rating.create',
                'store' => 'student.teacher_rating.store',
                'edit' => 'student.teacher_rating.edit',
                'update' => 'student.teacher_rating.update',
                'destroy' => 'student.teacher_rating.destroy',
            ]
        ]);

        //----------------------------------for homework submission--------------
        Route::get('homework-submission/{id}', [HomeworkSubmissionController::class, 'submissionUpload'])->name('student.homework.upload');
        Route::get('homework', [HomeworkSubmissionController::class, 'getHomework'])->name('student.homework.get');
        Route::get('homework-submission/{id}', [HomeworkSubmissionController::class, 'homeworkDetail'])->name('student.homework-submission');
        Route::post('homework-submission/submit/', [HomeworkSubmissionController::class, 'homeworkSubmit'])->name('student.homework.submit');
        Route::get('homework-submission/view/{id}', [HomeworkSubmissionController::class, 'userSubmissionShow'])->name('student.homework-submission.show');
        Route::get('homework-submission/edit/{id}', [HomeworkSubmissionController::class, 'submissionEdit'])->name('student.homework-submission.edit');
        Route::get('homework-submission/update/', [HomeworkSubmissionController::class, 'submissionUpdate'])->name('student.homework-submission.update');
        Route::delete('/homework-submission/destroy/{id}', [HomeworkSubmissionController::class, 'submissionDestroy'])->name('student.homework-submission.destroy');
    });

});
