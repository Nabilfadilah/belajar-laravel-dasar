<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Nabil', $firstName);
        self::assertEquals('Fadilah', $lastName);
        self::assertEquals('fadilah@gmail.com', $email);
        self::assertEquals('portofolio-nabil.vercel.app', $web);
    }
}
