<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Models\Account;
use App\Models\SubAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $tax = (float) $request->input('taxes', 0);
        $discount = (float) $request->input('discount', 0);
        Log::info("Taxes: $tax, Discount: $discount");
        // Calcular subtotal
        $subtotal = $subAccount->details->sum('subtotal');

        // Calcular total: subtotal + impuestos - descuento
        $taxAmount = $subtotal * ($tax / 100);
        $baseWithTax = $subtotal + $taxAmount;
        $discountAmount = $baseWithTax * ($discount / 100);

        Log::info("Taxes Amount: $taxAmount, Discount Amount: $discountAmount");

        $total = $baseWithTax - $discountAmount;

        // Crear el registro en la tabla accounts
        $account = Account::create([
            'sub_total' => $subtotal,
            'taxes' => $taxAmount,
            'discount' => $discountAmount,
            'total' => $total,
            // Agrega aquí otros campos necesarios
        ]);

        // Cargar relaciones necesarias para evitar problemas con 'pivot'
        $subAccount->load('details.food.products');

        foreach ($subAccount->details as $detail) {
            $food = $detail->food;
            $foodQuantity = $detail->quantity;

            // Verificar si el food tiene productos relacionados
            if ($food && $food->products->isNotEmpty()) {
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
        }

        $subAccount->update([
            'billed' => true,
            'active' => false, // Desactivar la subcuenta
        ]);

        return response()->json([
            'message' => 'Subcuenta facturada exitosamente.',
            'account' => $account,
        ], 201);
    }
}
