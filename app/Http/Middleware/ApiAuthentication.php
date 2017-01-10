<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Auth;

class ApiAuthentication
{
    protected $tokenHeaderKey = 'Authorization';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->authenticate($request)) {
            return response()->json('Unauthorised.', HTTP_CODE_UNAUTHORIZED);
        }
        return $next($request);

    }

    protected function authenticate($request) {
        if($request->hasHeader($this->tokenHeaderKey)) {
            $token = $this->getTokenFromHeader($request->headers->get($this->tokenHeaderKey));
            $user = User::findByToken($token);
            if($user) {
                if($user->hasValidToken()) {
                    $user->refreshApiToken();
                    Auth::setUser($user);
                    return true;
                } else {
                    $user->revokeToken()->save();
                }
            }
        }
        return false;
    }

    public function getTokenFromHeader(string $header)
    {
        return substr($header, 6);
    }
}
