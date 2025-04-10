<?php

declare(strict_types=1);

namespace Src\Accounts\Actions;

use App\Models\SubAccount;
use Common\DTOs\Accounts\CreateSubAccountDTO;

class CreateSubAccountAction
{
    public function execute(CreateSubAccountDTO $dto): SubAccount
    {
        // Crear la subcuenta en la base de datos
        return SubAccount::create([
            'table_id' => $dto->table_id,
            'name' => $dto->name,
            'active' => true,
            'total' => 0,
        ]);
    }
}
