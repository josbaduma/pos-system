<?php

declare(strict_types=1);

namespace Src\Accounts\Actions;

use App\Models\DetailSubAccount;
use App\Models\SubAccount;
use App\Models\Table;
use Common\DTOs\Tables\GetTablesResponseDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UpdateDetailQuantityAction
{
    public function __construct() {}

    /**
     * Actualiza la cantidad de un detalle de subcuenta.
     *
     * @param int $subAccountId
     * @param int $detailId
     * @param int $quantity
     * @return JsonResponse
     */
    public function execute(int $subAccountId, int $detailId, int $quantity): JsonResponse
    {
        ob_clean(); // Clear any buffered output
        DB::beginTransaction();

        try {
            // Buscar el detalle de la subcuenta
            $detail = DetailSubAccount::where('sub_accounts_id', $subAccountId)
                ->where('id', $detailId)
                ->firstOrFail();

            // Recalcular el subtotal
            $subtotal = (float) $detail->product->price * $quantity;

            // Actualizar la cantidad y subtotal
            $detail->update([
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);

            // Recalcular el total de la subcuenta
            $total = DetailSubAccount::where('sub_accounts_id', $subAccountId)->sum('subtotal');
            SubAccount::where('id', $subAccountId)->update(['total' => $total]);

            DB::commit();
            return response()->json($detail->load('product'), 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar el detalle', 'message' => $e->getMessage()], 500);
        }
    }
}
