<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ManageSyllabusStatusController;
use App\Http\Controllers\Admin\ManageLessonPlanController;
use App\Http\Controllers\StaffDirectoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemStockController;
use \App\Http\Controllers\IssueItemController;
use App\Http\Controllers\LibraryStaffMemberController;
use App\Http\Controllers\LibraryMemberController;
use App\Http\Controllers\LibraryStudentMemberController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\IssueReturnController;
use App\Http\Controllers\Admin\PurposeController;
use App\Http\Controllers\Admin\ComplainTypeController;
use App\Http\Controllers\Admin\SourceController;
use App\Http\Controllers\Admin\ReferenceController;
use App\Http\Controllers\Admin\AdmissionInquiryController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\PhoneCallLogController;
use App\Http\Controllers\Admin\PostalDispatchController;
use App\Http\Controllers\Admin\PostalReceiveController;
use App\Http\Controllers\Admin\ComplainController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\SessionClassController;
use App\Http\Controllers\Admin\EclassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\StudentController;
//use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CalendarController;
//use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\FeedController;
use App\Http\Controllers\Admin\ClassScheduleController;
use App\Http\Controllers\Admin\ExaminationTypeController;
use App\Http\Controllers\Admin\ExaminationGroupController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\HomeworkController;
use App\Http\Controllers\Admin\HomeworkSubmissionController;

