<?php

    namespace App\Services\SliderServices;

    use App\Models\Slider;

    interface SliderServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(Slider $slider, array $data);
        public function delete(Slider $slider);
    }
