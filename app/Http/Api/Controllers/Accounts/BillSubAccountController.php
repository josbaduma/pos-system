<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Models\Account;
use Illuminate\Http\JsonResponse;
use App\Models\SubAccount;
use Illuminate\Support\Facades\DB;

class BillSubAccountController
{
    public function __invoke(int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $subAccount = SubAccount::with('details')->findOrFail($id);

            $total = $subAccount->details->sum('subtotal');

            $account = Account::create([
                'sub_account_id' => $subAccount->id,
                'customer_id'  => $subAccount->name ?? null,
                'total'          => $total,
            ]);

            $subAccount->update(['active' => false]);

            DB::commit();

            return response()->json([
                'message' => 'Subcuenta facturada y desactivada exitosamente.',
                'account' => $account,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al facturar la subcuenta.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
