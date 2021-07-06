<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EditUserData
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
        // dd( $request->user_id) ; 
       
        if($request->user()->id == $request->user_id){
            return $next($request);
        }
        else{
            return response()->json("you can't edit this user ");

        }
    }
}
