<?php
namespace App\Repositories\User;

use App\Repositories\User\IUserRepository;
use App\Models\User;

class UserRepository implements IUserRepository {

    protected $model;
    public function __construct(User $model) {
        $this->model = $model;
    }


    public function getAllWithPagination($perPage=10) {
        return $this->model->select('id', 'name', 'role', 'email_verified_at', 'created_at', 'updated_at')->paginate($perPage);
    }

    public function findById($id) {
        return $this->model->findOrFail($id);
    }
    
    public function findByEmail(string $email) {
        return $this->model->where('email', $email)->first();
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $user = $this->model->findOrFail($id);
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function delete($id) {
        $user = $this->model->findOrFail($id);
        return $user->delete();
    }
}