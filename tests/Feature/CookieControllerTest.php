<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    // test membuat cookie
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertCookie('User-Id', 'abil')
            ->assertCookie('Is-Member', 'true');
    }

    // test menerima cookie
    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'abil')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'abil',
                'isMember' => 'true'
            ]);
    }
}
