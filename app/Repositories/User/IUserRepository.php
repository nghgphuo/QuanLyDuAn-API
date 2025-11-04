<?php

namespace App\Repositories\User;

use App\Repositories\IBaseRepository;

interface IUserRepository extends IBaseRepository
{
    /*
    * Tìm user theo email
    */
    public function findByEmail(string $email);
}