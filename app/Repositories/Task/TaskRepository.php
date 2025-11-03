<?php
namespace App\Repositories\Task;

use App\Repositories\Task\ITaskRepository;
use App\Models\Task;
use Exception;


class TaskRepository implements ITaskRepository {
    protected $model;

    public  function __construct(Task $model) {
        $this->model = $model;
    }

    // Lấy tất cả tasks
    public function getAllWithPagination($perPage=10) {
        return $this->model->select()->paginate($perPage);
    }

    /*
    * Lấy tasks được giao cho User hiện tại 
    */
    public function findByUser($userId, $perPage=10){
        return $this->model->query()
            ->with(['assignee:id,name'])
            ->where('created_by', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /*
    * Tìm task theo Id
    */
    public function findById($id) {
        return $this->model->find($id);
    }

    /**
     * Tạo Task mới (admin)
    */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * Cập nhật task
     */
    public function update($id, array $data) {
        $task = $this->model->find($id);

        if(!$task) {
            throw new Exception('Task not found', 404);
        }

        $task->fill($data);
        $task->save();
        return $task;
    }

    /**
     * Xóa task
     */
    public function delete($id) {
        $task = $this->model->find($id);

        if(!$task) {
            throw new Exception('Task not found', 404);
        }

        return $task->delete();
    }
}