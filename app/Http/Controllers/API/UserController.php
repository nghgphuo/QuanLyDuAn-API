<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\DeleteUserRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequests\ShowUserRequest;
use App\Http\Requests\UserRequests\StoreUserRequest;
use App\Http\Requests\UserRequests\UpdateUserRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    use ApiResponseTrait;
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
    * Lấy danh sách tất cả users
    */
    public function index(Request $request) {
        $perPage = $request->query('per_page', 10);
        $users = $this->userService->getPaginated($perPage);
        return $this->successResponse($users, 'Danh sách người dùng');
    }

    /**
    * Lấy chi tiết 1 user
    * Sử dụng ShowUserRequest để validate ID
    */
    public function show(ShowUserRequest $request) {
        $id = $request->validated('id');

        $user =  $this->userService->findById($id);

       return $this->successResponse($user, 'Thông tin chi tiết người dùng');
     }

    /**
    * Tạo user mới
    * Sử dụng StoreUserRequest để validate
    */
    public function store(StoreUserRequest $request) {
        $data = $request->all();
        $arrData = collect($data)->only(['name', 'email', 'password', 'role'])->toArray();
        $user = $this->userService->create($arrData);
        return $this->successResponse($user, 'Tạo người dùng mới thành công', 201);
      }

    /**
    * Cập nhật user
    * Sử dụng UpdateUserRequest để validate
    */
    public function update(UpdateUserRequest $request) {
        $id = $request->input('id');
        $user = $this->userService->update($id, $request->validated());
        return $this->successResponse($user, 'Cập nhật người dùng mới thành công');
    }

    /**
    * Xóa user
    */
    public function destroy(DeleteUserRequest $request) {
        $id = $request->validated('id');
        $this->userService->delete($id);
        return $this->successResponse(code: 204);
    }
}
