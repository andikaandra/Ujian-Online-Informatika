<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class MahasiswaOnly
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == 'mahasiswa') {
            return $next($request);
        }
        elseif (Auth::user() && Auth::user()->role == 'dosen') {
            return redirect('/dosen');
        }
        elseif (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/admin');
        }
        if ($request->ajax()) {
          return response()->json(['message' => 'unauthorised'], 401);
        }
        return redirect('/');
    }
}
