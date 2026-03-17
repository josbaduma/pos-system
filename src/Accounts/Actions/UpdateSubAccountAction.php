<?php

declare(strict_types=1);

namespace Src\Accounts\Actions;

use App\Models\SubAccount;
use Common\DTOs\Accounts\UpdateSubAccountDTO;
use Illuminate\Database\Eloquent\Collection;

class UpdateSubAccountAction
{
    /**
     * Summary of execute
     * @param UpdateSubAccountDTO $dto
     * @return \Illuminate\Database\Eloquent\Collection<int, SubAccount>
     */
    public function execute(UpdateSubAccountDTO $dto): Collection
    {
        // Crear la subcuenta en la base de datos
        SubAccount::where('id', '=', $dto->id)->update([
            'name' => $dto->name,
            'active' => true,
            'total' => 0,
        ]);

        return SubAccount::where('id', '=', $dto->id)->get();
    }
}
