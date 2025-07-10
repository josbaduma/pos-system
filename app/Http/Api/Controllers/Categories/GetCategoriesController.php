<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Categories;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class GetCategoriesController
{
    public function __invoke(): JsonResponse
    {
        $categories = Category::with([
            'products' => function ($query): void {
                $query->where('is_active', true);
            },
        ])->where('is_active', true)->get();


        ob_clean(); // Clear any buffered output

        return response()->json([
            'categories' => $categories,
        ]);
    }
}
