<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if($guard == 'student'){
                    return redirect(RouteServiceProvider::STUDENT_HOME);
                }elseif($guard == 'parent'){
                    return redirect(RouteServiceProvider::PARENT_HOME);
                } elseif ($guard == 'staff'){
                    if (auth()->guard('staff')->user()->role->name == 'Teacher'){
                        return redirect(RouteServiceProvider::TEACHER_HOME);
                    }
                    elseif(auth()->guard('staff')->user()->role->name == 'Librarian'){
                        return redirect(RouteServiceProvider::LIBRARIAN_HOME);
                    }
                    elseif (auth()->guard('staff')->user()->role->name == 'Accountant') {
                        return redirect(RouteServiceProvider::ACCOUNTANT_HOME);
                    }
                    elseif (auth()->guard('staff')->user()->role->name == 'Receptionist') {
                        return redirect(RouteServiceProvider::RECEPTIONIST_HOME);
                    }
                    elseif (auth()->guard('staff')->user()->role->name == 'Admin') {
                        return redirect(RouteServiceProvider::ADMIN_HOME);
                    }
                }elseif (Auth::user()->user_type == 'superadmin'){
                    return redirect()->route('super.dashboard');
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
