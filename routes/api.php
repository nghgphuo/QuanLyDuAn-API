<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;

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
// Authentication routes
Route::prefix('auth')->group(function () {
    // Public routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    // Protected routes
    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware('jwt.auth');
    Route::post('refresh', [AuthController::class, 'refresh'])
        ->middleware('jwt.auth');
    Route::get('me', [AuthController::class, 'me'])
        ->middleware('jwt.auth');
});

// User management routes - Admin only
Route::prefix('users')->middleware(['jwt.auth', 'admin'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::match(['put', 'patch'], '/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::middleware(['jwt.auth', 'admin'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/user/{user_id}', [TaskController::class, 'getByUser'])->name('tasks.getByUser');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']); 
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
    // Route::middleware('isAdmin')->group(function () {
    // });
});

