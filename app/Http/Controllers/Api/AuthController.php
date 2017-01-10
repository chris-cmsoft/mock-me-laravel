<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Hash;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), HTTP_CODE_VALIDATION_ERROR);
        }

        $user = User::where('email', $request->input('email'))->first();

        if(!$user || ($user && !Hash::check($request->input('password'), $user->password))) {
            return response()->json(['email' => ['Username & Password does not match out records']], HTTP_CODE_VALIDATION_ERROR);
        }

        $user->generateApiToken()->save();

        return response()->json(['token' => $user->getApiToken()]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), HTTP_CODE_VALIDATION_ERROR);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->generateApiToken();

        return response()->json(['token' => $user->getApiToken()]);
    }

    public function logout(Request $request)
    {
        Auth::user()->revokeToken();
        return response()->json(null);
    }
}
