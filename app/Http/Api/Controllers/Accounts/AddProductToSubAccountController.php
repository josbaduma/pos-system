<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Accounts;

use App\Http\Requests\AddProductToSubAccountRequest;
use Common\DTOs\Accounts\AddProductToSubAccountDTO;
use Illuminate\Http\JsonResponse;
use Src\Accounts\Actions\AddProductToSubAccountAction;

class AddProductToSubAccountController
{
    public function __invoke(
        AddProductToSubAccountRequest $request,
        AddProductToSubAccountAction $addProductToSubAccountAction,
        int $id,
    ): JsonResponse {
        // Crear el DTO a partir de los datos del request
        $dto = new AddProductToSubAccountDTO(
            subAccountId: $id,
            productId: $request->get('product_id'),
            quantity: $request->get('quantity'),
            subtotal: $request->get('subtotal')
        );

        // Ejecutar la acción para agregar el producto
        $result = $addProductToSubAccountAction->execute($dto);

        if ($result) {
            $result->load('product');
        }

        ob_clean(); // Clear any buffered output

        // Retornar la respuesta en formato JSON
        return response()->json([
            'message' => $result ? 'Producto agregado exitosamente.' : 'El producto ya existe en la subcuenta.',
            'product' => $result ?: null,
        ], $result ? 201 : 409);
    }
}