Route::group(['prefix' => 'admin'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest:staff');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login')->middleware('guest:staff');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => 'admin'], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        //----------------------------------for purpose--------------
        Route::get('/purpose', [PurposeController::class, 'purposeCreate'])->name('admin.purpose');
        Route::post('/purpose/add', [PurposeController::class, 'purposeStore'])->name('admin.purpose.add');
        Route::get('/purpose', [PurposeController::class, 'purposeShow'])->name('admin.purpose');
        Route::get('purpose-edit/{id}', [PurposeController::class, 'purposeEdit'])->name('admin.purpose.edit');
        Route::post('purpose-update/', [PurposeController::class, 'purposeUpdate'])->name('admin.purpose.update');
        Route::delete('/purpose/destroy/{id}', [PurposeController::class, 'purposeDestroy'])->name('admin.purpose.destroy');

        //----------------------------------for complain type--------------
        Route::get('complain-type', [ComplainTypeController::class, 'complainTypeCreate'])->name('admin.complain-type');
        Route::post('complain-type/add', [ComplainTypeController::class, 'complainTypeStore'])->name('admin.complain-type/add');
        Route::get('complain-type', [ComplainTypeController::class, 'complainTypeShow'])->name('admin.complain-type');
        Route::get('complain-type-edit/{id}', [ComplainTypeController::class, 'complainTypeEdit'])->name('admin.complain-type.edit');
        Route::post('complain-type-update/', [ComplainTypeController::class, 'complainTypeUpdate'])->name('admin.complain-type.update');
        Route::delete('/complain-type/destroy/{id}', [ComplainTypeController::class, 'complainTypeDestroy'])->name('admin.complain-type.destroy');

        //----------------------------------for source--------------
        Route::get('source', [SourceController::class, 'sourceCreate'])->name('admin.source');
        Route::post('source/add', [SourceController::class, 'sourceStore'])->name('admin.source/add');
        Route::get('source', [SourceController::class, 'sourceShow'])->name('admin.source');
        Route::get('source-edit/{id}', [SourceController::class, 'sourceEdit'])->name('admin.source.edit');
        Route::post('source-update/', [SourceController::class, 'sourceUpdate'])->name('admin.source.update');
        Route::delete('/source/destroy/{id}', [SourceController::class, 'sourceDestroy'])->name('admin.source.destroy');

        //----------------------------------for reference--------------
        Route::get('reference', [ReferenceController::class, 'referenceCreate'])->name('admin.reference');
        Route::post('reference/add', [ReferenceController::class, 'referenceStore'])->name('admin.reference/add');
        Route::get('reference', [ReferenceController::class, 'referenceShow'])->name('admin.reference');
        Route::get('reference-edit/{id}', [ReferenceController::class, 'referenceEdit'])->name('admin.reference.edit');
        Route::post('reference-update/', [ReferenceController::class, 'referenceUpdate'])->name('admin.reference.update');
        Route::delete('/reference/destroy/{id}', [ReferenceController::class, 'referenceDestroy'])->name('admin.reference.destroy');

        //----------------------------------for admission inquiry--------------
        Route::get('admission-inquiry', [AdmissionInquiryController::class, 'admissionInquiryCreate'])->name('admin.admission-inquiry');
        Route::post('admission-inquiry/add', [AdmissionInquiryController::class, 'admissionInquiryStore'])->name('admin.admission-inquiry/add');
        Route::get('admission-inquiry/view', [AdmissionInquiryController::class, 'admissionInquiryShow'])->name('admin.admission-inquiry');
        Route::get('admission-inquiry-edit/{id}', [AdmissionInquiryController::class, 'admissionInquiryEdit'])->name('admin.admission-inquiry.edit');
        Route::post('admission-inquiry-update/', [AdmissionInquiryController::class, 'admissionInquiryUpdate'])->name('admin.admission-inquiry.update');
        Route::delete('/admission-inquiry/destroy/{id}', [AdmissionInquiryController::class, 'admissionInquiryDestroy'])->name('admin.admission-inquiry.destroy');

        //----------------------------------for visitor book----------------
        Route::get('visitor-book', [VisitorController::class, 'visitorCreate'])->name('admin.visitor-book');
        Route::post('visitor-book/add', [VisitorController::class, 'visitorStore'])->name('admin.visitor-book/add');
        Route::get('visitor-book/view', [VisitorController::class, 'visitorShow'])->name('admin.visitor-book');
        Route::get('visitor-book-edit/{id}', [VisitorController::class, 'visitorEdit'])->name('admin.visitor-book.edit');
        Route::post('visitor-book-update/', [VisitorController::class, 'visitorUpdate'])->name('admin.visitor-book.update');
        Route::delete('/visitor-book/destroy/{id}', [VisitorController::class, 'visitorDestroy'])->name('admin.visitor-book.destroy');

        //----------------------------------for phone call log--------------
        Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogCreate'])->name('admin.phone-call-log');
        Route::post('phone-call-log/add', [PhoneCallLogController::class, 'phoneCallLogStore'])->name('admin.phone-call-log/add');
        Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogShow'])->name('admin.phone-call-log');
        Route::get('phone-call-log-edit/{id}', [PhoneCallLogController::class, 'phoneCallLogEdit'])->name('admin.phone-call-log.edit');
        Route::post('phone-call-log-update/', [PhoneCallLogController::class, 'phoneCallLogUpdate'])->name('admin.phone-call-log.update');
        Route::delete('/phone-call-log/destroy/{id}', [PhoneCallLogController::class, 'phoneCallLogDestroy'])->name('admin.phone-call-log.destroy');

        //----------------------------------for postal dispatch--------------
        Route::get('postal-dispatch', [PostalDispatchController::class, 'create'])->name('admin.postal-dispatch');
        Route::post('postal-dispatch/add', [PostalDispatchController::class, 'store'])->name('admin.postal-dispatch/add');
        Route::get('postal-dispatch/view', [PostalDispatchController::class, 'show'])->name('admin.postal-dispatch');
        Route::get('postal-dispatch/{id}', [PostalDispatchController::class, 'edit'])->name('admin.postal-dispatch.edit');
        Route::post('postal-dispatch-update/', [PostalDispatchController::class, 'update'])->name('admin.postal-dispatch.update');
        Route::delete('/postal-dispatch/destroy/{id}', [PostalDispatchController::class, 'destroy'])->name('admin.postal-dispatch.destroy');

        //----------------------------------for postal receive--------------
        Route::get('postal-receive', [PostalReceiveController::class, 'postalReceiveCreate'])->name('admin.postal-receive');
        Route::post('postal-receive/add', [PostalReceiveController::class, 'postalReceiveStore'])->name('admin.postal-receive/add');
        Route::get('postal-receive/view', [PostalReceiveController::class, 'postalReceiveShow'])->name('admin.postal-receive');
        Route::get('postal-receive-edit/{id}', [PostalReceiveController::class, 'postalReceiveEdit'])->name('admin.postal-receive.edit');
        Route::post('postal-receive-update/', [PostalReceiveController::class, 'postalReceiveUpdate'])->name('admin.postal-receive.update');
        Route::delete('/postal-receive/destroy/{id}', [PostalReceiveController::class, 'postalReceiveDestroy'])->name('admin.postal-receive.destroy');

        //----------------------------------for complain--------------
        Route::get('complain', [ComplainController::class, 'complainCreate'])->name('admin.complain');
        Route::post('complain/add', [ComplainController::class, 'complainStore'])->name('admin.complain/add');
        Route::get('complain/view', [ComplainController::class, 'complainShow'])->name('admin.complain');
        Route::get('complain-edit/{id}', [ComplainController::class, 'complainEdit'])->name('admin.complain.edit');
        Route::post('complain-update/', [ComplainController::class, 'complainUpdate'])->name('admin.complain.update');
        Route::delete('/complain/destroy/{id}', [ComplainController::class, 'complainDestroy'])->name('admin.complain.destroy');

        //----------------------------------for session--------------
        Route::get('session', [SessionController::class, 'create'])->name('admin.session');
        Route::post('session/add', [SessionController::class, 'store'])->name('admin.session/add');
        Route::get('session', [SessionController::class, 'show'])->name('admin.session');
        Route::get('session-edit/{id}', [SessionController::class, 'edit'])->name('admin.session.edit');
        Route::post('session-update/', [SessionController::class, 'update'])->name('admin.session.update');
        Route::delete('/session/destroy/{id}', [SessionController::class, 'destroy'])->name('admin.session.destroy');

        //----------------------------------for eclass--------------
        Route::get('class', [EclassController::class, 'classCreate'])->name('admin.class');
        Route::post('class/add', [EclassController::class, 'classStore'])->name('admin.class/add');
        Route::get('class', [EclassController::class, 'classShow'])->name('admin.class');
        Route::get('class-edit/{id}', [EclassController::class, 'classEdit'])->name('admin.class.edit');
        Route::post('class-update/', [EclassController::class, 'classUpdate'])->name('admin.class.update');
        Route::delete('/class/destroy/{id}', [EclassController::class, 'classDestroy'])->name('admin.class.destroy');

        //----------------------------------for section--------------
        Route::get('section', [SectionController::class, 'sectionCreate'])->name('admin.section');
        Route::post('section/add', [SectionController::class, 'sectionStore'])->name('admin.section/add');
        Route::get('section/view', [SectionController::class, 'classDropDownShow'])->name('admin.section');
        Route::get('section-edit/{id}', [SectionController::class, 'sectionEdit'])->name('admin.section.edit');
        Route::post('section-update/', [SectionController::class, 'sectionUpdate'])->name('admin.section.update');
        Route::delete('/section/destroy/{id}', [SectionController::class, 'sectionDestroy'])->name('admin.section.destroy');

        //----------------------------------for session class--------------
        Route::get('session-class', [SessionClassController::class, 'create'])->name('admin.session-class');
        Route::post('session-class/add', [SessionClassController::class, 'store'])->name('admin.session-class/add');
        Route::get('session-class/view', [SessionClassController::class, 'show'])->name('admin.session-class');
        Route::get('session-class-edit/{id}', [SessionClassController::class, 'edit'])->name('admin.session-class.edit');
        Route::post('session-class-update/', [SessionClassController::class, 'update'])->name('admin.session-class.update');
        Route::delete('/session-class/destroy/{id}', [SessionClassController::class, 'destroy'])->name('admin.session-class.destroy');

        //----------------------------------for subject--------------
        Route::get('subject', [SubjectController::class, 'subjectCreate'])->name('admin.subject');
        Route::post('subject/add', [SubjectController::class, 'subjectStore'])->name('admin.subject/add');
        Route::get('subject/view', [SubjectController::class, 'classDropDownShow'])->name('admin.subject');
        Route::get('subject-edit/{id}', [SubjectController::class, 'subjectEdit'])->name('admin.subject.edit');
        Route::post('subject-update/', [SubjectController::class, 'subjectUpdate'])->name('admin.subject.update');
        Route::delete('/subject/destroy/{id}', [SubjectController::class, 'subjectDestroy'])->name('admin.subject.destroy');

        //----------------------------------for category--------------
        Route::get('category', [CategoryController::class, 'categoryCreate'])->name('admin.category');
        Route::post('category/add', [CategoryController::class, 'categoryStore'])->name('admin.category/add');
        Route::get('category/view', [CategoryController::class, 'dropDownShow'])->name('admin.category');
        Route::get('category-edit/{id}', [CategoryController::class, 'categoryEdit'])->name('admin.category.edit');
        Route::post('category-update/', [CategoryController::class, 'categoryUpdate'])->name('admin.category.update');
        Route::delete('/category/destroy/{id}', [CategoryController::class, 'categoryDestroy'])->name('admin.category.destroy');

        //----------------------------------for student--------------
        Route::get('student', [StudentController::class, 'studentCreate'])->name('admin.student');
        Route::post('student/add', [StudentController::class, 'studentStore'])->name('admin.student/add');
        Route::get('student/view', [StudentController::class, 'dropDownShow'])->name('admin.student');
        Route::get('student-edit/{id}', [StudentController::class, 'studentEdit'])->name('admin.student.edit');
        Route::post('student-update/', [StudentController::class, 'studentUpdate'])->name('admin.student.update');
        Route::delete('/student/destroy/{id}', [StudentController::class, 'studentDestroy'])->name('admin.student.destroy');

        //----------------------------------for academic calendar--------------
        Route::get('academic-calendar', [CalendarController::class, 'calendarCreate'])->name('admin.academic-calendar');
        Route::post('academic-calendar/add', [CalendarController::class, 'calendarStore'])->name('admin.academic-calendar/add');
        Route::get('academic-calendar/view', [CalendarController::class, 'calendarShow'])->name('admin.academic-calendar');
        Route::get('academic-calendar-edit/{id}', [CalendarController::class, 'calendarEdit'])->name('admin.academic-calendar.edit');
        Route::post('academic-calendar-update/', [CalendarController::class, 'calendarUpdate'])->name('admin.academic-calendar.update');
        Route::delete('/academic-calendar/destroy/{id}', [CalendarController::class, 'calendarDestroy'])->name('admin.academic-calendar.destroy');

        //----------------------------------for feed--------------
        Route::get('feed', [FeedController::class, 'feedCreate'])->name('admin.feed');
        Route::post('feed/add', [FeedController::class, 'feedStore'])->name('admin.feed/add');
        Route::get('feed/view', [FeedController::class, 'feedShow'])->name('admin.feed');
        Route::get('feed/edit/{id}', [FeedController::class, 'feedEdit'])->name('admin.feed.edit');
        Route::post('feed/update/', [FeedController::class, 'feedUpdate'])->name('admin.feed.update');
        Route::delete('/feed/destroy/{id}', [FeedController::class, 'feedDestroy'])->name('admin.feed.destroy');

        //----------------------------------for class schedule--------------
        Route::get('class-schedule', [ClassScheduleController::class, 'scheduleCreate'])->name('admin.class-schedule');
        Route::post('class-schedule/add', [ClassScheduleController::class, 'scheduleStore'])->name('admin.class-schedule/add');
        Route::get('class-schedule/view', [ClassScheduleController::class, 'dropDownShow'])->name('admin.class-schedule');
        Route::get('class-schedule-edit/{id}', [ClassScheduleController::class, 'scheduleEdit'])->name('admin.class-schedule.edit');
        Route::post('class-schedule-update/', [ClassScheduleController::class, 'scheduleUpdate'])->name('admin.class-schedule.update');
        Route::delete('/class-schedule/destroy/{id}', [ClassScheduleController::class, 'scheduleDestroy'])->name('admin.class-schedule.destroy');

        //----------------------------------for exam type--------------
        Route::get('exam-type', [ExaminationTypeController::class, 'examinationCreate'])->name('admin.exam-type');
        Route::post('exam-type/add', [ExaminationTypeController::class, 'examinationStore'])->name('admin.exam-type/add');
        Route::get('exam-type/view', [ExaminationTypeController::class, 'examinationShow'])->name('admin.exam-type');
        Route::get('/exam-type/edit/{id}', [ExaminationTypeController::class, 'examinationEdit'])->name('admin.exam-type.edit');
        Route::post('/exam-type/update/', [ExaminationTypeController::class, 'examinationUpdate'])->name('admin.exam-type.update');
        Route::delete('/exam-type/destroy/{id}', [ExaminationTypeController::class, 'examinationDestroy'])->name('admin.exam-type.destroy');

        //----------------------------------for exam group--------------
        Route::get('exam-group', [ExaminationGroupController::class, 'examinationGroupCreate'])->name('admin.exam-group');
        Route::post('exam-group/add', [ExaminationGroupController::class, 'examinationStore'])->name('admin.exam-group/add');
        Route::get('exam-group/view', [ExaminationGroupController::class, 'dropDownShow'])->name('admin.exam-group');
        Route::get('/exam-group/edit/{id}', [ExaminationGroupController::class, 'examinationGroupEdit'])->name('admin.exam-group.edit');
        Route::get('/exam-group/assign/{id}', [ExaminationGroupController::class, 'examinationGroupAssign'])->name('admin.exam-group.assign');
        Route::post('/exam-group/update/', [ExaminationGroupController::class, 'examinationGroupUpdate'])->name('admin.exam-group.update');
        Route::delete('/exam-group/destroy/{id}', [ExaminationGroupController::class, 'examinationGroupDestroy'])->name('admin.exam-group.destroy');
        Route::get('getExam/{id}', [ExaminationGroupController::class, 'getExam'])->name('get_exam');
        Route::get('exam-group/class', [ExaminationGroupController::class, 'index'])->name('exam-group/class');

        //----------------------------------for marks grade--------------
        Route::get('grade', [GradeController::class, 'gradeCreate'])->name('admin.grade');
        Route::post('grade/add', [GradeController::class, 'gradeStore'])->name('admin.grade/add');
        Route::get('grade/view', [GradeController::class, 'dropDownShow'])->name('admin.grade');
        Route::get('/grade/edit/{id}', [GradeController::class, 'gradeEdit'])->name('admin.grade.edit');
        Route::post('/grade/update/', [GradeController::class, 'gradeUpdate'])->name('admin.grade.update');
        Route::delete('/grade/destroy/{id}', [GradeController::class, 'gradeDestroy'])->name('admin.grade.destroy');

        //----------------------------------for homework--------------
        Route::get('homework', [HomeworkController::class, 'homeworkCreate'])->name('admin.homework');
        Route::post('homework/add', [HomeworkController::class, 'homeworkStore'])->name('admin.homework/add');
        Route::get('homework/view', [HomeworkController::class, 'homeworkDropDownShow'])->name('admin.homework');
        Route::get('homework-edit/{id}', [HomeworkController::class, 'homeworkEdit'])->name('admin.homework.edit');
        Route::get('homework-view/{id}', [HomeworkController::class, 'homeworkSubmissionView'])->name('admin.homework.view');
        Route::post('homework-update/', [HomeworkController::class, 'homeworkUpdate'])->name('admin.homework.update');
        Route::delete('/homework/destroy/{id}', [HomeworkController::class, 'homeworkDestroy'])->name('admin.homework.destroy');

        //----------------------------------for lesson plan--------------
        /*Lesson*/
        Route::resource('lesson', 'LessonController',[
            'names' => [
                'index' => 'admin.lesson.index',
                'create' => 'admin.lesson.create',
                'store' => 'admin.lesson.store',
                'edit' => 'admin.lesson.edit',
                'update' => 'admin.lesson.update',
                'destroy' => 'admin.lesson.destroy',
            ]
        ]);

        /*Topic*/
        Route::resource('topic', 'App\Http\Controllers\Admin\TopicController', [
            'names' => [
                'index' => 'admin.topic.index',
                'create' => 'admin.topic.create',
                'store' => 'admin.topic.store',
                'edit' => 'admin.topic.edit',
                'update' => 'admin.topic.update',
                'destroy' => 'admin.topic.destroy',
            ]
        ]);

