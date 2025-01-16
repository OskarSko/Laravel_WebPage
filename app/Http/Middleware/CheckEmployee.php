<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Upewnij się, że Auth jest używane
use Symfony\Component\HttpFoundation\Response;

class CheckEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['employee', 'admin'])) {
            return $next($request);
        }

        // Przekierowanie w przypadku braku uprawnień
        return redirect()->route('home')->with('error', 'Unauthorized');
    }
}
