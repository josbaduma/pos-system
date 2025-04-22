<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Categories;

use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Category;

class CreateCategoryController
{
    public function __invoke(CreateCategoryRequest $request): JsonResponse
    {
        $category = Category::create([
            'name' => $request->get('name'),
        ]);

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Categoría creada exitosamente.',
            'category' => $category,
        ], 201);
    }
}
