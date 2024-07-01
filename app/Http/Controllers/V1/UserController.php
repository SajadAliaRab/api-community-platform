<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function RegisterUser(Request $request)
    {
        if($request!=null) {
            $userName = $request->input('userName');
            $fName = $request->input('fName');
            $lName = $request->input('lName');
            $email = $request->input('email');
            $password = $request->input('password');
             $user =User::query()->where('email',$email)->first();
            if (!$user ) {
                User::query()->create([
                    'userName' => $userName,
                    'fName' => $fName,
                    'lName' => $lName,
                    'email' => $email,
                    'password' => $password
                ]);
                return response()->json([
                    'result' => true,
                    'message' => 'user added successfully',
                    'data' => [
                        'userName' => $userName,
                        'fName' => $fName,
                        'lName' => $lName,
                        'email' => $email
                    ]
                ], 201);
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'This user exist in db',
                ], 400);
            }
        }else{
            return response()->json([
                'result' => false,
                'message' => 'the request not exist',
            ], 404);
        }
    }
    public function LoginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($request['remember']===true) {
                $token = $user->createToken('AuthToken')->plainTextToken;
            }else{
                $token =$user->createToken('AuthToken',['*'], now()->addMinutes(30))->plainTextToken;
            }
            return response()->json([
                'result'=>true,
                'message' => 'Login successful',
                'data'=> $token
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }

    public function LogoutUser(Request $request)
    {
        $token = PersonalAccessToken::findToken($request['token']);
        if(!$token){
           return response()->json([
                'result'=> false,
                'message'=> 'token could not find'
            ],404);
        }else{
            $token->delete();
           return response()->json([
                'result'=>true,
                'message'=> 'User Logout Successfully'
            ],200);
        }
    }

    public function CheckToken(Request $request)
    {
        $token = PersonalAccessToken::findToken($request['token']);
        if(!$token){
            return response()->json([
                'result'=> false,
                'message'=> 'token could not find',
            ],401);
        }else{
            if ($token->expires_at>=now() || $token->expires_at === null){

                return response()->json([
                    'result'=>true,
                    'message'=>'token accepted',
                    'data'=> $token->tokenable_id
                    ],200);
            }else{
                return response()->json([
                    'result'=> false,
                    'message'=> 'token has expired',
                ],401);
            }
        }

    }
}
