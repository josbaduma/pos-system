<?php

declare(strict_types=1);

namespace App\Http\API\Controllers\Auth;

use Illuminate\Http\Request;
use Src\Auth\Actions\LoginAction;

class LoginController
{
    public function __construct(private readonly LoginAction $loginAction)
    {
    }

    public function __invoke(Request $request)
    {
        $email = $request->string('email')->toString();
        $password = $request->string('password')->toString();

        $loginResponse = $this->loginAction->execute($email, $password);

        return response()->json([
            'accessToken' => $loginResponse->accessToken,
            'id' => $loginResponse->id,
        ]);
    }
}
