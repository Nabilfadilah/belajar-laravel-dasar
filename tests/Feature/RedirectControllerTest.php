<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    // redirect
    public function testRedirect()
    {
        $this->get('/redirect/from')->assertRedirect('/redirect/to');
    }

    // redirect to named routes
    public function testRedirectName()
    {
        // ambil redirect name
        $this->get('/redirect/name')
            // lalu pindahkan ke redirect abil
            ->assertRedirect('/redirect/name/Abil');
    }

    // redirect to controller action
    public function testRedirectAction()
    {
        // ambil redirect action
        $this->get('/redirect/action')
            // lalu pindahkan ke redirect abil
            ->assertRedirect('/redirect/name/Abil');
    }

    // redirect to external domain away
    public function testRedirectAway()
    {
        // ambil redirect action
        $this->get('/redirect/abl')
            // lalu pindahkan ke redirect abil
            ->assertRedirect('https://portofolio-nabil.vercel.app/');
    }
}
