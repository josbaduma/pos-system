<?php

declare(strict_types=1);

namespace Src\Auth\Actions;

use App\Models\User;
use Common\DTOs\Auth\LoginResponseDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Auth\Exceptions\InvalidCredentialsException;
use Src\Auth\Services\AuthService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginAction
{
    public function __construct(
        private AuthService $authService,
    ) {}

    /**
     * @param string $email
     * @param string $password
     * @return LoginResponseDTO
     */
    public function execute(string $email, string $password): LoginResponseDTO
    {
        $decryptPasswordToken = config('database.connections.legacy-pgsql.encryption_key');

        /** @var User&object{decrypted_password: string} $user */
        $user = User::query()
            ->addSelect('*')
            ->selectRaw("AES_DECRYPT(password, '$decryptPasswordToken') as decrypted_password")
            ->where('email', $email)
            ->first();

        if ($user == null) {
            throw new HttpException(401, 'Invalid Credentials');
        }
        if ($user->decrypted_password != $password) { // @php-ignore-line
            throw new HttpException(401, 'Invalid Credentials');
        }

        Auth::login($user);

        $token = $this->authService->generateAccessToken($user);


        return new LoginResponseDTO(
            accessToken: $token,
            user: $user,
            id: $user->id,
        );
    }
}
