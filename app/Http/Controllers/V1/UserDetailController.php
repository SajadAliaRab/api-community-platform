<?php

namespace App\Http\Controllers\V1;

use App\Enums\TitleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserDetailController extends Controller
{
    public function createUserDetail(Request $request)
    {
        $user_id = $request->input('userId');

        // Check if the user ID exists in the users table
        $user = User::find($user_id);

        if (!$user) {
            return response()->json([
                'result' => false,
                'message' => 'User ID does not exist'
            ], 404);
        }

        // Create user detail
        UserDetail::query()->create([
            'user_id' => $user_id,
        ]);

        return response()->json([
            'result' => true,
            'message' => 'User detail created'
        ], 201);
    }

    public function updateUserDetail(Request $request, $userId)
    {
        try {
            $userDetail = UserDetail::where('user_id', $userId)->first();
        // Validate input data
        $validatedData = $request->validate([
            'image' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'tagline' => 'nullable|string',
            'title' => ['nullable', Rule::in(TitleEnum::getValues())],
            'website' => 'nullable|string|url',
            'mobile' => 'required|string',
            'point' => 'nullable|integer',
        ]);



            if ($userDetail) {
                // Update user details with validated data
                $userDetail->update($validatedData);

                return response()->json([
                    'result'=> true,
                    'message'=> 'User details updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'result'=> false,
                    'message'=> 'User could not be found'
                ], 404);
            }
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'result' => false,
                'message' => 'An error occurred while updating user details: ' . $e->getMessage()
            ], 500);
        }
    }
}
