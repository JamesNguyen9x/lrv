<?php

namespace App\Http\Middleware;

use Closure;

class Active
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
        if (!is_numeric($request->input('id')) || strlen($request->input('token')) != 32) {
            return redirect()->route('user.login');
        }
        return $next($request);
    }
}
