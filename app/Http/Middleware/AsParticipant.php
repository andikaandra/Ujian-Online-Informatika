<?php

namespace App\Http\Middleware;

use Closure;

class AsParticipant
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
