<?php

    namespace App\Services\OrderLineServices;

    use App\Models\OrderLine;

    interface OrderLineServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(OrderLine $orderLine, array $data);
        public function delete(OrderLine $orderLine);
    }
