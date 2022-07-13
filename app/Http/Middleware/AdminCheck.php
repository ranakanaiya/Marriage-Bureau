<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminCheck
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
        if(Auth::user()->role==0)
            return $next($request);
        else
        {
            Auth::logout();
            return redirect()->route('admin.login')->with(['status'=>'error','message'=>'Please login with account having Admin Rights']);
        }
    }
}
