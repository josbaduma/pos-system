<?php

declare(strict_types=1);

namespace Common\DTOs\Accounts;

class UpdateSubAccountDTO
{
    public function __construct(
        public string $name,
        public int $id,
    ) {}
}
