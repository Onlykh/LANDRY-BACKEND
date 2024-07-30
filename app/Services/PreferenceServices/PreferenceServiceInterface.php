<?php

    namespace App\Services\PreferenceServices;

    use App\Models\Preference;

    interface PreferenceServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(Preference $preference, array $data);
        public function delete(Preference $preference);
    }
