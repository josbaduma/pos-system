<?php

declare(strict_types=1);

namespace Src\Accounts\Actions;

use App\Models\Table;
use Common\DTOs\Tables\GetTablesResponseDTO;
use Illuminate\Support\Collection;

class GetSubAccountsAction
{
    public function __construct() {}

    /**
     * @param string $email
     * @param string $password
     * @return Collection<GetTablesResponseDTO>
     */
    public function execute(int $id): Collection
    {
        ob_clean(); // Clear any buffered output
        $mesa = Table::with(['subAccounts' => function ($query) {
            $query->where('active', true);
        }])->findOrFail($id);

        return $mesa->subAccounts;
    }
}
