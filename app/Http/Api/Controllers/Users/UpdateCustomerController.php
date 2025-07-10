<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Users;

use App\Http\Requests\UpdateCustomerRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UpdateCustomerController
{
    public function __invoke(UpdateCustomerRequest $request, int $id): JsonResponse
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->update($request->only(['name', 'email', 'password']));

        ob_clean(); // Clear any buffered output

        return response()->json([
            'message' => 'Cliente actualizado exitosamente.',
            'customer' => $customer,
        ]);
    }
}
