<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Models\Account;
use App\Models\SubAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BillSubAccountController
{
    public function __invoke(Request $request, int $subAccountId): JsonResponse
    {
        $subAccount = SubAccount::find($subAccountId);

        if (! $subAccount) {
            return response()->json([
                'message' => 'Subcuenta no encontrada.',
            ], 404);
        }

        // Recibir impuestos y descuento desde el request
        $tax = (float) $request->input('tax', 0);
        $discount = (float) $request->input('discount', 0);

        // Calcular subtotal
        $subtotal = $subAccount->details()->sum('subtotal');

        // Calcular total: subtotal + impuestos - descuento
        $total = $subtotal + $tax - $discount;

        // Crear el registro en la tabla accounts
        $account = Account::create([
            'sub_account_id' => $subAccount->id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discount' => $discount,
            'total' => $total,
            // Agrega aquí otros campos necesarios
        ]);

        // Marcar la subcuenta como facturada si lo necesitas
        $subAccount->update(['billed' => true]);

        // Cargar relaciones necesarias para evitar problemas con 'pivot'
        $subAccount->load('details.food.products');

        foreach ($subAccount->details as $detail) {
            $food = $detail->food;
            $foodQuantity = $detail->quantity;

            /** @var \App\Models\Product $product */
            foreach ($food->products as $product) {
                /** @var \Illuminate\Database\Eloquent\Relations\Pivot&object{quantity:int} $pivot */
                $pivot = $product->pivot;
                $usedQuantity = $pivot->quantity * $foodQuantity;

                $inventory = $product->inventory;
                if ($inventory) {
                    $inventory->decrement('quantity', $usedQuantity);
                }
            }
        }

        return response()->json([
            'message' => 'Subcuenta facturada exitosamente.',
            'account' => $account,
        ], 201);
    }
}
