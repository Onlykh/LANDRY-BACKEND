<?php

namespace App\Repositories\UserRepositories;

use App\Models\User;
use App\Repositories\UserRepositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function __construct(private User $user)
    {
    }

    public function all($filters = [])
    {
        $user = $this->user->filter($filters);

        if (isset($filters['select'])) {
            $user->select($filters['select']);
        }

        if (isset($filters['order_by'])) {
            $user->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
        }

        if (isset($filters['with'])) {
            $user->with($filters['with']);
        }

        return $filters['paginated'] ?? false
            ? $user->paginate($filters['page_size'] ?? 10)
            : $user->get();
    }

    public function findById($id, $with)
    {
        return $this->user->with($with)->find($id);
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function getUserByPhoneNumber(string $phoneNumber): ?User
    {
        return $this->user->where('phone_number', $phoneNumber)->first();
    }
}
