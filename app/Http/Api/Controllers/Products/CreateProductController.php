<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Products;

use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class CreateProductController
{
    public function __invoke(CreateProductRequest $request): JsonResponse
    {
        $product = Product::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id'),
        ]);

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Producto creado exitosamente.',
            'product' => $product,
        ], 201);
    }
}
