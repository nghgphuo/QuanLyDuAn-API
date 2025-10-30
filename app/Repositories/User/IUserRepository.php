<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

interface IUserRepository
{
    public function getAllWithPagination($perPage=10);

    /*
    * Tìm user theo ID
    */
    public function findById($id);

    /*
    * Tìm user theo email
    */
    public function findByEmail(string $email);

    /**
     * Tạo user mới
     */
    public function create(array $data);

    /**
     * Cập nhật user
     */
    public function update($id, array $data);

    /**
     * Xóa user
     */
    public function delete($id);
}