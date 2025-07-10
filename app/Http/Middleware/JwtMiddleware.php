<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json(['error' => 'Token not provided'], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $decoded = JWT::decode($token, new Key(config('auth.jwt.secret'), 'HS256'));
            $request->attributes->add(['jwt_payload' => (array) $decoded]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
