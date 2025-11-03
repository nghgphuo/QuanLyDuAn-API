<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Http\Requests\AuthRequests\LoginRequest;
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
        $data = $request->validated();
        $result = $this->authService->register($data);

        $responseData = array_merge([
            'success' => true,
            'message' => 'Đăng ký thành công',
        ], $result);

        return response()->json($responseData, 201);
    }

    public function login(LoginRequest $request): JsonResponse {
        $credentials = $request->validated();
        $result = $this->authService->login($credentials);

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
        $user = $this->authService->me();

        return response()->json([
            'success' => true,
            'user' => $user,
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