<?php
namespace App\Services;

use App\Traits\ApiResponseTrait;
use Exception;

abstract class BaseService {
    // use ApiResponseTrait;

    protected $repository;

    public function __construct($repository) {
        $this->repository = $repository;
    }
    
    public function getPaginated($perPage = 10) {
        return $this->repository->getAllWithPagination($perPage);
    }

    public function findById($id) {
        return $this->repository->find($id);
    }

    public function create(array $data) {
        return $this->repository->create($data);
    }

    public function update($id, array $data) {
        return $this->repository->update($id, $data);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }
}