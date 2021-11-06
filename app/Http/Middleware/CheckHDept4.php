<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHDept4
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
        if ($request->user()->role == 'HeadDepartment4') {
            return $next($request);
        }
        else{
            return response()->view('error');
        }
    }
}
