<?php

namespace App\Http\Middleware;

use Closure;

class VeryfyWebToken
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
        if($request->header('web-token')){
            return $next($request);
        }
        else{
            abort(403);
        }
    }
}
