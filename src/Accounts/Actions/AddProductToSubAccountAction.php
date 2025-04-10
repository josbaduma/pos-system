<?php

declare(strict_types=1);

namespace Src\Accounts\Actions;

use App\Models\DetailSubAccount;
use Common\DTOs\Accounts\AddProductToSubAccountDTO;

class AddProductToSubAccountAction
{
    public function execute(AddProductToSubAccountDTO $dto): bool
    {
        // Verificar si el producto ya existe en el detalle de la subcuenta
        $existingDetail = DetailSubAccount::where('sub_accounts_id', $dto->subAccountId)
            ->where('product_id', $dto->productId)
            ->first();

        if ($existingDetail) {
            // Si ya existe, no agregarlo
            return false;
        }

        // Crear el detalle de la subcuenta
        DetailSubAccount::create([
            'sub_accounts_id' => $dto->subAccountId,
            'product_id' => $dto->productId,
            'quantity' => $dto->quantity,
            'subtotal' => $dto->subtotal,
        ]);

        return true;
    }
}
