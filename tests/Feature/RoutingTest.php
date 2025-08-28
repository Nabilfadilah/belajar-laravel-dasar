<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    // test routing basic
    public function testBasicRouting()
    {
        $this->get("/pzn")
            ->assertStatus(200)
            ->assertSeeText("Hello Nabil Fadilah");
    }

    // test redirect routing
    public function testRedirect()
    {
        $this->get("/youtube")
            ->assertRedirect("/pzn");
    }

    // test fallback route
    public function testFallback()
    {
        $this->get("/404")
            ->assertSeeText("404");
    }
}
