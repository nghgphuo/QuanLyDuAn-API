<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Lấy user từ JWT guard
        $user = auth('api')->user();

        // Kiểm tra user có tồn tại và có role admin không

        $responseData = [
                'success' => false,
                'message' => 'Bạn không có quyền truy cập. Chỉ admin mới được phép.'
        ];

        if (!$user || $user->role !== 'admin') {
            return response()->json($responseData, 403);
        }

        return $next($request);
    }
}
