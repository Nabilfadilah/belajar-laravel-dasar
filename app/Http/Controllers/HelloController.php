<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloService $helloService;

    // dependency injection
    // construct
    // public function __construct(HelloService $helloService)
    // {
    //     // nanti akan dimaskukan ke sini helloservice
    //     $this->helloService = $helloService;
    // }

    // public function hello(string $name): string
    // {
    //     return $this->helloService->hello($name);
    // }

    // function hello
    // public function hello(): string
    // {
    //     return "Hello NGABBB";
    // }

    // Request
    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello(Request $request, string $name): string
    {
        return $this->helloService->hello($name);
    }
}