//        Route::get('getSubjectLessons/{id}', [LessonController::class, 'getSubjectLessons'])->name('get_subject_lessons');

        /*Manage Syllabus Status*/
        Route::get('get_lessons/search', [ManageSyllabusStatusController::class, 'getLessons'])->name('admin.get_lessons.search');
        Route::get('manage-syllabus-status', [ManageSyllabusStatusController::class, 'index'])->name('admin.manage_syllabus_status.index');

        /*Manage Lesson Plan*/
        Route::get('manage-lesson-plan', [ManageLessonPlanController::class, 'index'])->name('admin.manage_lesson_plan.index');
        Route::get('get-teachers/search', [ManageLessonPlanController::class, 'search'])->name('admin.get_teacher.search');

        //----------------------------------For Human Resource--------------
        /*Role*/
        Route::resource('role', 'RoleController', [
            'names' => [
                'index' => 'admin.role.index',
                'create' => 'admin.role.create',
                'store' => 'admin.role.store',
                'edit' => 'admin.role.edit',
                'update' => 'admin.role.update',
                'destroy' => 'admin.role.destroy',
            ]
        ]);

        /*Designation*/
        Route::resource('designation', 'DesignationController', [
            'names' => [
                'index' => 'admin.designation.index',
                'create' => 'admin.designation.create',
                'store' => 'admin.designation.store',
                'edit' => 'admin.designation.edit',
                'update' => 'admin.designation.update',
                'destroy' => 'admin.designation.destroy',
            ]
        ]);

        /*Department*/
        Route::resource('department', 'DepartmentController', [
            'names' => [
                'index' => 'admin.department.index',
                'create' => 'admin.department.create',
                'store' => 'admin.department.store',
                'edit' => 'admin.department.edit',
                'update' => 'admin.department.update',
                'destroy' => 'admin.department.destroy',
            ]
        ]);

        /*Staff*/
        Route::resource('staff_directory', 'StaffDirectoryController',[
            'names' => [
                'index' => 'admin.staff_directory.index',
                'create' => 'admin.staff_directory.create',
                'store' => 'admin.staff_directory.store',
                'edit' => 'admin.staff_directory.edit',
                'update' => 'admin.staff_directory.update',
                'show' => 'admin.staff_directory.show',
                'destroy' => 'admin.staff_directory.destroy',
            ]
        ]);

        Route::get('get_staffs/{id}', [StaffDirectoryController::class, 'getStaffs'])->name('get_staffs');

        /*Leave Type*/
        Route::resource('leave_type', 'LeaveTypeController', [
            'names' => [
                'index' => 'admin.leave_type.index',
                'create' => 'admin.leave_type.create',
                'store' => 'admin.leave_type.store',
                'edit' => 'admin.leave_type.edit',
                'update' => 'admin.leave_type.update',
                'destroy' => 'admin.leave_type.destroy',
            ]
        ]);

        /*Apply Leave*/
        Route::resource('apply_leave', 'ApplyLeaveController', [
            'names' => [
                'index' => 'admin.apply_leave.index',
                'create' => 'admin.apply_leave.create',
                'store' => 'admin.apply_leave.store',
                'edit' => 'admin.apply_leave.edit',
                'update' => 'admin.apply_leave.update',
                'destroy' => 'admin.apply_leave.destroy',
            ]
        ]);

        /*Leave Request*/
        Route::resource('leave_request', 'LeaveRequestController', [
            'names' => [
                'index' => 'admin.leave_request.index',
                'create' => 'admin.leave_request.create',
                'store' => 'admin.leave_request.store',
                'edit' => 'admin.leave_request.edit',
                'update' => 'admin.leave_request.update',
                'destroy' => 'admin.leave_request.destroy',
            ]
        ]);

        /*Teacher Rating*/
        Route::resource('teacher_rating', 'TeacherRatingController', [
            'names' => [
                'index' => 'admin.teacher_rating.index',
                'create' => 'admin.teacher_rating.create',
                'store' => 'admin.teacher_rating.store',
                'edit' => 'admin.teacher_rating.edit',
                'update' => 'admin.teacher_rating.update',
                'destroy' => 'admin.teacher_rating.destroy',
            ]
        ]);

        /*Staff Attendance*/
        Route::resource('staff_attendance', 'StaffAttendanceController', [
            'names' => [
                'index' => 'admin.staff_attendance.index',
                'create' => 'admin.staff_attendance.create',
                'store' => 'admin.staff_attendance.store',
                'edit' => 'admin.staff_attendance.edit',
                'update' => 'admin.staff_attendance.update',
                'destroy' => 'admin.staff_attendance.destroy',
            ]
        ]);

        /*Disable Staff*/
        Route::get('disable_staff', [StaffDirectoryController::class, 'disable'])->name('admin.disable_staff.index');
        Route::get('disable_staff/search', [StaffDirectoryController::class, 'searchStaff'])->name('admin.disable_staff.search');
