<?php
namespace App\Services;

use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService {
    protected $userRepo;

    public function __construct(IUserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function getAllWithPagination($perPage=10) {
        return $this->userRepo->getAllWithPagination($perPage);
    }

    public function getById($id) {
        return $this->userRepo->findById($id);
    }

    public function create(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepo->create($data);
    }

    public function update($id, array $data) {

        if(isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepo->update($id, $data);
    }

    public function delete($id) {
        $user = $this->userRepo->findById($id);

        if ($user->id === Auth::id()) {
            throw new \Exception('Không thể xóa chính mình', 403);
        }

        return $this->userRepo->delete($id);
    }
}
