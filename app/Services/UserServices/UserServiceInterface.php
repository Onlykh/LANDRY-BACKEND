<?php

    namespace App\Services\UserServices;

    use App\Models\User;

    interface UserServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(User $user, array $data);
        public function delete(User $user);
    }
