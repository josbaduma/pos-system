<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyAuthTokenIntegration
{
    public function handle(Request $request, Closure $next, string $integrationName)
    {
        $integrationsConfig = config('integrations.' . $integrationName);
        $authHeader = $request->header('Authorization');

        foreach ($integrationsConfig as $integrationConfig) {
            if (! is_array($integrationConfig)) {
                continue;
            }
            if ($authHeader === 'Bearer ' . $integrationConfig['auth_token']) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
