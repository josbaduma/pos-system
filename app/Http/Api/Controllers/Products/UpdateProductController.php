<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Products;

use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class UpdateProductController
{
    public function __invoke(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id'),
        ]);

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Producto actualizado exitosamente.',
            'product' => $product,
        ]);
    }
}
