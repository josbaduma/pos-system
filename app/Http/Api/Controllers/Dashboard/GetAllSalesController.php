<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Dashboard;

use App\Http\Requests\GetAllSalesRequest;
use Common\DTOs\Dashboard\GetAllSalesDTO;
use Illuminate\Http\JsonResponse;
use Src\Dashboard\Actions\GetAllSalesAction;

class GetAllSalesController
{
    public function __invoke(
        GetAllSalesRequest $request,
        GetAllSalesAction $createSubAccountAction,
    ): JsonResponse {
        // Crear el DTO a partir de los datos del request
        /*$dto = new GetAllSalesDTO(
            name: $request->get('name'),
            id: $request->get('id')
        );*/

        // Ejecutar la acción para crear la subcuenta
        $sales = $createSubAccountAction->execute(/*$dto*/);

        ob_clean(); // Clear any buffered output

        // Retornar la respuesta en formato JSON
        return response()->json([
            'message' => 'Sales fetched successfully.',
            'sales' => $sales,
        ], 201);
    }
}
