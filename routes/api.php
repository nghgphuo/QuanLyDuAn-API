<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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

// Routes công khai
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

// Bảo vệ bằng middleware auth:sanctum (hoặc jwt tùy bạn đang dùng)
// Route::middleware(['auth:sanctum'])->group(function () {
// });


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