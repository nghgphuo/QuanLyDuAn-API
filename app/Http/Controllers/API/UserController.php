<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\DeleteUserRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequests\ShowUserRequest;
use App\Http\Requests\UserRequests\StoreUserRequest;
use App\Http\Requests\UserRequests\UpdateUserRequest;
use App\Services\UserService;

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
        $users = $this->userService->getAllWithPagination($perPage);
        $responseData = [
            'success' => true,
            'users' => $users,
        ];
        return response()->json($responseData, 200);
    }

     /**
     * Lấy chi tiết 1 user
     * Sử dụng ShowUserRequest để validate ID
     */
    public function show(ShowUserRequest $request) {
        $id = $request->validated('id');

        $user =  $this->userService->getById($id);

        $responseData = [
            'success' => true,
            'users' => $user,
        ];

        return response()->json($responseData, 200);
    }

    /**
     * Tạo user mới
     * Sử dụng StoreUserRequest để validate
     */
    public function store(StoreUserRequest $request) {
        $data = $request->validated();
        $user = $this->userService->create($data);

        $responseData = [
            'success' => true,
            'message' => 'Tạo người dùng thành công',
            'user' => $user,
        ];

        return response()->json($responseData, 201);
    }

    /**
     * Cập nhật user
     * Sử dụng UpdateUserRequest để validate
     */
    public function update(UpdateUserRequest $request) {
        $id = $request->input('id');
        
        $user = $this->userService->update($id, $request->validated());

        $responseData = [
            'success' => true,
            'message' => 'Cập nhật người dùng thành công',
            'user' => $user,
        ];

        return response()->json($responseData, 201);
    }

    /**
     * Xóa user
     */
    public function destroy(DeleteUserRequest $request) {
        $id = $request->validated('id');

        $this->userService->delete($id);

        $responseData = [
            'success' => true,
            'message' => 'Xóa người dùng thành công',
        ];

        return response()->json($responseData, 204);
    }
}
