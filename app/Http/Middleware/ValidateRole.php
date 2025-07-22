<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Temporarily bypass role validation for debugging
        return $next($request);

        // Original logic (commented out for now):
        // $user_role = $request->user()->role()->first()->name;

        // foreach ($roles as $role) {
        //     if ($user_role == $role) {
        //         return $next($request);
        //     }
        // }

        // return redirect('/dashboard')->with('errormsg', 'You do not have permission to access this page.');
    }
}
