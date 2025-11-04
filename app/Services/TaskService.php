<?php

namespace App\Services;

use App\Repositories\Task\ITaskRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class TaskService {
    protected $taskRepo;

    public function __construct(ITaskRepository $taskRepo) {
        $this->taskRepo = $taskRepo;
    }

    public function getAllWithPagination($perPage=10) {
        return $this->taskRepo->getAllWithPagination($perPage);
    }

    public function getByUser($userId, $perPage) {
        return $this->taskRepo->findByUser($userId, $perPage);
    }

    public function getById($id) {
        return $this->taskRepo->find($id);
    }

    public function create(array $data) {
        return $this->taskRepo->create($data);
    }

    public function update($id, array $data) {
        return $this->taskRepo->update($id, $data);
    }

    public function delete($id) {
        return $this->taskRepo->delete($id);
    }
}