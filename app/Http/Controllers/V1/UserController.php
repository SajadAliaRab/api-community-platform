<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
               $createdUser =  User::query()->create([
                    'userName' => $userName,
                    'fName' => $fName,
                    'lName' => $lName,
                    'email' => $email,
                    'password' => $password
                ]);
               UserDetail::query()->create([
                   'user_id'=> $createdUser->id,
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

    public function GetUserById(Request $request)
    {
        $user = User::query()->find($request['id']);
        if($user){
            return response()->json([
                'result'=>true,
                'message'=> 'user found',
                'data'=> $user
            ],200);
        }else{
            return response()->json([
                'result'=> false,
                'message'=> 'user not found',
            ],400);
        }
    }
    public function DeleteUser($userId)
    {
        try {
            $user = User::query()->where('id', $userId)->first();
            if ($user) {
                $user->delete();
                return response()->json([
                    'result' => true,
                    'message' => 'user have deleted successfully'
                ],200);
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'user not found'
                ],404);
            }
        }catch(\Exception $e){
            return response()->json([
                'result' => false,
                'message' => 'An error occurred while deleting user : ' . $e->getMessage()
            ], 500);
        }

}
    public function UpdateUser(Request $request, $userId)
{
    try {
        $user = User::where('id',$userId)->first();

            $validatedUser= $request->validate([
                'userName'=> 'required|string',
                'fName'=> 'required|string',
                'lName'=> 'nullable|string'
            ]);
            if($user){
                $user->update($validatedUser);
                return response()->json([
                    'result'=>true,
                    'message'=> 'user updated successfully'
                ],200);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=> 'user could not find'

                ],404);
            }
    }catch (\Exception $e){
        return response()->json([
           'result'=> false,
            'message' => 'An error occurred while updating user : ' . $e->getMessage()
        ],500);
    }
}
    public function ChangePassword(Request $request, $userId)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
        ]);
        try{
            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'result' => false,
                    'message' => 'User not found',
                ], 404);
            }


            if (!Hash::check($request->input('currentPassword'), $user->password)) {
                return response()->json([
                    'result' => false,
                    'message' => 'Current password is incorrect',
                ], 400);
            }


            $user->password = Hash::make($request->input('newPassword'));
            $user->save();

            return response()->json([
                'result' => true,
                'message' => 'Password changed successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'An error occurred while changing the password: ' . $e->getMessage(),
            ], 500);

        }
    }
}
