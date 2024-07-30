<?php

namespace App\Repositories\UserRepositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function all($filters = []);
    public function findById($id, $with);
    public function create(array $data);
    public function update(User $user, array $data);
    public function delete(User $user);
    public function getUserByPhoneNumber(string $phoneNumber): ?User;
}
