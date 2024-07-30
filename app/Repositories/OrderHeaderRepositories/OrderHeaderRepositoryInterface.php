<?php

    namespace App\Repositories\OrderHeaderRepositories;

    use App\Models\OrderHeader;

    interface OrderHeaderRepositoryInterface {
        public function all($filters = []);
        public function findById($id, $with);
        public function create(array $data);
        public function update(OrderHeader $orderHeader, array $data);
        public function delete(OrderHeader $orderHeader);
    }
