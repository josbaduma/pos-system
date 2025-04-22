<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Categories;

use Illuminate\Http\JsonResponse;
use App\Models\Category;
use App\Models\Product;

class GetCategoriesController
{
    public function __invoke(): JsonResponse
    {
        $categories = Category::with('products')->get();


        ob_clean(); // Clear any buffered output
        return response()->json([
            'categories' => $categories,
        ]);
    }
}
