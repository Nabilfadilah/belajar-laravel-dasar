<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);

        // ningali kabeh
        // var_dump(Config::all());
    }

    public function testConfigDepedency()
    {
        // diambil dari app, key nya config
        $config = $this->app->make('config');

        // ini juga manggil config get
        $firstName3 = $config->get('contoh.author.first');

        $firstName1 = config('contoh.author.first');
        // mengunakan package jika kita tidak bisa akses application
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2, $firstName3);

        // var_dump($config->all());
    }

    // mock yang config
    public function testConfigMock()
    {
        // kalau menerima method get, aka menerima ini 
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Nabil dek');

        $firstName = Config::get("contoh.author.first");

        self::assertEquals("Nabil dek", $firstName);
    }
}
