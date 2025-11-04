<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;


trait ApiResponseTrait
{
    protected function successResponse($data = [], string $message = 'Success', int $code = 200): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}