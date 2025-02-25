<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            throw new HttpException(403, 'Access denied: Role requirement not fulfilled.');
        }

        return $next($request);
    }
}
