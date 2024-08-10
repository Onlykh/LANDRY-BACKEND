<?php

namespace App\Services\SliderServices;

use App\Services\SliderServices\SliderServiceInterface;
use App\Repositories\SliderRepositories\SliderRepository;
use App\Models\Slider;

class SliderService implements SliderServiceInterface
{

    public function __construct(private SliderRepository $sliderRepository) {}

    public function all($filters = [])
    {
        return $this->sliderRepository->all($filters);
    }

    public function findById($id, $with = [])
    {
        return $this->sliderRepository->findById($id, $with);
    }

    public function create(array $data)
    {
        try {
            $filePath = uploadFile($data['image'], 'sliders');
            $data['image'] = $filePath;
            $slider = $this->sliderRepository->create($data);
            return $slider;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Slider $slider, array $data)
    {
        return $this->sliderRepository->update($slider, $data);
    }

    public function delete(Slider $slider)
    {
        return $this->sliderRepository->delete($slider);
    }
}
