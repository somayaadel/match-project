<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        // return $next($request);

        if($request->user()->role->name == 'admin'){
            return $next($request);
        }
        else{
            return response()->json("you have to be admin");
        }
    }
}
