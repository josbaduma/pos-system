<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Models\Account;
use App\Models\SubAccount;
use App\Services\Printer\TicketPrinter;
use Carbon\CarbonInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillSubAccountController
{
    private TicketPrinter $ticketPrinter;

    public function __construct(TicketPrinter $ticketPrinter)
    {
        $this->ticketPrinter = $ticketPrinter;
    }

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

        $account = DB::transaction(function () use ($subAccount, $subtotal, $taxAmount, $discountAmount, $total) {
            // Crear el registro en la tabla accounts
            $account = Account::create([
                'sub_total' => $subtotal,
                'taxes' => $taxAmount,
                'discount' => $discountAmount,
                'total' => $total,
            ]);

            $weekStart = now()->startOfWeek(CarbonInterface::MONDAY)->toDateString();
            $weekEnd = now()->endOfWeek(CarbonInterface::SUNDAY)->toDateString();

            foreach ($subAccount->details as $detail) {
                //TODO: Add account details model and save the details of the account for future reference

                $usedQuantity = (int) $detail->quantity;
                $inventoryCategory = $detail->product->inventoryCategory;

                if ($inventoryCategory) {
                    $existingWeeklyInventory = DB::table('weekly_inventory')
                        ->where('inventory_category_id', $detail->product->inventory_category_id)
                        ->whereDate('week_start', $weekStart)
                        ->lockForUpdate()
                        ->first();

                    if ($existingWeeklyInventory) {
                        DB::table('weekly_inventory')
                            ->where('id', $existingWeeklyInventory->id)
                            ->increment('units_used', $usedQuantity);
                    } else {
                        DB::table('weekly_inventory')->insert([
                            'inventory_category_id' => $detail->product->inventory_category_id,
                            'week_start' => $weekStart,
                            'week_end' => $weekEnd,
                            'units_in' => 0,
                            'units_used' => $usedQuantity,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            $subAccount->update([
                'billed' => true,
                'active' => false, // Desactivar la subcuenta
            ]);

            return $account;
        });

        $this->ticketPrinter->printSale($subAccount, $total);


        return response()->json([
            'message' => 'Subcuenta facturada exitosamente.',
            'account' => $account,
        ], 201);
    }
}
