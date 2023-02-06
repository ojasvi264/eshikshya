<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Homework\HomeworkController;
use App\Http\Controllers\Homework\HomeworkSubmissionController;
use App\Http\Controllers\HumanResource\StaffDirectoryController;
use App\Http\Controllers\HumanResource\StaffAttendanceController;
use App\Http\Controllers\LessonPlans\ManageLessonPlanController;
use App\Http\Controllers\LessonPlans\ManageSyllabusStatusController;
use App\Http\Controllers\Library\IssueReturnController;
use App\Http\Controllers\Library\LibraryStaffMemberController;
use App\Http\Controllers\Library\LibraryStudentMemberController;
use App\Http\Controllers\Super\Academics\CalendarController;
use App\Http\Controllers\Super\Academics\CategoryController;
use App\Http\Controllers\Super\Academics\EclassController;
use App\Http\Controllers\Super\Academics\FeedController;
use App\Http\Controllers\Super\Academics\GroupController;
use App\Http\Controllers\Super\Academics\NoticeController;
use App\Http\Controllers\Super\Academics\SectionController;
use App\Http\Controllers\Super\Academics\SessionClassController;
use App\Http\Controllers\Super\Academics\SessionController;
use App\Http\Controllers\Super\Academics\StudentController;
use App\Http\Controllers\Super\EmailController;
use App\Http\Controllers\Super\ExamController;
use App\Http\Controllers\Super\ExamGradeController;
use App\Http\Controllers\Super\SubjectController;
use App\Http\Controllers\Super\Examination\ExaminationGroupController;
use App\Http\Controllers\Super\Examination\ExaminationTypeController;
use App\Http\Controllers\Super\Examination\GradeController;
use App\Http\Controllers\Super\ExamMarkController;
use App\Http\Controllers\Super\ExamScheduleController;
use App\Http\Controllers\Super\FeeTypeController;
use App\Http\Controllers\Super\FrontOffice\AdmissionInquiryController;
use App\Http\Controllers\Super\FrontOffice\ComplainController;
use App\Http\Controllers\Super\FrontOffice\ComplainTypeController;
use App\Http\Controllers\Super\FrontOffice\PhoneCallLogController;
use App\Http\Controllers\Super\FrontOffice\PostalDispatchController;
use App\Http\Controllers\Super\FrontOffice\PostalReceiveController;
use App\Http\Controllers\Super\FrontOffice\PurposeController;
use App\Http\Controllers\Super\FrontOffice\ReferenceController;
use App\Http\Controllers\Super\FrontOffice\SourceController;
use App\Http\Controllers\Super\FrontOffice\VisitorController;
use App\Http\Controllers\Super\Hostel\HostelController;
use App\Http\Controllers\Super\Hostel\HostelRoomController;
use App\Http\Controllers\Super\Hostel\RoomTypeController;
use App\Http\Controllers\Super\LogController;
use App\Http\Controllers\Super\NoticeBoardController;
use App\Http\Controllers\Super\OnlineExamController;
use App\Http\Controllers\Super\PrintMarksheetController;
use App\Http\Controllers\Super\QuestionBankController;
use App\Http\Controllers\Super\Schedule\ClassScheduleController;
use App\Http\Controllers\Super\SchoolSettingController;
use App\Http\Controllers\Super\StudentInvoiceController;
use App\Http\Controllers\Super\Transportation\AssignVehicleController;
use App\Http\Controllers\Super\Transportation\VehicleController;
use App\Http\Controllers\Super\Transportation\VehicleRouteController;
use App\Http\Controllers\Super\UploadContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Super\Fee\AssignFeeController;
use App\Http\Controllers\Super\Fee\AssignDiscountController;
use App\Http\Controllers\Super\Fee\CollectFeeController;
use App\Http\Controllers\Super\Fee\FeeCarryForwardController;

