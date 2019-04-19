<?php

namespace App\Http\Middleware;

use Closure;

class AdminOnly
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return $next($request);
        }
        elseif (Auth::user() && Auth::user()->role == 'mahasiswa') {
            return redirect('/mahasiswa');
        }
        elseif (Auth::user() && Auth::user()->role == 'dosen') {
            return redirect('/dosen');
        }
        if ($request->ajax()) {
          return response()->json(['message' => 'unauthorised'], 401);
        }
        return redirect('/');
    }
}
