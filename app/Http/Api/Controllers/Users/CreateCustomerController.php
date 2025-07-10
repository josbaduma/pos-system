<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Users;

use App\Http\Requests\CreateCustomerRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class CreateCustomerController
{
    public function __invoke(CreateCustomerRequest $request): JsonResponse
    {
        $customer = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
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
