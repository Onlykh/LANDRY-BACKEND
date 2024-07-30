<?php

namespace App\Services\ServiceServices;

use App\Models\Service;

interface ServiceServiceInterface
{
    public function all($filters = []);
    public function findById($id, $with = []);
    public function create(array $data);
    public function update(Service $service, array $data);
    public function delete(Service $service);
}
