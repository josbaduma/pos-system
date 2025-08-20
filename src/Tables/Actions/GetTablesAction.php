<?php

declare(strict_types=1);

namespace Src\Tables\Actions;

use App\Models\Table;
use Common\DTOs\Tables\GetTablesResponseDTO;
use Illuminate\Support\Collection;

class GetTablesAction
{
    public function __construct() {}

    /**
     * @return Collection<GetTablesResponseDTO>
     */
    public function execute(): Collection
    {
        $tables = Table::get()->map(function ($response): GetTablesResponseDTO {
            return new GetTablesResponseDTO($response->id, "Mesa {$response->id}", $response->status);
        });

        return $tables;
    }
}
