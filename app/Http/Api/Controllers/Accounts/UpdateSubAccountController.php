<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Http\Requests\UpdateSubAccountRequest;
use Common\DTOs\Accounts\UpdateSubAccountDTO;
use Illuminate\Http\JsonResponse;
use Src\Accounts\Actions\UpdateSubAccountAction;

class UpdateSubAccountController
{
    public function __invoke(
        int $id,
        UpdateSubAccountRequest $request,
        UpdateSubAccountAction $createSubAccountAction,
    ): JsonResponse {
        // Crear el DTO a partir de los datos del request
        $dto = new UpdateSubAccountDTO(
            name: $request->get('name'),
            id: $id,
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
