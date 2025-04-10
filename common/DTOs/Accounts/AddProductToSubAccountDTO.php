<?php

declare(strict_types=1);

namespace Common\DTOs\Accounts;

class AddProductToSubAccountDTO
{
    public function __construct(
        public int $subAccountId,
        public int $productId,
        public int $quantity,
        public float $subtotal
    ) {}
}
