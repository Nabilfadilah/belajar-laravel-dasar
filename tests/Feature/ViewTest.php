<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    // basic view
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText("Hello GOBILL");

        $this->get('/hello-again')
            ->assertSeeText("Hello GOBILL");
    }

    // nested view directory
    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText("World fadilah");
    }

    // test view tanpa routing
    public function testViewWithRoute()
    {
        $this->view('hello', ['name' => 'Fadilah'])
            ->assertSeeText("Hello Fadilah");
    }
}
