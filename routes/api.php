<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes công khai - tiền tố auth/
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// Bảo vệ bằng middleware authentication (có JWT token) (hoặc jwt tùy bạn đang dùng)
Route::middleware(['jwt.auth'])->group(function () {
     // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    // Routes chỉ dành cho Admin
 
    Route::middleware(['admin'])->group(function () {
        // User management
        // Danh sách users
        Route::get('/users', [UserController::class, 'index']);

        // Xem chi tiết user
        Route::get('/users/{id}', [UserController::class, 'show']);

        // Tạo user mới (chỉ Admin)
        Route::post('/users', [UserController::class, 'store']);

        // Cập nhật user
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::patch('/users/{id}', [UserController::class, 'update']);

        // Xóa user
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});



