<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{route('super.dashboard')}}" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Front Office</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Setup Front Office</a>
                        <ul>
                            <li><a href="{{route('purpose') }}">Purpose</a></li>
                            <li><a href="{{route('complain-type') }}">Complain Type</a></li>
                            <li><a href="{{route('source') }}">Source</a></li>
                            <li><a href="{{route('reference') }}">Reference</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('admission-inquiry')}}">Admission Inquiry</a></li>
                    <li><a href="{{route('visitor-book')}}">Visitor Book</a></li>
                    <li><a href="{{route('phone-call-log')}}">Phone Call Log</a></li>
                    <li><a href="{{route('postal-dispatch')}}">Postal Dispatch</a></li>
                    <li><a href="{{route('postal-receive')}}">Postal Receive</a></li>
                    <li><a href="{{route('complain')}}">Complain</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Academics</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('session') }}">Session</a></li>
                    <li><a href="{{route('class') }}">Class</a></li>
                    <li><a href="{{route('section') }}">Section</a></li>
                    <li><a href="{{route('session-class') }}">Session Class</a></li>
                    <li><a href="{{route('category') }}">Category</a></li>
                    <li><a href="{{route('subject') }}">Subject</a></li>
                    <li><a href="{{route('student') }}">Student</a></li>
                    <li><a href="{{route('academic-calendar') }}">Academic Calendar</a></li>
                    <li><a href="{{route('feed') }}">Feed</a></li>
                </ul>
            </li>
          {{--  <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Student Information</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('studentdetails')}}">Student Details</a></li>
                    <li><a href="">Student Admission</a></li>
                    <li><a href="{{route('bulk.delete')}}">Bulk Delete</a></li>
                    <li><a href="">Student Category</a></li>
                    <li><a href="">Student House</a></li>
                    <li><a href="">Disable Reason</a></li>
                </ul>
            </li>--}}
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Human Resource</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('role.index') }}">Roles</a></li>
                    <li><a href="{{route('department.index') }}">Departments</a></li>
                    <li><a href="{{route('designation.index') }}">Designations</a></li>
                    <li><a href="{{route('staff_directory.index') }}">Staff Directory</a></li>
                    <li><a href="{{route('teacher_rating.index') }}">Teacher Rating</a></li>
                    <li><a href="{{route('leave_type.index') }}">Leave Type</a></li>
{{--                    <li><a href="{{route('apply_leave.index') }}">Apply Leave</a></li>--}}
                    <li><a href="{{route('leave_request.index') }}">Approve Leave Request</a></li>
                    <li><a href="{{route('disable_staff.index') }}">Disable Staff</a></li>
                    <li><a href="{{route('staff_attendance.index') }}">Staff Attendance</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Fee Collection</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('fee_group.index') }}">Fee Title</a></li>
                    <li><a href="{{route('fees_type.index') }}">Fees Type</a></li>
                    <li><a href="{{route('fee_master.index') }}">Assign Fees</a></li>
                    <li><a href="{{route('fee_discount.index') }}">Fee Discount</a></li>
                    <li><a href="#">Print Monthly Fee</a></li>
                    <li><a href="{{route('collect_fee.index')}}">Collect Fees</a></li>
                    <li><a href="{{route('fee_carry_forward.index')}}">Fees Carry Forward</a></li>
                    <li><a href="{{route('fee_reminder.index')}}">Fees Reminder</a></li>
                    <li><a href="{{route('due_fees.index')}}">Search Due Fees</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Lesson Plans</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('lesson.index') }}">Lessons</a></li>
                    <li><a href="{{route('topic.index') }}">Topics</a></li>
                    <li><a href="{{route('manage_syllabus_status.index') }}">Manage Syllabus Status</a></li>
                    <li><a href="{{route('manage_lesson_plan.index') }}">Manage Lesson Plan</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Library</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('book.index')}}">Book List</a></li>
                    <li><a href="{{route('library_staff_member.index')}}">Add Staff Member</a></li>
                    <li><a href="{{route('library_student_member.index')}}">Add Student Member</a></li>
                    <li><a href="{{route('issue_return.index')}}">Issue Return</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-building"></i>
                    <span class="nav-text">Inventory</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('item_category.index') }}">Item Category</a></li>
                    <li><a href="{{route('item.index') }}">Item</a></li>
                    <li><a href="{{route('item_store.index') }}">Item Store</a></li>
                    <li><a href="{{route('item_supplier.index') }}">Item Supplier</a></li>
                    <li><a href="{{route('item_stock.index') }}">Item Stock</a></li>
                    <li><a href="{{route('issue_item.index') }}">Issue Item</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                    <span class="nav-text">Communicate</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('notice.board.index') }}">Notice Board</a></li>
                    <li><a href="{{ route('mailsms.create') }}">Send Email</a></li>
                    <li><a href="{{ route('mailsms.create.sms') }}">Send SMS</a></li>
                    <li><a href="{{ route('mailsms.index') }}">Email / SMS Log</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <span class="nav-text">Download Center</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('upload.content.index') }}">Upload Content</a></li>
                    <li><a href="{{ route('upload.content.data', 'assignments') }}">Assignments</a></li>
                    <li><a href="{{ route('upload.content.data', 'study_material') }}">Study Materials</a></li>
                    <li><a href="{{ route('upload.content.data', 'syllabus') }}">Syllabus</a></li>
                    <li><a href="{{ route('upload.content.data', 'other_download') }}">Other Downloads</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-tasks"></i>
                    <span class="nav-text">Examination</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('exam-type') }}">Exam Type</a></li>
                    <li><a href="{{ route('exam_grade.index') }}">Exam Grade</a></li>
                    <li><a href="{{ route('exam.index') }}">Exam</a></li>
                    <li><a href="{{ route('exam_schedule.index') }}">Exam Schedule</a></li>
                    <li><a href="{{ route('exam_mark.index') }}">Manage Mark</a></li>
                    <li><a href="{{ route('print.mark.sheet.index') }}">Print Mark sheet</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="fa fa-rss" aria-hidden="true"></i>
                    <span class="nav-text">Online Examinations</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('online.exam.index') }}">Online Exam</a></li>
                    <li><a href="{{ route('question.bank.index') }}">Question Bank</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Schedule</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('class-schedule') }}">Class Schedule</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Homework</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('homework')}}">Homework</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-building"></i>
                    <span class="nav-text">Hostel</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('hostel.room.index') }}">Hostel Rooms</a></li>
                    <li><a href="{{ route('hostel.room_type.index') }}">Room Type</a></li>
                    <li><a href="{{ route('hostel.index') }}">Hostel</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-bus"></i>
                    <span class="nav-text">Transport</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('vehicle.route.index') }}">Routes</a></li>
                    <li><a href="{{ route('vehicle.index') }}">Vehicles</a></li>
                    <li><a href="{{ route('assign.vehicle.index') }}">Assign Vehicle</a></li>
                </ul>
            </li>
            <li><a href="{{ route('school.setting.index') }}" aria-expanded="false">
                    <i class="fa fa-gear"></i>
                    <span class="nav-text">School Setting</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Account</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('account.category.index') }}">Category</a></li>
                    <li class="{{ (request()->is('account/voucher*')) ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                            Voucher
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('account.voucher.getupapproved') }}">Unapproved Voucher</a></li>
                            <li><a href="{{route('account.voucher.getapproved') }}">Approved Voucher</a></li>
                            <li><a href="{{route('account.voucher.rejected') }}">Rejected Voucher</a></li>
                        </ul>
                    </li>
                    <li class="{{ (request()->is('account/voucherentry*')) ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                            Voucher Entry
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('account.voucherentry.journalentry') }}">Journal Entry</a></li>
                            <li><a href="{{route('account.voucherentry.receiptentry') }}">Income Entry</a></li>
                            <li><a href="{{route('account.voucherentry.paymententry') }}">Expense Entry</a></li>
                        </ul>
                    </li>
                    <li class="{{ (request()->is('account/report*')) ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                            Financial Reports
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('account.report.trailbalance') }}">Trial Balance</a></li>
                            <li><a href="{{route('account.report.generalledger') }}">General Ledger</a></li>
                            <li><a href="{{route('account.report.profilandloss') }}">Profit & Loss</a></li>
                            <li><a href="{{route('account.report.balancesheet') }}">Balance Sheet</a></li>
                            <li><a href="{{route('account.report.daybook') }}">Day Book</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
