<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class DeleteProductController
{
    public function __invoke(int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->update(['is_active' => false]);

        ob_clean(); // Clear any buffered output

        return response()->json([
            'message' => 'Producto eliminado exitosamente.',
        ]);
    }
}
