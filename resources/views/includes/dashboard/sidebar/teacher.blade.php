<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{route('teacher.dashboard')}}" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
{{--            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">--}}
{{--                    <i class="la la-calendar-check-o"></i>--}}
{{--                    <span class="nav-text">Front Office</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="{{route('admission-inquiry')}}">Admission Enquiry</a></li>--}}
{{--                    <li><a href="{{route('visitor-book')}}">Visitor Book</a></li>--}}
{{--                    <li><a href="{{route('phone-call-log')}}">Phone Call Log</a></li>--}}
{{--                    <li><a href="{{route('postal-dispatch')}}">Postal Dispatch</a></li>--}}
{{--                    <li><a href="{{route('postal-receive')}}">Postal Receive</a></li>--}}
{{--                    <li><a href="{{route('complain')}}">Complain</a></li>--}}
{{--                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Setup Front Office</a>--}}
{{--                        <ul>--}}
{{--                            <li><a href="{{route('purpose') }}">Purpose</a></li>--}}
{{--                            <li><a href="{{route('complain-type') }}">Complain Type</a></li>--}}
{{--                            <li><a href="{{route('source') }}">Source</a></li>--}}
{{--                            <li><a href="{{route('reference') }}">Reference</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Academics</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('teacher.session') }}">Session</a></li>
                    <li><a href="{{route('teacher.class') }}">Class</a></li>
                    <li><a href="{{route('teacher.section') }}">Section</a></li>
                    <li><a href="{{route('teacher.session-class') }}">Session Class</a></li>
                    <li><a href="{{route('teacher.category') }}">Category</a></li>
                    <li><a href="{{route('teacher.subject') }}">Subject</a></li>
                    <li><a href="{{route('teacher.student') }}">Student</a></li>
                    <li><a href="{{route('teacher.academic-calendar') }}">Academic Calendar</a></li>
                    <li><a href="{{route('teacher.feed') }}">Feed</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Lesson Plans</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('teacher.lesson.index') }}">Lessons</a></li>
                    <li><a href="{{route('teacher.topic.index') }}">Topics</a></li>
                    <li><a href="{{route('teacher.manage_syllabus_status.index') }}">Manage Syllabus Status</a></li>
                    <li><a href="{{route('teacher.manage_lesson_plan.index') }}">Manage Lesson Plan</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Leave</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('teacher.apply_leave.index') }}">Apply Leave</a></li>
                </ul>
            </li>
{{--            <li>--}}
{{--                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
{{--                    <i class="la la-book"></i>--}}
{{--                    <span class="nav-text">Library</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="{{route('book.index')}}">Book List</a></li>--}}
{{--                    <li><a href="{{route('library_staff_member.index')}}">Add Staff Member</a></li>--}}
{{--                    <li><a href="{{route('library_student_member.index')}}">Add Student Member</a></li>--}}
{{--                    <li><a href="{{route('issue_return.index')}}">Issue Return</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
{{--                    <i class="la la-building"></i>--}}
{{--                    <span class="nav-text">Inventory</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="{{route('item_category.index') }}">Item Category</a></li>--}}
{{--                    <li><a href="{{route('item_store.index') }}">Item Store</a></li>--}}
{{--                    <li><a href="{{route('item_supplier.index') }}">Item Supplier</a></li>--}}
{{--                    <li><a href="{{route('item.index') }}">Item</a></li>--}}
{{--                    <li><a href="{{route('item_stock.index') }}">Item Stock</a></li>--}}
{{--                    <li><a href="{{route('issue_item.index') }}">Issue Item</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-tasks"></i>
                    <span class="nav-text">Examination</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('teacher.exam-type') }}">Exam Type</a></li>
                    <li><a href="{{route('teacher.exam-group') }}">Exam Group</a></li>
                    <li><a href="{{route('teacher.grade') }}">Marks Grade</a></li>
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
                    <li><a href="{{route('teacher.class-schedule') }}">Class Schedule</a></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            Teacher Schedule
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="#">Add Teacher Schedule</a></li>
                            <li><a href="#">View Teacher Schedule</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Homework</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('teacher.homework') }}">Homework</a></li>
                </ul>
            </li>
{{--            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
{{--                    <i class="la la-calendar-check-o"></i>--}}
{{--                    <span class="nav-text">Homework</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="{{route('homework') }}">Homework</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
