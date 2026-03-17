<?php

declare(strict_types=1);

namespace Src\Dashboard\Actions;

use App\Models\Account;
use Common\DTOs\Dashboard\GetAllSalesDTO;
use Illuminate\Database\Eloquent\Collection;

class GetAllSalesAction
{
    /**
     * Summary of execute
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account>
     */
    public function execute(/*GetAllSalesDTO $dto*/): Collection
    {
        return Account::get();
    }
}
