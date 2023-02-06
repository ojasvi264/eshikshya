<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\SParent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ParentLoginController extends Controller
{
    /**
     * Login The User
     * @param Request $request
     * @return User|\Illuminate\Http\JsonResponse
     */
    public function  parentLogin(Request $request){
        try{
            $validateUser =Validator::make($request->all(),
                [
                    'email' => 'required|email|exists:parents',
                    'password' => 'required'
                ]);
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            $user = SParent::where('email', $request->email)->firstOrFail();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'password' => ['Password is incorrect.'],
                ]);
            }
            elseif($user){
                return response()->json([
                    'status' => true,
                    'message' => 'Parent Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                    'data' =>$user
                ], 200);
            }
            else{
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Credentials!'
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
