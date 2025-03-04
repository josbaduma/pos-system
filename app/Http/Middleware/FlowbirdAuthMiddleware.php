<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FlowbirdAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Authorization') !== 'Bearer ' . config('integrations.flowbird.authToken')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
