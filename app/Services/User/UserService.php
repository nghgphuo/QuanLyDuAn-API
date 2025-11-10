<?php
namespace App\Services\user;

use App\Repositories\User\IUserRepository;
use App\Services\BaseService;
use App\Services\User\IUserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService extends BaseService implements IUserService{
    protected $userRepo;

    public function __construct(IUserRepository $userRepo) {
        parent::__construct($userRepo);
        $this->userRepo = $userRepo;
    }

    public function create(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepo->create($data);
    }

    public function update($id, array $data) {
        if($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->repository->update($id, $data);
    }
}
