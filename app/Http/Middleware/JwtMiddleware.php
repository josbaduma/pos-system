<?php

namespace App\Http\Middleware;

use App\Models\LegacyBlacklistedToken;
use App\Models\LegacyUser;
use Closure;
use Firebase\JWT\JWTExceptionWithPayloadInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Src\Auth\Services\AuthService;
use Symfony\Component\HttpKernel\Exception\HttpException;
use UnexpectedValueException;

class JwtMiddleware
{
    public function __construct(
        private readonly AuthService $authService,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @param array<string>                                 $scopes
     *
     * @return Response|RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        $jwt = $request->bearerToken();

        if (! $jwt) {
            throw new HttpException(401, 'Unauthorized. Token not found');
        }

        if (LegacyBlacklistedToken::whereToken($jwt)->exists()) {
            throw new HttpException(401, 'Unauthorized. Token is blacklisted');
        }

        try {
            $decoded = $this->authService->decodeOrFail($jwt, $scopes);
        } catch (JWTExceptionWithPayloadInterface $e) {
            throw new HttpException(401, "Invalid Token: {$e->getMessage()}");
        } catch (UnexpectedValueException) {
            throw new HttpException(400, 'JWT Token malformed');
        }

        $user = LegacyUser::find($decoded->sub);

        if (! $user) {
            throw new HttpException(404, "User $decoded->sub not found");
        }

        Auth::login($user);

        return $next($request);
    }
}
