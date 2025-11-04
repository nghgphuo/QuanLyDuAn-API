<?php
namespace App\Repositories\Task;

use App\Repositories\BaseRepository;
use App\Repositories\Task\ITaskRepository;
use App\Models\Task;

class TaskRepository extends BaseRepository implements ITaskRepository {
    public  function __construct(Task $model) {
        parent::__construct($model);
    }

    /*
    * Lấy tasks được giao cho User hiện tại 
    */
    public function findByUser($userId, $perPage=10){
        return $this->model->query()
            ->with(['assignee:id,name'])
            ->where('assigned_to', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}