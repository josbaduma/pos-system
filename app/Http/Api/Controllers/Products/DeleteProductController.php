<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Products;

use Illuminate\Http\JsonResponse;
use App\Models\Product;

class DeleteProductController
{
    public function __invoke(int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Producto eliminado exitosamente.',
        ]);
    }
}
