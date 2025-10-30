<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Http\Requests\AuthRequests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) :JsonResponse {
        $result = $this->authService->register($request->validated());

        return response()->json(array_merge([
            'success' => true,
            'message' => 'Đăng ký thành công',
        ], $result), 201);
    }

    public function login(LoginRequest $request): JsonResponse {
        $result = $this->authService->login($request->validated());

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Email hoặc mật khẩu không chính xác'
            ], 401);
        }

       return response()->json(array_merge([
            'success' => true,
            'message' => 'Đăng nhập thành công',
        ], $result));
    }   

    public function me(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'user' => $this->authService->me(),
        ]);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json([
            'success' => true,
            'message' => 'Đăng xuất thành công'
        ]);
    }

    public function refresh(): JsonResponse
    {
        $newToken = $this->authService->refresh();
        return response()->json([
            'success' => true,
            'token' => $newToken,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}