<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMDept3
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
        if ($request->user()->role == 'MemberDepartment3') {
            return $next($request);
        }
        else{
            return response()->view('error');
        }
    }
}
