<?php

    namespace App\Services\CategoryServices;

    use App\Models\Category;

    interface CategoryServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(Category $category, array $data);
        public function delete(Category $category);
    }
