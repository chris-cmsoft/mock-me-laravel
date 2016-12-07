<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Api;

class MockMeController extends Controller
{
    public function mockme(Request $request, Api $api, $url) {
        $route = $api->routes()
            ->where(function($query) use ($url) {
                $query
                    ->where('url', $url)
                    ->orWhere('url', ltrim($url, '/'))
                    ->orWhere('url', '/'. $url);

            })
            ->where('request_method', strtolower($request->method()))
            ->firstOrFail();

        sleep($route->response_time);

        return response()->json(json_decode($route->payload), $route->response_code);
    }
}
