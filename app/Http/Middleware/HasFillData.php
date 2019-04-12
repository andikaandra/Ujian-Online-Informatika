<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class HasFillData
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            if (Auth::user()->name) {
                return redirect('/');
            }
            return $next($request);
        }
        if ($request->ajax()) {
          return response()->json(['message' => 'unauthorised'], 401);
        }
        return redirect('/');
    }
}
