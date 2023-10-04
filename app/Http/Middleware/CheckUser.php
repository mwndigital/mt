<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the user ID from the route parameters
        $userId = $request->route('user');

        // Check if the authenticated user is the same as the requested user
        if (Auth::id() == $userId) {
            return $next($request);
        }

        // Redirect or return an unauthorized response if the user doesn't match
        return abort(403, 'Unauthorized');
    }
}
