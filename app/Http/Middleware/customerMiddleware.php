<?php

namespace App\Http\Middleware;

use Closure;

class customerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() and (auth()->user()->level == 'customer' or auth()->user()->level == 'representation') and (auth()->user()->active == 1))
            return $next($request);
        return abort(402);
    }
}
