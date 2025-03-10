<?php

declare(strict_types=1);

namespace Common\DTOs\Tables;

use Illuminate\Support\Collection;

class GetTablesResponseDTO
{
    /**
     * @param int $id
     * @param string $name
     * @param string $status
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $status,
    ) {}
}
