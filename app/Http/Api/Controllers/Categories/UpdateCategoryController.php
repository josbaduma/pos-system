<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Categories;

use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Category;

class UpdateCategoryController
{
    public function __invoke(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->get('name'),
        ]);

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Categoría actualizada exitosamente.',
            'category' => $category,
        ]);
    }
}
