<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class ClientUser
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

        if (!$request->user())
        {
            abort(403, 'Unauthorized action.');
        }

        if ($request->user()->type != 'client')
        {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);

    }

}

