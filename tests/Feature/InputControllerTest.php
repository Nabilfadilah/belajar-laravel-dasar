<?php

namespace Tests\Feature;

use Tests\TestCase;

class InputControllerTest extends TestCase
{
    // request input
    public function testInput()
    {
        $this->get('/input/hello?name=Abil')
            ->assertSeeText("Hello Abil");

        $this->post('/input/hello', ['name' => 'Abil'])
            ->assertSeeText("Hello Abil");

        // $this->post('/input/hello', ['name' => 'Abil'])
        //     ->assertSeeText("Hello Abil");

        // $this->postJson('/input/hello', ['name' => 'Abil'])
        //     ->assertSeeText("Hello Abil");
    }

    // nested input
    public function testNestedInput()
    {
        $this->post('/input/hello/first', ['name' => [
            'first' => 'Abil'
        ]])->assertSeeText('Hello Abil');
    }
}
