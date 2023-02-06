<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{route('admin.dashboard')}}" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Front Office</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Setup Front Office</a>
                        <ul>
                            <li><a href="{{route('admin.purpose') }}">Purpose</a></li>
                            <li><a href="{{route('admin.complain-type') }}">Complain Type</a></li>
                            <li><a href="{{route('admin.source') }}">Source</a></li>
                            <li><a href="{{route('admin.reference') }}">Reference</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('admin.admission-inquiry')}}">Admission Inquiry</a></li>
                    <li><a href="{{route('admin.visitor-book')}}">Visitor Book</a></li>
                    <li><a href="{{route('admin.phone-call-log')}}">Phone Call Log</a></li>
                    <li><a href="{{route('admin.postal-dispatch')}}">Postal Dispatch</a></li>
                    <li><a href="{{route('admin.postal-receive')}}">Postal Receive</a></li>
                    <li><a href="{{route('admin.complain')}}">Complain</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Academics</span>
                </a>
                <ul aria-expanded="false">
                   <li><a href="{{route('admin.session') }}">Session</a></li>
                    <li><a href="{{route('admin.class') }}">Class</a></li>
                    <li><a href="{{route('admin.section') }}">Section</a></li>
                    <li><a href="{{route('admin.session-class') }}">Session Class</a></li>
                    <li><a href="{{route('admin.category') }}">Category</a></li>
                    <li><a href="{{route('admin.subject') }}">Subject</a></li>
                    <li><a href="{{route('admin.student') }}">Student</a></li>
                    <li><a href="{{route('admin.academic-calendar') }}">Academic Calendar</a></li>
                    <li><a href="{{route('admin.feed') }}">Feed</a></li>
                  {{--  <li> <a href="{{route('student') }}">Student</a></li>
                    <li><a href="{{route('parents') }}">Parent</a></li>--}}
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Lesson Plans</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.lesson.index') }}">Lessons</a></li>
                    <li><a href="{{route('admin.topic.index') }}">Topics</a></li>
                    <li><a href="{{route('admin.manage_syllabus_status.index') }}">Manage Syllabus Status</a></li>
                    <li><a href="{{route('admin.manage_lesson_plan.index') }}">Manage Lesson Plan</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Human Resource</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.role.index') }}">Roles</a></li>
                    <li><a href="{{route('admin.department.index') }}">Departments</a></li>
                    <li><a href="{{route('admin.designation.index') }}">Designations</a></li>
                    <li><a href="{{route('admin.staff_directory.index') }}">Staff Directory</a></li>
                    <li><a href="{{route('admin.teacher_rating.index') }}">Teacher Rating</a></li>
                    <li><a href="{{route('admin.leave_type.index') }}">Leave Type</a></li>
                    <li><a href="{{route('admin.apply_leave.index') }}">Apply Leave</a></li>
                    <li><a href="{{route('admin.leave_request.index') }}">Approve Leave Request</a></li>
                    <li><a href="{{route('admin.disable_staff.index') }}">Disable Staff</a></li>
                    <li><a href="{{route('admin.staff_attendance.index') }}">Staff Attendance</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Library</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.book.index')}}">Book List</a></li>
                    <li><a href="{{route('admin.library_staff_member.index')}}">Add Staff Member</a></li>
                    <li><a href="{{route('admin.library_student_member.index')}}">Add Student Member</a></li>
                    <li><a href="{{route('admin.issue_return.index')}}">Issue Return</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-building"></i>
                    <span class="nav-text">Inventory</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.item_category.index') }}">Item Category</a></li>
                    <li><a href="{{route('admin.item_store.index') }}">Item Store</a></li>
                    <li><a href="{{route('admin.item_supplier.index') }}">Item Supplier</a></li>
                    <li><a href="{{route('admin.item.index') }}">Item</a></li>
                    <li><a href="{{route('admin.item_stock.index') }}">Item Stock</a></li>
                    <li><a href="{{route('admin.issue_item.index') }}">Issue Item</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-tasks"></i>
                    <span class="nav-text">Examination</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.exam-type') }}">Exam Type</a></li>
                    <li><a href="{{route('admin.exam-group') }}">Exam Group</a></li>
                    <li><a href="{{route('admin.grade') }}">Marks Grade</a></li>
           {{--         <li><a href="{{route('exam-schedule') }}">Exam Schedule</a></li>--}}
               {{--     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Exam Result</a>
                        <ul>
                            <li><a href="{{route('exam-result') }}">Add Result</a></li>
                            <li><a href="{{route('exam-result-view') }}">View Result</a></li>
                        </ul>
                    </li>--}}
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Schedule</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.class-schedule') }}">Class Schedule</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Homework</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.homework') }}">Homework</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
