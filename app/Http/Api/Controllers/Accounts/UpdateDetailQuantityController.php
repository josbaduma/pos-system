<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Http\Requests\UpdateDetailQuantityRequest;
use Illuminate\Http\JsonResponse;
use Src\Accounts\Actions\UpdateDetailQuantityAction;

class UpdateDetailQuantityController
{
    public function __invoke(
        UpdateDetailQuantityRequest $request,
        UpdateDetailQuantityAction $getTableAction,
        int $id,
        int $detailId,
    ): JsonResponse {
        $subAccounts = $getTableAction->execute($id, $detailId, $request->quantity);

        ob_clean(); // Clear any buffered output

        return response()->json($subAccounts);
    }
}
