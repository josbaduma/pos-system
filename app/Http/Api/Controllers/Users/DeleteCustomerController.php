<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Users;

use Illuminate\Http\JsonResponse;
use App\Models\User;

class DeleteCustomerController
{
    public function __invoke(int $id): JsonResponse
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->update(['is_active' => false]);

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Cliente desactivado exitosamente.',
        ]);
    }
}
