<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public function getAll() {
        return User::select('id', 'name', 'role', 'email_verified_at', 'created_at', 'updated_at')->get();
    }

    public function findById($id) {
        return User::findOrFail($id);
    }

    public function create(array $data) {
        return User::create($data);
    }

    public function update($id, array $data) {
        $user = User::findOrFail($id);
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}