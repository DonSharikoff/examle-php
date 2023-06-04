<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthService
{

    public function __construct()
    {
    }

    public function makeTokenForUser(User $user): array
    {
        $token = $user->createToken(config('app.name'));

        return [
            'tokenType' => 'Bearer',
            'token' => $token->accessToken,
        ];
    }
}