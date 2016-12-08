<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserApi;
use App\Models\UserApiAccess;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Api;

class ApiController extends Controller
{
    protected $viewPath = 'admin/api';
    
    protected $defaultValidations = [
        'name' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apis = auth()->user()->apis;

        return view('index', compact('apis'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $api = new Api();
        return view('create', compact('api'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultValidations);

        $api = Api::create($request->all());

        $userApi = UserApi::create([
            'api_id' => $api->id,
            'user_id' => auth()->user()->id,
            'api_key' => $this->generateNewKey(),
            'invite_sent_at' => Carbon::now(),
            'accepted_invite' => true,
        ]);

        $userApi->grantAllAccess();

        return redirect()->route('api-view', ['api' => $api]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function show(Api $api)
    {
        $api->load(['routes']);

        return view('view', compact('api'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function edit(Api $api)
    {
        return view('update', compact('api'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Api $api)
    {
        $this->validate($request, $this->defaultValidations);

        $api->update($request->all());

        return redirect()->route('api-view', compact('api'));
    }

    public function findInvitee(Api $api)
    {
        $users = User::all();

        $accesses = UserApiAccess::getAllAccesses();

        return view('invite', compact('api', 'users', 'accesses'));
    }

    public function invite(Request $request, Api $api)
    {
        if($request->has('invite')) {
            foreach ($request->input('invite') as $user_id => $details) {
                $user = User::find($user_id);
                $detail = collect($details);
                if($detail->has('selected') && $detail->get('selected') == 1) {
                    $user = User::find($user_id);
                    $userApi = $user->userApis()->where('api_id', $api->id)->first();
                    if(!$userApi) {
                        $userApi = $user->userApis()->create([
                            'api_id' => $api->id,
                            'api_key' => $this->generateNewKey(),
                            'invite_sent_at' => Carbon::now(),
                            'accepted_invite' => false
                        ]);
                        $accessRecord = $userApi->createAccessRecord();
                    } else {
                        $accessRecord = $userApi->access;
                    }

                    if($detail->has('access')) {
                        $accessRecord->update($detail->get('access'));
                    }
                }
            }
        }
        return redirect()->route('api-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api)
    {
        $api->delete();

        return redirect()->route('api-index');
    }
}
