<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Api;
use App\Models\Route;

class RouteController extends Controller
{
    protected $viewPath = 'admin/route';

    protected $defaultValidations = [
        'name' => 'required',
        'url' => 'required'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Api $api)
    {
        $route = new Route();
        return view('create', compact('route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Api $api)
    {
        $this->validate($request, $this->defaultValidations);

        $route = $api->routes()->create($request->all());

        return redirect()->route('route-view', compact('api', 'route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Api $api, Route $route)
    {
        $this->validateRoute($api, $route);

        return view('view', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Api $api, Route $route)
    {
        $this->validateRoute($api, $route);

        return view('update', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Api $api, Route $route)
    {
        $this->validateRoute($api, $route);

        $this->validate($request, $this->defaultValidations);

        $route->update($request->all());

        return redirect()->route('route-view', compact('api' ,'route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api, Route $route)
    {
        $this->validateRoute($api, $route);

        $route->delete();

        return redirect()->route('api-view', compact('api'));
    }

    /**
     * Validate that the route belongs to the Api,
     * and throw 404 if it does not.
     *
     * @param  \App\Models\Api $api
     * @param  \App\Models\Route $route
     * @return void
     */
    private function validateRoute(Api $api, Route $route) {
        if(!$api->routes()->where('id', $route->id)->exists()) {
            abort(404);
        }
    }
}
