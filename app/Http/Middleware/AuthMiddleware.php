<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Customize your redirect URL here
            return route('account.login'); // or '/login' or any custom route
        }
        
        return null;
    }
    public function handle(Request $request, Closure $next): Response
    {
       if (Auth::check()) {
            return $next($request);
        }

        // Custom redirect logic
        // if ($request->expectsJson()) {
        //     return response()->json(['error' => 'Unauthenticated.'], 401);
        // }

        // Redirect to custom login page with intended URL
        return redirect()-> route('account.login')
            ->with('error', 'Please login to access this page.')
            ->with('intended', $request->url());
    }
}
