<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Products;

use Illuminate\Http\JsonResponse;
use App\Models\Category;

class DeleteCategoryController
{
    public function __invoke(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Categoría eliminada exitosamente.',
        ]);
    }
}
