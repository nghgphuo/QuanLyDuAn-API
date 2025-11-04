<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Repositories\User\IUserRepository;
use App\Models\User;
use Exception;

class UserRepository extends BaseRepository implements IUserRepository {

    public function __construct(User $model) {
        parent::__construct($model);
    }

    public function getAllWithPagination($perPage=10) {
        return $this->model->select('id', 'name', 'email', 'role', 'email_verified_at', 'created_at', 'updated_at')->paginate($perPage);
    }
    
    public function findByEmail(string $email) {
        $user = $this->model->where('email', $email)->first();

        if(!$user) {
            throw new Exception("User not found", 404);
        }

        return $user;
    }
}