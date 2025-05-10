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
        $categories = Category::with([
            'products' => function ($query) {
                $query->where('is_active', true);
            }
        ])->where('is_active', true)->get();


        ob_clean(); // Clear any buffered output
        return response()->json([
            'categories' => $categories,
        ]);
    }
}
