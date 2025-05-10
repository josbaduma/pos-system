<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Categories;

use Illuminate\Http\JsonResponse;
use App\Models\Category;

class DeleteCategoryController
{
    public function __invoke(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->update(['is_active' => false]);

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Categoría eliminada exitosamente.',
        ]);
    }
}
