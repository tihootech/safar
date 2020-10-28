<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfCounseler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (user()->isCounseler()) {
            return $next($request);
        }else {
            abort(403);
        }
    }
}
