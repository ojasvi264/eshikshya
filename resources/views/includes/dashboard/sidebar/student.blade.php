<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{route('student.dashboard') }}" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Homework</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('student.homework.get') }}">Homework Submission</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Leave</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('student.leave_request.index') }}">Apply Leave</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Teacher Rating</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('student.teacher_rating.index') }}">Teacher Rating</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
