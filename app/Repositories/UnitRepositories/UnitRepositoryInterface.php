<?php

    namespace App\Repositories\UnitRepositories;

    use App\Models\Unit;

    interface UnitRepositoryInterface {
        public function all($filters = []);
        public function findById($id, $with);
        public function create(array $data);
        public function update(Unit $unit, array $data);
        public function delete(Unit $unit);
    }
