<?php

    namespace App\Repositories\VersionRepositories;

    use App\Models\Version;

    interface VersionRepositoryInterface {
        public function all($filters = []);
        public function findById($id, $with);
        public function create(array $data);
        public function update(Version $version, array $data);
        public function delete(Version $version);
    }
