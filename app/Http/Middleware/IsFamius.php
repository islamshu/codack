<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsFamius
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
        if (Auth::guard('famous')->check() ) {
            return $next($request);
        }
        else{
            abort(404);
        }
    }
}
