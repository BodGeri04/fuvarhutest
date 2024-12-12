<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_admin == 0) {
            return $next($request); // Ha nem admin, irány a fuvarozói munkák
        } else {
            abort(403, 'Hozzáférés megtagadva.');  // Ha nem fuvarozó (admin), abort
        }
    }
}
