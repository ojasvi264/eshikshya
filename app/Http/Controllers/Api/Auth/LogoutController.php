<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function apiLogout(){
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
            return response()->json(['success' =>'Successfully logged out!'],200);
        }else{
            return response()->json(['error' =>'Something went wrong!'], 500);
        }
    }
}
