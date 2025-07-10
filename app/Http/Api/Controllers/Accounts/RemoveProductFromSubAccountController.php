<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Models\DetailSubAccount;
use Illuminate\Http\JsonResponse;

class RemoveProductFromSubAccountController
{
    public function __invoke(int $subAccountId, int $detailId): JsonResponse
    {
        $detail = DetailSubAccount::where('sub_accounts_id', $subAccountId)
            ->where('id', $detailId)
            ->first();

        if (! $detail) {
            return response()->json([
                'message' => 'Detalle no encontrado.',
            ], 404);
        }

        $detail->delete();

        return response()->json([
            'message' => 'Detalle eliminado exitosamente.',
        ], 200);
    }
}
