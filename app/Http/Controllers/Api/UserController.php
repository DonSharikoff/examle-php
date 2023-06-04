<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\ProfileResponse;
use App\Models\Profile;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __invoke(UpdateUserRequest $request): JsonResponse
    {
        Profile::query()->where('user_id', auth()->id())->update($request->all());

        return response()->json(
            array_merge(ProfileResponse::make(auth()->user()->profile)->toArray($request))
        );
    }
}