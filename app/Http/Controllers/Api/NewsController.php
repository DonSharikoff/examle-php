<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\ProfileResponse;
use App\Models\News;
use App\Models\Profile;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class NewsController extends Controller
{

    public function __invoke(): JsonResponse
    {
        $news = News::query()->limit(10)->get();

        return response()->json($news);
    }
}