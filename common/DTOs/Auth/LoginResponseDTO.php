<?php

declare(strict_types=1);

namespace Common\DTOs\Auth;

use App\Models\User;
use Illuminate\Support\Collection;

class LoginResponseDTO
{
    /**
     * @param string $accessToken
     * @param User $user
     * @param int $id
     */
    public function __construct(
        public string $accessToken,
        public User $user,
        public int $id,
    ) {}
}
