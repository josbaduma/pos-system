<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Src\Auth\Actions\LoginAction;

class LoginController
{
    public function __invoke(LoginRequest $request, LoginAction $loginAction)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        Log::info("Email: {$email}, Pass: {$password}");
        $loginResponse = $loginAction->execute($email, $password);

        return response()->json([
            'accessToken' => $loginResponse->accessToken,
            'id' => $loginResponse->id,
        ]);
    }
}
