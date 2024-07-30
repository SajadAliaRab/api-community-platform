<?php

namespace Tests\Feature\Model;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Model\ModelHelperTesting;
use Tests\TestCase;

class ArticleModelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
 use ModelHelperTesting ,RefreshDatabase;

    protected function model():Model
    {
        return new Article();
    }
}
