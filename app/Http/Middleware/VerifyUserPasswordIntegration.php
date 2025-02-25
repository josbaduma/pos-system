<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyUserPasswordIntegration
{
    public function handle(Request $request, Closure $next, string $integrationName)
    {
        $integrationUser = config('integrations.' . $integrationName . '.auth.user');
        $integrationPassword = config('integrations.' . $integrationName . '.auth.password');
        if (
            $request->header('php-auth-user') !== $integrationUser
            || $request->header(
                'php-auth-pw'
            ) !== $integrationPassword
        ) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
