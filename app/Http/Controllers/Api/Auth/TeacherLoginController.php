<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\StaffDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TeacherLoginController extends Controller
{
    /**
     * Login The User
     * @param Request $request
     * @return User|\Illuminate\Http\JsonResponse
     */
    public function  teacherLogin(Request $request){
        try{
            $validateUser =Validator::make($request->all(),
                [
                    'email' => 'required|email|exists:staff_directories',
                    'password' => 'required'
                ]);
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            $user = StaffDirectory::where('email', $request->email)->firstOrFail();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'password' => ['Password is incorrect.'],
                ]);
            }
            elseif($user->role->name == 'Teacher'){
                return response()->json([
                    'status' => true,
                    'message' => 'Teacher Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                    'data' =>$user
                ], 200);
            }
            else{
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials!'
                ], 500);
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
