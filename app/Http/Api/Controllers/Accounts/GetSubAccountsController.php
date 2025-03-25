<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Src\Accounts\Actions\GetSubAccountsAction;

class GetSubAccountsController
{
    public function __invoke(
        GetSubAccountsAction $getTableAction,
        int $id,
    ): JsonResponse {
        $subAccounts = $getTableAction->execute($id);

        ob_clean(); // Clear any buffered output
        return response()->json($subAccounts);
    }
}