Route::group(['prefix' => 'super','middleware' => ['IsSuperadmin','XSS']], function() {
    Route::get('/dashboard', [App\Http\Controllers\Super\DashboardController::class, 'index'])->name('super.dashboard');

    //----------------------------------for purpose--------------
    Route::get('purpose', [PurposeController::class, 'purposeCreate'])->name('purpose');
    Route::post('purpose/add', [PurposeController::class, 'purposeStore'])->name('purpose/add');
    Route::get('purpose', [PurposeController::class, 'purposeShow'])->name('purpose');
    Route::get('purpose-edit/{id}', [PurposeController::class, 'purposeEdit'])->name('purpose.edit');
    Route::post('purpose-update/', [PurposeController::class, 'purposeUpdate'])->name('purpose.update');
    Route::delete('/purpose/destroy/{id}', [PurposeController::class, 'purposeDestroy'])->name('purpose.destroy');

    //----------------------------------for complain type--------------
    Route::get('complain-type', [ComplainTypeController::class, 'complainTypeCreate'])->name('complain-type');
    Route::post('complain-type/add', [ComplainTypeController::class, 'complainTypeStore'])->name('complain-type/add');
    Route::get('complain-type', [ComplainTypeController::class, 'complainTypeShow'])->name('complain-type');
    Route::get('complain-type-edit/{id}', [ComplainTypeController::class, 'complainTypeEdit'])->name('complain-type.edit');
    Route::post('complain-type-update/', [ComplainTypeController::class, 'complainTypeUpdate'])->name('complain-type.update');
    Route::delete('/complain-type/destroy/{id}', [ComplainTypeController::class, 'complainTypeDestroy'])->name('complain-type.destroy');

    //----------------------------------for source--------------
    Route::get('source', [SourceController::class, 'sourceCreate'])->name('source');
    Route::post('source/add', [SourceController::class, 'sourceStore'])->name('source/add');
    Route::get('source', [SourceController::class, 'sourceShow'])->name('source');
    Route::get('source-edit/{id}', [SourceController::class, 'sourceEdit'])->name('source.edit');
    Route::post('source-update/', [SourceController::class, 'sourceUpdate'])->name('source.update');
    Route::delete('/source/destroy/{id}', [SourceController::class, 'sourceDestroy'])->name('source.destroy');

    //----------------------------------for reference--------------
    Route::get('reference', [ReferenceController::class, 'referenceCreate'])->name('reference');
    Route::post('reference/add', [ReferenceController::class, 'referenceStore'])->name('reference/add');
    Route::get('reference', [ReferenceController::class, 'referenceShow'])->name('reference');
    Route::get('reference-edit/{id}', [ReferenceController::class, 'referenceEdit'])->name('reference.edit');
    Route::post('reference-update/', [ReferenceController::class, 'referenceUpdate'])->name('reference.update');
    Route::delete('/reference/destroy/{id}', [ReferenceController::class, 'referenceDestroy'])->name('reference.destroy');

    //----------------------------------for admission inquiry--------------
    Route::get('admission-inquiry', [AdmissionInquiryController::class, 'admissionInquiryCreate'])->name('admission-inquiry');
    Route::post('admission-inquiry/add', [AdmissionInquiryController::class, 'admissionInquiryStore'])->name('admission-inquiry/add');
    Route::get('admission-inquiry/view', [AdmissionInquiryController::class, 'admissionInquiryShow'])->name('admission-inquiry');
    Route::get('admission-inquiry-edit/{id}', [AdmissionInquiryController::class, 'admissionInquiryEdit'])->name('admission-inquiry.edit');
    Route::post('admission-inquiry-update/', [AdmissionInquiryController::class, 'admissionInquiryUpdate'])->name('admission-inquiry.update');
    Route::delete('/admission-inquiry/destroy/{id}', [AdmissionInquiryController::class, 'admissionInquiryDestroy'])->name('admission-inquiry.destroy');

    //----------------------------------for visitor book----------------
    Route::get('visitor-book', [VisitorController::class, 'visitorCreate'])->name('visitor-book');
    Route::post('visitor-book/add', [VisitorController::class, 'visitorStore'])->name('visitor-book/add');
    Route::get('visitor-book/view', [VisitorController::class, 'visitorShow'])->name('visitor-book');
    Route::get('visitor-book-edit/{id}', [VisitorController::class, 'visitorEdit'])->name('visitor-book.edit');
    Route::post('visitor-book-update/', [VisitorController::class, 'visitorUpdate'])->name('visitor-book.update');
    Route::delete('/visitor-book/destroy/{id}', [VisitorController::class, 'visitorDestroy'])->name('visitor-book.destroy');

    //----------------------------------for phone call log--------------
    Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogCreate'])->name('phone-call-log');
    Route::post('phone-call-log/add', [PhoneCallLogController::class, 'phoneCallLogStore'])->name('phone-call-log/add');
    Route::get('phone-call-log', [PhoneCallLogController::class, 'phoneCallLogShow'])->name('phone-call-log');
    Route::get('phone-call-log-edit/{id}', [PhoneCallLogController::class, 'phoneCallLogEdit'])->name('phone-call-log.edit');
    Route::post('phone-call-log-update/', [PhoneCallLogController::class, 'phoneCallLogUpdate'])->name('phone-call-log.update');
    Route::delete('/phone-call-log/destroy/{id}', [PhoneCallLogController::class, 'phoneCallLogDestroy'])->name('phone-call-log.destroy');

    //----------------------------------for postal dispatch--------------
    Route::get('postal-dispatch', [PostalDispatchController::class, 'create'])->name('postal-dispatch');
    Route::post('postal-dispatch/add', [PostalDispatchController::class, 'store'])->name('postal-dispatch/add');
    Route::get('postal-dispatch/view', [PostalDispatchController::class, 'show'])->name('postal-dispatch');
    Route::get('postal-dispatch/{id}', [PostalDispatchController::class, 'edit'])->name('postal-dispatch.edit');
    Route::post('postal-dispatch-update/', [PostalDispatchController::class, 'update'])->name('postal-dispatch.update');
    Route::delete('/postal-dispatch/destroy/{id}', [PostalDispatchController::class, 'destroy'])->name('postal-dispatch.destroy');

    //----------------------------------for postal receive--------------
    Route::get('postal-receive', [PostalReceiveController::class, 'postalReceiveCreate'])->name('postal-receive');
    Route::post('postal-receive/add', [PostalReceiveController::class, 'postalReceiveStore'])->name('postal-receive/add');
    Route::get('postal-receive/view', [PostalReceiveController::class, 'postalReceiveShow'])->name('postal-receive');
    Route::get('postal-receive-edit/{id}', [PostalReceiveController::class, 'postalReceiveEdit'])->name('postal-receive.edit');
    Route::post('postal-receive-update/', [PostalReceiveController::class, 'postalReceiveUpdate'])->name('postal-receive.update');
    Route::delete('/postal-receive/destroy/{id}', [PostalReceiveController::class, 'postalReceiveDestroy'])->name('postal-receive.destroy');

    //----------------------------------for complain--------------
    Route::get('complain', [ComplainController::class, 'complainCreate'])->name('complain');
    Route::post('complain/add', [ComplainController::class, 'complainStore'])->name('complain/add');
    Route::get('complain/view', [ComplainController::class, 'complainShow'])->name('complain');
    Route::get('complain-edit/{id}', [ComplainController::class, 'complainEdit'])->name('complain.edit');
    Route::post('complain-update/', [ComplainController::class, 'complainUpdate'])->name('complain.update');
    Route::delete('/complain/destroy/{id}', [ComplainController::class, 'complainDestroy'])->name('complain.destroy');

    //----------------------------------for session--------------
    Route::get('session', [SessionController::class, 'create'])->name('session');
    Route::post('session/add', [SessionController::class, 'store'])->name('session/add');
    Route::get('session', [SessionController::class, 'show'])->name('session');
    Route::get('session-edit/{id}', [SessionController::class, 'edit'])->name('session.edit');
    Route::post('session-update/', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/session/destroy/{id}', [SessionController::class, 'destroy'])->name('session.destroy');

    //----------------------------------for eclass--------------
    Route::get('class', [EclassController::class, 'classCreate'])->name('class');
    Route::post('class/add', [EclassController::class, 'classStore'])->name('class/add');
    Route::get('class', [EclassController::class, 'classShow'])->name('class');
    Route::get('class-edit/{id}', [EclassController::class, 'classEdit'])->name('class.edit');
    Route::post('class-update/', [EclassController::class, 'classUpdate'])->name('class.update');
    Route::delete('/class/destroy/{id}', [EclassController::class, 'classDestroy'])->name('class.destroy');

    //----------------------------------for section--------------
    Route::get('section', [SectionController::class, 'sectionCreate'])->name('section');
    Route::post('section/add', [SectionController::class, 'sectionStore'])->name('section/add');
    Route::get('section/view', [SectionController::class, 'classDropDownShow'])->name('section');
    Route::get('section-edit/{id}', [SectionController::class, 'sectionEdit'])->name('section.edit');
    Route::post('section-update/', [SectionController::class, 'sectionUpdate'])->name('section.update');
    Route::delete('/section/destroy/{id}', [SectionController::class, 'sectionDestroy'])->name('section.destroy');

    //----------------------------------for session class--------------
    Route::get('session-class', [SessionClassController::class, 'create'])->name('session-class');
    Route::post('session-class/add', [SessionClassController::class, 'store'])->name('session-class/add');
    Route::get('session-class/view', [SessionClassController::class, 'show'])->name('session-class');
    Route::get('session-class-edit/{id}', [SessionClassController::class, 'edit'])->name('session-class.edit');
    Route::post('session-class-update/', [SessionClassController::class, 'update'])->name('session-class.update');
    Route::delete('/session-class/destroy/{id}', [SessionClassController::class, 'destroy'])->name('session-class.destroy');

    //----------------------------------for subject--------------
    Route::get('subject', [SubjectController::class, 'subjectCreate'])->name('subject');
    Route::post('subject/add', [SubjectController::class, 'subjectStore'])->name('subject/add');
    Route::get('subject/view', [SubjectController::class, 'classDropDownShow'])->name('subject');
    Route::get('subject-edit/{id}', [SubjectController::class, 'subjectEdit'])->name('subject.edit');
    Route::post('subject-update/', [SubjectController::class, 'subjectUpdate'])->name('subject.update');
    Route::delete('/subject/destroy/{id}', [SubjectController::class, 'subjectDestroy'])->name('subject.destroy');
    Route::get('subject', [SubjectController::class, 'subjectShow'])->name('subject');

    //----------------------------------for group--------------
    Route::get('group', [GroupController::class, 'groupCreate'])->name('group');
    Route::post('group/add', [GroupController::class, 'groupStore'])->name('group/add');
    Route::get('group/view', [GroupController::class, 'dropDownShow'])->name('group');
    Route::get('group-edit/{id}', [GroupController::class, 'groupEdit'])->name('group.edit');
    Route::post('group-update/', [GroupController::class, 'groupUpdate'])->name('group.update');
    Route::delete('/group/destroy/{id}', [GroupController::class, 'groupDestroy'])->name('group.destroy');
//    Route::get('getGroups/{id}', [GroupController::class, 'getGroups'])->name('get_groups');
    Route::get('group', [GroupController::class, 'groupShow'])->name('group');

    //----------------------------------for category--------------
    Route::get('category', [CategoryController::class, 'categoryCreate'])->name('category');
    Route::post('category/add', [CategoryController::class, 'categoryStore'])->name('category/add');
    Route::get('category/view', [CategoryController::class, 'dropDownShow'])->name('category');
    Route::get('category-edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
    Route::post('category-update/', [CategoryController::class, 'categoryUpdate'])->name('category.update');
    Route::delete('/category/destroy/{id}', [CategoryController::class, 'categoryDestroy'])->name('category.destroy');

    //----------------------------------for student--------------
    Route::get('student', [StudentController::class, 'studentCreate'])->name('student');
    Route::post('student/add', [StudentController::class, 'studentStore'])->name('student/add');
    Route::get('student/view', [StudentController::class, 'dropDownShow'])->name('student');
    Route::get('student-edit/{id}', [StudentController::class, 'studentEdit'])->name('student.edit');
    Route::post('student-update/', [StudentController::class, 'studentUpdate'])->name('student.update');
    Route::delete('/student/destroy/{id}', [StudentController::class, 'studentDestroy'])->name('student.destroy');

    //----------------------------------for academic calendar--------------
    Route::get('academic-calendar', [CalendarController::class, 'calendarCreate'])->name('academic-calendar');
    Route::post('academic-calendar/add', [CalendarController::class, 'calendarStore'])->name('academic-calendar/add');
    Route::get('academic-calendar/view', [CalendarController::class, 'calendarShow'])->name('academic-calendar');
    Route::get('academic-calendar-edit/{id}', [CalendarController::class, 'calendarEdit'])->name('academic-calendar.edit');
    Route::post('academic-calendar-update/', [CalendarController::class, 'calendarUpdate'])->name('academic-calendar.update');
    Route::delete('/academic-calendar/destroy/{id}', [CalendarController::class, 'calendarDestroy'])->name('academic-calendar.destroy');

    //----------------------------------for notice--------------
    Route::get('notice', [NoticeController::class, 'noticeCreate'])->name('notice');
    Route::post('notice/add', [NoticeController::class, 'noticeStore'])->name('notice/add');
    Route::get('notice/view', [NoticeController::class, 'dropDownShow'])->name('notice');
    Route::get('notice-edit/{id}', [NoticeController::class, 'noticeEdit'])->name('notice.edit');
    Route::post('notice-update/', [NoticeController::class, 'noticeUpdate'])->name('notice.update');
    Route::delete('/notice/destroy/{id}', [NoticeController::class, 'noticeDestroy'])->name('notice.destroy');

    //----------------------------------for feed--------------
    Route::get('feed', [FeedController::class, 'feedCreate'])->name('feed');
    Route::post('feed/add', [FeedController::class, 'feedStore'])->name('feed/add');
    Route::get('feed/view', [FeedController::class, 'feedShow'])->name('feed');
    Route::get('feed/edit/{id}', [FeedController::class, 'feedEdit'])->name('feed.edit');
    Route::post('feed/update/', [FeedController::class, 'feedUpdate'])->name('feed.update');
    Route::delete('/feed/destroy/{id}', [FeedController::class, 'feedDestroy'])->name('feed.destroy');

    //----------------------------------for class schedule--------------
    Route::get('class-schedule', [ClassScheduleController::class, 'scheduleCreate'])->name('class-schedule');
    Route::post('class-schedule/add', [ClassScheduleController::class, 'scheduleStore'])->name('class-schedule/add');
    Route::get('class-schedule/view', [ClassScheduleController::class, 'dropDownShow'])->name('class-schedule');
    Route::get('class-schedule-edit/{id}', [ClassScheduleController::class, 'scheduleEdit'])->name('class-schedule.edit');
    Route::post('class-schedule-update/', [ClassScheduleController::class, 'scheduleUpdate'])->name('class-schedule.update');
    Route::delete('/class-schedule/destroy/{id}', [ClassScheduleController::class, 'scheduleDestroy'])->name('class-schedule.destroy');

    //----------------------------------for exam type--------------
    Route::get('exam-type', [ExaminationTypeController::class, 'examinationCreate'])->name('exam-type');
    Route::post('exam-type/add', [ExaminationTypeController::class, 'examinationStore'])->name('exam-type/add');
    Route::get('exam-type/view', [ExaminationTypeController::class, 'examinationShow'])->name('exam-type');
    Route::get('/exam-type/edit/{id}', [ExaminationTypeController::class, 'examinationEdit'])->name('exam-type.edit');
    Route::post('/exam-type/update/', [ExaminationTypeController::class, 'examinationUpdate'])->name('exam-type.update');
    Route::delete('/exam-type/destroy/{id}', [ExaminationTypeController::class, 'examinationDestroy'])->name('exam-type.destroy');

    //----------------------------------for exam group--------------
    Route::get('exam-group', [ExaminationGroupController::class, 'examinationGroupCreate'])->name('exam-group');
    Route::post('exam-group/add', [ExaminationGroupController::class, 'examinationStore'])->name('exam-group/add');
    Route::get('exam-group/view', [ExaminationGroupController::class, 'dropDownShow'])->name('exam-group');
    Route::get('/exam-group/edit/{id}', [ExaminationGroupController::class, 'examinationGroupEdit'])->name('exam-group.edit');
    Route::get('/exam-group/assign/{id}', [ExaminationGroupController::class, 'examinationGroupAssign'])->name('exam-group.assign');
    Route::post('/exam-group/update/', [ExaminationGroupController::class, 'examinationGroupUpdate'])->name('exam-group.update');
    Route::delete('/exam-group/destroy/{id}', [ExaminationGroupController::class, 'examinationGroupDestroy'])->name('exam-group.destroy');
    Route::get('getExam/{id}', [ExaminationGroupController::class, 'getExam'])->name('get_exam');
    Route::get('exam-group/class', [ExaminationGroupController::class, 'index'])->name('exam-group/class');

    //----------------------------------for marks grade--------------
    Route::get('grade', [GradeController::class, 'gradeCreate'])->name('grade');
    Route::post('grade/add', [GradeController::class, 'gradeStore'])->name('grade/add');
    Route::get('grade/view', [GradeController::class, 'dropDownShow'])->name('grade');
    Route::get('/grade/edit/{id}', [GradeController::class, 'gradeEdit'])->name('grade.edit');
    Route::post('/grade/update/', [GradeController::class, 'gradeUpdate'])->name('grade.update');
    Route::delete('/grade/destroy/{id}', [GradeController::class, 'gradeDestroy'])->name('grade.destroy');

    //----------------------------------for homework--------------
    Route::get('homework', [HomeworkController::class, 'homeworkCreate'])->name('homework');
    Route::post('homework/add', [HomeworkController::class, 'homeworkStore'])->name('homework/add');
    Route::get('homework/view', [HomeworkController::class, 'homeworkDropDownShow'])->name('homework');
    Route::get('homework-view/{id}', [HomeworkController::class, 'homeworkSubmissionView'])->name('homework.view');
    Route::get('homework/submission/{id}', [HomeworkController::class, 'submittedHomeworkView'])->name('homework.submission');
    Route::get('homework-edit/{id}', [HomeworkController::class, 'homeworkEdit'])->name('homework.edit');
    Route::post('homework-update/', [HomeworkController::class, 'homeworkUpdate'])->name('homework.update');
    Route::delete('/homework/destroy/{id}', [HomeworkController::class, 'homeworkDestroy'])->name('homework.destroy');

    //----------------------------------for homework submission--------------
    Route::get('homework/get', [HomeworkSubmissionController::class, 'getHomework'])->name('homework.get');
    Route::get('homework-submission/{id}', [HomeworkSubmissionController::class, 'homeworkDetail'])->name('homework-submission');
    Route::post('homework-submission/submit/', [HomeworkSubmissionController::class, 'homeworkSubmit'])->name('homework.submit');
    Route::get('homework-submission/show/{id}', [HomeworkSubmissionController::class, 'submittedHomeworkView'])->name('homework-submission.submitted');
    Route::get('homework-submission/view/{id}', [HomeworkSubmissionController::class, 'submissionShow'])->name('homework-submission.show');
    Route::get('homework-submission/edit/{id}', [HomeworkSubmissionController::class, 'submissionEdit'])->name('homework-submission.edit');
    Route::get('homework-submission/update/', [HomeworkSubmissionController::class, 'submissionUpdate'])->name('homework-submission.update');
    Route::delete('/homework-submission/destroy/{id}', [HomeworkSubmissionController::class, 'submissionDestroy'])->name('homework-submission.destroy');

    //----------------------------------for lesson plan--------------
    /*Topic*/
    Route::resource('topic', 'App\Http\Controllers\TopicController');

    /*Lesson*/
    Route::resource('lesson', 'App\Http\Controllers\LessonController');

    /*Manage Syllabus Status*/
    Route::get('get_lessons/search', [ManageSyllabusStatusController::class, 'getLessons'])->name('get_lessons.search');
    Route::get('manage-syllabus-status', [ManageSyllabusStatusController::class, 'index'])->name('manage_syllabus_status.index');

    /*Manage Lesson Plan*/
    Route::get('manage-lesson-plan', [ManageLessonPlanController::class, 'index'])->name('manage_lesson_plan.index');
    Route::get('get-teachers/search', [ManageLessonPlanController::class, 'search'])->name('get_teacher.search');

    //----------------------------------For Human Resource--------------
    /*Role*/
    Route::resource('role', 'App\Http\Controllers\HumanResource\RoleController');

    /*Designation*/
    Route::resource('designation', 'App\Http\Controllers\HumanResource\DesignationController');

    /*Department*/
    Route::resource('department', 'App\Http\Controllers\HumanResource\DepartmentController');

    /*Staff*/
    Route::resource('staff_directory', 'App\Http\Controllers\HumanResource\StaffDirectoryController');

    /*Leave Type*/
    Route::resource('leave_type', 'App\Http\Controllers\HumanResource\LeaveTypeController');

    /*Apply Leave*/
    Route::resource('apply_leave', 'App\Http\Controllers\HumanResource\ApplyLeaveController');

    /*Leave Request*/
    Route::resource('leave_request', 'App\Http\Controllers\HumanResource\LeaveRequestController');

    /*Teacher Rating*/
    Route::resource('teacher_rating', 'App\Http\Controllers\HumanResource\TeacherRatingController');

    /*Staff Attendance*/
    Route::resource('staff_attendance', 'App\Http\Controllers\HumanResource\StaffAttendanceController');
    Route::post('staff_attendance/search', [StaffAttendanceController::class, 'searchStaffs'])->name('staff.search');

    /*Disable Staff*/
    Route::get('disable_staff', [StaffDirectoryController::class, 'disable'])->name('disable_staff.index');
    Route::get('disable_staff/search', [StaffDirectoryController::class, 'searchStaff'])->name('disable_staff.search');

    //----------------------------------For Inventory--------------
    /*Item Category*/
    Route::resource('item_category', 'App\Http\Controllers\Inventory\ItemCategoryController');

    /*Item Store*/
    Route::resource('item_store', 'App\Http\Controllers\Inventory\ItemStoreController');

    /*Item Supplier*/
    Route::resource('item_supplier', 'App\Http\Controllers\Inventory\ItemSupplierController');

    /*Item*/
    Route::resource('item', 'App\Http\Controllers\Inventory\ItemController');

    /*Item Stock*/
    Route::resource('item_stock', 'App\Http\Controllers\Inventory\ItemStockController');

    /*Issue Item*/
    Route::resource('issue_item', 'App\Http\Controllers\Inventory\IssueItemController');

    //----------------------------------For Library--------------
    /*Book*/
    Route::resource('book', 'App\Http\Controllers\Library\BookController');

    /*Library Staff and Student Member*/
    Route::get('library/staff_member', [LibraryStaffMemberController::class, 'index'])->name('library_staff_member.index');

    Route::get('library/student_member', [LibraryStudentMemberController::class, 'index'])->name('library_student_member.index');
    Route::get('get_students/search', [LibraryStudentMemberController::class, 'getStudents'])->name('get_students.search');


    /*Issue Return*/
    Route::resource('issue_return', 'App\Http\Controllers\Library\IssueReturnController');
    Route::get('issue_return/get_library_members/search', [IssueReturnController::class, 'getLibraryMembers'])->name('get_library_members.search');
    //Route::get('issue_return/staff/{id}/detail', [IssueReturnController::class, 'staffIssueReturn'])->name('staff_issue_return.detail');
    Route::get('issue_return/{id}/detail', [IssueReturnController::class, 'issueReturn'])->name('issue_return.detail');
    //Route::get('student_return_book/{id}', [IssueReturnController::class, 'studentReturnBook'])->name('student_return_book');
    //Route::post('issue_return/store', [IssueReturnController::class, 'store'])->name('issue_return.store');

    //----------------------------------for NoticeBoard--------------
    Route::get('notice/board', [NoticeBoardController::class, 'index'])->name('notice.board.index');
    Route::get('notice/board/create', [NoticeBoardController::class, 'create'])->name('notice.board.create');
    Route::post('notice/board/store', [NoticeBoardController::class, 'store'])->name('notice.board.store');
    Route::get('notice/board/{id}/destroy', [NoticeBoardController::class, 'noticeDestroy'])->name('notice.board.destroy');

    //----------------------------------for Vehicle Routes--------------
    Route::get('route', [VehicleRouteController::class, 'index'])->name('vehicle.route.index');
    Route::post('route/store', [VehicleRouteController::class, 'store'])->name('vehicle.route.store');
    Route::get('route/{id}/edit', [VehicleRouteController::class, 'edit'])->name('vehicle.route.edit');
    Route::post('route/update', [VehicleRouteController::class, 'update'])->name('vehicle.route.update');
    Route::get('route/{id}/destroy', [VehicleRouteController::class, 'destroy'])->name('vehicle.route.destroy');
    Route::get('route/{id}/restore', [VehicleRouteController::class, 'restore'])->name('vehicle.route.restore');

    //----------------------------------for Vehicle--------------
    Route::get('vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
    Route::post('vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('vehicle/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::post('vehicle/update', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::get('vehicle/{id}/destroy', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
    Route::get('vehicle/{id}/restore', [VehicleController::class, 'restore'])->name('vehicle.restore');

    //----------------------------------for Assign Vehicle--------------
    Route::get('assign_vehicle', [AssignVehicleController::class, 'index'])->name('assign.vehicle.index');
    Route::post('assign_vehicle/store', [AssignVehicleController::class, 'store'])->name('assign.vehicle.store');
    Route::get('assign_vehicle/{id}/edit', [AssignVehicleController::class, 'edit'])->name('assign.vehicle.edit');
    Route::post('assign_vehicle/update', [AssignVehicleController::class, 'update'])->name('assign.vehicle.update');
    Route::get('assign_vehicle/{id}/destroy', [AssignVehicleController::class, 'destroy'])->name('assign.vehicle.destroy');
    Route::get('assign_vehicle/{id}/restore', [AssignVehicleController::class, 'restore'])->name('assign.vehicle.restore');

    //----------------------------------for hostel--------------
    Route::get('hostel', [HostelController::class, 'index'])->name('hostel.index');
    Route::post('hostel/store', [HostelController::class, 'store'])->name('hostel.store');
    Route::get('hostel/{id}/edit', [HostelController::class, 'edit'])->name('hostel.edit');
    Route::post('hostel/update', [HostelController::class, 'update'])->name('hostel.update');
    Route::get('hostel/{id}/destroy', [HostelController::class, 'destroy'])->name('hostel.destroy');
    Route::get('hostel/{id}/restore', [HostelController::class, 'restore'])->name('hostel.restore');

    //----------------------------------for Room Type--------------
    Route::get('room_type', [RoomTypeController::class, 'index'])->name('hostel.room_type.index');
    Route::post('room_type/store', [RoomTypeController::class, 'store'])->name('hostel.room_type.store');
    Route::get('room_type/{id}/edit', [RoomTypeController::class, 'edit'])->name('hostel.room_type.edit');
    Route::post('room_type/update', [RoomTypeController::class, 'update'])->name('hostel.room_type.update');
    Route::get('room_type/{id}/destroy', [RoomTypeController::class, 'destroy'])->name('hostel.room_type.destroy');
    Route::get('room_type/{id}/restore', [RoomTypeController::class, 'restore'])->name('hostel.room_type.restore');

    //----------------------------------for Hostel Rooms--------------
    Route::get('room', [HostelRoomController::class, 'index'])->name('hostel.room.index');
    Route::post('room/store', [HostelRoomController::class, 'store'])->name('hostel.room.store');
    Route::get('room/{id}/edit', [HostelRoomController::class, 'edit'])->name('hostel.room.edit');
    Route::post('room/update', [HostelRoomController::class, 'update'])->name('hostel.room.update');
    Route::get('room/{id}/destroy', [HostelRoomController::class, 'destroy'])->name('hostel.room.destroy');
    Route::get('room/{id}/restore', [HostelRoomController::class, 'restore'])->name('hostel.room.restore');

    //----------------------------------for Upload Content--------------
    Route::get('upload/content', [UploadContentController::class, 'index'])->name('upload.content.index');
    Route::get('upload/content/create', [UploadContentController::class, 'create'])->name('upload.content.create');
    Route::post('upload/content/store', [UploadContentController::class, 'store'])->name('upload.content.store');
    Route::get('upload/content/{id}/destroy', [UploadContentController::class, 'destroy'])->name('upload.content.destroy');
    Route::get('upload/content/{key}', [UploadContentController::class, 'getData'])->name('upload.content.data');

    //----------------------------------for Question Bank--------------
    Route::get('question/bank', [QuestionBankController::class, 'index'])->name('question.bank.index');
    Route::get('question/bank/create', [QuestionBankController::class, 'create'])->name('question.bank.create');
    Route::post('question/bank/store', [QuestionBankController::class, 'store'])->name('question.bank.store');
    Route::get('question/bank/{id}/show', [QuestionBankController::class, 'show'])->name('question.bank.show');
    Route::get('question/bank/{id}/edit', [QuestionBankController::class, 'edit'])->name('question.bank.edit');
    Route::post('question/bank/update', [QuestionBankController::class, 'update'])->name('question.bank.update');
    Route::get('question/bank/{id}/destroy', [QuestionBankController::class, 'destroy'])->name('question.bank.destroy');
    Route::get('question/bank/{id}/restore', [QuestionBankController::class, 'restore'])->name('question.bank.restore');

    //----------------------------------for Online Exam--------------
    Route::get('online/exam', [OnlineExamController::class, 'index'])->name('online.exam.index');
    Route::get('online/exam/create', [OnlineExamController::class, 'create'])->name('online.exam.create');
    Route::post('online/exam/store', [OnlineExamController::class, 'store'])->name('online.exam.store');
    Route::get('online/exam/{id}/edit', [OnlineExamController::class, 'edit'])->name('online.exam.edit');
    Route::post('online/exam/update', [OnlineExamController::class, 'update'])->name('online.exam.update');
    Route::get('online/exam/{id}/destroy', [OnlineExamController::class, 'destroy'])->name('online.exam.destroy');
    Route::get('online/exam/{id}/restore', [OnlineExamController::class, 'restore'])->name('online.exam.restore');
    Route::get('online/exam/{id}/question', [OnlineExamController::class, 'addQuestion'])->name('online.exam.question');
    Route::get('online/exam/{id}/assign', [OnlineExamController::class, 'assign'])->name('online.exam.assign');

    //----------------------------------for School Settng--------------
    Route::get('school/setting', [SchoolSettingController::class, 'index'])->name('school.setting.index');
    Route::post('school/setting/update', [SchoolSettingController::class, 'update'])->name('school.setting.update');

    //----------------------------------for FeeType--------------
    Route::get('fee/type', [FeeTypeController::class, 'index'])->name('fee.type.index');
    Route::post('fee/type/store', [FeeTypeController::class, 'store'])->name('fee.type.store');
    Route::get('fee/type/{id}/edit', [FeeTypeController::class, 'edit'])->name('fee.type.edit');
    Route::post('fee/type/update', [FeeTypeController::class, 'update'])->name('fee.type.update');
    Route::get('fee/type/{id}/destroy', [FeeTypeController::class, 'destroy'])->name('fee.type.destroy');
    Route::get('fee/type/{id}/restore', [FeeTypeController::class, 'restore'])->name('fee.type.restore');

    //----------------------------------for Student Invoice--------------
    Route::get('student/invoice', [StudentInvoiceController::class, 'index'])->name('student.invoice.index');
    Route::get('student/invoice/create', [StudentInvoiceController::class, 'create'])->name('student.invoice.create');
    Route::post('student/invoice/store', [StudentInvoiceController::class, 'store'])->name('student.invoice.store');
    Route::get('student/invoice/{id}/show', [StudentInvoiceController::class, 'show'])->name('student.invoice.show');
    Route::get('student/invoice/{id}/mark/paid', [StudentInvoiceController::class, 'markPaid'])->name('student.invoice.mark.paid');
    Route::get('student/invoice/{id}/destroy', [StudentInvoiceController::class, 'destroy'])->name('student.invoice.destroy');

    //----------------------------------for NoticeBoard--------------
    Route::get('notice/board', [NoticeBoardController::class, 'index'])->name('notice.board.index');
    Route::get('notice/board/create', [NoticeBoardController::class, 'create'])->name('notice.board.create');
    Route::post('notice/board/store', [NoticeBoardController::class, 'store'])->name('notice.board.store');
    Route::get('notice/board/{id}/destroy', [NoticeBoardController::class, 'destroy'])->name('notice.board.destroy');

    //----------------------------------for SendEmail--------------
    Route::get('mailsms/compose', [EmailController::class, 'create'])->name('mailsms.create');
    Route::post('mailsms/store', [EmailController::class, 'store'])->name('mailsms.store');
    Route::get('mailsms/compose_sms', [EmailController::class, 'createSMS'])->name('mailsms.create.sms');
    Route::post('mailsms/store/sms', [EmailController::class, 'storeSMS'])->name('mailsms.store.sms');
    Route::get('mailsms/index', [LogController::class, 'index'])->name('mailsms.index');

    //----------------------------------for Exam Grade--------------
    Route::resource('exam_grade', 'App\Http\Controllers\Super\ExamGradeController');
    Route::get('exam_grade/{examGrade}/destroy', [ExamGradeController::class, 'destroy'])->name('exam_grade.delete');

    //----------------------------------for Exam--------------
    Route::resource('exam', 'App\Http\Controllers\Super\ExamController');
    Route::get('exam/{exam}/destroy', [ExamController::class, 'destroy'])->name('exam.delete');
    Route::get('exam/{exam}/restore', [ExamController::class, 'restore'])->name('exam.restore');

    //----------------------------------for Exam Student--------------
    Route::get('exam/{exam_id}/student', [ExamController::class, 'student'])->name('exam.student');
    Route::post('exam/student/store', [ExamController::class, 'studentStore'])->name('exam.student.store');

    //----------------------------------for Exam Schedule--------------
    Route::get('exam_schedule/{exam_id}/create', [ExamScheduleController::class, 'create'])->name('exam_schedule.create.exam');
    Route::resource('exam_schedule', 'App\Http\Controllers\Super\ExamScheduleController');

    //----------------------------------for Exam Mark--------------
    Route::get('exam_mark', [ExamMarkController::class, 'index'])->name('exam_mark.index');
    Route::get('exam_mark/create', [ExamMarkController::class, 'create'])->name('exam_mark.create');
    Route::get('exam_mark/edit/{exam_id}/{class_id}/{section_id}/{subject_id}', [ExamMarkController::class, 'edit'])->name('exam_mark.edit');
    Route::post('exam_mark/update', [ExamMarkController::class, 'update'])->name('exam_mark.update');

    //----------------------------------for Print Mark sheet--------------
    Route::get('print/mark/sheet', [PrintMarksheetController::class, 'index'])->name('print.mark.sheet.index');
    Route::get('print/mark/sheet/student', [PrintMarksheetController::class, 'getStudent'])->name('print.mark.sheet.student');
    Route::post('print/mark/sheet/generate', [PrintMarksheetController::class, 'generate'])->name('print.mark.sheet.generate');

    //----------------------------------For Fee Collection--------------
    /*Fee Group*/
    Route::resource('fee_group', 'App\Http\Controllers\Super\Fee\FeeGroupController');
    /*Account Ledger*/
    Route::resource('account_ledger', 'App\Http\Controllers\Super\Fee\AccountLedgerController');
    /*Fees Type*/
    Route::resource('fees_type', 'App\Http\Controllers\Super\Fee\FeesTypeController');
    /*Fee Master*/
    Route::resource('fee_master', 'App\Http\Controllers\Super\Fee\FeeMasterController');
    /*Fee Discount*/
    Route::resource('fee_discount', 'App\Http\Controllers\Super\Fee\FeeDiscountController');

    //----------------------------------for student information--------------
    Route::get('studentdetails', [StudentController::class, 'studentdetails'])->name('studentdetails');
    Route::post('student/search', [StudentController::class, 'studentSearch'])->name('student.search');
    Route::get('bulkdelete', [StudentController::class, 'bulkdelete'])->name('bulk.delete');

    Route::get('profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('fee_master/{fee_master}/assign-fee', [AssignFeeController::class, 'index'])->name('assign_fee.index');
    Route::get('fee_master/student/search', [AssignFeeController::class, 'search'])->name('fee_students.search');
    Route::post('fee_master/assign-fee/store', [AssignFeeController::class, 'store'])->name('assign_fee.store');
    Route::get('assigned_fee/student/list', [AssignFeeController::class, 'list'])->name('assign_fee.list');
    Route::get('assigned_fee/student/search', [AssignFeeController::class, 'assignedStudentSearch'])->name('assigned_fee_student.search');
    Route::delete('assigned_fee/student/{id}/delete', [AssignFeeController::class, 'destroy'])->name('assigned_fee_student.destroy');


    Route::get('fee_discount/{fee_discount}/assign-discount', [AssignDiscountController::class, 'index'])->name('assign_discount.index');
    Route::get('fee_discount/student/search', [AssignDiscountController::class, 'search'])->name('discount_students.search');
    Route::post('fee_discount/assign-discount/store', [AssignDiscountController::class, 'store'])->name('assign_discount.store');
    Route::get('assigned_discount/student/list', [AssignDiscountController::class, 'list'])->name('assigned_discount.list');
    Route::get('assigned_discount/student/search', [AssignDiscountController::class, 'assignedDiscountStudentSearch'])->name('assigned_discount_student.search');
    Route::delete('assigned_discount/student/{id}/delete', [AssignDiscountController::class, 'destroy'])->name('assigned_discount_student.destroy');

    Route::get('collect_fee', [CollectFeeController::class, 'index'])->name('collect_fee.index');
    Route::get('collect_fee/student/search', [CollectFeeController::class, 'search'])->name('collect_fee_students.search');
//    Route::get('collect_fee/student/{id}', [CollectFeeController::class, 'collectFee'])->name('collect_fee.student');

    Route::get('fee_carry_forward', [FeeCarryForwardController::class, 'index'])->name('fee_carry_forward.index');
    Route::post('fee_carry_forward/store', [FeeCarryForwardController::class, 'store'])->name('fee_carry_forward.store');
    Route::get('fee_carry_forward/student/search', [FeeCarryForwardController::class, 'search'])->name('fee_carry_forward.search');

    Route::get('fee_reminder', [\App\Http\Controllers\Super\Fee\FeeReminderController::class, 'index'])->name('fee_reminder.index');
    Route::post('fee_reminder/store', [\App\Http\Controllers\Super\Fee\FeeReminderController::class, 'store'])->name('fee_reminder.store');

    Route::get('student/due-fees', [\App\Http\Controllers\Super\Fee\CollectFeeController::class, 'dueFees'])->name('due_fees.index');

});
