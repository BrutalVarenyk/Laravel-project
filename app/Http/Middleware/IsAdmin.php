<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        dd($next, $request, $next($request));

        if (!is_admin($request->user())) {
            if (!$request->expectsJson()) {
                return redirect('/');
            } else {
                return response()->json(['message' => 'You do not have admin privileges '], 403);
            }

        }

        return $next($request);
    }
}
