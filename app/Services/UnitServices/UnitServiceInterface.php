<?php

    namespace App\Services\UnitServices;

    use App\Models\Unit;

    interface UnitServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(Unit $unit, array $data);
        public function delete(Unit $unit);
    }
