<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testController()
    {
        $this->get('/controller/hello')
            ->assertSeeText("Hello World");
    }

    // public function testController2()
    // {
    //     $this->get('/controller/hello/Abil')
    //         ->assertSeeText("Hello Abil");
    // }
}
