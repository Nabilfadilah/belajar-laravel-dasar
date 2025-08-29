<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    // request input
    public function hello(Request $request)
    {
        $name = $request->input('name');
        return "Hello " . $name;
        // return response("Hello " . $name);
    }

    // nested input
    public function helloFirst(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Hello " . $firstName;
    }
}
