<?php

namespace App\Http\Middleware;

use App\Models\PersonalAccessToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');
        if(!$header || !str_starts_with($header, 'Bearer')){
            return response()->json(['message'=>'UnAuthenticated'], 401);
        }
        //'[$plainToken] Bearer' 7 characters away
        $plainToken = substr($header, 7);
        $hashedToken = hash('sha256', $plainToken);
        $token = PersonalAccessToken::where('token', $hashedToken)->first();
        if(!$token || $token->isExpired()){
            return response()->json(['message'=>'Session Expired'], 401);
        }
        $request->setUserResolver(fn () => $token->user);
        return $next($request);
    }
}
