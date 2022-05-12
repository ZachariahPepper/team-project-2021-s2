<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {

          if ($request->ajax()) {

            return redirect()->route('unauthorised');

          } else {

            return redirect()->guest('login');

          }

        } else if (!Auth::guard($guard)->user()->is_admin) {

          return redirect()->route('unauthorised');

        }

        return $next($request);

    }
}
