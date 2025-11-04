<?php
namespace App\Repositories;

interface IBaseRepository {
    /*
    * Lấy tất cả tasks theo phân trang
    */
    public function getAllWithPagination($perPage=10);

    /*
    * Tìm theo ID
    */
    public function find($id);

    /**
     * Tạo mới
     */
    public function create(array $data);

    /**
     * Cập nhật 
     */
    public function update($id, array $data);

    /**
     * Xóa 
     */
    public function delete($id);
}