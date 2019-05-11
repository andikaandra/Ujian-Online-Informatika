<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class DosenOnly
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == 'dosen') {
            return $next($request);
        }
        elseif (Auth::user() && Auth::user()->role == 'mahasiswa') {
            return redirect('tcexam/mahasiswa');
        }
        if ($request->ajax()) {
          return response()->json(['message' => 'unauthorised'], 401);
        }
        return redirect('/');
    }
}
