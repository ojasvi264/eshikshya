<?php

use App\Http\Controllers\Librarian\Auth\LoginController;
use App\Http\Controllers\Librarian\DashboardController;
use App\Http\Controllers\Library\IssueReturnController;
use App\Http\Controllers\Library\LibraryStaffMemberController;
use App\Http\Controllers\Library\LibraryStudentMemberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'librarian'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest:staff');
    Route::post('login', [LoginController::class, 'login'])->name('librarian.login')->middleware('guest:staff');
    Route::post('logout', [LoginController::class, 'logout'])->name('librarian.logout');

    Route::group(['middleware' => 'librarian'], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('librarian.dashboard');

        /*Apply Leave*/
        Route::resource('apply_leave', 'ApplyLeaveController', [
            'names' => [
                'index' => 'librarian.apply_leave.index',
                'create' => 'librarian.apply_leave.create',
                'store' => 'librarian.apply_leave.store',
                'edit' => 'librarian.apply_leave.edit',
                'update' => 'librarian.apply_leave.update',
                'destroy' => 'librarian.apply_leave.destroy',
            ]
        ]);

        //----------------------------------For Library--------------
        /*Book*/
        Route::resource('book', 'BookController', [
            'names' => [
                'index' => 'librarian.book.index',
                'create' => 'librarian.book.create',
                'store' => 'librarian.book.store',
                'edit' => 'librarian.book.edit',
                'update' => 'librarian.book.update',
                'destroy' => 'librarian.book.destroy',
            ]
        ]);

        /*Library Staff and Student Member*/
        Route::get('library/staff_member', [LibraryStaffMemberController::class, 'index'])->name('librarian.library_staff_member.index');
//        Route::get('add_library_member/{id}', [LibraryMemberController::class, 'create'])->name('add_library_member');
//        Route::get('remove_member/{id}', [LibraryMemberController::class, 'destroy'])->name('remove_library_member');

        Route::get('library/student_member', [LibraryStudentMemberController::class, 'index'])->name('librarian.library_student_member.index');
        Route::get('get_students/search', [LibraryStudentMemberController::class, 'getStudents'])->name('librarian.get_students.search');

//        /* Add/Remove Completion Date On Library Staff and Student Members */
//        /* Add/Remove Completion Date On Library Staff and Student Members */
//        Route::get('completion_date/{id}', [TopicController::class, 'completionDate'])->name('completion_date');
//        Route::get('remove_completion_date/{id}', [TopicController::class, 'removeCompletionDate'])->name('remove_completion_date');

        /*Issue Return*/
        Route::resource('issue_return', 'IssueReturnController', [
            'names' => [
                'index' => 'librarian.issue_return.index',
                'create' => 'librarian.issue_return.create',
                'store' => 'librarian.issue_return.store',
                'edit' => 'librarian.issue_return.edit',
                'update' => 'librarian.issue_return.update',
                'destroy' => 'librarian.issue_return.destroy',
            ]
        ]);
        Route::get('issue_return/get_library_members/search', [IssueReturnController::class, 'getLibraryMembers'])->name('librarian.get_library_members.search');
//Route::get('issue_return/staff/{id}/detail', [IssueReturnController::class, 'staffIssueReturn'])->name('staff_issue_return.detail');
        Route::get('issue_return/{id}/detail', [IssueReturnController::class, 'issueReturn'])->name('librarian.issue_return.detail');
//        Route::get('getBookQuantity/{id}', [IssueReturnController::class, 'getBookQuantity'])->name('get_book_quantity');
//Route::get('student_return_book/{id}', [IssueReturnController::class, 'studentReturnBook'])->name('student_return_book');
//Route::post('issue_return/store', [IssueReturnController::class, 'store'])->name('issue_return.store');
//        Route::get('return_book/{id}', [IssueReturnController::class, 'returnBook'])->name('return_book');

    });
});

