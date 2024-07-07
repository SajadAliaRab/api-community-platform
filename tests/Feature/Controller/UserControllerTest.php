<?php

namespace Tests\Feature\Controller;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{

use RefreshDatabase;
    public function test_user_registration_successful()
    {
        // Use the factory to create a user's data
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'secret123'; // Add password manually as it's not in the factory

        $response = $this->postJson('/api/v1/signup', $userData);
        $response->assertStatus(201)
            ->assertJson([
                'result' => true,
                'message' => 'user added successfully',
                'data' => [
                    'userName' => $userData['userName'],
                    'fName' => $userData['fName'],
                    'lName' => $userData['lName'],
                    'email' => $userData['email']
                ]
            ]);

        // Ensure the password is hashed in the database
        $this->assertDatabaseHas('users', [
            'userName' => $userData['userName'],
            'fName' => $userData['fName'],
            'lName' => $userData['lName'],
            'email' => $userData['email'],
        ]);

        $this->assertTrue(Hash::check('secret123', User::where('email', $userData['email'])->first()->password));
    }

    public function test_user_registration_fails_with_missing_fields()
    {
        $response = $this->postJson('/api/v1/signup', [
            'userName' => 'johndoe',
            // Missing fName, lName, email, and password
        ]);

        $response->assertStatus(500);
    }

    public function test_login_successful()
    {
        // Create a user using the factory
        $password = 'secret123';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        // Attempt to log in with the correct credentials
        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);

        // Ensure the token is returned in the response
        $this->assertArrayHasKey('data', $response->json());
    }

    public function test_login_fails_with_invalid_credentials()
    {
        // Create a user using the factory
        $user = User::factory()->create([
            'password' => Hash::make('correct_password'),
        ]);

        // Attempt to log in with incorrect credentials
        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function test_logout_successful()
    {
        // Create a user and generate a token
        $user = User::factory()->create();
        $token = $user->createToken('AuthToken')->plainTextToken;
        $tokenHash = explode('|', $token, 2)[1];

        // Act as the user and attempt to logout
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/v1/logout', ['token' => $tokenHash]);

        // Check if the token is deleted
        $this->assertDatabaseMissing('personal_access_tokens', [
            'token' => hash('sha256', $tokenHash)
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'result' => true,
                'message' => 'User Logout Successfully'
            ]);
    }

    public function test_logout_token_not_found()
    {
        // Generate a random token hash
        $randomTokenHash = 'randomTokenHash';

        // Attempt to logout with a non-existent token
        $response = $this->postJson('/api/v1/logout', ['token' => $randomTokenHash]);

        $response->assertStatus(404)
            ->assertJson([
                'result' => false,
                'message' => 'token could not find'
            ]);
    }

    public function test_check_token_successful()
    {
        // Create a user and generate a token
        $user = User::factory()->create();
        $token = $user->createToken('AuthToken')->plainTextToken;
        $tokenHash = explode('|', $token, 2)[1];

        // Act as the user and attempt to check the token
        $response = $this->postJson('/api/v1/check-token', ['token' => $tokenHash]);

        $response->assertStatus(200)
            ->assertJson([
                'result' => true,
                'message' => 'token accepted',
                'data' => $user->id
            ]);
    }

    public function test_check_token_not_found()
    {
        // Generate a random token hash
        $randomTokenHash = 'randomTokenHash';

        // Attempt to check a non-existent token
        $response = $this->postJson('/api/v1/check-token', ['token' => $randomTokenHash]);

        $response->assertStatus(401)
            ->assertJson([
                'result' => false,
                'message' => 'token could not find'
            ]);
    }

    public function test_check_token_expired()
    {
        // Create a user and generate an expired token
        $user = User::factory()->create();
        $token = $user->createToken('AuthToken')->plainTextToken;
        $tokenHash = explode('|', $token, 2)[1];

        // Manually set the token's expiration date to the past
        $tokenModel = PersonalAccessToken::findToken($tokenHash);
        $tokenModel->expires_at = Carbon::now()->subDay();
        $tokenModel->save();

        // Act as the user and attempt to check the token
        $response = $this->postJson('/api/v1/check-token', ['token' => $tokenHash]);

        $response->assertStatus(401)
            ->assertJson([
                'result' => false,
                'message' => 'token has expired'
            ]);
    }

    public function test_get_user_by_id_successful()
    {
        // Create a user
        $user = User::factory()->create();

        // Attempt to get the user by ID
        $response = $this->postJson('/api/v1/get-user-by-id', ['id' => $user->id]);

        $response->assertStatus(200)
            ->assertJson([
                'result' => true,
                'message' => 'user found',
                'data' => [
                    'id' => $user->id,
                    'userName' => $user->userName,
                    'fName' => $user->fName,
                    'lName' => $user->lName,
                    'email' => $user->email,
                    // Include other user attributes as needed
                ]
            ]);
    }

    public function test_get_user_by_id_user_not_found()
    {
        // Attempt to get a user by a non-existent ID
        $response = $this->postJson('/api/v1/get-user-by-id', ['id' => 999]);

        $response->assertStatus(400)
            ->assertJson([
                'result' => false,
                'message' => 'user not found'
            ]);
    }
    public function test_delete_user_successful()
    {
        $user = User::factory()->create();
        $response = $this->deleteJson('api/v1/delete-user/'.$user->id);
        $response->assertStatus(200)
            ->assertJson([
                'result'=>true,
                'message'=>'user have deleted successfully'
            ]);
    }
    public function test_delete_user_not_found()
    {
        $response = $this->deleteJson('api/v1/delete-user/988');
        $response->assertStatus(404)
            ->assertJson([
                'result'=>false,
                'message'=>'user not found'
            ]);

    }


}
