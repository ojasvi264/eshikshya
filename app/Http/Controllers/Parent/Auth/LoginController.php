<?php

namespace App\Http\Controllers\Parent\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PARENT_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:parent')->except('logout');
    }

    public function showLoginForm()
    {
        return view('parent.login');
    }

    public function guard(){
        return Auth::guard('parent');
    }

    public function logout(Request $request)
    {
        Auth::guard('parent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/parent/login');
    }
}