//        Route::get('change_staff_status/{id}', [StaffDirectoryController::class, 'changeStatus'])->name('change_staff_status');

        //----------------------------------For Inventory--------------
        /*Item Category*/
        Route::resource('item_category', 'App\Http\Controllers\Inventory\ItemCategoryController', [
            'names' => [
                'index' => 'admin.item_category.index',
                'create' => 'admin.item_category.create',
                'store' => 'admin.item_category.store',
                'edit' => 'admin.item_category.edit',
                'update' => 'admin.item_category.update',
                'destroy' => 'admin.item_category.destroy',
            ]
        ]);

        /*Item Store*/
        Route::resource('item_store', 'ItemStoreController', [
            'names' => [
                'index' => 'admin.item_store.index',
                'create' => 'admin.item_store.create',
                'store' => 'admin.item_store.store',
                'edit' => 'admin.item_store.edit',
                'update' => 'admin.item_store.update',
                'destroy' => 'admin.item_store.destroy',
            ]
        ]);

        /*Item Supplier*/
        Route::resource('item_supplier', 'ItemSupplierController', [
            'names' => [
                'index' => 'admin.item_supplier.index',
                'create' => 'admin.item_supplier.create',
                'store' => 'admin.item_supplier.store',
                'edit' => 'admin.item_supplier.edit',
                'update' => 'admin.item_supplier.update',
                'destroy' => 'admin.item_supplier.destroy',
            ]
        ]);

        /*Item*/
        Route::resource('item', 'App\Http\Controllers\Inventory\ItemController', [
            'names' => [
                'index' => 'admin.item.index',
                'create' => 'admin.item.create',
                'store' => 'admin.item.store',
                'edit' => 'admin.item.edit',
                'update' => 'admin.item.update',
                'destroy' => 'admin.item.destroy',
            ]
        ]);
