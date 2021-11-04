<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHDiv
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
        if ($request->user()->role == 'HDiv') {
            return $next($request);
        }
        else{
            return response()->view('error');
        }
    }
}
