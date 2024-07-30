<?php

    namespace App\Repositories\ServiceRepositories;

    use App\Models\Service;
    use App\Repositories\ServiceRepositories\ServiceRepositoryInterface;

    class ServiceRepository implements ServiceRepositoryInterface {

        public function __construct(private Service $service)
        {
        }

        public function all($filters = [])
        {
            $service = $this->service->filter($filters);

            if (isset($filters['select'])) {
                $service->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $service->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $service->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $service->paginate($filters['page_size'] ?? 10)
                : $service->get();
        }

        public function findById($id, $with)
        {
            return $this->service->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->service->create($data);
        }

        public function update(Service $service, array $data)
        {
            $service->update($data);
            return $service;
        }

        public function delete(Service $service)
        {
            $service->delete();
        }
    }
