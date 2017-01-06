<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get all extra Request headers
        $requestHeaders = $request->header('Access-Control-Request-Headers');
        $response = $next($request);
        return $response
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*')
            // Allow any extra Request Headers
            ->header('Access-Control-Allow-Headers', $requestHeaders);
    }
}
