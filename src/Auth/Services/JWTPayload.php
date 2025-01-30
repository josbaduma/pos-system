<?php

declare(strict_types=1);

namespace Src\Auth\Services;

class JWTPayload
{
    public function __construct(
        public int $sub,
        public string $email,
        public array $scopes,
        public int $exp,
        public int $iat,
    ) {}

    public static function fromStdClass(\stdClass $payload): self
    {
        return new self(
            sub: $payload->sub,
            email: $payload->email,
            scopes: $payload->scopes,
            exp: $payload->exp,
            iat: $payload->iat
        );
    }
}
