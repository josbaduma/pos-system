<?php

namespace App\Http\Middleware;

class RestrictedDocsAccess
{
    public function handle($request, \Closure $next)
    {
        if (app()->environment('local', 'development')) {
            return $next($request);
        }

        abort(403);
    }
}
