<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest\DeleteTaskRequest;
use App\Http\Requests\TaskRequest\ShowTaskRequest;
use App\Http\Requests\TaskRequest\StoreTaskRequest;
use App\Http\Requests\TaskRequest\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }
    
    public function index(Request $request) {
        $perPage = $request->query('per_page', 10);
        $tasks = $this->taskService->getAllWithPagination($perPage);
        
        $responseData = [
            'success' => true,
            'tasks' => $tasks
        ];

        return response()->json($responseData, 200);
    }

    /**
     * Lấy danh sách task theo user_id
     * Sử dụng ShowTaskRequest để validate Id
     */
    public function getByUser(ShowTaskRequest $request) {
        $perPage = $request->query('per_page', 10);
        $user_id = $request->validated('user_id');

        $tasks = $this->taskService->getByUser($user_id, $perPage);

        $responseData = [
            'success' => true,
            'task' => $tasks,
        ];

        return response()->json($responseData, 200);
    }

    /**
     * Lấy chi tiết 1 task
     * Sử dụng ShowTaskRequest để validate Id
     */
    public function show(ShowTaskRequest $request) {
        $id = $request->validated('id');

        $task = $this->taskService->getById($id);

        $responseData = [
            'success' => true,
            'task' => $task,
        ];

        return response()->json($responseData, 200);
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

        $responseData = [
            'success' => true,
            'message' => 'Tạo task mới thành công',
            'task' => $task,
        ];

        return response()->json($responseData, 201);
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

        $responseData = [
            'success' => true,
            'message' => 'Tạo task mới thành công',
            'task' => $task,
        ];

        return response()->json($responseData, 201);
    }

    /**
     * Xóa task
     * Dành cho Admin 
     */
    public function destroy(DeleteTaskRequest $request) {
        $id = $request->validated('id');

        $this->taskService->delete($id);

        $responseData = [
            'success' => true,
            'message' => 'Xóa task thành công',
        ];

        return response()->json($responseData, 204);
    }
}
