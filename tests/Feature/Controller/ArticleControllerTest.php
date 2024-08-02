<?php

namespace Tests\Feature\Controller;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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



}
