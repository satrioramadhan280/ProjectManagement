<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHDept2
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
        if ($request->user()->roleID == 4) {
            return $next($request);
        }
        else{
            return response()->view('error');
        }
    }
}
