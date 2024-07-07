<?php

namespace Tests\Feature\Controller;

use App\Enums\TitleEnum;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertJson;

class UserDetailControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_user_detail_successful(): void
    {
        $userDetailData = UserDetail::factory()->create();
        $response = $this->postJson('/api/v1/create-user-detail', ['userId'=>$userDetailData->user_id]);
        $response->assertStatus(201)
                ->assertJson([
            'result' => true,
            'message'=> 'User detail created'
    ]);
    }
    public function test_create_user_detail_can_not_find_user(): void
    {
       $userDetailData = UserDetail::factory()->create();
       $response = $this->postJson('/api/v1/create-user-detail', ['userId'=>980]);
       $response->assertStatus(404)
           ->assertJson([
               'result' => false,
               'message'=> 'User ID does not exist'
           ]);
    }
    public function test_update_user_detail_successful(): void
    {
        $userDetailData = UserDetail::factory()->create();
        $data =[
            'image'=> 'test.jpg',
            'cover_image'=> 'test2.jpg',
            'tagline'=> 'CTO',
            'title'=> TitleEnum::Ms,
            'website'=> 'https://example.com',
            'mobile'=>'07777777777',
            'point'=>5
        ];
        $response = $this->putJson('api/v1/update-user-detail/'.$userDetailData->user_id,$data);

        $response->assertStatus(200)
            ->assertJson([
                'result'=>true,
                'message'=>'User details updated successfully'
            ]);
    }
    public function test_update_user_detail_faild_validate():void
    {
        $userDetailData = UserDetail::factory()->create();
        $data =[
            'image'=> 'test.jpg',
            'cover_image'=> 'test2.jpg',
            'tagline'=> 'CTO',
            'title'=> TitleEnum::Ms,
            'website'=> 'test',
            'mobile'=>'07777777777',
            'point'=>5
        ];
        $response = $this->putJson('api/v1/update-user-detail/'.$userDetailData->user_id,$data);
        $response->assertStatus(500)
            ->assertJson([
                'result'=>false,
                'message'=>'An error occurred while updating user details: The website field must be a valid URL.'
            ]);
    }
    public function test_update_user_detail_can_not_find_user(): void
    {
        $userDetailData = UserDetail::factory()->create();
        $data =[
            'image'=> 'test.jpg',
            'cover_image'=> 'test2.jpg',
            'tagline'=> 'CTO',
            'title'=> TitleEnum::Ms,
            'website'=> 'https://example.com',
            'mobile'=>'07777777777',
            'point'=>5
        ];
        $response = $this->putJson('/api/v1/update-user-detail/988',$data);
        $response->assertStatus(404)
            ->assertJson([
                'result' => false,
                'message'=> 'User could not be found'
            ]);
    }


}
