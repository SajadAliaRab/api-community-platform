<?php

namespace Tests\Feature\Controller;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Article index test
     */
    public function test_index_article_successful(): void
    {

        Article::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/get-articles');
        $response->assertStatus(200)
            ->assertJson([
                'result'=>true,
                'message'=>'articles received successfully',
               'data' => Article::all()->toArray()
            ]);
    }
    public function test_index_article_none_article():void
    {

        $response = $this->getJson('/api/v1/get-articles');
        $response->assertStatus(400)
            ->assertJson([
                'result'=>false,
                'message'=>'there is not any article'
            ]);
    }

    /**
     * Article store test
     */
    public function test_store_article_successful(): void
    {
        $user = User::factory()->create();

        $request = new Request([
            'author_id' => $user->id,
            'content' => 'Test content',
            'title' => 'Test Title',
            'slug' => 'test-slug',
            'image' => 'test-image.jpg'
        ]);
        $response = $this->postJson('/api/v1/create-article', $request->toArray());
        $response->assertStatus(201)
            ->assertJson([
                'result'=>true,
                'message'=>'article created successfully',
            ]);

    }
    public function test_store_article_user_not_found():void
    {
        $request = new Request([
            'author_id' => 999,
            'content' => 'Test content',
            'title' => 'Test Title',
            'slug' => 'test-slug',
            'image' => 'test-image.jpg'
        ]);
        $response = $this->postJson('/api/v1/create-article', $request->toArray());
        $response->assertStatus(400)
            ->assertJson([
                'result'=>false,
                'message'=>'there is not valid user as an author'
            ]);
    }
    public function test_store_article_data_not_validate():void
    {
        $user = User::factory()->create();
        $request = new Request([
            'author_id' => $user->id,

        ]);
        $response = $this->postJson('/api/v1/create-article', $request->toArray());
        $response->assertStatus(422)
            ->assertJson([
                "message"=> "The content field is required. (and 2 more errors)"
            ]);
    }
    /**
     * Article show test
     */
    public function test_show_article_successful(): void
    {
        $article = Article::factory()->create();
        $response = $this->getJson('/api/v1/get-article/'.$article->id);
        $response->assertStatus(200)
            ->assertJson([
                'result'=>true,
                'message'=>'article retrieved successfully',
                'data'=>$article->toArray()
            ]);
    }
    public function test_show_article_not_found():void
    {
        $response = $this->getJson('/api/v1/get-article/999');
        $response->assertStatus(404)
            ->assertJson([
                'result'=>false,
                'message'=>'article not found'
            ]);
    }
    /**
     * Article Update test
     */
    public function test_update_article_successful():void
    {
        $article = Article::factory()->create();
        $request = new Request([
            'content'=>'test2',
            'slug'=>'test2',
            'image'=>'test2.png',
            'title'=>'test2'
        ]);
        $response = $this->putJson('/api/v1/update-article/'.$article->id,$request->toArray());
        $response->assertStatus(201)
            ->assertJson([
                'result'=>true,
                'message'=>'article updated successfully'
            ]);
    }
    public function test_update_article_not_found():void
    {
        $request = new Request([
            'content'=>'test2',
            'slug'=>'test2',
            'image'=>'test2.png',
            'title'=>'test2'
        ]);
        $response = $this->putJson('/api/v1/update-article/999',$request->toArray());
        $response->assertStatus(404)
            ->assertJson([
                'result'=>false,
                'message'=>'article not found'
            ]);
    }
    public function test_update_article_data_not_validate():void
    {
        $article =Article::factory()->create();
        $request = new Request([]);
        $response = $this->putJson('/api/v1/update-article/'.$article->id,$request->toArray());
        $response->assertStatus(500)
            ->assertJson([
                "result"=> false,
                "message"=> "An error occurred while updating article: The content field is required. (and 2 more errors)"
            ]);
    }
    /**
     * Article destroy test
     */
    public function test_destroy_article_successful():void
    {
        $article = Article::factory()->create();
        $response= $this->deleteJson('/api/v1/delete-article/'.$article->id);
        $response->assertStatus(200)
            ->assertJson([
                'result'=>true,
                'message'=>'article deleted successfully'
            ]);
    }
    public function test_destroy_article_not_found():void
    {
        $response= $this->deleteJson('/api/v1/delete-article/999');
        $response->assertStatus(404)
            ->assertJson([
                'result'=>false,
                'message'=>'article not found'
            ]);
    }
}
