<?php

namespace App\Services\ServiceServices;

use App\Services\ServiceServices\ServiceServiceInterface;
use App\Repositories\ServiceRepositories\ServiceRepository;
use App\Models\Service;

class ServiceService implements ServiceServiceInterface
{

    public function __construct(private ServiceRepository $serviceRepository)
    {
    }

    public function all($filters = [])
    {
        return $this->serviceRepository->all($filters);
    }

    public function findById($id, $with = [])
    {
        return $this->serviceRepository->findById($id, $with);
    }

    public function findByReference($reference, $with = [])
    {
        return $this->serviceRepository->findByReference($reference, $with);
    }

    public function create(array $data)
    {
        return $this->serviceRepository->create($data);
    }

    public function update(Service $service, array $data)
    {
        return $this->serviceRepository->update($service, $data);
    }

    public function delete(Service $service)
    {
        return $this->serviceRepository->delete($service);
    }
}
