<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Lấy danh sách tất cả users
     */
    public function index(Request $request) {
        $perPage = $request->query('per_page', 10);
        $users = $this->userService->getAllUsers($perPage);

        return response()->json([
            'success' => true,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'last_page' => $users->lastPage(),
            'users' => $users->items(),
        ], 200);
    }

     /**
     * Lấy chi tiết 1 user
     * Sử dụng ShowUserRequest để validate ID
     */
    public function show(ShowUserRequest $request, $id) {
         return response()->json([
            'success' => true,
            'users' => $this->userService->getUserById($id),
        ], 200);
    }

    /**
     * Tạo user mới
     * Sử dụng StoreUserRequest để validate
     */
    public function store(StoreUserRequest $request) {
        // authorize trước khi tạo
        // $this->authorize(ability: 'create', arguments: User::class);
        
        $user = $this->userService->createUser($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tạo người dùng thành công',
            'user' => $user,
        ], 201);
    }

    /**
     * Cập nhật user
     * Sử dụng UpdateUserRequest để validate
     */
    public function update(UpdateUserRequest $request, $id) {
        // lấy target user (chỉ lấy, chưa thay đổi)
        $targetUser = $this->userService->getUserById($id);

        // authorize trên target
        // $this->authorize('update', $targetUser);
        
        $user = $this->userService->updateUser($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật người dùng thành công',
            'user' => $user,
        ]);
    }

    /**
     * Xóa user
     * Tạm thời chưa cần làm
     */
    public function destroy($id) {
        // lấy target user (chỉ lấy, chưa thay đổi)
        $targetUser = $this->userService->getUserById($id);

        // authorize trên target
        // $this->authorize('update', $targetUser);

        $user = $this->userService->deleteUser($id);

        return response()->json([
            'success' => true,
            'message' => 'Xóa người dùng thành công',
        ], 204);
    }
}
