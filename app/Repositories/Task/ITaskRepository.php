<?php

namespace App\Repositories\Task;

use App\Repositories\IBaseRepository;

interface ITaskRepository extends IBaseRepository{
    /*
    * Tìm tasks được giao cho User hiện tại 
    */
    public function findByUser($userId);
    public function findById($id);
    public function getAllWithPagination($perPage = 10);
}