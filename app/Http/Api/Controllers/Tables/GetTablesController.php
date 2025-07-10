<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Tables;

use Illuminate\Http\JsonResponse;
use Src\Tables\Actions\GetTablesAction;

class GetTablesController
{
    public function __invoke(GetTablesAction $getTableAction): JsonResponse
    {
        $tables = $getTableAction->execute();

        ob_clean(); // Clear any buffered output

        return response()->json($tables);
    }
}
