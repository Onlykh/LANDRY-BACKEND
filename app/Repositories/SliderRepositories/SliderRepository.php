<?php

    namespace App\Repositories\SliderRepositories;

    use App\Models\Slider;
    use App\Repositories\SliderRepositories\SliderRepositoryInterface;

    class SliderRepository implements SliderRepositoryInterface {

        public function __construct(private Slider $slider)
        {
        }

        public function all($filters = [])
        {
            $slider = $this->slider->filter($filters);

            if (isset($filters['select'])) {
                $slider->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $slider->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $slider->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $slider->paginate($filters['page_size'] ?? 10)
                : $slider->get();
        }

        public function findById($id, $with)
        {
            return $this->slider->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->slider->create($data);
        }

        public function update(Slider $slider, array $data)
        {
            $slider->update($data);
            return $slider;
        }

        public function delete(Slider $slider)
        {
            $slider->delete();
        }
    }
