<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Http\Requests\CreateSubAccountRequest;
use Common\DTOs\Accounts\CreateSubAccountDTO;
use Illuminate\Http\JsonResponse;
use Src\Accounts\Actions\CreateSubAccountAction;

class CreateSubAccountController
{
    public function __invoke(
        CreateSubAccountRequest $request,
        CreateSubAccountAction $createSubAccountAction,
    ): JsonResponse {
        // Crear el DTO a partir de los datos del request
        $dto = new CreateSubAccountDTO(
            name: $request->get('name'),
            table_id: $request->get('table_id')
        );

        // Ejecutar la acción para crear la subcuenta
        $subAccount = $createSubAccountAction->execute($dto);

        ob_clean(); // Clear any buffered output

        // Retornar la respuesta en formato JSON
        return response()->json([
            'message' => 'Subaccount created successfully.',
            'sub_account' => $subAccount,
        ], 201);
    }
}
