<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        if(!unserialize($request->cookie('prof'))['id']){
            return redirect()->route('account')->with('status', 'Login');
        }

        return $next($request);
    }
}
