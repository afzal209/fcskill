<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
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
        if (Auth::check() && Auth::user()->user_role == 1) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->user_role == 2) {
            return redirect('/admin/no_access');
        }

        return redirect('/admin/login');
    }
}