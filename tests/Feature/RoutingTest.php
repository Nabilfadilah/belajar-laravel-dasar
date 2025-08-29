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

    // route parameter
    // public function testRouteParameter()
    // {
    //     $this->get("/products/1")
    //         ->assertSeeText("Product 1");

    //     $this->get("/products/2")
    //         ->assertSeeText("Product 2");

    //     $this->get("/products/1/items/XXX")
    //         ->assertSeeText("Product 1, Item XXX");
    // }

    // regular expression constraints
    public function testRouteParameterRegex()
    {
        $this->get('/categories/12345')->assertSeeText("Categories : 12345");
        $this->get('/categories/salah')->assertSeeText("404");
    }

    // optional route parameter
    public function testRouteOptionalParameter()
    {
        $this->get('/users/12345')->assertSeeText("Users : 12345");
        $this->get('/users/')->assertSeeText("Users : 404");
    }

    // routing conflict
    public function testRouteConflict()
    {
        // ini ada conflict ternyata
        $this->get('/conflict/abil')->assertSeeText("Conflict Nabil Fadilah");
        $this->get('/conflict/budi')->assertSeeText("Conflict budi");
    }

    // menggunakan named route
    // public function testNamedRoute()
    // {
    //     $this->get('/produk/12345')->assertSeeText("Link http://localhost/products/12345");
    //     $this->get('/produk-redirect/12345')->assertSeeText("product/12345");
    // }
}
