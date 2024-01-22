<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Peran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $peran): Response
    {
        // return $next($request);
        if (Auth::check()) {
            $peran = explode('-', $peran);
            foreach ($peran as $group) {
                if (Auth::user()->role == $group){
                    return $next($request);
                }
            }
        }
        return redirect ('/');
    }
}
