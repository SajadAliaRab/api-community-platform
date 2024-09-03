<?php

namespace Tests\Feature\Model;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagModelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
  use RefreshDatabase,ModelHelperTesting;
  protected function model():Model
  {
      return new Tag();
  }
}
