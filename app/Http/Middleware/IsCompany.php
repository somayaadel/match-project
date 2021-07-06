<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCompany
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
        if($request->user()->role->name == 'company'){
            return $next($request);
        }
        else{
            return response()->json("you have to be company");

        }
    }
}
