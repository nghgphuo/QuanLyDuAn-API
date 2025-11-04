<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepository {
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function getAllWithPagination($perPage = 10) {
        return $this->model->paginate($perPage);
    }

    public function find($id) {
        $record = $this->model->find($id);
        if(!$record) {
            throw new Exception(class_basename($this->model) . " not found.", 404);
        }
        return $record;
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $item = $this->find($id);

        $item->fill($data);
        $item->save();
        return $item;
    }

    public function delete($id) {
        $item = $this->find($id);

        return $item->delete();
    }
}