<?php
namespace App\Repositories\Task;

use App\Repositories\BaseRepository;
use App\Repositories\Task\ITaskRepository;
use App\Models\Task;

class TaskRepository extends BaseRepository implements ITaskRepository {
    public  function __construct(Task $model) {
        parent::__construct($model);
    }

    public function findByUser($userId, $perPage=10){
        $tasks = $this->model->query()
            ->with(['assignee:id,name', 'creator:id,name'])
            ->where('assigned_to', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $tasks->getCollection()->transform(function($task) {
            return $task->makeHidden(['created_by', 'assigned_to']);
        });

        return $tasks;
    }


    public function findById($id) {
        $task = $this->model->with(['assignee:id,name', 'creator:id,name'])->find($id);
        return $task->makeHidden(['created_by', 'assigned_to']);
    }

    public function getAllWithPagination($perPage = 10) {
        $tasks = $this->model->with(['assignee:id,name', 'creator:id,name'])->paginate($perPage);
        $tasks->getCollection()->transform(function ($task) {
            return $task->makeHidden(['created_by', 'assigned_to']);
        });
        return $tasks;
    }

}
