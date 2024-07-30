<?php

    namespace App\Services\VersionServices;

    use App\Models\Version;

    interface VersionServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(Version $version, array $data);
        public function delete(Version $version);
    }
