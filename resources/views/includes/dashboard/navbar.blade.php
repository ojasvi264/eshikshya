<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="" class="brand-logo">
            <img class="logo-abbr toggle-logo" src="{{ asset('images/logo/text-logo.png') }}" alt="{{ config('app.name') }}">
            <img class="logo-abbr collapsed-toggle-logo" src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                      {{--  <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            <div class="dropdown-menu p-0 m-0">
                                <form>
                                    <input class="form-control" type="search" placeholder="Search"
                                           aria-label="Search">
                                </form>
                            </div>
                        </div>--}}
                    </div>

                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown notification_dropdown">
                            <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                                <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                     viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <div class="pulse-css"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="list-unstyled">
                                    <li class="media dropdown-item">
                                        <span class="success"><i class="ti-user"></i></span>
                                        <div class="media-body">
                                            <a href="#">
                                                <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                    Successfully
                                                </p>
                                            </a>
                                        </div>
                                        <span class="notify-time">3:20 am</span>
                                    </li>
                                    <li class="media dropdown-item">
                                        <span class="primary"><i class="ti-shopping-cart"></i></span>
                                        <div class="media-body">
                                            <a href="#">
                                                <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                            </a>
                                        </div>
                                        <span class="notify-time">3:20 am</span>
                                    </li>
                                    <li class="media dropdown-item">
                                        <span class="danger"><i class="ti-bookmark"></i></span>
                                        <div class="media-body">
                                            <a href="#">
                                                <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                    unsolved.
                                                </p>
                                            </a>
                                        </div>
                                        <span class="notify-time">3:20 am</span>
                                    </li>
                                    <li class="media dropdown-item">
                                        <span class="primary"><i class="ti-heart"></i></span>
                                        <div class="media-body">
                                            <a href="#">
                                                <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                            </a>
                                        </div>
                                        <span class="notify-time">3:20 am</span>
                                    </li>
                                    <li class="media dropdown-item">
                                        <span class="success"><i class="ti-image"></i></span>
                                        <div class="media-body">
                                            <a href="#">
                                                <p><strong> James.</strong> has added a<strong>customer</strong>
                                                    Successfully
                                                </p>
                                            </a>
                                        </div>
                                        <span class="notify-time">3:20 am</span>
                                    </li>
                                </ul>
                                <a class="all-notification" href="#">See all notifications <i
                                        class="ti-arrow-right"></i></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <img src="{{ asset('template/images/profile/education/pic1.jpg') }}" width="20" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('user.profile')}}" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                         viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="email-inbox.html" class="dropdown-item ai-icon">
                                    <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                         viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span class="ml-2">Inbox </span>
                                </a>
                                @if(auth()->guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        <a href="{{ route('teacher.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                            <i class="la la-sign-out"></i>
                                            <span class="ml-2">Logout </span>
                                        </a>
                                        <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                        <a href="{{ route('librarian.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                            <i class="la la-sign-out"></i>
                                            <span class="ml-2">Logout </span>
                                        </a>
                                        <form id="logout-form" action="{{ route('librarian.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        <a href="{{ route('accountant.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                            <i class="la la-sign-out"></i>
                                            <span class="ml-2">Logout </span>
                                        </a>
                                        <form id="logout-form" action="{{ route('accountant.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Admin')
                                        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                            <i class="la la-sign-out"></i>
                                            <span class="ml-2">Logout </span>
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        <a href="{{ route('receptionist.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                            <i class="la la-sign-out"></i>
                                            <span class="ml-2">Logout </span>
                                        </a>
                                        <form id="logout-form" action="{{ route('receptionist.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endif
                                @elseif(auth()->guard('student')->check())
                                    <a href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                        <i class="la la-sign-out"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @elseif(auth()->guard('parent')->check())
                                    <a href="{{ route('parent.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                        <i class="la la-sign-out"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                    <form id="logout-form" action="{{ route('parent.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                        <i class="la la-sign-out"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->

    <!--**********************************
        Sidebar end
    ***********************************-->
</div>


