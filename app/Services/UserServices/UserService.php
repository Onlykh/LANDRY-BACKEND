<?php

namespace App\Services\UserServices;

use App\Services\UserServices\UserServiceInterface;
use App\Repositories\UserRepositories\UserRepository;
use App\Models\User;

class UserService implements UserServiceInterface
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function all($filters = [])
    {
        return $this->userRepository->all($filters);
    }

    public function findById($id, $with = [])
    {
        return $this->userRepository->findById($id, $with);
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update(User $user, array $data)
    {
        return $this->userRepository->update($user, $data);
    }

    public function delete(User $user)
    {
        return $this->userRepository->delete($user);
    }

    public function getUserByPhoneNumber(string $phoneNumber): ?User
    {
        return $this->userRepository->getUserByPhoneNumber($phoneNumber);
    }
}
