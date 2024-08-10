<?php

namespace App\Services\UnitServices;

use App\Services\UnitServices\UnitServiceInterface;
use App\Repositories\UnitRepositories\UnitRepository;
use App\Models\Unit;

class UnitService implements UnitServiceInterface
{

    public function __construct(private UnitRepository $unitRepository) {}

    public function all($filters = [])
    {
        return $this->unitRepository->all($filters);
    }

    public function findById($id, $with = [])
    {
        return $this->unitRepository->findById($id, $with);
    }

    public function create(array $data)
    {
        return $this->unitRepository->create($data);
    }

    public function update(Unit $unit, array $data)
    {
        return $this->unitRepository->update($unit, $data);
    }

    public function delete(Unit $unit)
    {
        return $this->unitRepository->delete($unit);
    }
}
