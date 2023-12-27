<?php

namespace App\Http\Controllers;

use Crm\User\Request\UserCreation;
use Crm\USer\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    const TOKEN_NAME = "personal";
    public function __construct(private readonly UserService $userService)
    {
    }
    public function index(Request $request): Collection
    {
        return $this->userService->index($request);
    }

    public function show(int $userId)
    {
        return $this->userService->show($userId) ?? response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
    }

    public function  create(UserCreation $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userService->create($request);

        return response()->json(
            [
                'user' => $user,
                'token' => $user->createToken(self::TOKEN_NAME)->plainTextToken
            ]
        );
    }

    public function  update(Request $request, $userId)
    {
        return $this->userService->update($request, $userId);
    }

    public function  delete(Request $request, int $userId): \Illuminate\Http\JsonResponse
    {
        return $this->userService->delete($request, $userId);
    }
}
