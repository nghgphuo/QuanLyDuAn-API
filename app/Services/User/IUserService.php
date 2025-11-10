<?php

namespace App\Services\User;

interface IUserService {
    public function create(array $data);
    public function update($id, array $data);
}