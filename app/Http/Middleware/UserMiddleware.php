<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserMiddleware
 * @package App\Http\Middleware
 */
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle (Request $request, Closure $next)
    {
        if ( !Auth::id() ) {
            return redirect('/')->with('failure', 'Please login');
        }

        return $next($request);
    }
}
