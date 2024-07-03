<?php

namespace Tests\Feature\Model;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserDetailModelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
use ModelHelperTesting , RefreshDatabase;
protected function model(): Model
{
    return new UserDetail();
}
}
