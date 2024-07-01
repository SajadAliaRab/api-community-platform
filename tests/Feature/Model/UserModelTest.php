<?php

namespace Tests\Feature\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModelTest extends TestCase
{

    use ModelHelperTesting,RefreshDatabase;
    /**
     * A basic feature test example.
     */
    protected function model(): Model
    {
        return new User();
    }



}
