<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check 1: Is a user currently authenticated?
        // Check 2: Does the authenticated user's 'role' column equal 'admin'?
        if (!auth()->check() || auth()->user()->role !== 'admin') {

            // If the user fails the checks, we prevent them from proceeding.
            // We redirect them to the homepage (/) and flash an error message.
            return redirect('/')->with('error', 'Administrator access required to view this area.');
        }

        // If the user passes the checks, allow the request to proceed to the controller
        return $next($request);
    }
}
