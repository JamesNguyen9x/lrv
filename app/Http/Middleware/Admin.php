<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if(!auth()->check()){
            return redirect()->route('admin.login');
        }
        if(!auth()->user()->isAdmin()) {
            return redirect()->route('main');
        }
        return $next($request);
    }
}
