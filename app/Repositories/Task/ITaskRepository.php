<?php

namespace App\Repositories\Task;

interface ITaskRepository {
    
    // Lấy tất cả tasks
    public function getAllWithPagination($perPage=10);

    /*
    * Tìm tasks được giao cho User hiện tại 
    */
    public function findByUser($userId);

    /*
    * Tìm task theo Id
    */
    public function findById($id);

    /**
     * Tạo Task mới (admin)
    */
    public function create(array $data);

    /**
     * Cập nhật task
     */
    public function update($id, array $data);

    /**
     * Xóa task
     */
    public function delete($id);
}