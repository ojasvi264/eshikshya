<?php

use App\Http\Controllers\Api\Auth\AdminLoginController;
use App\Http\Controllers\Api\Auth\ParentLoginController;
use App\Http\Controllers\Api\Auth\StudentLoginController;
use App\Http\Controllers\Api\Auth\TeacherLoginController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Common\CommonController;
use App\Http\Controllers\Api\Communicate\NoticeBoardController;
use App\Http\Controllers\APi\Homework\HomeworkController;
use App\Http\Controllers\Api\Homework\HomeworkSubmissionController;
use App\Http\Controllers\Super\Academics\CalendarController;
use App\Http\Controllers\Super\Academics\FeedController;
use App\Http\Controllers\Super\Schedule\ClassScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//----------------------------------for login--------------
Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', [AdminLoginController::class, 'adminLogin'])->name('login');
});
Route::group(['prefix' => 'student'], function () {
    Route::post('/login', [StudentLoginController::class, 'studentLogin'])->name('login');
});
Route::group(['prefix' => 'parent'], function () {
    Route::post('/login', [ParentLoginController::class, 'parentLogin'])->name('login');
});
Route::group(['prefix' => 'teacher'], function () {
    Route::post('/login', [TeacherLoginController::class, 'teacherLogin'])->name('login');
});


Route::middleware('auth:sanctum')->group(function () {
    //----------------------------------for profile--------------
    Route::get('/admin/profile', [ProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/teacher/profile', [ProfileController::class, 'teacherProfile'])->name('teacher.profile');
    Route::get('/parent/profile', [ProfileController::class, 'parentProfile'])->name('parents.profile');
    Route::get('/student/profile', [ProfileController::class, 'studentProfile'])->name('student.profile');
    Route::get('/parents-student/profile', [ProfileController::class, 'parentStudentProfile'])->name('parent-student.profile');

    //----------------------------------for logout--------------
    Route::post('/logout', [LogoutController::class, 'apiLogout'])->name('logout');

    //----------------------------------for academic calendar--------------
    Route::post('/calendar/add', [CalendarController::class, 'store'])->name('calendar.add');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::post('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    Route::get('calendar/edit/{id}', [CalendarController::class, 'edit'])->name('calendar.edit');

    //----------------------------------for feed-----------------------
    Route::get('/feed', [FeedController::class, 'index'])->name('feed');
    Route::post('/feed/add', [FeedController::class, 'store'])->name('feed.add');
    Route::post('feed/update/{id}', [FeedController::class, 'update'])->name('feed.update');
    Route::delete('/feed/destroy/{id}', [FeedController::class, 'destroy'])->name('feed.destroy');
    Route::get('/feed/{user_id}', [FeedController::class, 'show'])->name('feed.show');
    Route::get('feed/edit/{id}', [FeedController::class, 'edit'])->name('feed.edit');

    //----------------------------------for class schedule--------------
    Route::get('/class-schedule', [ClassScheduleController::class, 'index'])->name('class-schedule');
    Route::post('/class-schedule/add', [ClassScheduleController::class, 'store'])->name('class-schedule.add');
    Route::post('/class-schedule/update/{id}', [ClassScheduleController::class, 'update'])->name('class-schedule.update');
    Route::delete('/class-schedule/destroy/{id}', [ClassScheduleController::class, 'destroy'])->name('class-schedule.destroy');
    Route::get('class-schedule-edit/{id}', [ClassScheduleController::class, 'edit'])->name('class-schedule.edit');

    //----------------------------------for NoticeBoard--------------
    Route::get('/notice-board', [NoticeBoardController::class, 'index'])->name('notice-board');
    Route::post('/notice-board/add', [NoticeBoardController::class, 'store'])->name('notice-board.add');
    Route::post('/notice-board/update/{id}', [NoticeBoardController::class, 'update'])->name('notice-board.update');
    Route::delete('/notice-board/destroy/{id}', [NoticeBoardController::class, 'destroy'])->name('notice.board.destroy');

    //----------------------------------for homework--------------
    Route::get('/homework', [HomeworkController::class, 'index'])->name('homework');
    Route::post('/homework/add', [HomeworkController::class, 'store'])->name('homework.add');
    Route::post('/homework/search', [HomeworkController::class, 'show'])->name('homework.search');
    Route::get('/homework-edit/{id}', [HomeworkController::class, 'edit'])->name('homework.edit');
    Route::post('/homework/update/{id}', [HomeworkController::class, 'update'])->name('homework.update');
    Route::delete('/homework/destroy/{id}', [HomeworkController::class, 'destroy'])->name('homework.destroy');

    //----------------------------------for homework submission--------------
    Route::post('/homework/search', [HomeworkSubmissionController::class, 'homeworkSearch'])->name('homework.search');
    Route::post('/homework-submission/submit/{homework_id}', [HomeworkSubmissionController::class, 'homeworkSubmission'])->name('homework.submit');
    Route::get('/homework-submission/{homework_id}', [HomeworkSubmissionController::class, 'index'])->name('homework-submission');
    Route::post('homework-submission/update/{homework_id}/{id}', [HomeworkSubmissionController::class, 'homeworkSubmissionUpdate'])->name('homework-submission.update');
    Route::delete('/homework-submission/destroy/{id}', [HomeworkSubmissionController::class, 'destroy'])->name('homework-submission.destroy');


    //----------------------------------get class section subject--------------
    Route::get('/class', [CommonController::class, 'getClass'])->name('class');
    Route::get('/section', [CommonController::class, 'getSection'])->name('section');
    Route::get('/subject', [CommonController::class, 'getSubject'])->name('subject');
    Route::get('class-section/{id}', [CommonController::class, 'getClassSection'])->name('class.section');
    Route::get('class-subject/{id}', [CommonController::class, 'getClassSubject'])->name('class.subject');
});

