<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    // route middleware
    public function testMiddlewareInvalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function testMiddlewareValid()
    {
        $this->withHeader('X-API-KEY', 'abl')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText("OK");
    }

    // global middleware

}
