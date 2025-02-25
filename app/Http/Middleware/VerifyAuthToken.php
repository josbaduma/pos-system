<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyAuthToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Authorization') !== 'Bearer ' . config('vergeLegacy.auth_token')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
