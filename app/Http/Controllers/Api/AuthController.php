<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\ProfileResponse;
use App\Models\Profile;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authService
    ) {
    }

    public function registration(RegistrationRequest $request): JsonResponse
    {
        $user = User::query()->create(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        );

        $profile = Profile::query()->create(
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]
        );

        return response()->json(
            array_merge(ProfileResponse::make($profile)->toArray($request), $this->authService->makeTokenForUser($user))
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::query()->where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            abort(400, __('Incorrect username/email or password'));
        }
        return response()->json(
            array_merge(
                ProfileResponse::make($user->profile)->toArray($request),
                $this->authService->makeTokenForUser($user)
            )
        );
    }
}