<?php

namespace App\Http\Middleware;

use App\Helpers\Token;
use Closure;
use App\User;

class CheckAuth
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
        $header_token = $request->header('Authorization');
        $token = new Token();
        $decoded_token = $token->decode($header_token);
        
        $user = User::where('email', '=', $decoded_token->email)->first();
                     
        $request->request->add(['user' => $user]);

        if($user != null)
        {
            return $next($request);
        }
        else
        {
            return response()->json([
                "message" => "no tienes permisos"
            ], 401);
        }
     
    }
}
