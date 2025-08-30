<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContohMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // parameter ke-1 $request, ke-2 closure
    public function handle(Request $request, Closure $next) // $next mau exsekusi/enggak?
    {
        // apikey dari header
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey == "abl") {
            return $next($request);
        } else {
            return response('Access Denied', 404);
        }
    }

    // middleware parameter
    // public function handle(Request $request, Closure $next, string $key, int $status)
    // {
    //     $apiKey = $request->header('X-API-KEY');
    //     if ($apiKey == $key) {
    //         return $next($request);
    //     } else {
    //         return response('Access Denied', $status);
    //     }
    // }
}
