<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataBaseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testEnvironmentVariables()
    {
        $this->assertEquals('community-platform-test', env('DB_DATABASE'));
        $this->assertEquals('sajad', env('DB_USERNAME'));
        $this->assertEquals('77409819', env('DB_PASSWORD'));
    }
    public function testDatabaseConnection()
    {
        $databaseName = config('database.connections.mysql.database');
        $this->assertEquals('community-platform-test', $databaseName);
    }
}
