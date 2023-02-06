<!DOCTYPE html>
<html lang="en">
@include('includes.login-head')
<body style="margin: 0px;">
<div id="login-page" class="common-background-page" style="background-image: url({{asset('images/teacher1.jpg')}});">
    <div class="login-box">
        <div class="login-box-wrapper">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">
                </div>
            </div>
            <div class="content">
                <h3 class="form-title">User Login</h3>
                <form action="{{route('login')}}" method="POST" class="login-form">
                    @csrf
                    <div class="username input-item">
                        <input type="text" class="form-control" name="email" id="username" placeholder="Username">
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <span class="text-danger">@error('email'){{$message}} @enderror</span>
                    </div>
                    <div class="password input-item">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <span class="text-danger">@error('password'){{$message}} @enderror</span>
                    </div>
                    <button class="btn" type="submit">Sign In</button>
                </form>
                <a href="#" class="forgot-password-link">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                    Forgot Password
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
{{--<script>--}}
{{--    function superLogin(){--}}
{{--        const email = $('#username').val();--}}
{{--        const password = $('#password').val();--}}
{{--        if (!email){--}}
{{--            $('#email_error').html('Please enter your email.')--}}
{{--            return--}}
{{--        }--}}
{{--        if (!password){--}}
{{--            $('#password_error').html('Please enter your password.')--}}
{{--            return--}}
{{--        }--}}
{{--        $.ajax({--}}
{{--            type: 'POST',--}}
{{--            url: "{{route('login')}}",--}}
{{--            data: {_token:'{{csrf_token()}}', email: email, password: password},--}}
{{--            success: function (response) {--}}
{{--                window.location.href = {{route('super.dashboard')}};--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
</body>

</html>
