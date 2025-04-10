<?php

declare(strict_types=1);

namespace Common\DTOs\Accounts;

class CreateSubAccountDTO
{
    public function __construct(
        public string $name,
        public int $table_id,
    ) {}
}
