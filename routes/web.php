<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\HumanResource\StaffDirectoryController;
use App\Http\Controllers\Inventory\IssueItemController;
use App\Http\Controllers\Inventory\ItemController;
use App\Http\Controllers\Inventory\ItemStockController;
use App\Http\Controllers\LessonPlans\LessonController;
use App\Http\Controllers\LessonPlans\TopicController;
use App\Http\Controllers\Library\IssueReturnController;
use App\Http\Controllers\Library\LibraryMemberController;
use App\Http\Controllers\Super\Academics\SectionController;
use App\Http\Controllers\Super\Academics\SubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'super','middleware' => ['XSS']], function () {
    Auth::routes(['register' => false]);
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//---------------------------CommonRoutes-----------------
Route::get('class/sections/{class_id}', [CommonController::class, 'getClassSectionInDropDown']);
Route::get('get/exams/{exam_type_id}', [CommonController::class, 'getExam']);
Route::get('class/sections/checkbox/{class_id}', [CommonController::class, 'getClassSectionInCheckbox']);
Route::get('class/subjects/{class_id}/{exam_id}', [CommonController::class, 'getClassSubjectInDropDown']);
Route::get('class/sections/{class_id}/{exam_id}', [CommonController::class, 'getClassSectionInDropDownByExam']);
Route::get('answer/field/{question_type}', [CommonController::class, 'getAnswerField']);
Route::get('subject/field/{section_id}', [CommonController::class, 'getSubjectField']);
Route::post('question/add', [CommonController::class, 'questionAdd'])->name('online.question.add');
Route::post('get/student', [CommonController::class, 'getStudent'])->name('get.student');
Route::post('assign/stuent', [CommonController::class, 'assignStudent'])->name('online.assign.student');
Route::get('section/students/{section_id}', [CommonController::class, 'getStudentBySection']);
Route::get('get/invoice/field/{class_id}/{section_id}', [CommonController::class, 'getInvoiceField']);
Route::get('data/{message_to_type}', [CommonController::class, 'getData']);
Route::get('class/subjects/{class_id}', [CommonController::class, 'getClassSubjects']);
Route::get('getExams/{class_id}', [CommonController::class, 'getExams']);
Route::get('getSchedules', [CommonController::class, 'getSchedules']);

Route::get('getSections/{id}', [SectionController::class, 'getSections'])->name('get_sections');
Route::get('getSubjects/{id}', [SubjectController::class, 'getSubjects'])->name('get_subjects');
Route::get('add_library_member/{id}', [LibraryMemberController::class, 'create'])->name('add_library_member');
Route::get('remove_member/{id}', [LibraryMemberController::class, 'destroy'])->name('remove_library_member');
Route::get('return_book/{id}', [IssueReturnController::class, 'returnBook'])->name('return_book');
Route::get('getBookQuantity/{id}', [IssueReturnController::class, 'getBookQuantity'])->name('get_book_quantity');
Route::get('disable_staff_status/{id}', [StaffDirectoryController::class, 'disableStaff'])->name('disable_staff_status');
Route::get('enable_staff_status/{id}', [StaffDirectoryController::class, 'enableStaff'])->name('enable_staff_status');
Route::get('item_categories/{id}', [ItemController::class, 'getItemCategories'])->name('get_categories');
Route::get('get_staffs/{id}', [StaffDirectoryController::class, 'getStaffs'])->name('get_staffs');
Route::get('item_quantity/{id}', [ItemStockController::class, 'getQuantity'])->name('get_quantity');
Route::get('return_item/{id}', [IssueItemController::class, 'returnItem'])->name('return_item');
Route::get('getSubjectLessons/{id}', [LessonController::class, 'getSubjectLessons'])->name('get_subject_lessons');
Route::get('changeLeaveStatus/{id}', [\App\Http\Controllers\HumanResource\LeaveRequestController::class, 'changeStatus'])->name('change_leave_status');

/* Add/Remove Completion Date On Library Staff and Student Members */
Route::get('completion_date/{id}', [TopicController::class, 'completionDate'])->name('completion_date');
Route::get('remove_completion_date/{id}', [TopicController::class, 'removeCompletionDate'])->name('remove_completion_date');
Route::get('collect_fee/student/{id}', [\App\Http\Controllers\Super\Fee\CollectFeeController::class, 'collectFee'])->name('student.collect_fee');

Route::post('paid_fee/store', [\App\Http\Controllers\Super\Fee\CollectFeeController::class, 'paidFee'])->name('paid_fee.store');



//Route::group(['prefix' => 'admin'], function() {
//    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->middleware('guest:staff');
//    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login')->middleware('guest:staff');
//    Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
//
//    Route::group(['middleware' => 'admin'], function(){
//        Route::get('/dashboard', [App\Http\Controllers\Admin\Auth\LoginController::class, 'index'])->name('admin.dashboard');
//    });
//
//});

/*Student Middleware*/
//Route::group(['prefix' => 'student','middleware' => 'student'], function() {
//    Route::get('login', [App\Http\Controllers\Student\Auth\LoginController::class, 'showLoginForm'])->middleware('guest:student');
//    Route::post('login', [App\Http\Controllers\Student\Auth\LoginController::class, 'login'])->name('student.login')->middleware('guest:student');
//    Route::post('logout', [App\Http\Controllers\Student\Auth\LoginController::class, 'logout'])->name('student.logout');
//    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
//

//});

/*Teacher Middleware*/
//Route::group(['prefix' => 'teacher'], function() {
//    Route::get('login', [App\Http\Controllers\Teacher\Auth\LoginController::class, 'showLoginForm'])->middleware('guest:staff');
//    Route::post('login', [App\Http\Controllers\Teacher\Auth\LoginController::class, 'login'])->name('teacher.login')->middleware('guest:staff');
//    Route::post('logout', [App\Http\Controllers\Teacher\Auth\LoginController::class, 'logout'])->name('teacher.logout');
//
//    Route::group(['middleware' => 'teacher'], function(){
//        Route::get('/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');
//    });
//});

/*Accountant Middleware*/
//Route::group(['prefix' => 'accountant'], function() {
//    Route::get('login', [App\Http\Controllers\Accountant\Auth\LoginController::class, 'showLoginForm'])->middleware('guest:staff');
//    Route::post('login', [App\Http\Controllers\Accountant\Auth\LoginController::class, 'login'])->name('accountant.login')->middleware('guest:staff');
//    Route::post('logout', [App\Http\Controllers\Accountant\Auth\LoginController::class, 'logout'])->name('accountant.logout');
//
//    Route::group(['middleware' => 'accountant'], function(){
//        Route::get('/dashboard', [App\Http\Controllers\Accountant\DashboardController::class, 'index'])->name('accountant.dashboard');
//    });
//});

/*Parent Middleware*/
//Route::group(['prefix' => 'parent','middleware' => 'parent'], function() {
//    Route::get('login', [App\Http\Controllers\Parent\Auth\LoginController::class, 'showLoginForm'])->middleware('guest:parent');
//    Route::post('login', [App\Http\Controllers\Parent\Auth\LoginController::class, 'login'])->name('parent.login')->middleware('guest:parent');
//    Route::post('logout', [App\Http\Controllers\Parent\Auth\LoginController::class, 'logout'])->name('parent.logout');
//    Route::get('/dashboard', [App\Http\Controllers\Parent\DashboardController::class, 'index'])->name('parent.dashboard');
//});
