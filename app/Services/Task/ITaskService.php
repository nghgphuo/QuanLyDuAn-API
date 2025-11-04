<?php

namespace App\Services\Task;

interface ITaskService {
    public function findByUser($userId, $perPage);
}