<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Check if the user is already authenticated for each guard
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // If the user is authenticated, redirect them to the appropriate page
                // For example, redirect to 'home.index' or another dashboard route
                return redirect()->route('home.index');
            }
        }
        // If the user is not authenticated, allow the request to continue
        return $next($request);
    }
}
