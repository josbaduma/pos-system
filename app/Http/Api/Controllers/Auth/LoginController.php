<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Src\Auth\Actions\LoginAction;

class LoginController
{
    public function __invoke(LoginRequest $request, LoginAction $loginAction): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $loginResponse = $loginAction->execute($email, $password);

        ob_clean(); // Clear any buffered output

        return new JsonResponse([
            'accessToken' => $loginResponse->accessToken,
            'id' => $loginResponse->id,
        ]);
    }
}