//        Route::get('item_categories/{id}', [ItemController::class, 'getItemCategories'])->name('get_categories');

        /*Item Stock*/
        Route::resource('item_stock', 'App\Http\Controllers\Inventory\ItemStockController', [
            'names' => [
                'index' => 'admin.item_stock.index',
                'create' => 'admin.item_stock.create',
                'store' => 'admin.item_stock.store',
                'edit' => 'admin.item_stock.edit',
                'update' => 'admin.item_stock.update',
                'destroy' => 'admin.item_stock.destroy',
            ]
        ]);
//        Route::get('item_quantity/{id}', [ItemStockController::class, 'getQuantity'])->name('get_quantity');

        /*Issue Item*/
        Route::resource('issue_item', 'App\Http\Controllers\Inventory\IssueItemController', [
            'names' => [
                'index' => 'admin.issue_item.index',
                'create' => 'admin.issue_item.create',
                'store' => 'admin.issue_item.store',
                'edit' => 'admin.issue_item.edit',
                'update' => 'admin.issue_item.update',
                'destroy' => 'admin.issue_item.destroy',
            ]
        ]);
//        Route::get('return_item/{id}', [IssueItemController::class, 'returnItem'])->name('return_item');

        //----------------------------------For Library--------------
        /*Book*/
        Route::resource('book', 'BookController', [
            'names' => [
                'index' => 'admin.book.index',
                'create' => 'admin.book.create',
                'store' => 'admin.book.store',
                'edit' => 'admin.book.edit',
                'update' => 'admin.book.update',
                'destroy' => 'admin.book.destroy',
            ]
        ]);

        /*Library Staff and Student Member*/
        Route::get('library/staff_member', [LibraryStaffMemberController::class, 'index'])->name('admin.library_staff_member.index');
