<?php

    namespace App\Repositories\PreferenceRepositories;

    use App\Models\Preference;

    interface PreferenceRepositoryInterface {
        public function all($filters = []);
        public function findById($id, $with);
        public function create(array $data);
        public function update(Preference $preference, array $data);
        public function delete(Preference $preference);
    }
