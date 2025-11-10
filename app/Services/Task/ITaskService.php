<?php

namespace App\Services\Task;

interface ITaskService {
    public function findByUser($userId, $perPage);
    public function findById($id);
    public function getAllWithPagination($perPage = 10);
}