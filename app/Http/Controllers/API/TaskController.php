<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest\DeleteTaskRequest;
use App\Http\Requests\TaskRequest\ShowTaskRequest;
use App\Http\Requests\TaskRequest\StoreTaskRequest;
use App\Http\Requests\TaskRequest\UpdateTaskRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Services\Task\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use ApiResponseTrait;
    protected $taskService;
    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }
    
    public function index(Request $request) {
        $perPage = $request->query('per_page', 10);
        $tasks = $this->taskService->getPaginated($perPage);
        return $this->successResponse( $tasks,  __('messages.tasks.list'));
    }

    /**
    * Lấy danh sách task theo user_id
    * Sử dụng ShowTaskRequest để validate Id
    */
    public function getByUser(ShowTaskRequest $request) {
        $perPage = $request->query('per_page', 10);
        $userId = $request->validated('user_id');
        $tasks = $this->taskService->findByUser($userId, $perPage);
        return $this->successResponse( $tasks,  __('messages.tasks.list_by_user', ['id' => $userId]));
    }

    /**
    * Lấy chi tiết 1 task
    * Sử dụng ShowTaskRequest để validate Id
    */
    public function show(ShowTaskRequest $request) {
        $id = $request->validated('id');
        $task = $this->taskService->findById($id);
        return $this->successResponse( $task,  __('messages.tasks.list_by_id', ['id' => $id]));
    }

    /**
    * Tạo task mới
    * Sử dụng StoreTaskRequest để validate
    */
    public function store(StoreTaskRequest $request) {
        $user_id = Auth::user()->id; 
        $data = array_merge($request->validated(), [
            'created_by' => $user_id,
        ]);
        $task = $this->taskService->create($data);
        return $this->successResponse( $task,  __('messages.tasks.created'), 201);
    }

    /**
    * Cập nhật task
    * Sử dụng UpdateTaskRequest để validate
    */
    public function update(UpdateTaskRequest $request) {
        $task_id = $request->input('id');
        $user_id = Auth::user()->id;
        $data = array_merge($request->validated(),[
            'created_by' => $user_id,
        ]);
        $task = $this->taskService->update($task_id, $data);
        return $this->successResponse( $task,  __('messages.tasks.updated'));
    }

    /**
    * Xóa task
    * Dành cho Admin 
    */
    public function destroy(DeleteTaskRequest $request) {
        $id = $request->validated('id');
        $this->taskService->delete($id);
        return $this->successResponse(code: 204);
    }
}
