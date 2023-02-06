<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.dashboard.header')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
@include('includes.dashboard.navbar')
    <!------------------------------------- Wrapper Starts ------------------------------------->
    <div id="wrapper">
        <!--------------------------------- Header Wrapper Starts ---------------------------------->
        <header id="header-wrapper">
            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                @if (\Illuminate\Support\Facades\Auth::guard('staff')->user()->role->name ==  'Teacher')
                    @include('includes.dashboard.sidebar.teacher')
                @elseif (\Illuminate\Support\Facades\Auth::guard('staff')->user()->role->name == 'Librarian')
                    @include('includes.dashboard.sidebar.librarian')
                @elseif (\Illuminate\Support\Facades\Auth::guard('staff')->user()->role->name == 'Accountant')
                    @include('includes.dashboard.sidebar.accountant')
                @elseif (\Illuminate\Support\Facades\Auth::guard('staff')->user()->role->name == 'Admin')
                    @include('includes.dashboard.sidebar.admin')
                @elseif (\Illuminate\Support\Facades\Auth::guard('staff')->user()->role->name == 'Receptionist')
                    @include('includes.dashboard.sidebar.receptionist')
                @endif
            @elseif (\Illuminate\Support\Facades\Auth::guard('student')->check())
                @include('includes.dashboard.sidebar.student')
            @elseif (\Illuminate\Support\Facades\Auth::guard('parent')->check())
                @include('includes.dashboard.sidebar.parent')
            @else
                @include('includes.dashboard.sidebar.superAdmin')
            @endif
            @include('includes.dashboard.navbar')

        </header>

        <!---------------------------------- Header Wrapper Ends ----------------------------------->

        <!-------------------------------- Content Wrapper Starts ---------------------------------->
        <div id="content-wrapper">
            <section class="content">
                     @yield('content')
            </section>


        </div>
        <!--------------------------------- Content Wrapper Ends ----------------------------------->


        <!--------------------------------- Footer Wrapper Starts ---------------------------------->
        <footer id="footer-wrapper">
            @include('includes.dashboard.footer')
        </footer>

        <!---------------------------------- Footer Wrapper Ends ----------------------------------->
    </div>
    <!-------------------------------------- Wrapper Ends -------------------------------------->
    <!--**********************************
          Scripts
      ***********************************-->
    @include('includes.dashboard.scripts')
    @yield('scripts')
</body>
</html>
