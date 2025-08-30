<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    // membuat cookie
    public function createCookie(Request $request): Response
    {
        return response('Hello Cookie')
            ->cookie('User-Id', 'abil', 1000, '/')
            ->cookie('Is-Member', 'true', 1000, '/');
    }

    // menerima cookie
    public function getCookie(Request $request): JsonResponse
    {
        return response()->json([
            'userId' => $request->cookie('User-Id', 'guest'),
            'isMember' => $request->cookie('Is-Member', 'false')
        ]);
    }

    // clear cookie
    public function clearCookie(Request $request): Response
    {
        return response('Clear Cookie')
            ->withoutCookie('User-Id')
            ->withoutCookie('Is-Member');
    }
}