//        Route::get('add_library_member/{id}', [LibraryMemberController::class, 'create'])->name('add_library_member');
//        Route::get('remove_member/{id}', [LibraryMemberController::class, 'destroy'])->name('remove_library_member');

        Route::get('library/student_member', [LibraryStudentMemberController::class, 'index'])->name('admin.library_student_member.index');
        Route::get('get_students/search', [LibraryStudentMemberController::class, 'getStudents'])->name('admin.get_students.search');

//        /* Add/Remove Completion Date On Library Staff and Student Members */
//        /* Add/Remove Completion Date On Library Staff and Student Members */
//        Route::get('completion_date/{id}', [TopicController::class, 'completionDate'])->name('completion_date');
//        Route::get('remove_completion_date/{id}', [TopicController::class, 'removeCompletionDate'])->name('remove_completion_date');

        /*Issue Return*/
        Route::resource('issue_return', 'IssueReturnController', [
            'names' => [
                'index' => 'admin.issue_return.index',
                'create' => 'admin.issue_return.create',
                'store' => 'admin.issue_return.store',
                'edit' => 'admin.issue_return.edit',
                'update' => 'admin.issue_return.update',
                'destroy' => 'admin.issue_return.destroy',
            ]
        ]);
        Route::get('issue_return/get_library_members/search', [IssueReturnController::class, 'getLibraryMembers'])->name('admin.get_library_members.search');
//Route::get('issue_return/staff/{id}/detail', [IssueReturnController::class, 'staffIssueReturn'])->name('staff_issue_return.detail');
        Route::get('issue_return/{id}/detail', [IssueReturnController::class, 'issueReturn'])->name('admin.issue_return.detail');
//        Route::get('getBookQuantity/{id}', [IssueReturnController::class, 'getBookQuantity'])->name('get_book_quantity');
//Route::get('student_return_book/{id}', [IssueReturnController::class, 'studentReturnBook'])->name('student_return_book');
//Route::post('issue_return/store', [IssueReturnController::class, 'store'])->name('issue_return.store');
//        Route::get('return_book/{id}', [IssueReturnController::class, 'returnBook'])->name('return_book');

        //----------------------------------For Fee Collection--------------
        /*Book*/
        Route::resource('fee_group', 'FeeGroupController', [
            'names' => [
                'index' => 'admin.fee_group.index',
                'create' => 'admin.fee_group.create',
                'store' => 'admin.fee_group.store',
                'edit' => 'admin.fee_group.edit',
                'update' => 'admin.fee_group.update',
                'destroy' => 'admin.fee_group.destroy',
            ]
        ]);

    });

});
