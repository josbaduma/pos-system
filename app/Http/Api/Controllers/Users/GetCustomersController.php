<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Users;

use Illuminate\Http\JsonResponse;
use App\Models\User;

class GetCustomersController
{
    public function __invoke(): JsonResponse
    {
        $customers = User::where('role', 'customer')->get();

        ob_clean(); // Clear any buffered output
        return response()->json([
            'customers' => $customers,
        ]);
    }
}
