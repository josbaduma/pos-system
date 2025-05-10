<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Users;

use App\Http\Requests\CreateCustomerRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class CreateCustomerController
{
    public function __invoke(CreateCustomerRequest $request): JsonResponse
    {
        $customer = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => 'customer',
        ]);

        ob_clean(); // Clear any buffered output
        return response()->json([
            'message' => 'Cliente creado exitosamente.',
            'customer' => $customer,
        ], 201);
    }
}
