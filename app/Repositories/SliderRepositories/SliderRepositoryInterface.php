<?php

    namespace App\Repositories\SliderRepositories;

    use App\Models\Slider;

    interface SliderRepositoryInterface {
        public function all($filters = []);
        public function findById($id, $with);
        public function create(array $data);
        public function update(Slider $slider, array $data);
        public function delete(Slider $slider);
    }
