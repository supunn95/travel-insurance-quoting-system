<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class DatabaseConnectionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_sqlite_connection_is_working()
    {
        $this->assertInstanceOf(\PDO::class, DB::connection()->getPdo());
    }
}
