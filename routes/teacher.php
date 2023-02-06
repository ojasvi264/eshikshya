<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\Auth\LoginController;
use App\Http\Controllers\Teacher\SessionController;
use App\Http\Controllers\Teacher\SessionClassController;
use App\Http\Controllers\Teacher\EclassController;
use App\Http\Controllers\Teacher\SectionController;
use App\Http\Controllers\Teacher\SubjectController;
use App\Http\Controllers\Teacher\CategoryController;
use App\Http\Controllers\Teacher\CalendarController;
use App\Http\Controllers\Teacher\NoticeController;
use App\Http\Controllers\Teacher\FeedController;
use App\Http\Controllers\Teacher\ClassScheduleController;
use App\Http\Controllers\Teacher\ExaminationTypeController;
use App\Http\Controllers\Teacher\ExaminationGroupController;
use App\Http\Controllers\Teacher\GradeController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\Teacher\ManageSyllabusStatusController;
use App\Http\Controllers\Teacher\ManageLessonPlanController;
use App\Http\Controllers\Teacher\HomeworkController;

Route::group(['prefix' => 'teacher'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest:staff');
    Route::post('login', [LoginController::class, 'login'])->name('teacher.login')->middleware('guest:staff');
    Route::post('logout', [LoginController::class, 'logout'])->name('teacher.logout');

    Route::group(['middleware' => 'teacher'], function(){
        Route::get('/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');

        //----------------------------------for session--------------
        Route::get('session', [SessionController::class, 'create'])->name('teacher.session');
        Route::post('session/add', [SessionController::class, 'store'])->name('teacher.session/add');
        Route::get('session', [SessionController::class, 'show'])->name('teacher.session');
        Route::get('session-edit/{id}', [SessionController::class, 'edit'])->name('teacher.session.edit');
        Route::post('session-update/', [SessionController::class, 'update'])->name('teacher.session.update');
        Route::delete('/session/destroy/{id}', [SessionController::class, 'destroy'])->name('teacher.session.destroy');

        //----------------------------------for eclass--------------
        Route::get('class', [EclassController::class, 'classCreate'])->name('teacher.class');
        Route::post('class/add', [EclassController::class, 'classStore'])->name('teacher.class/add');
        Route::get('class', [EclassController::class, 'classShow'])->name('teacher.class');
        Route::get('class-edit/{id}', [EclassController::class, 'classEdit'])->name('teacher.class.edit');
        Route::post('class-update/', [EclassController::class, 'classUpdate'])->name('teacher.class.update');
        Route::delete('/class/destroy/{id}', [EclassController::class, 'classDestroy'])->name('teacher.class.destroy');

        //----------------------------------for section--------------
        Route::get('section', [SectionController::class, 'sectionCreate'])->name('teacher.section');
        Route::post('section/add', [SectionController::class, 'sectionStore'])->name('teacher.section/add');
        Route::get('section/view', [SectionController::class, 'classDropDownShow'])->name('teacher.section');
        Route::get('section-edit/{id}', [SectionController::class, 'sectionEdit'])->name('teacher.section.edit');
        Route::post('section-update/', [SectionController::class, 'sectionUpdate'])->name('teacher.section.update');
        Route::delete('/section/destroy/{id}', [SectionController::class, 'sectionDestroy'])->name('teacher.section.destroy');

        //----------------------------------for session class--------------
        Route::get('session-class', [SessionClassController::class, 'create'])->name('teacher.session-class');
        Route::post('session-class/add', [SessionClassController::class, 'store'])->name('teacher.session-class/add');
        Route::get('session-class/view', [SessionClassController::class, 'show'])->name('teacher.session-class');
        Route::get('session-class-edit/{id}', [SessionClassController::class, 'edit'])->name('teacher.session-class.edit');
        Route::post('session-class-update/', [SessionClassController::class, 'update'])->name('teacher.session-class.update');
        Route::delete('/session-class/destroy/{id}', [SessionClassController::class, 'destroy'])->name('teacher.session-class.destroy');

        //----------------------------------for subject--------------
        Route::get('subject', [SubjectController::class, 'subjectCreate'])->name('teacher.subject');
        Route::post('subject/add', [SubjectController::class, 'subjectStore'])->name('teacher.subject/add');
        Route::get('subject/view', [SubjectController::class, 'classDropDownShow'])->name('teacher.subject');
        Route::get('subject-edit/{id}', [SubjectController::class, 'subjectEdit'])->name('teacher.subject.edit');
        Route::post('subject-update/', [SubjectController::class, 'subjectUpdate'])->name('teacher.subject.update');
        Route::delete('/subject/destroy/{id}', [SubjectController::class, 'subjectDestroy'])->name('teacher.subject.destroy');
//        Route::get('subject', [SubjectController::class, 'subjectShow'])->name('subject');

        //----------------------------------for group--------------
//        Route::get('group', [GroupController::class, 'groupCreate'])->name('group');
//        Route::post('group/add', [GroupController::class, 'groupStore'])->name('group/add');
//        Route::get('group/view', [GroupController::class, 'dropDownShow'])->name('group');
//        Route::get('group-edit/{id}', [GroupController::class, 'groupEdit'])->name('group.edit');
//        Route::post('group-update/', [GroupController::class, 'groupUpdate'])->name('group.update');
//        Route::delete('/group/destroy/{id}', [GroupController::class, 'groupDestroy'])->name('group.destroy');
////    Route::get('getGroups/{id}', [GroupController::class, 'getGroups'])->name('get_groups');
//        Route::get('group', [GroupController::class, 'groupShow'])->name('group');

        //----------------------------------for category--------------
        Route::get('category', [CategoryController::class, 'categoryCreate'])->name('teacher.category');
        Route::post('category/add', [CategoryController::class, 'categoryStore'])->name('teacher.category/add');
        Route::get('category/view', [CategoryController::class, 'dropDownShow'])->name('teacher.category');
        Route::get('category-edit/{id}', [CategoryController::class, 'categoryEdit'])->name('teacher.category.edit');
        Route::post('category-update/', [CategoryController::class, 'categoryUpdate'])->name('teacher.category.update');
        Route::delete('/category/destroy/{id}', [CategoryController::class, 'categoryDestroy'])->name('teacher.category.destroy');

        //----------------------------------for student--------------
        Route::get('student', [StudentController::class, 'studentCreate'])->name('teacher.student');
        Route::post('student/add', [StudentController::class, 'studentStore'])->name('teacher.student/add');
        Route::get('student/view', [StudentController::class, 'dropDownShow'])->name('teacher.student');
        Route::get('student-edit/{id}', [StudentController::class, 'studentEdit'])->name('teacher.student.edit');
        Route::post('student-update/', [StudentController::class, 'studentUpdate'])->name('teacher.student.update');
        Route::delete('/student/destroy/{id}', [StudentController::class, 'studentDestroy'])->name('teacher.student.destroy');

        //----------------------------------for academic calendar--------------
        Route::get('academic-calendar', [CalendarController::class, 'calendarCreate'])->name('teacher.academic-calendar');
        Route::post('academic-calendar/add', [CalendarController::class, 'calendarStore'])->name('teacher.academic-calendar/add');
        Route::get('academic-calendar/view', [CalendarController::class, 'calendarShow'])->name('teacher.academic-calendar');
        Route::get('academic-calendar-edit/{id}', [CalendarController::class, 'calendarEdit'])->name('teacher.academic-calendar.edit');
        Route::post('academic-calendar-update/', [CalendarController::class, 'calendarUpdate'])->name('teacher.academic-calendar.update');
        Route::delete('/academic-calendar/destroy/{id}', [CalendarController::class, 'calendarDestroy'])->name('teacher.academic-calendar.destroy');

        //----------------------------------for notice--------------
//        Route::get('notice', [NoticeController::class, 'noticeCreate'])->name('teacher.notice');
//        Route::post('notice/add', [NoticeController::class, 'noticeStore'])->name('teacher.notice/add');
//        Route::get('notice/view', [NoticeController::class, 'dropDownShow'])->name('teacher.notice');
//        Route::get('notice-edit/{id}', [NoticeController::class, 'noticeEdit'])->name('teacher.notice.edit');
//        Route::post('notice-update/', [NoticeController::class, 'noticeUpdate'])->name('teacher.notice.update');
//        Route::delete('/notice/destroy/{id}', [NoticeController::class, 'noticeDestroy'])->name('teacher.notice.destroy');

        //----------------------------------for feed--------------
        Route::get('feed', [FeedController::class, 'feedCreate'])->name('teacher.feed');
        Route::post('feed/add', [FeedController::class, 'feedStore'])->name('teacher.feed/add');
        Route::get('feed/view', [FeedController::class, 'feedShow'])->name('teacher.feed');
        Route::get('feed/edit/{id}', [FeedController::class, 'feedEdit'])->name('teacher.feed.edit');
        Route::post('feed/update/', [FeedController::class, 'feedUpdate'])->name('teacher.feed.update');
        Route::delete('/feed/destroy/{id}', [FeedController::class, 'feedDestroy'])->name('teacher.feed.destroy');

        //----------------------------------for class schedule--------------
        Route::get('class-schedule', [ClassScheduleController::class, 'scheduleCreate'])->name('teacher.class-schedule');
        Route::post('class-schedule/add', [ClassScheduleController::class, 'scheduleStore'])->name('teacher.class-schedule/add');
        Route::get('class-schedule/view', [ClassScheduleController::class, 'dropDownShow'])->name('teacher.class-schedule');
        Route::get('class-schedule-edit/{id}', [ClassScheduleController::class, 'scheduleEdit'])->name('teacher.class-schedule.edit');
        Route::post('class-schedule-update/', [ClassScheduleController::class, 'scheduleUpdate'])->name('teacher.class-schedule.update');
        Route::delete('/class-schedule/destroy/{id}', [ClassScheduleController::class, 'scheduleDestroy'])->name('teacher.class-schedule.destroy');

        //----------------------------------for exam type--------------
        Route::get('exam-type', [ExaminationTypeController::class, 'examinationCreate'])->name('teacher.exam-type');
        Route::post('exam-type/add', [ExaminationTypeController::class, 'examinationStore'])->name('teacher.exam-type/add');
        Route::get('exam-type/view', [ExaminationTypeController::class, 'examinationShow'])->name('teacher.exam-type');
        Route::get('/exam-type/edit/{id}', [ExaminationTypeController::class, 'examinationEdit'])->name('teacher.exam-type.edit');
        Route::post('/exam-type/update/', [ExaminationTypeController::class, 'examinationUpdate'])->name('teacher.exam-type.update');
        Route::delete('/exam-type/destroy/{id}', [ExaminationTypeController::class, 'examinationDestroy'])->name('teacher.exam-type.destroy');

        //----------------------------------for exam group--------------
        Route::get('exam-group', [ExaminationGroupController::class, 'examinationGroupCreate'])->name('teacher.exam-group');
        Route::post('exam-group/add', [ExaminationGroupController::class, 'examinationStore'])->name('teacher.exam-group/add');
        Route::get('exam-group/view', [ExaminationGroupController::class, 'dropDownShow'])->name('teacher.exam-group');
        Route::get('/exam-group/edit/{id}', [ExaminationGroupController::class, 'examinationGroupEdit'])->name('teacher.exam-group.edit');
        Route::get('/exam-group/assign/{id}', [ExaminationGroupController::class, 'examinationGroupAssign'])->name('teacher.exam-group.assign');
        Route::post('/exam-group/update/', [ExaminationGroupController::class, 'examinationGroupUpdate'])->name('teacher.exam-group.update');
        Route::delete('/exam-group/destroy/{id}', [ExaminationGroupController::class, 'examinationGroupDestroy'])->name('teacher.exam-group.destroy');
        Route::get('getExam/{id}', [ExaminationGroupController::class, 'getExam'])->name('get_exam');
        Route::get('exam-group/class', [ExaminationGroupController::class, 'index'])->name('exam-group/class');

        //----------------------------------for marks grade--------------
        Route::get('grade', [GradeController::class, 'gradeCreate'])->name('teacher.grade');
        Route::post('grade/add', [GradeController::class, 'gradeStore'])->name('teacher.grade/add');
        Route::get('grade/view', [GradeController::class, 'dropDownShow'])->name('teacher.grade');
        Route::get('/grade/edit/{id}', [GradeController::class, 'gradeEdit'])->name('teacher.grade.edit');
        Route::post('/grade/update/', [GradeController::class, 'gradeUpdate'])->name('teacher.grade.update');
        Route::delete('/grade/destroy/{id}', [GradeController::class, 'gradeDestroy'])->name('teacher.grade.destroy');

        //----------------------------------for lesson plan--------------
        /*Lesson*/
        Route::resource('lesson', 'LessonController',[
            'names' => [
                'index' => 'teacher.lesson.index',
                'create' => 'teacher.lesson.create',
                'store' => 'teacher.lesson.store',
                'edit' => 'teacher.lesson.edit',
                'update' => 'teacher.lesson.update',
                'destroy' => 'teacher.lesson.destroy',
            ]
        ]);

        /*Topic*/
        Route::resource('topic', 'TopicController', [
            'names' => [
                'index' => 'teacher.topic.index',
                'create' => 'teacher.topic.create',
                'store' => 'teacher.topic.store',
                'edit' => 'teacher.topic.edit',
                'update' => 'teacher.topic.update',
                'destroy' => 'teacher.topic.destroy',
            ]
        ]);

//        Route::get('getSubjectLessons/{id}', [LessonController::class, 'getSubjectLessons'])->name('get_subject_lessons');

        /*Manage Syllabus Status*/
        Route::get('get_lessons/search', [ManageSyllabusStatusController::class, 'getLessons'])->name('teacher.get_lessons.search');
        Route::get('manage-syllabus-status', [ManageSyllabusStatusController::class, 'index'])->name('teacher.manage_syllabus_status.index');

        /*Manage Lesson Plan*/
        Route::get('manage-lesson-plan', [ManageLessonPlanController::class, 'index'])->name('teacher.manage_lesson_plan.index');
        Route::get('get-teachers/search', [ManageLessonPlanController::class, 'search'])->name('teacher.get_teacher.search');

        /*Apply Leave*/
        Route::resource('apply_leave', 'ApplyLeaveController', [
            'names' => [
                'index' => 'teacher.apply_leave.index',
                'create' => 'teacher.apply_leave.create',
                'store' => 'teacher.apply_leave.store',
                'edit' => 'teacher.apply_leave.edit',
                'update' => 'teacher.apply_leave.update',
                'destroy' => 'teacher.apply_leave.destroy',
            ]
        ]);

        //----------------------------------for homework--------------
        Route::get('homework', [HomeworkController::class, 'homeworkCreate'])->name('teacher.homework');
        Route::post('homework/add', [HomeworkController::class, 'homeworkStore'])->name('teacher.homework/add');
        Route::get('homework/view', [HomeworkController::class, 'homeworkDropDownShow'])->name('teacher.homework');
        Route::get('homework-edit/{id}', [HomeworkController::class, 'homeworkEdit'])->name('teacher.homework.edit');
        Route::get('homework-view/{id}', [HomeworkController::class, 'homeworkSubmissionView'])->name('teacher.homework.view');
        Route::post('homework-update/', [HomeworkController::class, 'homeworkUpdate'])->name('teacher.homework.update');
        Route::delete('/homework/destroy/{id}', [HomeworkController::class, 'homeworkDestroy'])->name('teacher.homework.destroy');
    });
});
//Route::get('/getSections/{id}', [SectionController::class, 'getSections'])->name('get_sections');
//Route::get('/getSubjects/{id}', [SubjectController::class, 'getSubjects'])->name('get_subjects');


