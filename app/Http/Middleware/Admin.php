<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( null === $request->user() ||  env('ADMINISTRATOR', 'admin') !== $request->user()->userRole->role ) {
              //dd('hi');
            return redirect()->route('/')
                ->with('error', 'You need to register!');
        }

        return $next($request);
    }
}
