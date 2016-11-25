<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Api;
use App\Models\Route;
use App\Models\Response;

class ResponseController extends Controller
{

    protected $viewPath = 'admin/response';

    protected $defaultValidations = [
        'request_method' => 'required|in:get,post,put,patch,delete,options',
        'response_time' => 'required|integer|min:0|max:240',
        'response_code' => 'required|integer|min:0',
        'payload' => 'json',
        'payload_type' => 'required|in:json',
        'is_active' => 'required|boolean'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = new Response();

        return view('create', compact('response'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Api $api, Route $route)
    {
        $this->validate($request, $this->defaultValidations);

        if($request->input('is_active')) {
            $route->responses()->where('request_method', $request->input('request_method'))->update(['is_active' => false]);
        }

        $response = $route->responses()->create($request->all());

        return redirect()->route('response-view', ['api' => $api, 'route' => $route, 'response' => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Api $api, Route $route, Response $response)
    {
        $this->validateResponse($api, $route, $response);

        return view('view', compact('response'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Api $api, Route $route, Response $response)
    {
        $this->validateResponse($api, $route, $response);

        return view('update', compact('response'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Api $api, Route $route, Response $response)
    {
        $this->validateResponse($api, $route, $response);

        $this->validate($request, $this->defaultValidations);

        if($request->input('is_active')) {
            $route->responses()->where('request_method', $request->input('request_method'))->update(['is_active' => false]);
        }

        $response->update($request->all());

        return redirect()->route('response-view', ['api' => $api, 'route' => $route, 'response' => $response]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api, Route $route, Response $response)
    {
        $this->validateResponse($api, $route, $response);
        
        $response->delete();

        return redirect()->route('route-view', ['api' => $api, 'route' => $route]);
    }

    private function validateResponse($api, $route, $response) {
        $valid = false;
        foreach($api->routes()->with('responses')->get() as $route) {
            if($route->responses->contains($response)) {
                $valid = true;
                break;
            }
        }
        if(!$valid) {
            abort(404);
        }
    }
}
