<?php

declare(strict_types=1);

namespace Src\Accounts\Actions;

use App\Models\Table;
use Illuminate\Support\Collection;

class GetSubAccountsAction
{
    public function __construct() {}

    /**
     * @param int $id
     * @return Collection<\App\Models\SubAccount>
     */
    public function execute(int $id): Collection
    {
        ob_clean(); // Clear any buffered output
        $mesa = Table::with(['subAccounts' => function ($query): void {
            $query->with('details', 'details.product')->where('active', true);
        }])->findOrFail($id);

        return $mesa->subAccounts;
    }
}
