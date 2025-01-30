<?php

declare(strict_types=1);

namespace Src\Auth\Services;

use App\Models\User;
use Carbon\CarbonInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthService
{
    private $jwtSecretKey;
    private $algorithm = 'HS256';

    public function __construct()
    {
        $this->jwtSecretKey = config('auth.jwt.secret');
    }

    /**
     * @param User $user
     * @param array<string> $scopes
     * @param CarbonInterface $expiration
     * @return string
     */
    public function generateJWTToken(User $user, array $scopes, CarbonInterface $expiration): string
    {
        return JWT::encode([
            'userId' => $user->id, // <-- Retrocompat
            'sub' => $user->id,
            'email' => $user->email,
            'scopes' => $scopes,
            'exp' => $expiration->timestamp,
            'iat' => now()->timestamp
        ], $this->jwtSecretKey, $this->algorithm);
    }

    /**
     * @param User $user
     * @return string
     */
    public function generateAccessToken(User $user): string
    {
        /** @var int $accessTokenExpiration */
        $accessTokenExpiration = config('auth.jwt.accessTokenExpiration');
        return $this->generateJWTToken($user, ['access'], now()->addMinutes($accessTokenExpiration));
    }

    /**
     * Decodes JWT and returns payload
     *
     * @param string $jwt
     * @return JWTPayload
     */
    public function decodeJwt(string $jwt): JWTPayload
    {
        return JWTPayload::fromStdClass(JWT::decode($jwt, new Key($this->jwtSecretKey, $this->algorithm)));
    }

    /**
     * Decodes JWT and verifies if the token has the given scopes.
     *
     * @param string $jwt
     * @param array $scopes
     * @return JWTPayload
     */
    public function decodeOrFail(string $jwt, array $scopes): JWTPayload
    {
        $decoded = $this->decodeJwt($jwt);
        $diff = collect($scopes)->intersect($decoded->scopes);
        if ($diff->count() == 0) {
            $scopesNeeded = collect($scopes)->join(',');
            throw new HttpException(403, "Forbidden. Token needs at least one of these scopes: $scopesNeeded");
        }

        return $decoded;
    }

    public function blacklistToken(User $user, string $jwt): void
    {
        $payload = $this->decodeJwt($jwt);
        $user->blacklistedTokens()->create([
            'token' => $jwt,
            'expires_at' => $payload->exp
        ]);
    }
}
