<?php

namespace App\Services\Task;

use App\Repositories\Task\ITaskRepository;
use App\Services\BaseService;
use App\Services\Task\ITaskService;

class TaskService extends BaseService implements ITaskService {
    protected $taskRepo;

    public function __construct(ITaskRepository $taskRepo) {
        parent::__construct($taskRepo);
        $this->taskRepo = $taskRepo;
    }

    public function findByUser($userId, $perPage) {
        return $this->taskRepo->findByUser($userId, $perPage);
    }
}