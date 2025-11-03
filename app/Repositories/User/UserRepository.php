<?php
namespace App\Repositories\User;

use App\Repositories\User\IUserRepository;
use App\Models\User;
use Exception;

class UserRepository implements IUserRepository {

    protected $model;
    public function __construct(User $model) {
        $this->model = $model;
    }


    public function getAllWithPagination($perPage=10) {
        return $this->model->select('id', 'name', 'role', 'email_verified_at', 'created_at', 'updated_at')->paginate($perPage);
    }

    public function findById($id) {
        $user = $this->model->find($id);

        if(!$user) {
            throw new Exception("User not found", 404);
        }

        return $user;
    }
    
    public function findByEmail(string $email) {
        $user = $this->model->where('email', $email)->first();

        if(!$user) {
            throw new Exception("User not found", 404);
        }

        return $user;
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $user = $this->model->find($id);

        if(!$user) {
    
            throw new Exception("User not found", 404);
        }

        $user->fill($data);
        $user->save();
        return $user;
    }

    public function delete($id) {
        $user = $this->model->find($id);

         if(!$user) {
            throw new Exception("User not found", 404);
        }

        return $user->delete();
    }
}